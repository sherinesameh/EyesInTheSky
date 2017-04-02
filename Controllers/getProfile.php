<?php

require("dbControllers.php");

         // $flag =$_POST['flag'];

$flag = 2;


if ($flag == 1) {
          	//government required
	

          	//$id = $_POST['id'];
	$id = 1;
	$dboperation = new DbOperation;
	$result= $dboperation->getGovProfile($id);
	echo json_encode($result);

          	# code...
}

else {

          	//$id = $_POST['id'];
	$crim_id = 5;
	$ dboperation = new DbOperation;
	$result= $dboperation->getCrimProfile($crim_id);
	echo json_encode($result);

}
?>