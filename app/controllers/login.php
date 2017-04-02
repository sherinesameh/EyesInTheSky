<?php
session_start();

 // configuration
    require("../helpers/helpers.php");
    require("../helpers/dbControllers.php");

    	$email = htmlspecialchars($_POST['email']) ;
        $password = htmlspecialchars($_POST['password']) ;
        $auth = (int)$_POST['btn'];
       
		$dboperation = new DbOperation;
        $result= $dboperation->loginUser( $email, $password ,$auth);
       if($result)
       {
          header("Location: http://localhost/EyesInTheSky/public/users");
       }else{
       	echo "msh mawgod";
       }

?>