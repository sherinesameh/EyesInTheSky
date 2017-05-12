<?php
class mySocket
{
	private $host = "localhost";
  private $port = 8080;
  private $socket;

	function __construct()
	{
		$this->socket = socket_create(AF_INET, SOCK_STREAM,0) or die("Could not create socket\n");
    socket_connect($this->socket , $this->host,$this->port ) ;
	}
	function send($path)
	{
		$type ="user";
		$output = $path;
		socket_write($this->socket, $type, strlen ($type)) or die("Could not write output\n");
		sleep(1);
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
