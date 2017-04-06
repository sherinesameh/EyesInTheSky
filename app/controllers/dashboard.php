<?php
  require_once '../models/dashboard.php';
  require_once '../models/user.php';
  session_start();
  $user = new User;
  $model = new Dashboard;
  $params = json_decode(file_get_contents("php://input"));
  $request = $params->request;
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
      echo json_encode('404 Error');
      break;
  }
?>
