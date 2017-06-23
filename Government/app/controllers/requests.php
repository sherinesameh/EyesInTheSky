<?php
require_once '../models/user.php';
require_once '../models/actions.php';
require_once 'upload_criminal.php';
require("Socket.php");

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
    case 'getLocations':
          $result = $actions->getLocations();
          echo json_encode($result);
          break;    
    case "addCriminal":
        #el file hayegy ezay hena ??
        $criminal = new upload_crminal($_FILES["zip_file"]);
        $fileName = $criminal->upload();
        #el image hena 
        $tmp_file = $_FILES['image']['tmp_name'];
        $image = $_FILES['image']['name'];
        move_uploaded_file($tmp_file, '../../Images/'. $image);
        #el locations
        $type = $params->type;
        if (!strcmp($type, "specific")) {          
        $locations = $params->location;
        }else{
          $locations = null;
        }
        $Fname = $params->Fname;
        $Mname = $params->Mname;
        $Lname = $params->Lname;
        $priority = $params->priority;
        $date  = $params->expireDate;
        $path  = $fileName;
        $id = $_SESSION['id'];
        $username = $_SESSION['username'];
        $result= $actions->addCriminal($Fname, $Mname, $Lname, $priority, $date, $path, $image, $id, $username);
        if ($result) {
          $socket = new mySocket;
          $socket->send($type,$locations);
        }

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
          $socket = new mySocket;
          $socket->send('general',null);
        }
      echo json_encode($result);
      break;
    default:
      echo "unkown action";
      break;
  }


?>
