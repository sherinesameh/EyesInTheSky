<?php
  class Dashboard
  {
    private $conn;
    function __construct()
    {
      require_once '../helpers/dbConnection.php';
      require_once '../helpers/definitions.php';
      $db = new DbConnection();
      $this->conn = $db->connect();

    }
    function getAdminsLog()
    {
      $RESULT = array();
      $stmt = $this->conn->prepare("SELECT Admin.Admin_username AS name, Admin_Log.Action,Admin_Log.Action_time FROM Admin_Log INNER JOIN Admin on Admin_Log.Admin_id = Admin.Admin_id ORDER BY Admin_Log.Action_time");
      $stmt->execute();
      $stmt->store_result();
      for ($i = 0; $i < $stmt->num_rows; $i++)
      {
        $Metadata = $stmt->result_metadata();
        $PARAMS = array();
        while ($Field = $Metadata->fetch_field())
        {
          $PARAMS[] = &$RESULT[ $i ][ $Field->name ];
        }
        call_user_func_array(array( $stmt, 'bind_result'), $PARAMS );
        $stmt->fetch();
      }
      return $RESULT;
    }

    function getRpSpecs()
  	{
      $RESULT = array();
      $stmt = $this->conn->prepare("SELECT Current_Specs.Mac, Rp_Log.Jobs_Num, Rp_Specs.LocationLat,Rp_Specs.LocationLng, Rp_Specs.LocationName, Rp_Specs.PublicIP, Rp_Specs.Username, Rp_Specs.Password, Rp_Specs.Generation, Rp_Specs.OS, Rp_Specs.Ram, Rp_Specs.Storage, Rp_Specs.HasCamera,Current_Specs.RamUsage, Current_Specs.Temperature,Current_Specs.CpuUsage, Current_Specs.FreeStorage FROM Rp_Specs INNER JOIN Current_Specs on Rp_Specs.Mac = Current_Specs.Mac INNER JOIN Rp_Log on Rp_Log.Mac = Rp_Specs.Mac ");
      $stmt->execute();
  		$stmt->store_result();
  		for ( $i = 0; $i < $stmt->num_rows; $i++ )
  		{
  			$Metadata = $stmt->result_metadata();
  			$PARAMS = array();
  			while ( $Field = $Metadata->fetch_field() )
  			{
  				$PARAMS[] = &$RESULT[ $i ][ $Field->name ];
  			}
  			call_user_func_array( array( $stmt, 'bind_result' ), $PARAMS );
  			$stmt->fetch();
  		}
  		return $RESULT;
  	}

      public function killProcess($mac, $contID )
    {
        $stmt = $this->conn->prepare ("DELETE FROM `Process` WHERE Mac = ? AND Cont_id = ?");
        $stmt->bind_param("ss", $mac,$contID);
        $result = $stmt->execute();
        $stmt->close();
        $this->decrementPi($mac);
        $id = $_SESSION['id'];
        $Action = "Killed Process at Raspberry pi ".$mac." with container ID ".$contID;
        $this->addAdminLog($id,$Action);

        if ($result) {
            return CREATED_SUCCESSFULY;
        } else {
            return ERROR;
        }

    }
    public function decrementPi($mac)
    {
      $stmt = $this->conn->prepare ("UPDATE `Rp_Log` SET `Jobs_Num`=Jobs_Num - 1 WHERE Mac = ?");
      $stmt->bind_param("s", $mac);
      $result = $stmt->execute();
      $stmt->close();
    }

     public function deleteAdmin($id)
    {
        $stmt = $this->conn->prepare ("DELETE FROM `Admin` WHERE Admin_id = ?");
        $stmt->bind_param("i", $id);
        $result = $stmt->execute();
        $stmt->close();
        if ($result) {
            return CREATED_SUCCESSFULY;
        } else {
            return ERROR;
        }
    }

    public function addGov($Fname, $Lname, $username, $password, $email ,  $image )
    {
        $stmt = $this->conn->prepare ("INSERT INTO `Government`( `Gov_username`, `Fname`, `Lname`, `Email`, `Password`, `image`) VALUES (?,?,?,?,?,?)");
        $stmt->bind_param("ssssss", $username,$Fname, $Lname,$email , $password, $image );
        $result = $stmt->execute();
        $stmt->close();
        $id = $_SESSION['id'];

        if ($result) {

            $Action = "Added government employee ".$username;
            $this->addAdminLog($id,$Action);
            return CREATED_SUCCESSFULY;
        }
        else {
            return ERROR;
        }
    }


     public function deleteGov($id,$username)
    {
        $stmt = $this->conn->prepare ("DELETE FROM `Government` WHERE Gov_id = ?");
        $stmt->bind_param("i", $id);
        $result = $stmt->execute();
        $stmt->close();
        $id = $_SESSION['id'];
        $Action = "Deleted government employee ".$username;
        $this->addAdminLog($id,$Action);

        if ($result) {
            return CREATED_SUCCESSFULY;
        } else {
            return ERROR;
        }
    }



     public function updateGov($id , $Password ,$username)
    {
        $stmt = $this->conn->prepare ("UPDATE `Government` SET `Password`=? WHERE Gov_id = ?");
        $stmt->bind_param("si",$Password, $id);
        $result = $stmt->execute();
        $stmt->close();
        $id = $_SESSION['id'];
        $Action = "Updated government employee ".$username;
        $this->addAdminLog($id,$Action);
        if ($result) {
            return CREATED_SUCCESSFULY;
        } else {
            return ERROR;
        }
    }
    public function addAdminLog($id , $Action)
    {
        $stmt = $this->conn->prepare ("INSERT INTO `Admin_Log`(`Admin_id`, `Action`) VALUES (?,?)");
        $stmt->bind_param("is", $id,$Action );
        $result = $stmt->execute();
        $stmt->close();
    }
    function getAdmins()
    {
      $RESULT = array();
      $stmt = $this->conn->prepare("SELECT Admin_id , Admin_username , Email,image FROM `Admin` WHERE 1");
      $stmt->execute();
      $stmt->store_result();
      for ($i = 0; $i < $stmt->num_rows; $i++)
      {
        $Metadata = $stmt->result_metadata();
        $PARAMS = array();
        while ($Field = $Metadata->fetch_field())
        {
          $PARAMS[] = &$RESULT[ $i ][ $Field->name ];
        }
        call_user_func_array(array( $stmt, 'bind_result'), $PARAMS );
        $stmt->fetch();
      }
      return $RESULT;
    }


    function getGovs()
    {
      $RESULT = array();
      $stmt = $this->conn->prepare("SELECT `Gov_id`, `Gov_username`, `Email`, `Fname`, `Lname`, `image` FROM `Government` WHERE 1");
      $stmt->execute();
      $stmt->store_result();
      for ($i = 0; $i < $stmt->num_rows; $i++)
      {
        $Metadata = $stmt->result_metadata();
        $PARAMS = array();
        while ($Field = $Metadata->fetch_field())
        {
          $PARAMS[] = &$RESULT[ $i ][ $Field->name ];
        }
        call_user_func_array(array( $stmt, 'bind_result'), $PARAMS );
        $stmt->fetch();
      }
      return $RESULT;
    }


    function getRunningProcesses()
  	{
  		$RESULT = array();
      $stmt = $this->conn->prepare ("SELECT Rp_Specs.Mac, COUNT(Process.Img_id) AS procs FROM Rp_Specs INNER JOIN Process ON Rp_Specs.Mac = Process.Mac GROUP BY Process.Mac");
      $stmt->execute();
  		$stmt->store_result();
  		for ( $i = 0; $i < $stmt->num_rows; $i++ )
  		{
  			$Metadata = $stmt->result_metadata();
  			$PARAMS = array();
  			while ($Field = $Metadata->fetch_field())
  			{
  				$PARAMS[] = &$RESULT[ $i ][ $Field->name ];
  			}
  			call_user_func_array( array( $stmt, 'bind_result' ), $PARAMS );
  			$stmt->fetch();
  		}
  		return $RESULT;
  	}
    public function getRpProcesses($mac)
    {
      $RESULT = array();
      $stmt = $this->conn->prepare("SELECT Process.Process_name , Process.Cont_id , Process.Start_time , User.User_username FROM Process INNER JOIN User ON Process.User_id = User.User_id WHERE Process.Mac = ?");
      $stmt->bind_param("s", $mac);
      $stmt->execute();
  		$stmt->store_result();
  		for ( $i = 0; $i < $stmt->num_rows; $i++ )
  		{
  			$Metadata = $stmt->result_metadata();
  			$PARAMS = array();
  			while ($Field = $Metadata->fetch_field())
  			{
  				$PARAMS[] = &$RESULT[ $i ][ $Field->name ];
  			}
  			call_user_func_array( array( $stmt, 'bind_result' ), $PARAMS );
  			$stmt->fetch();
  		}
  		return $RESULT;
    }

  }
