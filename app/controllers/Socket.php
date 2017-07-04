<?php
class Socket
{
	// private $host = "localhost";
	private $host = "192.168.43.114";
  private $port = 8080;
  private $socket;
	function __construct()
	{
		$this->socket = socket_create(AF_INET, SOCK_STREAM,0) or die("Could not create socket\n");
    socket_connect($this->socket , $this->host,$this->port ) ;
    $type ="80702";
		socket_write($this->socket, $type, strlen ($type)) or die("Could not write output\n");
	}
	function send($type,$location)
	{
		if (!strcmp($type, "general")) {
			$type = 1;
		}else{
			$type = 2;
		}
		socket_write($this->socket, $type, strlen ($type)) or die("Could not write output\n");
		sleep(1);
		if ($type == 2) {
			$locations = $location[0];
			for ($i=0; $i < sizeof($location); $i++) {
				$locations = $locations .':_:'. $location[$i];
			}
		socket_write($this->socket, $locations, strlen ($locations)) or die("Could not write output\n");
		}
	}
	function receive()
	{
    $input = socket_read($this->socket, 1024) or die("Could not write output\n");
		echo $input;
		// if(socket_recv ( $this->socket , $buf , 2045 , MSG_WAITALL ) === FALSE)
		// {
		//     $errorcode = socket_last_error();
		//     $errormsg = socket_strerror($errorcode);
		//     die("Could not receive data: [$errorcode] $errormsg \n");
		// }
		// //print the received message
		// echo $buf;

	}
	function close()
	{
      socket_close($this->socket) ;
	}
}
?>
