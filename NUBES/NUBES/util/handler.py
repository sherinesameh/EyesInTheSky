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

import os

class Handler:
    """Object to analize the training folder."""

    def __init__(self,image_dir):
        """
        Instantiate an 'Handler' object.

        :param image_dir: The criminal's images path.
        :type image_dir: str
        :param MIN_NUM_IMAGES_PER_CLASS: The criminal's minmum number of images.
        :type MIN_NUM_IMAGES_PER_CLASS: int        
        """
        assert image_dir is not None


        self.image_dir = image_dir
        self.MIN_NUM_IMAGES_PER_CLASS = 24
    

    def NB_analyser(self):
        """
            check that the folder follows all the rules
            The images should be organized in subdirectories
            named by the image's class (who the person is)
        """

        #check input folder of images path
        if not os.path.lexists(self.image_dir):
            raise ValueError("Image directory '" + self.image_dir + "' not found.")

        #check that the folder is not empty
        if len(os.listdir(self.image_dir)) == 0:
            raise ValueError('No valid folders of images found at ' + self.image_dir) 

        #check that the root folder should at least contain 2 subfolders
        if len(os.listdir(self.image_dir)) < 2:
            raise ValueError('Only one valid folder of images found at ' + self.image_dir +' - multiple classes are needed for classification.')

        #check that each subfolder must contain at least 23 images
        for folder_name in os.listdir(self.image_dir):
        	
            if len(os.listdir(os.path.join(self.image_dir,folder_name))) < self.MIN_NUM_IMAGES_PER_CLASS:
                raise ValueError('WARNING: Folder ' + folder_name + ' has less than 23 images, which may cause issues.')  