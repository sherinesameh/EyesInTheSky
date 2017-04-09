<?php



class mySocket 
{
	private $host = "localhost";
    private $port = 5555;
    private $socket;

	function __construct()
	{
		$this->socket = socket_create(AF_INET, SOCK_STREAM,0) or die("Could not create socket\n");
        socket_connect($this->socket , $this->host,$this->port ) ;		
	}

	function send($host,$user,$pass,$path,$repo)
	{
		sleep(1);
		$output = $host.":_:".$user.":_:".$pass.":_:".$path.":_:".$repo;

		socket_write($this->socket, $output, strlen ($output)) or die("Could not write output\n");


	}

	function receive()
	{

	}

	function close()
	{

      socket_close($this->socket) ;
	}


}




?>


