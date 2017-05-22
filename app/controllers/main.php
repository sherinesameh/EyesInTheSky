<?php 

#include the upload_crminal class
include("upload_crminal.php"); 
#create an object from upload_crminal class
$criminal = new upload_crminal($_FILES["zip_file"]);
#upload the selected file by user
$criminal->upload();

require("Socket.php");
$socket = new mySocket;

 ?>