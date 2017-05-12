<?php
require_once '../models/user.php';
session_start();
$user = new User;
$email = $_SESSION['Email'];
$params = json_decode(file_get_contents("php://input"));
$request = $params->request;

switch ($request) {
    case "checkSession":
      if(isset($_SESSION['Email']))
        echo json_encode('success');
      break;
    case "getProfile":
      $result = $user->getProfile($email);
      echo json_encode($result);
      break;
    // case "updateProfile":
    //     $result = $user->updateProfile();
    //     echo json_encode($result);
    //     break;
    // case "getLog":
    //     $result = $user->getLog();
    //     echo json_encode($result);
    //     break;
    default:
      break;
  }
?>
