<?php  

class upload_criminal
{   
		/*
	    This class is used to upload the creminals folders to
	    Train them through inception neural network
	    */
	
	function __construct($file)
	    /*
	    Initiating the class constructor
	    */
	{
		$this->filename = $file["name"]; //file name uploaded by user
		$this->size     = $file['size'];//file size
		$this->source   = $file["tmp_name"];//file source
		$this->type     = $file["type"];//file type
        // $this->path     = '~/Desktop/RemoteShell/TF_FILES/criminals/';//path that the file will be saved at
	 $this->path     = '/opt/lampp/htdocs/sherif/TF_FILES/criminals/';//path that the file will be saved at
    
    }

	function check_zip()
		/*
	    Function to check if the uploaded file is a .zip file
	    */
	{   
        $name = explode('.', $this->filename);
        if ($name[1]!='zip') {
            return 'False';
            }     
	}
    
    function unZip()
    	/*
	    Function to unzip the uploaded file
	    */
    {
    	$zip = new ZipArchive;
        $res = $zip->open($this->source);
        if ($res === TRUE) {
            $zip->extractTo($this->path);

            $zip->close();
                    $name = explode('.', $this->filename);
                    $filename = $this->path . $name[0];

            chmod($filename, 0777);
            $command = 'chmod 777 '  . $filename .'/*';
            exec($command);
            // echo $this->filename.'_'.date("Y-m-d_H:i:s");
            return $this->filename;
        } 
        else {
          echo 'extraction error';
        }

    }

    function upload()
    	/*
	    The main function that upload and unzip the file
	    */
    {   if ($this->filename=='') {
    	    //check if user did not submit an empty request
    	    echo "There was a problem with the upload. Please try again.";
        }
        elseif ($this->check_zip() == 'False') {
        	echo"The file you are trying to upload is not a .zip file Please try again.";
        }
        else {
    	$result = $this->unZip();
        return $result;
        }
    }
    
}


?>