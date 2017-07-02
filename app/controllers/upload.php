<?php
require("socket.php");
require("../models/user.php");
// $socket = new Socket;
$user = new User;

$processName = $_POST['processName'];
echo $_FILES['dockerfile']['name'];
if (isset($_FILES['dockerfile'])) {
	$name_array = $_FILES['dockerfile']['name'];
	$temp_array = $_FILES['dockerfile']['tmp_name'];
	$type_array = $_FILES['dockerfile']['type'];
	$size_array = $_FILES['dockerfile']['size'];
	$error_array = $_FILES['dockerfile']['error'];

	if(!is_dir("../../test_uploads/")) {
		$oldmask = umask(0);
	mkdir("../../test_uploads/", 0777);
	umask($oldmask);
	}
	$check_docker = 0;
		for ($i=0; $i < count($name_array); $i++) {
			if (move_uploaded_file($temp_array[$i], "../../test_uploads/".$name_array[$i])) {
				if (!strcmp($name_array[$i], "Dockerfile")) {
					$check_docker = $check_docker + 1;
				}
			}
			chmod("../../test_uploads/".$name_array[$i], 0777);
		}
		if ($check_docker == 0) {
				echo "no Dockerfile exist <br>";
		} elseif ($check_docker > 1) {
				echo "there is more than one Dockerfile <br>";
		} else {
				$name = "webServer";
				$id  = 1;
				$path= "/opt/lampp/htdocs/Users/test_uploads";
				$socket->send($path);
				$socket->receive();
		}
	}
?>
