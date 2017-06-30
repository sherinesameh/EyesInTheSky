<?php
  require_once '../models/actions.php';
  require_once '../models/uploadCriminal.php';
  require_once 'Socket.php';

  session_start();
  $actions = new Actions;

  if(!empty($_FILES['image'])){
		$ext = pathinfo($_FILES['image']['name'],PATHINFO_EXTENSION);
    $image = time().'.'.$ext;
    move_uploaded_file($_FILES['image']['tmp_name'], '../../public/assets/img/uploads/'.$image);
		echo 'Image uploaded successfully as '.$image;
	}else{
		echo 'Image Is Empty';
	}
  $criminal = new uploadCriminal($_FILES['file']);
  $filename = $criminal->upload();

  $Fname = $_POST['fname'];
  $Mname = $_POST['mname'];
  $Lname = $_POST['lname'];
  $date  = $_POST['expireDate'];
  $locations = $_POST['locations'];
  $priority = $_POST['priority'];

  echo $filename .'_'. $Fname .'_'. $Mname .'_'. $Lname .'_'. $date .'_'. $locations .'_'. $priority;

  $id = $_SESSION['id'];
  $username = $_SESSION['username'];

  $result= $actions->addCriminal($Fname, $Mname, $Lname, $priority, $date, $filename, $image, $id, $username);
  // if ($result) {
  // $socket = new Socket;
  // $socket->send($type,$locations);
  // }
  echo json_encode($result);
?>
