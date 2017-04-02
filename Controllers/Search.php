<?php

require("dbControllers.php");

$text= 'yar';


	
	$dboperation = new DbOperation;
	$result= $dboperation->Search($text);
	echo json_encode($result);

     


?>