<?php
  class DbConnection
  {
    private $conn;
    function __construct()
    {
      include_once dirname(__FILE__) . '/config.php';
      $this->conn = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
      if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
      }
    }
    public function connect()
    {
        return $this->conn;
    }
  }
?>
