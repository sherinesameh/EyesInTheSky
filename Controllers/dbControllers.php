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

                            public function loginUser( $email, $pass )
                            {
                                $stmt = $this->conn->prepare("SELECT * FROM `Government` WHERE Email = ? AND Password = ? ");
                                $stmt->bind_param("ss", $email,$pass);
                                $stmt->execute();
                                $stmt->store_result();
                                $num_rows = $stmt->num_rows;
                                if ($num_rows > 0) {
                                    session_start();
                                    $_SESSION['Email'] = $email;
                                    $result = $this->get_result($stmt);
                                    $_SESSION['id'] = $result[0]["Gov_id"];
                                    $_SESSION['authority'] = $result[0]["authority"];
                                    return CREATED_SUCCESSFULY;
                                }else{
                                    return ERROR;
                                }

                            }


                            public function addCriminal($fname,$lname , $Mname , $priority, $date ,$path , $image,$id,$username)
                            {

                               $query = "INSERT INTO `Criminals`(`Mname`, `Fname`, `Lname`, `Dir_path`, `priority`, `expiry_date`, `image` ) VALUES ( '".$Mname ."','". $fname ."','". $lname ."','". $path ."',". $priority .",". $date .",'". $image."')";
                               echo $query;
                               $this->conn->query($query);

                               $Crim_id = $this->conn->insert_id;

                               $stmt = $this->conn->prepare("INSERT INTO `Gov_Log`(`Gov_id`, `Gov_username`, `Action`, `Crim_id`) VALUES (?,?,98312,?)");
                               $stmt->bind_param("isi", $id , $username , $Crim_id );
                               $result = $stmt->execute();
                               $stmt->close();
                               if ($result) {
                                  return CREATED_SUCCESSFULY;
                              }else{
                                return ERROR;
                            }

                        }

                        public function delCriminal($gov_id,$id,$username)
                        {

                            $stmt = $this->conn->prepare("DELETE FROM `Criminals` WHERE Crim_id = ? "); 
                            $stmt->bind_param("i", $id);
                            $stmt->execute();
                            $stmt2 = $this->conn->prepare("INSERT INTO `Gov_Log`(`Gov_id`, `Gov_username`, `Action`, `Crim_id`) VALUES (?,?,56489,?)");
                            $stmt2->bind_param("isi", $gov_id , $username , $id );
                            $result = $stmt2->execute();
                            if ($result) {
                              return CREATED_SUCCESSFULY;
                          }else{
                            return ERROR;
                        }
                    }


                    public function getGovProfile($id)
                    {

                        $stmt = $this->conn->prepare("SELECT Gov_username, Fname,Lname,Email,authority,image FROM Government WHERE Gov_id= ? ");
                        $stmt->bind_param("i",$id );
                        $stmt->execute();
                        $result = $this->get_result($stmt);
                        return $result;

                    }


                    public function getGovs()
                    {

                        $stmt = $this->conn->prepare("SELECT Gov_username,Gov_id , Fname,Lname,authority,image FROM Government WHERE 1 ");
                        $stmt->execute();
                        $result = $this->get_result($stmt);
                        return $result;

                    }



                    public function getCrimProfile($id)
                    {

                        $stmt = $this->conn->prepare("SELECT Mname, Fname,Lname,priority,expiry_date,image FROM `Criminals` WHERE Crim_id = ? ");
                        $stmt->bind_param("i",$id );
                        $stmt->execute();
                        $result = $this->get_result($stmt);
                        return $result;

                    }



                    public function Search($text)
                    {

                        $stmt = $this->conn->prepare("SELECT * FROM `Criminals` WHERE Mname LIKE '%$text%' OR Fname LIKE '%$text%' OR Lname LIKE '%$text%'");
                        $stmt->execute();
                        $result = $this->get_result($stmt);
                        return $result;

                    }




                    public function updateProf($username,$fname,$lname,$email,$pass,$priority,$image,$id)
                    {

                        $stmt = $this->conn->prepare("UPDATE `Government` SET `Gov_username`= ?,`Fname`= ? ,`Lname`= ? ,`Email`= ? ,`Password` = ?,`authority`= ?,`image`= ? WHERE Gov_id = ?;");
                        $stmt->bind_param("sssssisi",$username,$fname,$lname,$email,$pass,$priority,$image,$id );
                        $result = $stmt->execute();
                        if ($result) {
                          return CREATED_SUCCESSFULY;
                      }else{
                        return ERROR;
                    }
                }



                public function updateCrim($Mname, $Fname , $Lname , $priority , $expiry_date ,  $image , $crim_id)
                {

                    $stmt = $this->conn->prepare("UPDATE `Criminals` SET `Mname`= ?,`Fname`= ?,`Lname`= ? ,`priority`= ?,`expiry_date`= ? ,`image`= ? WHERE Crim_id = 5 ");
                    $stmt->bind_param("sssiis",$Mname, $Fname , $Lname , $priority , $expiry_date ,  $image );

                    $result = $stmt->execute();
                    if ($result) {
                      return CREATED_SUCCESSFULY;
                  }else{
                    return ERROR;
                }

            }

            public function getLog()
            {

                $stmt = $this->conn->prepare("SELECT Gov_Log.Gov_id, Gov_Log.Gov_username,Gov_Log.Action,Gov_Log.Start_time,Gov_Log.Crim_id , Criminals.Mname,Criminals.Fname ,Criminals.Lname FROM Gov_Log INNER JOIN Criminals ON Gov_Log.Crim_id = Criminals.Crim_id ORDER BY Gov_Log.Start_time DESC "); 


                $result = $stmt->execute();
                $stmt->execute();
                $result = $this->get_result($stmt);
                return $result;
                

            }




                            //Function to check whether user exist or not
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


            function get_result( $Statement ) {
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