<?php
          session_start();

           // configuration
          require("dbControllers.php");

          // $email = htmlspecialchars($_POST['email']) ;
          // $_SESSION['Email'] = $email;
          $id = 1;
          $fname = 'boshra';
          $Mname = 'ahmed';
          $lname = 'kandil';

          $path = 'test';
          $image = 'img.png';
          $date=3;
          $priority=3;
          $username ='farida';



          $dboperation = new DbOperation;
          $result= $dboperation->addCriminal($fname,$lname , $Mname , $priority, $date  ,$path, $image,$id ,$username);
          if($result)
          {
            header("Location: http://localhost/yamen/home.php");
          }else{
            echo "msh mawgod";
          }

?>