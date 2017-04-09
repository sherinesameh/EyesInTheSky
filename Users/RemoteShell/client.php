<?php

$host = "localhost";
$port = 8080;
$pass = "ayhaga";
$path = "ay haga bardo";
$repo = "repo";



$output2 =  $host.":_:".$port.":_:".$pass.":_:".$path.":_:".$repo;


$output = "user";

$socket1 = socket_create(AF_INET, SOCK_STREAM,0) or die("Could not create socket\n");

socket_connect ($socket1 , $host,$port ) ;
sleep(1);	
socket_write($socket1, $output, strlen ($output)) or die("Could not write output\n");

sleep(1);
socket_write($socket1, $output2, strlen ($output2)) or die("Could not write output\n");


socket_close($socket1) ;


?>