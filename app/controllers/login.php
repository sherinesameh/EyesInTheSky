<?php
  session_start();
  require("../helpers/dbControllers.php");

  $email = htmlspecialchars($_POST['email']) ;
  $_SESSION['Email'] = $email;

  $password = htmlspecialchars($_POST['password']) ;

  $dboperation = new DbOperation;
  $result= $dboperation->loginUser( $email, $password );
  if($result)
  {
    header("Location: http://localhost/Administration/app/views/home.php");
  }
  else
  {
    echo "Account not found";
  }

?>
