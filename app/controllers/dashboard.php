<?php
  require_once '../models/dashboard.php';
  require_once '../models/user.php';
  session_start();
  $user = new User;
  $model = new Dashboard;

  $request = $_POST['request'];
  switch ($request) {
    case "getUserInfo":
      $email = $_SESSION['Email'];
      $result= $user->getUserInfo($email);
  		echo json_encode($result);
      break;
    case "getAdminsLog":
      $result= $model->getAdminsLog();
      echo json_encode($result);
      break;
    case "getRpSpecs":
      $result= $model->getRpSpecs();
      echo json_encode($result);
      break;
    case "getRunningProcesses":
      $result= $model->getRunningProcesses();
      echo json_encode($result);
      break;
    default:
      echo "404 Error";
  }
?>
