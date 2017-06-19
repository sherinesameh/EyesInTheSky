<?php
class Socket
{
	private $host = "localhost";
    private $port = 8080;
    private $socket;
	function __construct()
	{
		$this->socket = socket_create(AF_INET, SOCK_STREAM,0) or die("Could not create socket\n");
    socket_connect($this->socket , $this->host,$this->port ) ;
    $type ="90901";
		socket_write($this->socket, $type, strlen ($type)) or die("Could not write output\n");
	}
	function kill($mac , $contID)
	{
		session_start();
		$id = $_SESSION['Id'];
		$cmd = "15151".":_:".$mac.":_:".$contID;
		socket_write($this->socket, $id, strlen ($id)) or die("Could not write output\n");
		sleep(1);
		socket_write($this->socket, $cmd, strlen ($cmd)) or die("Could not write output\n");
	}

	function shutDown($mac)
	{
		session_start();
		$id = $_SESSION['Id'];
		$cmd = "27351".":_:".$mac;
		socket_write($this->socket, $id, strlen ($id)) or die("Could not write output\n");
		sleep(1);
		socket_write($this->socket, $cmd , strlen($cmd))or die("Couldn't send kill mac ")
	}

	function restart($mac)
	{
		session_start();
		$id = $_SESSION['Id'];
		$cmd = "87452".":_:".$mac;
		socket_write($this->socket, $id, strlen ($id)) or die("Could not write output\n");
		sleep(1);
		socket_write($this->socket, $cmd , strlen($cmd))or die("Couldn't send kill mac ")
	}

	function receive()
	{
    $input = socket_read($this->socket, 1024) or die("Could not write output\n");
		echo $input;
	}
	function close()
	{
      socket_close($this->socket) ;
	}
}
?>