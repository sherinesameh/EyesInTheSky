<?php

if (isset($_FILES['file_array'])) {
	echo "tmam";
	$name_array = $_FILES['file_array']['name'];
	$temp_array = $_FILES['file_array']['tmp_name'];
	$type_array = $_FILES['file_array']['type'];
	$size_array = $_FILES['file_array']['size'];
	$error_array = $_FILES['file_array']['error'];

	// Create directory if it does not exist
/*if(!is_dir("Proposals/". $_SESSION["FirstName"] ."/")) {
    mkdir("Proposals/". $_SESSION["FirstName"] ."/");
}*/

//	Create directory if it does not exist
if(!is_dir("../../test_uploads/")) {
	echo "directory doesn't exist <br>";
	$oldmask = umask(0);
mkdir("../../test_uploads/", 0777);
umask($oldmask);
}
echo "3dad ".count($name_array)." <br>";

$check_docker = 0;

	for ($i=0; $i < count($name_array); $i++) {
		if (move_uploaded_file($temp_array[$i], "../../test_uploads/".$name_array[$i])) {
			if (!strcmp($name_array[$i], "Dockerfile")) {
				$check_docker = $check_docker + 1;
			}

			echo $name_array[$i]." upload is complete<br>";
		}else{
			echo $name_array[$i]." upload failed<br>";
		}
		chmod("../../test_uploads/".$name_array[$i], 0777);
	}
	echo "$check_docker = ".$check_docker."<br>";

	if ($check_docker == 0) {
		echo "no Dockerfile exist <br>";
	}elseif ($check_docker > 1) {
		echo "there is more than one Dockerfile <br>";
	}else
	{
		echo "correct dockerfile <br>";
 		$dockerfile= "/opt/lampp/htdocs/EyesInTheSky/uploads";
 		exec("python ../models/rundocker.py $dockerfile");

 	}


}








  ?>
