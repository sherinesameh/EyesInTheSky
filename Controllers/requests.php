<?php

require("dbControllers.php");
$dboperation = new DbOperation;

session_start();
$request = $_POST['request'];


        switch ($request) {

          case "search":
            $text = $_POST['search'];
            $result = $dboperation->Search($text);
            echo json_encode($result);
            break;

          case "register":
            $firstname = htmlspecialchars($_POST['firstname']) ;
            $lastname = htmlspecialchars($_POST['lastname']) ;
            $user_name = htmlspecialchars($_POST['username']);
            $email = htmlspecialchars($_POST['email']);
            $password = htmlspecialchars($_POST['password']);
            //$authority = htmlspecialchars($_POST['authority']);
            $authority = 20321;
            $img = 'x.png';
            $result =   $dboperation->createUser($firstname , $lastname , $user_name , $email , $password , $authority ,  $img);
            echo "string";
            break;

          case "deleteCriminal":
            $id = $_POST['crim_id'];
            $gov_id= $_POST['gov_id'];
            $username = $_POST['username'];
            $result= $dboperation->delCriminal($gov_id,$id,$username);
            break;

              
          case "addCriminal":
            $fname = $_POST['Fname'];
            $Mname = $_POST['Mname'];
            $lname = $_POST['Lname'];
            $path  = $_POST['path'];
            $image = $_POST['image'];
            $date  = $_POST['date'];
            $priority = $_SESSION['authority'];
            $username = $_SESSION['username'];
            $id = $_SESSION['id'];
            $result= $dboperation->addCriminal($fname, $lname , $Mname , $priority, $date  ,$path, $image ,$id ,$username);
            break;


           case "getProfile":
              $flag = $_POST['flag'];

                if ($flag == 1) { //government required                                          
                  $id = $_POST['id'];
                  $result = $dboperation->getGovProfile($id);
                  echo json_encode($result);
                }

                else {
                  $crim_id = $_POST['id'];
                  $result= $dboperation->getCrimProfile($crim_id);
                  echo json_encode($result);
                }

              break;

            case "getLog":
              $result = $dboperation->getLog();
              echo json_encode($result);
              break;  
            
            case "getGovs":
              $result = $dboperation->getGovs();
              echo json_encode($result);
              break;

            case "updateProfile":
              $flag = $_POST['flag'];

              if ($flag == 1) { //government required
                  $username = $_POST['username'];
                  $fname = $_POST['fname'];
                  $lname = $_POST['lname'];
                  $email = $_POST['email'];
                  $password = $_POST['password'];
                  $image = $_POST['image'];
                  $priority = $_POST['priority'];
                  $result= $dboperation->updateProf($username , $fname , $lname , $email , $password , $priority ,$image , $id);
                  echo $result;

                }

                else { //Criminal required 
                  $Mname = $_POST['mname'];
                  $Fname = $_POST['fname'];
                  $Lname = $_POST['lname'];
                  $priority = $_POST['priority'];
                  $image = $_POST['image'];
                  $expiry_date = $_POST['exp_date'];
                  $crim_id = $_POST['crim_id'];
                  $result= $dboperation->updateCrim($Mname, $Fname , $Lname , $priority , $expiry_date ,  $image , $crim_id);
                  echo $result;

                }
              break;

        
          default:
          echo "unkown action";
        }


?>