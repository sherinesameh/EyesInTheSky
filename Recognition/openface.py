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
#
import cv2
import os
from queue import Queue
import FaceRecognition

class OpenFace(object):

  def __init__(self):
    #Output directory to save image in
    self.path_output_dir = "/home/pi/Desktop/test"
    #Initiate face cascade classifier
    self.face_cascade   = cv2.CascadeClassifier("/home/pi/opencv-3.1.0/data/haarcascades/haarcascade_frontalface_default.xml")
    #Initiate the counter to prevent overwriting of images
    self.count = 0


  def Detect_Faces(self,cap,recognizer,label,q):

    images=[]
    #while camera is opened
    while cap.isOpened():

      success,image= cap.read()

      if success:
        #Convert image from RGB to GrayScale
        gray = cv2.cvtColor(image, cv2.COLOR_BGR2GRAY)
        #Detect faces in each frame
        faces = self.face_cascade.detectMultiScale(gray,scaleFactor=1.4,minNeighbors=5,minSize=(60, 60))
        
        for (x,y,w,h) in faces:

          #Croped face from frame
          detected_face = image[y:y+h, x:x+w]
          #Save the cropped face to the given path
          cv2.imwrite(os.path.join(self.path_output_dir, '%d.jpg') % self.count, detected_face)
          #put detected face in a queue
          q.put(self.path_output_dir + "/%d.jpg"%self.count)
          #Change image name
          self.count +=1
          #while path_output_dir is not empty    
          while not q.empty():
            #empty queue in a list
            images.append(q.get())
            
        #Recognize the detected faces
        recognizer.recognize(label,images)
 

  
def main():
  ###
  print("starting...")
  #Initiate a queue
  q = Queue()
  #Open web cam
  cap = cv2.VideoCapture(0)
  #Create an object from class Get_faces
  recognizer = FaceRecognition.Get_Faces()
  #Import the labels
  label = recognizer.Get_Labels()
  #Initiate the graph
  graph = recognizer.Create_Graph()
  #Initiate an object from class OpenFace
  detector = OpenFace()
  ###
  print("started successfully")
  #Detect and recognize faces
  detector.Detect_Faces(cap,recognizer,label,q)


if __name__ == '__main__':
  main()
