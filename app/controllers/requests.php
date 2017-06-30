<?php
  require_once '../models/dashboard.php';
  require_once '../models/user.php';
  require_once 'Socket.php';

  session_start();
  $user = new User;
  $model = new Dashboard;
  // $socket = new Socket;
  $email = $_SESSION['Email'];
  $params = json_decode(file_get_contents("php://input"));
  $request = $params->request;
  switch ($request) {
    case "checkSession":
      if(isset($_SESSION['Email']))
        echo json_encode('success');
      break;
    case "getUserInfo":
      $result= $user->getUserInfo($email);
      echo json_encode($result);
      break;
    case "getRpProcesses":
      $mac = $params->mac;
      $result= $model->getRpProcesses($mac);
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
    case 'killProcess':
        $mac = $params->mac;
        $contID = $params->contID;
        // $socket->kill($mac,$contID);
        break;
    case 'shutPi':
        $mac = $params->mac;
        // $socket->shutDown($mac);
        break;
    case 'restartPi':
        $mac = $params->mac;
        // $socket->restart($mac);
        break;
    default:
      echo json_encode('404 Error');
      break;
  }
?>
