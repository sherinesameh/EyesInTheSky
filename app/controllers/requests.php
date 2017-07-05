<?php
  require_once '../models/dashboard.php';
  require_once '../models/user.php';
  require_once 'Socket.php';

  session_start();
  $user = new User;
  $model = new Dashboard;
  $email = $_SESSION['Email'];
  $params = json_decode(file_get_contents('php://input'));
  $request = $params->request;
  switch ($request) {
    case 'checkSession':
      if(isset($_SESSION['Email']))
        echo json_encode('success');
      break;
    case 'deleteAdmin':
       $id = $params->id;
       $model->deleteAdmin($id);
       break;
    case 'deleteGov':
       $id = $params->id;
       $username = $params->username;
       $result = $model->deleteGov($id,$username);
       echo json_encode($result);
       break;
    case 'getUserInfo':
      $result= $user->getUserInfo($email);
      echo json_encode($result);
      break;
    case 'getRpProcesses':
      $mac = $params->mac;
      $result= $model->getRpProcesses($mac);
      echo json_encode($result);
      break;
    case 'getAdminsLog':
      $result= $model->getAdminsLog();
      echo json_encode($result);
      break;
    case 'getAdmins':
      $result= $model->getAdmins();
      echo json_encode($result);
      break;
    case 'getGovs':
      $result= $model->getGovs();
      echo json_encode($result);
      break;
    case 'updateAdmin':
        $id = $params->id;
        $newPassword = $params->pass;
        $model->updateAdmin($id,$newPassword);
        break;
    case 'updateGov':
        $id = $params->id;
        $newPassword = $params->password;
        $username = $params->username;
        $result = $model->updateGov($id, $newPassword, $username);
        echo json_encode($result);
        break;
    case 'getRpSpecs':
      $result= $model->getRpSpecs();
      echo json_encode($result);
      break;
    case 'getRunningProcesses':
      $result= $model->getRunningProcesses();
      echo json_encode($result);
      break;
    case 'killProcess':
        $mac = $params->mac;
        $contID = $params->contID;
        $model->killProcess($mac,$contID);
        $socket = new Socket;
        $socket->kill($mac,$contID);
        break;
    case 'shutdownPi':
        $mac = $params->mac;
        $socket = new Socket;
        $socket->shutDown($mac);
        break;
    case 'restartPi':
        $mac = $params->mac;
        $socket = new Socket;
        $socket->restart($mac);
        break;
    default:
      echo json_encode('404 Error');
      break;
  }
?>
