			<?php 



			include_once dirname(__FILE__) . '/config.php';

			        // Connecting to mysql database
			$conn = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
			if (mysqli_connect_errno()) {
				echo "Failed to connect to MySQL: " . mysqli_connect_error();
			}

			$stmt = $conn->prepare("SELECT Rp_Specs.Mac , COUNT(Process.Img_id) AS procs FROM Rp_Specs INNER JOIN Process ON Rp_Specs.Mac = Process.Mac GROUP BY Process.Mac ");
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




