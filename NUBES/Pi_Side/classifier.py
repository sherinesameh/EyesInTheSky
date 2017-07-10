# Developed By 2017 Computer and Communication Department-Alexandria University graduation project team
#
# Email: EITS@gmail.com
#
# Authors: MOHAMED SHERIF,YAMEN EMAD, SHERINE SAMEH
#
# Copyright (c) EITS TEAM 2017 
# 
# Permission is hereby granted, free of charge, to any person obtaining a copy
# of this software and associated documentation files (the "Software"), to deal
# in the Software without restriction, including without limitation the rights
# to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
# copies of the Software, and to permit persons to whom the Software is
# furnished to do so, subject to the following conditions:
# 
# The above copyright notice and this permission notice shall be included in all
# copies or substantial portions of the Software.
# 
# THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
# IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
# FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
# AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
# LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
# OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
# SOFTWARE.
#=================================================================================
"""
   This module gets the SVM model recived from the Server and start the detection
   if the criminal has been found the goverment's portal will be notified
   that the wanted criminal was found and his location.

   This module support simultaneous criminal detection according to the recived
   SVM model data.

   all you have to do is to run run the trainer with a command like this:

   ```bash
          python NUBES/classifier.py \
          --classifier_model ~/classifier.pkl  \
          --network_model    ~/model.t7 \
          --verbose = True
   ```

"""

import argparse
import cv2
import os
import pickle
import sys
import numpy as np

from EITS import specs
from EITS.dbHandler import dbHandler
from NUBES.util.align_dlib import AlignDlib
from NUBES.openface.torch_neural_net import TorchNeuralNet



def load_classifier(ClassiferPath):
    """
    Load the SVM classifier model.

    :param ClassifierPath: Path tp SVM classifier
    return: SVM model(clf) and LabelEncoder(le).
    """    
    with open(ClassiferPath, 'r') as f:
         # le - label and clf - c 
        (le, clf) = pickle.load(f)  

    return(le, clf)



def getRep(bgrImg):
    """
    Prepare the captured frame and feed it 
    To the neural network.

    :param bgrImg: The captured frame
    return: 128-representations of the face.
    """       
    alignedFaces = []
    reps = []

    rgbImg = cv2.cvtColor(bgrImg, cv2.COLOR_BGR2RGB)
    # Get all bounding boxes
    bb = align.OPENCV_getAllFaceBoundingBoxes(rgbImg)
    if bb is None:
        # raise Exception("Unable to find a face: {}".format(imgPath))
        return []

    #align each face
    for box in bb:
        alignedFaces.append(align.align(FLAGS.size,rgbImg,box))

    #feed the each aligned face to the neural network
    #to caluclate the face representations
    for alignedFace in alignedFaces:
        reps.append(net.forward(alignedFace))


    return reps


def infer(img,le,clf):
    """
    Calls getREP() function and predict the returned
    128-reprsentations using the generated SVM model
    from Training.

    :param bgrImg: The captured frame
    return: 128-representations of the face.
    """     
    persons = []
    confidences = []

    reps = getRep(img)
    #if reps is empty it wont enter the loop
    for rep in reps:
        #change shape of (128,) to (1,128) 'as tarined'
        rep = rep.reshape(1, -1)
        #get propapility of predictions
        # 0     1
        #[0.2,0.99]
        predictions = clf.predict_proba(rep).ravel()
        #Take the [i] heighst prediction
        #[0.2,0.99]-->maxI= '1'
        maxI = np.argmax(predictions)
        #get the inverse of the LabelEncoder to get the crossponding label name
        persons.append(le.inverse_transform(maxI))
        #get the propapility of heighst prediction
        #[0.2,o.99]-->prediction[1]=0.99
        confidences.append(predictions[maxI])
        
    return (persons, confidences) 


if __name__ == '__main__':

    parser = argparse.ArgumentParser()

    parser.add_argument(
      '--classifier_model',
      type=str,
      default='/home/pi/Desktop/Pi_Side/generated-embeddings/classifier.pkl',
      help='Path to classifier folder.'
    )

    parser.add_argument(
      '--network_model',
      type=str,
      default='/home/pi/Desktop/Pi_Side/models/openface/nn4.v1.ascii.t7',
      help='Path to neural_network model folder.'
    ) 

    parser.add_argument(
      '--dlibFacePredictor',
      type=str,
      default='/home/pi/Desktop/Pi_Side/models/dlib/shape_predictor_68_face_landmarks.dat',
      help='path to dlib facemark detector classifier.'
    )

    parser.add_argument(
      '--threshold',
      type=float,
      default=0.90,
      help='The threshold for unkown person.'
    )  

    parser.add_argument(
      '--size',
      type=int,
      default=96,
      help='Default image size.'
    )  


    FLAGS, unparsed = parser.parse_known_args()
    
    
    #set the precision of the output
    #0.23445-->0.23
    np.set_printoptions(precision=2)
    #get the current mac to help get the pi's location
    pi_mac = specs.getMac()

    #create instance of aligment, database_Handler and neural network classes
    align = AlignDlib(FLAGS.dlibFacePredictor)
    net = TorchNeuralNet(FLAGS.network_model,imgDim=FLAGS.size)
    DB = dbHandler()

    #load the classifier
    le,clf = load_classifier(FLAGS.classifier_model)

    pi_location = DB.notifyLocation(pi_mac)
    print(pi_location)
    # Capture device. Usually 0 will be webcam and 1 will be usb cam.
    video_capture = cv2.VideoCapture(0)
    #set the width and height == resolution
    video_capture.set(3, 320)
    video_capture.set(4, 240)

    while True:
        ret, frame = video_capture.read()

        persons, confidences = infer(frame,le,clf)
        print ("P: " + str(persons) + " C: " + str(confidences))
#==================================================================================
#update the status of the detected criminal in database
#================================================================================== 

        for i, c in enumerate(confidences):
            #threshold for known face.
            if c >= FLAGS.threshold:
                #Notify the govermnt's portal that the criminal has been found
                #change the criminal's status and send the location were
                #the criminal has been detected
                DB.updateCriminalStatus(persons[i],pi_location)
                
#==================================================================================

