<?php
  class Actions
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
    public function addCriminal($Fname, $Mname, $Lname, $priority, $date, $path, $image, $id, $username)
    {
       $query = "INSERT INTO `Criminals`(`Mname`, `Fname`, `Lname`, `Dir_path`, `priority`, `expiry_date`, `image` ) VALUES ( '".$Mname ."','". $Fname ."','". $Lname ."','". $path ."',". $priority .", DATE_ADD(NOW(), INTERVAL ". $date." DAY) ,'". $image."')";
       $this->conn->query($query);
       $Crim_id = $this->conn->insert_id;

       $oldname = DIRECTORY.$path;
       $newname = DIRECTORY.$Crim_id;
       rename($oldname, $newname);

       $Action = "Added Criminal ".Fname." ".$Mname." ".$Lname;
       $stmt = $this->conn->prepare("INSERT INTO `Gov_Log`(`Gov_id`, `Gov_username`, `Action`) VALUES (?,?,?)");
       $stmt->bind_param("iss", $id , $username , $Action );
       $result = $stmt->execute();
       $stmt->close();
       if ($result) {
          return CREATED_SUCCESSFULY;
      } else {
          return ERROR;
      }
    }



    public function updateExpired($id)
    {
        $stmt = $this->conn->prepare("UPDATE `Criminals` SET `State`=80808 WHERE Crim_id = ? ");
        $stmt->bind_param("i", $id);
        $result = $stmt->execute();
        $stmt->close();
        if ($result) {
          return CREATED_SUCCESSFULY;
        } else {
          return ERROR;
        }
    }    

    public function deleteCriminal($id, $gov_id, $username , $Fname ,$Mname ,$Lname)
    {
        $stmt = $this->conn->prepare("DELETE FROM `Criminals` WHERE Crim_id = ? ");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $Action = "Deleted Criminal ".$Fname.' '.$Mname.' '.$Lname;
        $stmt2 = $this->conn->prepare("INSERT INTO `Gov_Log`(`Gov_id`, `Gov_username`, `Action`) VALUES (?,?,?)");
        $stmt2->bind_param("iss", $gov_id , $username , $Action );
        $result = $stmt2->execute();
        if ($result) {
          return CREATED_SUCCESSFULY;
        } else {
          return ERROR;
        }
    }

    public function getLocations()
    {
      $stmt = $this->conn->prepare("SELECT DISTINCT(LocationName) as Location FROM Rp_Specs  ORDER BY LocationName ASC");
      $stmt->execute();
      $result = $this->getResult($stmt);
      return $result;
    }


    public function getCriminalLocation($id)
    {
      $stmt = $this->conn->prepare("SELECT `Location` FROM `Criminals` WHERE `Crim_id` = ?");
      $stmt->bind_param("i", $id);
      $stmt->execute();
      $result = $this->getResult($stmt);
      return $result;
    }

    public function getAllCriminals()
    {
      $stmt = $this->conn->prepare("SELECT * FROM `Criminals`");
      $stmt->execute();
      $result = $this->getResult($stmt);
      return $result;
    }
    public function getLog()
    {
      $stmt = $this->conn->prepare("SELECT Gov_Log.Gov_id, Gov_Log.Gov_username,Gov_Log.Action,Gov_Log.Start_time FROM Gov_Log ORDER BY Gov_Log.Start_time DESC ");
      $result = $stmt->execute();
      $stmt->execute();
      $result = $this->getResult($stmt);
      return $result;
    }
    public function getCriminalProfile($id)
    {
        $stmt = $this->conn->prepare("SELECT Mname, Fname,Lname,priority,expiry_date,image FROM `Criminals` WHERE Crim_id = ? ");
        $stmt->bind_param("i",$id );
        $stmt->execute();
        $result = $this->getResult($stmt);
        return $result;
    }
    // public function updateCriminalProfile($Mname, $Fname , $Lname , $priority , $expiry_date ,  $image , $crim_id)
    // {
    //     $stmt = $this->conn->prepare("UPDATE `Criminals` SET `Mname`= ?,`Fname`= ?,`Lname`= ? ,`priority`= ?,`expiry_date`= ? ,`image`= ? WHERE Crim_id = 5 ");
    //     $stmt->bind_param("sssiis",$Mname, $Fname , $Lname , $priority , $expiry_date ,  $image );
    //     $result = $stmt->execute();
    //     if ($result) {
    //       return CREATED_SUCCESSFULY;
    //     } else {
    //       return ERROR;
    //     }
    // }
    // public function search($text)
    // {
    //     $stmt = $this->conn->prepare("SELECT * FROM `Criminals` WHERE Mname LIKE '%$text%' OR Fname LIKE '%$text%' OR Lname LIKE '%$text%'");
    //     $stmt->execute();
    //     $result = $this->getResult($stmt);
    //     return $result;
    // }
  }
?>
