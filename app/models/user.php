<?php
  class User
  {
    private $conn;
    function __construct()
    {
      require_once '../helpers/dbConnection.php';
      require_once '../helpers/definitions.php';
      $db = new DbConnection();
      $this->conn = $db->connect();
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
    public function createUser($name, $username, $email, $pass, $date)
    {
        if (!$this->isUserExists($email)) {
            $stmt = $this->conn->prepare("INSERT INTO User(Name, Username, Email , Password , Authority , Birth_date ,Max_running_containers) values(?, ? , ? , ? , 1 , ? , 9)");
            $stmt->bind_param("sssss", $name,$username, $email,$pass , $date );
            $result = $stmt->execute();
            $stmt->close();
            if ($result) {
                return CREATED_SUCCESSFULY;
            } else {
                return ERROR;
            }
        } else {
            return ALREADY_EXIST;
        }
    }
    public function loginUser($email, $pass)
    {
            $stmt = $this->conn->prepare("SELECT * FROM `User` WHERE Email = ? AND Password = ?");
            $stmt->bind_param("ss", $email,$pass);
            $stmt->execute();
            $stmt->store_result();
            $num_rows = $stmt->num_rows;
            if ($num_rows > 0) {
                $result = $this->getResult($stmt);
                $_SESSION['Email'] = $email;
                $_SESSION['Username'] = $result[0]["User_username"];
                $_SESSION['Id'] = $result[0]["User_id"];
                return LOGGED_IN_SUCCESSFULY;
            }
            else {
                return LOGGED_IN_ERROR;
            }
    }
    private function isUserExists($email)
    {
        $stmt = $this->conn->prepare("SELECT User_id FROM User WHERE Email=?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();
        $num_rows = $stmt->num_rows;
        $stmt->close();
        return $num_rows > 0;
    }
    public function getProfile($email)
    {
        $stmt = $this->conn->prepare("SELECT * FROM `User` WHERE Email = ?");
        $stmt->bind_param("s",$email);
        $stmt->execute();
        $result = $this->getResult($stmt);
        return $result;
    }
    public function addProcesss($id,$name,$cont_id,$cont_ip,$mac,$img_id,$size,$process_state)
    {
        #processs table
            $stmt = $this->conn->prepare("INSERT INTO `Process`(`Img_id`, `Process_name`, `Cont_id`, `Cont_IP`, `Mac`, `User_id`, `Size`,  `Process_State`) VALUES (?,?,?,?,?,?,?,?)");
            $stmt->bind_param("isissiii",$img_id , $name , $cont_id , $cont_ip , $mac , $id , $size , $process_state );
            $result = $stmt->execute();
            $stmt->close();

         #log table \

            $stmt2 = $this->conn->prepare("INSERT INTO `User_Log`(`User_id`, `Img_id`, `Process_name`, `Action`) VALUES (?,?,?,?,20794)");
            $stmt2->bind_param("iis", $id ,$img_id , $name );
            $stmt2->execute();
            $stmt2->close();

    }
    public function getLog($id)
    {
      $stmt = $this->conn->prepare("SELECT User_Log.Process_name , User_Log.Time , Code_index.Action FROM `User_Log` INNER JOIN Code_index ON User_Log.Action = Code_index.Code  WHERE User_Log.User_id = ?");
      $stmt->bind_param("i",$id);
      $result = $stmt->execute();
      $stmt->execute();
      $result = $this->getResult($stmt);
      return $result;
    }
  }
?>
