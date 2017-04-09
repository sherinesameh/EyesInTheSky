<?php

 // configuration
    require("../helpers/helpers.php");
    require("../helpers/dbControllers.php");

    // if user reached page via GET (as by clicking a link or via redirect)
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        // else render form
        //render registeration form
        render("register_view.php", ["title" => "Register"]);
    }


     // else if user reached page via POST (as by submitting a form via POST)
     else if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
    	// assign form data to variables.
    	if(!empty($_POST['firstname']) && !empty($_POST['lastname'])&& !empty($_POST['username']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['confirm']) && !empty($_POST['birthdate']))
    	{
    		//htmlspecialchars() avoids html injection
    	$firstname = htmlspecialchars($_POST['firstname']) ;
      $lastname = htmlspecialchars($_POST['lastname']) ;
      $name = $firstname .' '.$lastname;
    	$user_name = htmlspecialchars($_POST['username']);
    	$email = htmlspecialchars($_POST['email']);
    	$password = htmlspecialchars($_POST['password']);
    	$pass_confirm = htmlspecialchars($_POST['confirm']);
    	$birthday = htmlspecialchars($_POST['birthdate']);

    	$name_valid = ctype_alpha($firstname);

      $name_valid2 = ctype_alpha($lastname);
      $username_valid = ctype_alnum($user_name);

      
        // $error = false;

        // list($dd,$mm,$yyyy) = explode('/', $birthday);
        // if (!checkdate($mm,$dd,$yyyy)) {
        // $error = true;
        // }
        if($name_valid && $name_valid2 && $username_valid )
        {
            

             $dboperation = new DbOperation;
           $result =   $dboperation->createUser($name, $user_name , $email, $password , 1 , $birthday , 9);

           if ($result) {
             header("Location: http://localhost/EyesInTheSky/public/users");
           }
        }
        else
        	echo "Bad";

        }
    	else
    		echo "Please fill the form properly";

    	
        
        
   }
    
 
?>