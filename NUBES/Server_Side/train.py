"""Functions for building the face recognition system.
"""
#Developed By 2017 Computer and Communication Department-Alexandria University graduation project team
# 
# Copyright (c) 2017 MOHAMED SHERIF
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


import os
import errno
import argparse
import subprocess
import random
import time
import cv2
import pickle
import pandas as pd

from NUBES.python  import app
from NUBES.util.align_dlib import AlignDlib
from NUBES.util.data  import iterImgs
from NUBES.util.handler import Handler

from operator import itemgetter
from sklearn.preprocessing import LabelEncoder
from sklearn.svm import SVC


def mkdirP(path):
    """
    Create a directory and don't error if the path already exists.

    If the directory already exists, don't do anything.

    :param path: The directory to create.
    :type path: str
    """
    assert path is not None

    try:
        os.makedirs(path)
    except OSError as exc:  # Python >2.5
        if exc.errno == errno.EEXIST and os.path.isdir(path):
            pass
        else:
            raise

def save_Classifier(le,clf):
	
	#save the Linear svm classifier in .pkl format
    fName = "{}/classifier.pkl".format(FLAGS.working_dir)
    with open(fName, 'w') as f:
        pickle.dump((le, clf), f)


def alignMain(align,landmarkIndices,ErrorHandler):
    """
    perform face aligment according to one of 2 landmarkIndcies
              
    outerEyesAndNose
    innerEyesAndBottomLip
              
    after aligment is done this function save the aligment images and call
    Graph class to produce a numpy representation of the aligment images
    """

    FallOut=0
    ErrorHandler.NB_analyser()

    #make directory
    mkdirP(FLAGS.output_dir)
    start = time.time()
    #return object [FolderName(cls),ImageName(name),Path(path)]
    imgs = list(iterImgs(FLAGS.image_dir))

    # Shuffle so multiple versions can be run at once.
    random.shuffle(imgs)


    for imgObject in imgs:

        #get image path
        print("=== {} ===".format(imgObject.path))
        #get image folder
        outDir = os.path.join(FLAGS.output_dir, imgObject.cls)

        #make a directory in the output_dir with image folder name
        #$ tree directory
        #person-1
        mkdirP(outDir)

        outputPrefix = os.path.join(outDir, imgObject.name)
        #image name to be saved on the disk later after aligment
        imgName = outputPrefix + ".png"

        if os.path.isfile(imgName):
            if FLAGS.verbose:
                print("  + Already found, skipping.")
        else:

            rgb = imgObject.getRGB()

            if rgb is None and FLAGS.verbose:
                print("  + Unable to load.")
                outRgb = None

            else:
                #align the input image
                outRgb = align.align(FLAGS.size, rgb,landmarkIndices=landmarkIndices)

                if outRgb is None:
                    if FLAGS.verbose:
                        print("  + Unable to align.")

                    FallOut+=1
                else:

                    if FLAGS.verbose:
                        print("  + Writing aligned file to disk.")
                    
                    #convert from RGB to BGR
                    outBgr = cv2.cvtColor(outRgb, cv2.COLOR_RGB2BGR)
                    #cv2.imwrite('/home/sherif/desktop/test',image to be saved)
                    cv2.imwrite(imgName, outBgr)
                    

    if FLAGS.verbose:
    	print(" ++ Face aligment completed")
    	print(" ---Aligment took {} seconds.".format(time.time() - start))
        print("=== Number of unAligmented images = {} ===".format(FallOut))


def Main():
    
    landmarkMap = {
        'outerEyesAndNose': [36, 45, 33],
        'innerEyesAndBottomLip': [39, 42, 57]
    }

    if FLAGS.landmarks not in landmarkMap:
        raise Exception("Landmarks unrecognized: {}".format(FLAGS.landmarks))

    landmarkIndices = landmarkMap[FLAGS.landmarks]

    ErrorHandler = Handler(FLAGS.image_dir)
    #setting the aligment class with the predictor model for dlib face LandMarks detector
    align = AlignDlib(FLAGS.dlibFacePredictor)

    AlignFaces = alignMain(align,landmarkIndices,ErrorHandler) 

    if FLAGS.verbose:
        print('********Caluculating The 128-Features Of Face..')
    
    start = time.time()
    results = subprocess.check_output(['./batch-represent/main.lua',
    	                               '-outDir','./generated-embeddings/',
                                       '-data','./aligned-images/']) 
    if FLAGS.verbose:                                    
        print(results)
        print("  +Geting face representations took {} seconds.".format(time.time() - start))
        print('********Training The Classifier..')
    
    start = time.time()
    #load labels.csv
    fname = "{}/labels.csv".format(FLAGS.working_dir)
    #load all rows colum 1
    labels = pd.read_csv(fname, header=None).as_matrix()[:, 1]
    #split labels from path
    #exampele: /home/Desktop/sherif-->label= 'sherif'
    labels = map(itemgetter(1),map(os.path.split,map(os.path.dirname, labels))) 

    #load reps.csv
    fname = "{}/reps.csv".format(FLAGS.working_dir)
    #load all rows and columns
    Features = pd.read_csv(fname, header=None).as_matrix()


    #Encode labels with value between 0 and n_classes-1.
    #Exampele: sherif=0 ; farida =1
    le = LabelEncoder().fit(labels)
    labelsNum = le.transform(labels)

    #number of unique labels
    nClasses = len(le.classes_)
    if FLAGS.verbose:
        print("  + Training for {} classes.".format(nClasses))

    #Linear svm classifier
    clf = SVC(C=1, kernel='linear', probability=True)
    clf.fit(Features, labelsNum)

    save_Classifier(le,clf)
    if FLAGS.verbose:
    	print("  +Training The Classifier Took {} seconds.".format(time.time() - start))
    
    print('=== THE CLASSIFIER IS READY TO BE SENT TO EITS SYSTEM ===')     	 


if __name__ == '__main__':

    parser = argparse.ArgumentParser()

    parser.add_argument(
      '--image_dir',
      type=str,
      default='/home/sherif/Desktop/test',
      help='Path to folders of training images.'
    )

    parser.add_argument(
      '--output_dir',
      type=str,
      default='/home/sherif/Desktop/packagetest/aligned-images',
      help='Output directory of aligned images.'
    ) 

    parser.add_argument(
      '--working_dir',
      type=str,
      default='/home/sherif/Desktop/packagetest/generated-embeddings',
      help='Where to save the trained model.'
    )

    parser.add_argument(
      '--dlibFacePredictor',
      type=str,
      default='/home/sherif/Desktop/packagetest/models/dlib/shape_predictor_68_face_landmarks.dat',
      help='path to dlib HGO classifier.'
    )

    parser.add_argument(
      '--landmarks',
      type=str,
      default='outerEyesAndNose',
      help='The landmarks to align to.'
    )  

    parser.add_argument(
      '--size',
      type=int,
      default=96,
      help='Default image size.'
    )  

    parser.add_argument(
      '--verbose',
      type=str,
      default='',
      help='debugg error messages.'
    ) 

    FLAGS, unparsed = parser.parse_known_args()
    
    app.run(main=Main)