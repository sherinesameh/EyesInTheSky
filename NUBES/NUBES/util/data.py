# coding=utf8
#
# Copyright 2015-2016 Carnegie Mellon University
#
# Licensed under the Apache License, Version 2.0 (the "License");
# you may not use this file except in compliance with the License.
# You may obtain a copy of the License at
#
#     http://www.apache.org/licenses/LICENSE-2.0
#
# Unless required by applicable law or agreed to in writing, software
# distributed under the License is distributed on an "AS IS" BASIS,
# WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
# See the License for the specific language governing permissions and
# limitations under the License.

import os
import cv2


class Image:
    """Object containing image metadata."""

    def __init__(self, cls, name, path):
        """
        Instantiate an 'Image' object.

        :param cls: The image's class; the name of the person.
        :type cls: str
        :param name: The image's name.
        :type name: str
        :param path: Path to the image on disk.
        :type path: str
        """
        assert cls is not None
        assert name is not None
        assert path is not None

        self.cls = cls
        self.name = name
        self.path = path

    def LoadImage(self):
        """
        Load the image from disk in BGR format.

        :return: BGR image. Shape: (height, width, 3)
        :rtype: numpy.ndarray
        """
        try:
            bgr_image = cv2.imread(self.path)
        except:
            bgr_image = None

        return bgr_image

    def getRGB(self):
        """
        Load the image from disk in RGB format.

        :return: RGB image. Shape: (height, width, 3)
        :rtype: numpy.ndarray
        """
        image = self.LoadImage()
        if image is not None:
            rgb = cv2.cvtColor(image, cv2.COLOR_BGR2RGB)
        else:
            rgb = None
        return rgb


def iterImgs(directory):
    """
    Iterate through the images in a directory.

    The images should be organized in subdirectories
    named by the image's class (who the person is)::


    :param directory: The directory to iterate through.
    :type directory: str
    :return: An iterator over Image objects.
    """
    assert directory is not None

    exts = [".jpg", ".jpeg", ".png"]

    #loop over each image folder in the Input_Image directory
    for subdir, dirs, files in os.walk(directory):
        #for each image in the image Folder
        for file in files:
            #get image Folder name and image name
            #The os.path.basename(path) function returns the tail of the path.
            #E.g.: The basename of '/foo/bar/item' returns 'item
            (imageClass, fName) = (os.path.basename(subdir), file)
            #get the extenstion of each image in the folder 
            #imageName = image name without extention
            #Split the pathname path into a pair (root, extention)
            #E.g.: The basename of 'EITS.jpg' returns '(EITS,jpg)'
            (imageName, ext) = os.path.splitext(fName)
            #if extenstion match
            try:
                if ext.lower() in exts:
                    yield Image(imageClass, imageName, os.path.join(subdir, fName))
            except Exception as e:
                raise ValueError('unsupport image format, trained images must be [".jpg", ".jpeg", ".png"].')
