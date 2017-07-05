<?php

  require_once '../models/dashboard.php';
  require_once '../models/user.php';
  require_once 'Socket.php';

  $model = new Dashboard;
  $socket = new Socket;
  session_start();
  $fname = $_POST['fname'];
  $lname = $_POST['lname'];
  $username = $_POST['username'];
  $password  = $_POST['password'];
  $email = $_POST['email'];
  if(!empty($_FILES['image'])){
    $ext = pathinfo($_FILES['image']['name'],PATHINFO_EXTENSION);
    $image = time().'.'.$ext;
    move_uploaded_file($_FILES['image']['tmp_name'], "../../public/assets/img/uploads/".$image);
    echo 'Image uploaded successfully as '.$image;
  } else {
    echo 'Image Is Empty';
    $image = 'PPGray.png';
  }
  $result= $model->addGov($fname, $lname, $username, $password, $email, $image);

  echo json_encode($result);
?>
