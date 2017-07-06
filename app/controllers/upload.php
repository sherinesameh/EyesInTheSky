<?php
require("socket.php");
require("../models/user.php");
$user = new User;
$socket = new Socket;
session_start();
$id = $_SESSION['Id'];

$processName =$_POST['processName'];

if (isset($_FILES['dockerfile'])) {
	$name_array = $_FILES['dockerfile']['name'];
	$temp_array = $_FILES['dockerfile']['tmp_name'];
	$type_array = $_FILES['dockerfile']['type'];
	$size_array = $_FILES['dockerfile']['size'];
	$error_array = $_FILES['dockerfile']['error'];

	$check_docker = 0;
		if (!strcmp($name_array, "Dockerfile")) {
				$check_docker = $check_docker + 1;
			}

	if ($check_docker == 0) {
				echo json_encode("1");
		}  else {
			##make directory 

			$date = date("Y-m-d_h:i:s");
            $filename = $date."_".$id."_".$processName;
			$oldmask = umask(0);
	        mkdir("../../uploads/".$filename."/", 0777);
	        umask($oldmask);

	        $directory = "../../uploads/".$filename."/";
	        #put files in the directory   
			
				if (move_uploaded_file($temp_array, $directory.$name_array)) {
					chmod($directory.$name_array, 0777);
				}
			

		    #send to server
			$user->addProcessInprogress($id,$processName);
			$path= "/opt/lampp/htdocs/Users/uploads/".$filename;
			$socket->send($path,$processName,$id);
			echo json_encode("3");

		}

		
	}
?>
