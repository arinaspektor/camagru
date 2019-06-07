<?php
		class User {

			private $db;

			function __construct($DB_con) {
     			 $this->db = $conn;
			}
			
			public function register($username, $email, $passwd) {

				try {
					$new_passwd = password_hash($passwd, PASSWORD_DEFAULT);
					echo $new_passwd;

					$stmt = $this->db->prepare(
						"INSERT INTO users(username, email, hashed_password) 
						VALUES(:username, :email, :passwd)"
						);

					$stmt->bindparam(":username", $username);
					$stmt->bindparam(":email", $email);
					$stmt->bindparam(":passwd", $new_passwd);
					$stmt->execute();

					return $stmt;
				} catch(PDOException $e) {
					echo $e->getMessage();
				}

			}
			
			public function login($username, $passwd) {

				try {

					$stmt = $this->db->prepare(
						"SELECT * FROM users 
						WHERE username=:username OR email=:email 
						LIMIT 1"
					);
					$stmt->execute(array(':username'=>$username, ':email'=>$email));
					$userRow = $stmt->fetch(PDO::FETCH_ASSOC);

					if ($stmt->rowCount() > 0) {
						if (password_verify($passwd, $userRow['user_pass'])) {
							$_SESSION['user_session'] = $userRow['user_id'];
                			return true;
						}
					} else {
						return false;
					}

				} catch(PDOException $e) {
					echo $e->getMessage();
				}

			}

			public function is_loggedin() {
				return isset($_SESSION['user_session']);
			}

			public function redirect($url) {
				header("Location: $url");
			}

			public function logout()
   			{
        		session_destroy();
        		unset($_SESSION['user_session']);
        		return true;
   			}
			
		}
?>