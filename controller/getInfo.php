			<?php 



			include_once dirname(__FILE__) . '/config.php';

			        // Connecting to mysql database
			$conn = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
			if (mysqli_connect_errno()) {
				echo "Failed to connect to MySQL: " . mysqli_connect_error();
			}


				    session_start();
					$email = $_SESSION['Email'];
			//$email = "yamenemad4@gmail.com";
			$stmt = $conn->prepare("SELECT * FROM Admin WHERE Email =  ?");
			$stmt->bind_param("s", $email);
			$stmt->execute();
			$result = get_result($stmt);
			echo json_encode($result);



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




