<?php

class DbOperation
{
    private $conn;

    //Constructor
    function __construct()
    {
        require_once dirname(__FILE__) . '/dbConnection.php';
        include_once dirname(__FILE__) . '/definitions.php';
        // opening db connection
        $db = new DbConnection();
        $this->conn = $db->connect();
    }

    //Function to create a new user
    public function createUser($name, $username , $email, $pass ,$date)
    {
        if (!$this->isUserExists($email)) {

            $stmt = $this->conn->prepare("INSERT INTO Users(Name, Username, Email , Password , Authority , Birth_date ,Max_running_containers) values(?, ? , ? , ? , 1 , ? , 9)");
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

    public function loginUser( $email, $pass ,$auth)
    {
            $stmt = $this->conn->prepare("SELECT * FROM `Users` WHERE Email = ? AND Password = ? AND Authority = ?");
            $stmt->bind_param("ssi", $email,$pass,$auth);
            $result = $stmt->execute();
            $stmt->store_result();
            $num_rows = $stmt->num_rows;
            $stmt->close();
            return $num_rows > 0;
         
    }

    //Function to check whether user exist or not
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
}