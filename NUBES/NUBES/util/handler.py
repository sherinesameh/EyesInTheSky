import os

class Handler:
    """Object containing image metadata."""

    def __init__(self,image_dir):
        """
        Instantiate an 'Image' object.

        :param cls: The image's class; the name of the person.
        :type cls: str
        :param name: The image's name.
        :type name: str
        :param path: Path to the image on disk.
        :type path: str
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
            
            if folder_name is str:
                raise ValueError('WARNING: Folder name has to be an ID of the criminal not his name.')

            else:     
                if len(os.listdir(os.path.join(self.image_dir,folder_name))) < self.MIN_NUM_IMAGES_PER_CLASS:
                    raise ValueError('WARNING: Folder ' + folder_name + ' has less than 23 images, which may cause issues.')  