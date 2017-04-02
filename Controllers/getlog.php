<?php

include_once dirname(__FILE__) . '/config.php';

	$conn = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
			if (mysqli_connect_errno()) {
				echo "Failed to connect to MySQL: " . mysqli_connect_error();
			}

$stmt = $conn->prepare("SELECT Gov_Log.Gov_id, Gov_Log.Gov_username,Gov_Log.Action,Gov_Log.Start_time,Gov_Log.Crim_id , Criminals.Mname,Criminals.Fname ,Criminals.Lname FROM Gov_Log INNER JOIN Criminals ON Gov_Log.Crim_id = Criminals.Crim_id ORDER BY Gov_Log.Start_time DESC ");

$stmt->execute();
$result=get_result($stmt);
echo $result[0]["Gov_username"];


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

?>