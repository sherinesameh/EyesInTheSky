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
    private function isUserExists($email)
    {
        $stmt = $this->conn->prepare("SELECT Gov_id FROM Government WHERE Email=?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();
        $num_rows = $stmt->num_rows;
        $stmt->close();
        return $num_rows > 0;
    }
    public function createUser($fname,$lname , $username , $email, $pass ,$auth , $img)
    {
        if (!$this->isUserExists($email)) {
            $stmt = $this->conn->prepare("INSERT INTO Government(Fname, Lname, Gov_username, Email , Password , Authority , image ) values(?, ? , ? , ? , ? , ? , ?)");
            $stmt->bind_param("sssssis", $fname, $lname,$username, $email,$pass , $auth , $img );
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
        $stmt = $this->conn->prepare("SELECT * FROM `Government` WHERE Email = ? AND Password = ? ");
        $stmt->bind_param("ss", $email,$pass);
        $stmt->execute();
        $stmt->store_result();
        $num_rows = $stmt->num_rows;
        if ($num_rows > 0) {
            $result = $this->getResult($stmt);
            $_SESSION['Email'] = $email;
            $_SESSION['username'] = $result[0]["Gov_username"];
            $_SESSION['id'] = $result[0]["Gov_id"];
            $_SESSION['authority'] = $result[0]["authority"];
            return LOGGED_IN_SUCCESSFULY;
        }
        else {
            return LOGGED_IN_ERROR;
        }
    }
    public function getProfile($email)
    {
        $stmt = $this->conn->prepare("SELECT Gov_username, Fname,Lname,Email,authority,image FROM Government WHERE Email = ? ");
        $stmt->bind_param("s",$email);
        $stmt->execute();
        $result = $this->getResult($stmt);
        return $result;
    }
    public function updateProfile($username, $fname, $lname, $email, $pass, $priority, $image, $id)
    {
        $stmt = $this->conn->prepare("UPDATE `Government` SET `Gov_username`= ?,`Fname`= ? ,`Lname`= ? ,`Email`= ? ,`Password` = ?,`authority`= ?,`image`= ? WHERE Gov_id = ?;");
        $stmt->bind_param("sssssisi",$username,$fname,$lname,$email,$pass,$priority,$image,$id );
        $result = $stmt->execute();
        if ($result) {
          return CREATED_SUCCESSFULY;
      } else {
          return ERROR;
      }
    }
    public function getAllProfiles()
    {
        $stmt = $this->conn->prepare("SELECT Gov_username, Gov_id, Fname, Lname, authority, image FROM Government WHERE 1 ");
        $stmt->execute();
        $result = $this->getResult($stmt);
        return $result;
    }
  }
?>
