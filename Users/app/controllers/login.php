<?php
          session_start();

           // configuration
          require("../helpers/helpers.php");
          require("../helpers/dbControllers.php");

          $email = htmlspecialchars($_POST['email']) ;
          $_SESSION['Email'] = $email;

          $password = htmlspecialchars($_POST['password']) ;

          $dboperation = new DbOperation;
          $result= $dboperation->loginUser( $email, $password ,$auth);
          if($result)
          {
            header("Location: http://localhost/yamen/home.php");
          }else{
            echo "msh mawgod";
          }

?>