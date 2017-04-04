<?php
  session_start();
  require_once '../models/user.php';

  $user = new User;
  $email = htmlspecialchars($_POST['email']) ;
  $password = htmlspecialchars($_POST['password']) ;
  $_SESSION['Email'] = $email;
  $result= $user->loginUser( $email, $password );
  if($result) {
    header("Location: http://localhost/Administration/public/dashboard");
  }
  else {
    header("Location: http://localhost/Administration/public/");
  }
?>
