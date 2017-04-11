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
    public function loginUser( $email, $pass)
    {
            $stmt = $this->conn->prepare("SELECT * FROM `User` WHERE Email = ? AND Password = ?");
            $stmt->bind_param("ss", $email,$pass);
            $stmt->execute();
            $stmt->store_result();
            $num_rows = $stmt->num_rows;
            if ($num_rows > 0) {
                $result = $this->getResult($stmt);
                $_SESSION['Email'] = $email;
                $_SESSION['username'] = $result[0]["User_username"];
                $_SESSION['id'] = $result[0]["User_id"];
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
    // public function updateProfile()
    // {
    //
    // }
    public function getLog($id)
    {
      // $stmt = $this->conn->prepare("SELECT Img_id Process_name FROM User_Log WHERE id = ?");
      // $stmt->bind_param("s",$id);
      // $result = $stmt->execute();
      // $stmt->execute();
      // $result = $this->getResult($stmt);
      // return $result;
    }
  }
?>
