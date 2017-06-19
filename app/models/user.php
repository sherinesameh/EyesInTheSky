<?php
  class User
  {
    private $conn;
    function __construct()
    {
      require_once '../helpers/dbConnection.php';
      $db = new DbConnection();
      $this->conn = $db->connect();
    }
    public function createUser($name, $username , $email, $pass ,$date)
    {
      if (!$this->isUserExists($email))
      {
        $stmt = $this->conn->prepare ("INSERT INTO Users(Name, Username, Email, Password, Authority, Birth_date, Max_running_containers) values(?, ? , ? , ? , 1 , ? , 9)");
        $stmt->bind_param("sssss", $name,$username, $email,$pass , $date);
        $result = $stmt->execute();
        $stmt->close();
        if ($result) {
            return CREATED_SUCCESSFULY;
        }
        else {
            return ERROR;
        }
      }
      else {
          return ALREADY_EXIST;
      }
    }
    public function getRpProcesses( $mac )
    {
      $stmt = $this->conn->prepare("SELECT Process.Process_name , Process.Cont_id , Process.Start_time , User.User_username FROM Process INNER JOIN User ON Process.User_id = User.User_id WHERE Process.Mac = ?");
      $stmt->bind_param("s", $mac);
      $stmt->execute();
      $result = getResult($stmt);
    }

    public function loginUser( $email, $pass )
    {
      $stmt = $this->conn->prepare("SELECT * FROM `Admin` WHERE Email = ? AND Password = ?");
      $stmt->bind_param("ss", $email,$pass);
      $result = $stmt->execute();
      $stmt->store_result();
      $num_rows = $stmt->num_rows;
      $stmt->close();
      return $num_rows > 0;
    }

    private function isUserExists($email)
    {
        $stmt = $this->conn->prepare("SELECT User_id FROM Users WHERE Email=?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();
        $num_rows = $stmt->num_rows;
        $stmt->close();
        return $num_rows > 0;
    }
    public function getUserInfo($email)
    {
      $RESULT = array();
      $stmt = $this->conn->prepare("SELECT * FROM Admin WHERE Email =  ?");
      $stmt->bind_param("s", $email);
      $stmt->execute();
      $stmt->store_result();
      for($i = 0; $i < $stmt->num_rows; $i++) {
        $Metadata = $stmt->result_metadata();
        $PARAMS = array();
        while($Field = $Metadata->fetch_field()) {
          $PARAMS[] = &$RESULT[$i][ $Field->name ];
        }
        call_user_func_array( array($stmt, 'bind_result'), $PARAMS );
        $stmt->fetch();
      }
      return $RESULT;
    }

        private function getResult( $Statement )
    {
        $RESULT = array();
        $Statement->store_result();
        for ( $i = 0; $i < $Statement->num_rows; $i++ ) {
            $Metadata = $Statement->result_metadata();
            $PARAMS = array();
            while ( $Field = $Metadata->fetch_field() ) {
                $PARAMS[] = &$RESULT[ $i ][ $Field->name ];
            }
            call_user_func_array( array( $Statement, 'bind_result' ), $PARAMS );
            $Statement->fetch();
        }
        return $RESULT;
    }
  }
?>
