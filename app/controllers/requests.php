<?php
require_once '../models/user.php';
require_once '../models/actions.php';
require_once '../models/uploadCriminal.php';
require_once 'Socket.php';

session_start();
$user = new User;
$actions = new Actions;
// $socket = new Socket;
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
    case "getAllCriminals":
        $result = $actions->getAllCriminals();
        for ($i=0; $i < sizeof($result); $i++) {
          if ($result[$i]["State"] === 20202) {
            $actions->updateExpired($result[$i]["Crim_id"]);
            // $socket->send(1,$locations);
          }
        }
        echo json_encode($result);
        break;
    case 'getLocations':
          $result = $actions->getLocations();
          echo json_encode($result);
          break;
    case "deleteCriminal":
      $criminalID = $params->criminalID;
      $filename = $params->filename;
      $govID= $_SESSION['id'];
      $username = $_SESSION['username'];
      system("rm -rf ".escapeshellarg($filename));
      $result= $actions->deleteCriminal($criminalID, $govID,$username);
       if ($result) {
          // $socket->send('general',null);
        }
      echo json_encode($result);
      break;
    default:
      echo "unkown action";
      break;
  }


?>
