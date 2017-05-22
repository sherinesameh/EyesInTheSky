<?php

#include the upload_crminal class
include("uploadCriminal.php");
#create an object from upload_crminal class
$params = json_decode(file_get_contents("php://input"));
$request = $params->request;

$criminal = new uploadCriminal($_FILES["zip_file"]);
#upload the selected file by user
$criminal->upload();

 ?>
