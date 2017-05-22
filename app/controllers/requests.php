<?php
require_once '../models/user.php';
require_once '../models/actions.php';
session_start();
$user = new User;
$actions = new Actions;
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
    case "getLog":
        $result = $actions->getLog();
        echo json_encode($result);
        break;
    case "search":
        $result = $actions->getAllCriminals();
        echo json_encode($result);
        break;
    case "addCriminal":
        $Fname = $params->Fname;
        $Mname = $params->Mname;
        $Lname = $params->Lname;
        $priority = $params->priority;
        $date  = $params->expireDate;
        $path  = $params->path;
        $image = $params->image;
        $id = $_SESSION['id'];
        $username = $_SESSION['username'];
        $result= $actions->addCriminal($Fname, $Mname, $Lname, $priority, $date, $path, $image, $id, $username);
        echo json_encode($result);
        break;
    case "deleteCriminal":
      // $criminalID = $params->criminalID;
      // $govID= $_SESSION['id'];
      // $username = $_SESSION['username'];
      // $result= $actions->deleteCriminal($criminalID, $govID,$username);
      // echo json_encode($result);
      break;
    default:
      echo "unkown action";
      break;
  }
?>
