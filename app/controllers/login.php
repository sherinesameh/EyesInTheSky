<?php
  session_start();
  require_once '../models/user.php';
  $user = new User;
  $params = json_decode(file_get_contents("php://input"));
  $email = $params->email;
  $password = $params->password;
  $result= $user->loginUser($email, $password);
  echo json_encode($result);
?>
