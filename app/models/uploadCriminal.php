<?php

class uploadCriminal
{
	/*
    This class is used to upload the creminals folders to
    Train them through inception neural network
  */
	function __construct($file)
	{
		/* Initiating the class constructor */
		$this->filename = $file["name"]; //file name uploaded by user
		$this->size     = $file['size']; //file size
		$this->source   = $file["tmp_name"]; //file source
		$this->type     = $file["type"]; //file type
    $this->path     = '/opt/lampp/htdocs/TF_FILES/criminals/'; //path that the file will be saved at
	}
	function check_zip()
	{
		/* Function to check if the uploaded file is a .zip file */
    $name = explode('.', $this->filename);
    if ($name[1]!='zip') {
      return 'False';
    }
	}
  function unZip()
  {
		/* Function to unzip the uploaded file */
  	$zip = new ZipArchive;
      $res = $zip->open($this->source);

      if ($res === TRUE) {
          $zip->extractTo($this->path);
          $zip->close();
          echo 'extraction successful <br/>';
      }
      else {
        echo 'extraction error';
      }
  }
  function upload()
  {
		/* The main function that upload and unzip the file */
	  if ($this->filename=='') {
	    //check if user did not submit an empty request
	    echo "There was a problem with the upload. Please try again.";
    }
    elseif ($this->check_zip() == 'False') {
    	echo"The file you are trying to upload is not a .zip file Please try again.";
    }
    else {
			echo "The upload is successful <br />";
			echo "File Size :".$this->size." <br />";
			$result = $this->unZip();
    }
  }
}
?>
