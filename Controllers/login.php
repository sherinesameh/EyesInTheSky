<?php
          session_start();

           // configuration
          require("dbControllers.php");

          $email = htmlspecialchars($_POST['email']) ;
          $_SESSION['Email'] = $email;

          $password = htmlspecialchars($_POST['password']) ;
          //$email = 'farida@gmail.com';
          //$password = '123123';
          $dboperation = new DbOperation;
          $result= $dboperation->loginUser( $email, $password );
          if($result)
          {
            header("Location: http://localhost/Gov/home.php");
          }else{
            echo "msh mawgod";
          }

?>
