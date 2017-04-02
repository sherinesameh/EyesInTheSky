<?php

require("dbControllers.php");

         // $flag =$_POST['flag'];

$flag = 2;
$username= 'farida94';
$fname = 'yamenn';
$lname= 'menisy';
$email= 'farida@gmail.com';
$password= '123123';
$image='test.png';
$priority= 10194;


$Mname='ahmed';
$email='ahmed@gmail.com';
$Fname='hany';
$Lname= 'wagih';
$priority=10794;
$image='test.png';
$expiry_date= 2;




if ($flag == 1) {
    //government required
	

    //$id = $_POST['id'];
	$id = 1;
	$dboperation = new DbOperation;
	$result= $dboperation->updateProf($username,$fname,$lname,$email,$password,$priority ,$image,$id);
	echo $result;

}

else { //ENTA LW CriminAl 

          	//$id = $_POST['id'];
	$crim_id = 5;
	$dboperation = new DbOperation;
	$result= $dboperation->updateCrim($Mname, $Fname , $Lname , $priority , $expiry_date ,  $image , $crim_id);
	echo $result;

}
?>