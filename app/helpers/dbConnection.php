<?php
  class DbConnection
  {
    private $conn;
    function connect()
    {
        include_once dirname(__FILE__) . '/config.php';
        $this->conn = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
        if (mysqli_connect_errno())
        {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }
        return $this->conn;
    }
   }
?>
