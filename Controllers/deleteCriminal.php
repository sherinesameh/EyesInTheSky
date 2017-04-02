<?php
          session_start();

           // configuration
          require("dbControllers.php");

          // $email = htmlspecialchars($_POST['email']) ;
          // $_SESSION['Email'] = $email;
          $id = 5;
          $gov_id=1;
          $username='farida';




          $dboperation = new DbOperation;
          $result= $dboperation->delCriminal($gov_id,$id,$username);
          if($result)
          {
            header("Location: http://localhost/yamen/home.php");
          }else{
            echo "msh mawgod";
          }

?>