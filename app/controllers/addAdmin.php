<?php

  require_once '../models/dashboard.php';
  require_once '../models/user.php';
  require_once 'Socket.php';

  $user = new User;
  $model = new Dashboard;
  
  if(!empty($_FILES['image'])){
		$ext = pathinfo($_FILES['image']['name'],PATHINFO_EXTENSION);
    $image = time().'.'.$ext;
    move_uploaded_file($_FILES['image']['tmp_name'], '../../public/assets/img/uploads/'.$image);
		echo 'Image uploaded successfully as '.$image;
	}else{
		echo 'Image Is Empty';
	}

  $username = $_POST['username'];
  $Fname = $_POST['fname'];
  $Lname = $_POST['lname'];
  $email = $_POST['email'];
  $password  = $_POST['password'];
  $phone = $_POST['phoneNumber'];


  $result= $user->addAdmin($Fname, $Lname, $username, $password, $email , $phone, $image );
  // if ($result) {
  // $socket = new Socket;
  // $socket->send($type,$locations);
  // }
  echo json_encode($result);
?>
