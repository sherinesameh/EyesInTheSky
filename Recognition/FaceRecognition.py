
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
import tensorflow as tf, sys
import os
from time import time

class Get_Faces(object):

  def __init__(self):
    #getting images from folder
    #self.listing = os.listdir('/home/pi/tf_files/test')
    #getting the retrained labels
    self.retrained_labels_path = "/home/pi/tf_files/retrained_labels.txt"
    #getting the retrained graph
    self.retrained_graph_path  = "/home/pi/tf_files/retrained_graph.pb"
  

  def Get_Labels(self):
    #Loads label file, strips off carriage return
    label_lines = [line.rstrip() for line 
                  in tf.gfile.GFile(self.retrained_labels_path)]
    return label_lines

  def Create_Graph(self):
    #Unpersists graph from file
    with tf.gfile.FastGFile(self.retrained_graph_path, 'rb') as f:
      graph_def = tf.GraphDef()
      graph_def.ParseFromString(f.read())
      _ = tf.import_graph_def(graph_def, name='')

  def recognize(self,label_lines,images):
    with tf.Session() as sess:
      # Feed the image_data as input to the graph and get first prediction
      softmax_tensor = sess.graph.get_tensor_by_name('final_result:0')

      listing = images 
      #file==image
      for file in listing:
        #path for each image
        #image_path = '/home/pi/Desktop/test/'+file
        #Read in the image_data
        image_data = tf.gfile.FastGFile(file, 'rb').read()
        #Start timer to see time taken to predict a person
        timer = time()
        #Get predictions
        predictions = sess.run(softmax_tensor, \
             {'DecodeJpeg/contents:0': image_data})
    
        # Sort to show labels of first prediction in order of confidence
        top_k = predictions[0].argsort()[-len(predictions[0]):][::-1]  
        #heighest score person
        result = top_k[0]

        #if score < 0.5-->unknown object
        if predictions[0][result] < 0.5:

          print("unknown person")
          #print time taken to recognize a person in seconds
          print(round(time()-timer,3),"s")
          #print cpu temp
          print (os.popen('vcgencmd measure_temp').readline())
          #remove the classified image from path
          #os.remove(image_path)

        else:

          #get the top prediction with the highest score,then print the name
          print("the result of recognition :" ,label_lines[result])
          #print time taken to recognize a person in seconds
          print(round(time()-timer,3),"s")
          #print cpu temp
          print (os.popen('vcgencmd measure_temp').readline())
          #remove the classified image from path
          #os.remove(image_path)
