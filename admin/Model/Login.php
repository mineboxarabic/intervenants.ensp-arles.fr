<?php
/**
 * @package Dossiers model
 * @author Eliot Masset <eliotmasset@gmail.com>
 * @copyright Eliot Masset 2021
 **/
if(file_exists ('../../../config/config.php')) // prevent ajax call
	require('../../../config/config.php');
else
	require('../config/config.php');

/**
 * class Login (Model)
 */

class Login {
	
	protected $conn; // the connection variable to database
	
	/**
	 * constructor of class
	 */
	public function __construct() {
		$this->conn = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME) //try to connect to database
			or die('I\'m sorry but the server has died. Please check your database credentials.');
	}
	
	/**
	*	This method checks the username and password from the login
	* 	and returns either a success message or error message 
	* @param string $username the username to check
	* @param string $password the password to check
	* @param string a message to indicate if the check if a success or not.
	*/
	public function checkUserLogin($username, $password) {
		// Set up our SQL statement 
		$sql = 'SELECT `id`,`first_name`,`last_name`,`member_admin` FROM `membre` WHERE email = ?';
		
		// Check their login attempts 
		$attempts = $_SESSION['attempts'] = isset($_SESSION['attempts']) ? $_SESSION['attempts'] : 0;
		if ($attempts >= NUMBER_OF_ATTEMPTS) {
			$message['error'] = true;
			$message['message'] = "Trop d'essais, merci de revenir plus tard!";
			return json_encode($message);
		} 
		else if ($stmt = $this->conn->prepare($sql)) {
			// A nice and secure way to query the database 
			$stmt->bind_param('s',$username);
			$stmt->execute();
			$stmt->bind_result($user_id,$first_name, $last_name, $acreditation);
			if (!empty($stmt->fetch())) {
				$_SESSION['member_logged_in'] = true;
				$_SESSION['member_id'] = $user_id;
				$_SESSION['first_name'] = $first_name;
				$_SESSION['last_name'] = $last_name;
				$_SESSION['username']=$username;
				$_SESSION['acreditation'] = $acreditation;
				$_SESSION['member_username'] = $username;
				// Reset login attempts 
				$_SESSION['attempts'] = 0;
				$_SESSION['admin']=true;
				
				$_COOKIE['username']=$username;
				$redir="index.php";
	
				// Ok so they have logged in... yaay! 
				$message['error'] = false;
				$message['message'] = "Bienvenue $username !<br>Click <a href='$redir'>here</a> to continue.";
				$message['redirect'] = $redir;
				return json_encode($message);
			} else {
				// Create a session and rack the attempts up so we can lock em out 
				@$_SESSION['attempts'] = $_SESSION['attempts'] + 1;
				// Ok they supplied incorrect details so scare them away 
				$message['error'] = true;
				$message['message'] = "Vous avez rentr&eacute; une  mauvaise association  login/mot de passe.";
				return json_encode($message);
			}
			$stmt->fetch();
			$stmt->close();
			

			
		} else {
			// Create a session and rack the attempts up so we can lock em out 
			@$_SESSION['attempts'] = $_SESSION['attempts'] + 1;
			// Ok they supplied incorrect details so scare them away 
			$message['error'] = true;
			$message['message'] = "Vous avez rentr&eacute; une  mauvaise association  login/mot de passe.";
			return json_encode($message);
		}
	}
	
	/**
	* Counts the number of members.
	* @return int the number of members
	*/
	public function countMembers() {
		$sql = "SELECT `id` FROM `intervenant`";
		$stmt = $this->conn->query($sql);
		if ($stmt) {
			$count = $stmt->num_rows;
			$stmt->close();
			return $count;
		}
	}

	/**
	* Getter of all user
	* @return array Array of all user
	*/
	public function getAllUsers() {
		
		$query = "SELECT * FROM `intervenant`";
		$result = $this->conn->query($query);
		
		$rows = array();
		
		while ($row = $result->fetch_row()) {
			$rows[] = $row;
		}
		
		$result->close();
		
		return $rows;
		
	}
	
	/**
	*	Register the user to the site 
	*/
	public function registerUser($first_name, $last_name, $username,$captcha) {
		// Do some checks to make sure everything is valid before we insert it into the database 
		if ($captcha != $_SESSION['answer']) {
			$error = true;
			$message['error'] = true;
			$message['message'] = "Invalid captcha, please try again!";
			return json_encode($message);
		} 

		if (strlen($password) < 3) {
			$error = true;
			$message['error'] = true;
			$message['message'] = "Please use a longer password to ensure security!";
			return json_encode($message);
		}
		
		if (!$this->validateEmailAddress($email)) {
			$error = true;
			$message['error'] = true;
			$message['message'] = "You have supplied an invalid email address!";
			return json_encode($message);
		}

		if (!isset($error)) {
			// Check to see if the username exists 
			$sql = "SELECT member_email FROM intervenant WHERE member_email = '$username' LIMIT 1";
			$stmt = $this->conn->query($sql);
			$count = $stmt->num_rows;
			$stmt->close();
			
			if($count >= 1) {
				$message['error'] = true;
				$message['message'] = "I'm sorry but $username is already in use!";
				return json_encode($message);
			} else {
				// Ok insert member into the database 
				$sql = "INSERT INTO intervenant (first_name,
											last_name,
											member_password,
											member_forgot,
											member_status,
											member_email) VALUES (?,?,?,?,?,?)";
						
				// Set the admin default to 0 					
				$admin = 0;
				// Generate a secret code incase the user forgets password 
				$secret = hash_pbkdf2("sha256",mt_rand(111111,999999), "salt", 1000, 20);
											
				if ($stmt = $this->conn->prepare($sql)) {
					$stmt->bind_param('ssssis',$first_name,$last_name,$secret,"",$status, $username);
					$stmt->execute();
					$stmt->close();
					require_once('Email.php');
					$Email = new Email;
					if ($mail = $Email->registerSuccess($first_name,$username,$userPassword)) {
						$message['error'] = false;
						$message['message'] = "Welcome $first_name, you have successfully signed up!";
						return json_encode($message);
					}
				} else {
					$message['error'] = true;
					$message['message'] = "Hmm, a weird error occurred, please try again!";
					return json_encode($message);
				}
			}
		}
	}
	
	/**
	*	Called if the user forgets password 
	*/
	public function forgotPassword($email) {
		if (!$this->validateEmailAddress($email)) {
			$error = true;
			$message['error'] = true;
			$message['message'] = "Please enter a valid email!";
			return json_encode($message);
		}
		
		if (!isset($error)) {
			$sql = "SELECT email FROM membres WHERE email = '$email' LIMIT 1";
			
			if ($stmt = $this->conn->query($sql)) {
				$count = $stmt->num_rows;
				if($count >= 1) {
					// Continue with the emailing of reset details as the email exists 
					$sql = "SELECT email,member_forgot FROM membres WHERE email = ? LIMIT 1";
					if ($stmt = $this->conn->prepare($sql)) {
						$stmt->bind_param('s',$email);
						$stmt->execute();
						$stmt->bind_result($email,$code);
						$stmt->fetch();
						$stmt->close();
						
						require_once 'Email.php';
						$Email = new Email;
						if ($send = $Email->sendForgotPassword($email,$code)) {
							$message['error'] = false;
							$message['message'] = "Merci, les instructions de réinitialisation de mot de passe vous ont été envoyées !";
							return json_encode($message);
						} else {
							$message['error'] = true;
							$message['message'] = "Hmm, a weird error occurred, please try again!";
							return json_encode($message);
						}
					}
				} else {
					// The email doesnt exist 
					$message['error'] = true;
					$message['message'] = "Cette adresse n'existe pas, contactez votre administrateur !";
					return json_encode($message);
				}
			}
		}
	}
	
	/**
	*	Validate email address 
	*/
	public function validateEmailAddress($email) {
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			return false;
		} else {
			return true;
		}
	}
	
	/**
	*	This method checks to see if a user is logged in
	*/
	public function verify() {
		if(isset($_SESSION['member_logged_in'])) {
			return true; 
		} else {
			header("Location: login.php");
			exit();
		}

	}
	
	/**
	 * Log the user out.
	 **/
	public function logUserOut() {
		if (isset($_SESSION['member_logged_in'])) {
			if(session_destroy()) {
				header("Location: login.php");
				exit();
			}
		}
	}
	
	/**
	*	Generates a sum for the user to ensure they are human 
	*/
	public function mathCaptcha() {
		$sum1 = mt_rand(1,9);
		$sum2 = mt_rand(1,9);
		$sum3 = $sum1 + $sum2;
		$_SESSION['answer'] = $sum3;
		return $sum1 . ' + ' . $sum2 . ' = ';
	}
	
	public function validateResetInfo($email,$code) {
		$email = strip_tags($email);
		$code = strip_tags($code);
		$sql = "SELECT email,member_forgot FROM membres WHERE email = '$email' AND member_forgot = '$code' LIMIT 1";
		if ($stmt = $this->conn->query($sql)) {
			$count = $stmt->num_rows;
			if ($count >= 1) {
				return true;
			} else {
				return false;
			}
		}
	}
	
	/**
	*	Change users password 
	*/
	public function changeUserPassword($email, $newPass, $newPass2, $code) {
		if ($newPass != $newPass2) {
			$error = true;
			$message['error'] = true;
			$message['message'] = "I'm sorry but those passwords don't match!";
			return json_encode($message);
		}
		
		if (strlen($newPass < 4)) {
			$error = true;
			$message['error'] = true;
			$message['message'] = "I'm sorry but that password is too short!";
			return json_encode($message);
		}

		if (!$this->validateResetInfo($email, $code)) {
			$error = true;
			$message['error'] = true;
			$message['message'] = "Hmm, seems as though the email doesn't match the reset code... Bailing out!";
			return json_encode($message);
		}
		
		if (!isset($error)) {
			// Ok no errors so change the users password 
			$sql = "UPDATE membres SET member_password = ? WHERE email = '$email' LIMIT 1";
			if($stmt = $this->conn->prepare($sql)) {
				$stmt->bind_param('s',$newPass);
				$stmt->execute();
				$stmt->close();
				
				$message['error'] = false;
				$message['message'] = "Merci votre mot de passe est reinitialisé !";
				return json_encode($message);
			}
		}
	}
	
	/**
	 * Close the connection to the database.
	 **/ 
	public function __destruct(){
		if ($this->conn->close())
			return true;
	}
}
?>