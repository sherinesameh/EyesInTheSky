<?php 

#include the upload_crminal class
include("upload_criminal.php"); 
#create an object from upload_crminal class
$criminal = new upload_criminal($_FILES["zip_file"]);
#upload the selected file by user
$criminal->upload();


 ?>