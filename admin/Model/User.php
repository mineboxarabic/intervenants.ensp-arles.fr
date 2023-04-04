<?php
/**
 * @package Intervention model
 * @author Eliot Masset <eliotmasset@gmail.com>
 * @copyright Eliot Masset 2021
 **/
if(file_exists ('../../../config/config.php')) // prevent ajax call
{
	require('../../../config/config.php');
}
else
{
	require('config/config.php');
}
 

/**
 * class user (Model)
 */

class User {
	
	protected $conn;// the connection variable to database
	
	/**
	 * constructor of class
	 */
	public function __construct() {
		$this->conn = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME) //try to connect to database
			or die('I\'m sorry but the server has died. Please check your database credentials.');
	}

	/**
	 * Update the profil
	 * @param int $id ID of the user to update
	 * @param string $l_name Last Name of the user
	 * @param string $f_name First Name of the user
	 * @param string $email e-mail of the user
	 * @param string $civ Civilité of the user
	 * @param string $borndate Born date of the user
	 * @param string $phone Phone number of the user
	 * @param string $nationality Nationality of the user
	 * @param string $secu SS number of the user
	 * @param string $siret Siret number of the user
	 * @param string $addr Address of the user
	 * @param string $cp CP of the user
	 * @param string $city City of the user
	 * @param string $live_country Live country of the user
	 * @param string $born_country Born country of the user
	 * @param string $rqth Say if the user is rqth
	 * @param string $msg a msg to return
	 * @return string the $msg that say if an error occurred
	 */
	public function updateProfil($id,$l_name, $f_name, $email, $civ, $borndate, $phone, $nationality, $secu, $siret, $addr, $cp, $city, $live_country, $born_country,$rqth,$msg) {
		if (!$this->validateEmailAddress($email)) {
			$msg = "You have supplied an invalid email address!";
		}
		// Check to see if the email exists
		$sql = "SELECT member_email FROM intervenant WHERE member_email = ? AND id != ? LIMIT 1";
		$count = 0;
		$error = false;
		if ($stmt = $this->conn->prepare($sql)) {
			$stmt->bind_param('si',$email,$id);
			$stmt->execute();
			$stmt->store_result();
			$count = $stmt->num_rows;
			$stmt->close();
		} else {
			$msg = "Error : Data update Faile !";
			$error = true;
		}
		
		if($count >= 1) {
			$msg = "You can't set an existing email !";
		} else if(!$error) {
			// Ok update data's member into the database
			$sql="UPDATE intervenant SET first_name=?, last_name=?, member_email=?, civilite=?, born_date=?, nationality=?, phone=?, ss=?, siret=?, address=?, CP=?, city=?,live_country=?, born_country=?, rqth=$rqth WHERE id=?";
			if ($stmt = $this->conn->prepare($sql)) {
				$stmt->bind_param('sssssssiisssssi',$f_name,$l_name,$email,$civ,$borndate,$nationality,$phone,$secu,$siret,$addr,$cp,$city,$live_country,$born_country,$id);
				$stmt->execute();
				$stmt->close();
			} else {
				$msg = "Error : Data update Faile !";
			}
		}
		return $msg;
	}

	/**
	 * Add new profil
	 * @param string $f_name First Name of the user
	 * @param string $l_name Last Name of the user
	 * @param string $email e-mail of the user
	 * @return string the $msg that say if an error occurred
	 */
    public function add($f_name,$l_name,$email) {
		$msg="";
		if (!$this->validateEmailAddress($email)) {
			$msg = error5;
		}
		
		$chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$mdp = '';
		for($i=0; $i<8; $i++){
			$mdp .= $chars[rand(0, strlen($chars)-1)];
		}

		$personnal_key = '';
		for($i=0; $i<10; $i++){
			$personnal_key .= $chars[rand(0, strlen($chars)-1)];
		}
		
		$sql="INSERT INTO `intervenant` (`id`, `first_name`, `last_name`, `member_password`, `member_forgot`, `member_redirect`, `member_email`,`personnal_key`) VALUES (NULL, ?, ?, '".hash_pbkdf2("sha256",$mdp, "salt", 1000, 20)."', '".hash_pbkdf2("sha256",mt_rand(111111,999999), "salt", 1000, 20)."', 'index.php', ?,'$personnal_key');";
		if ($stmt = $this->conn->prepare($sql)) {
			$stmt->bind_param('sss',$f_name,$l_name,$email);
			if($stmt->execute());
			else return error1;
			$stmt->close();

			$id_intervenant=$this->getId($email);
            if(!is_dir("../upload/" . $id_intervenant."-".$personnal_key))
                mkdir("../upload/" . $id_intervenant."-".$personnal_key, 0777, true);
			
			
		//require_once('Controller/Email.php');
		//$Email = new Email;
		
	include("config/Mailjet/php-mailjet-v3-simple.class.php");

$apiKey = '796120ead20556203da028d5843d4b7a';
$secretKey = '19a3b02d8633de6f0622122fb65d5994';

$mj = new Mailjet('334ed6fd723964363a5f3398c2d7622e', '997609099c64f1b139cbb2681d80a591');		
	$params = array(
    "method" => "POST",
    "from" => "support@ensp-arles.fr",
    "to" => $email,
    "subject" => "ENSP Inscriptions",
    "html" => "Bonjour $f_name $l_name,
			<br>
		Un accès à l'application de gestion des intervenants de l'Ecole nationale supérieure de la Photographie vient de vous être créé.
		". DOMAIN_NAME . "
		<br><br>
		Les identifiants et informations personnelles relatifs à votre compte sont :
		<br><br>
		Mail (nom d'utilisateur): $email <br>
		Mot de passe : $mdp <br>
		Attention : le mot de passe étant chiffré, il ne sera pas possible de le retransmettre !
		<br><br>
		Nous vous invitons fortement à finaliser les informations relatives à votre compte à l'adresse :". DOMAIN_NAME . "/profil.php
		Celle-ci seront automatiquement transmise à l'équipe administrative.
		<br><br>
		Cordialement.<br>
		L'équipe administrative de l'ENSP.  
		",);
$result = $mj->sendEmail($params);
if ($mj->_response_code == 200)
    echo "success - email sent";
else
    echo "error - " . $mj->_response_code;
	
		/*
		if ($mail = $Email->newUser($f_name,$l_name,$email, $mdp)) {
			} 
		*/		
		
		return $msg;
    }
  
}
	/**
	 * Getter to the database
	 * @param string $thing The thing to get
	 * @param int $id ID of the user
	 * @return string the $thing of the user $id
	 */
	public function get($thing,$id) {
		$ret="";
		$query = "SELECT $thing FROM `intervenant` WHERE id=$id LIMIT 1";
		if ($stmt = $this->conn->prepare($query)) {
			$stmt->execute();
			$stmt->bind_result($ret);
			$stmt->fetch();
			$stmt->close();
		}
		return $ret;
		
	}
	/**
	 * Getter to the database (admin)
	 * @param string $thing The thing to get
	 * @param int $id ID of the admin
	 * @return string the $thing of the admin $id
	 */
	public function getAdmin($thing,$id) {
		$ret="";
		$query = "SELECT $thing FROM `membres` WHERE id=? LIMIT 1";
		if ($stmt = $this->conn->prepare($query)) {
			$stmt->bind_param('i',$id);
			$stmt->execute();
			$stmt->bind_result($ret);
			$stmt->fetch();
			$stmt->close();
		}
		
		return $ret;
		
	}
	
	/**
	 * Getter of all user
	 * @return array all user
	 */
	public function getAll() {
		$sql = "SELECT `id`,`first_name` as 'Prénom',`last_name` as 'Nom',`member_email` as 'Email',`phone` as 'Téléphone' FROM `intervenant`";
		if ($stmt = $this->conn->query($sql)) {
			return $stmt;
			$stmt->close();
		}
		return false;
	}

	/**
	 * Getter of all referants
	 * @return array all referants
	 */
	public function getAllReferants() {
		$sql = "SELECT `id`,`first_name`,`last_name` FROM `referant` order by `last_name`";
		$stmt = $this->conn->query($sql);
		if ($stmt) {
			return $stmt;
			$stmt->close();
		}
		return false;

	}

	/**
	 * Modify the mdp of a user
	 * @param int $id ID of the user
	 * @param string $l_name Last mdp of the user
	 * @param string $n_mdp New mdp (Hashed) of the user
	 * @param string $mdp_unashed New mdp (un-Hashed) of the user
	 * @return string the $msg that say if an error occurred
	 */
	public function modifyMdp($id, $l_mdp, $n_mdp,$mdp_unashed)
	{
		$msg="";
		$sql = "SELECT * FROM intervenant WHERE member_password = ? AND id = ? LIMIT 1";
		$count = 0;
		$error = false;
		if ($stmt = $this->conn->prepare($sql)) {
			$stmt->bind_param('si',$l_mdp,$id);
			$stmt->execute();
			$stmt->store_result();
			$count = $stmt->num_rows;
			$stmt->close();
		} else {
			$msg = error4;
			$error = true;
		}
		
		if($count==0) {
			$msg = error3;
		} else {
			$sql="UPDATE intervenant SET member_password=? WHERE id=?";
			if ($stmt = $this->conn->prepare($sql)) {
				$stmt->bind_param('si',$n_mdp,$id);
				$stmt->execute();
				$stmt->close();
				require_once('Controller/Email.php');
				$Email = new Email;
				if ($mail = $Email->updateMdpSuccess("",$this->getEmail($id),$mdp_unashed)) {
				}
			} else {
				$msg = error4;
			}
		}
		return $msg;
	}

	/**
	 * Set the new mdp of the user (by the way of forgotting button)
	 * @param int $id ID of the user
	 * @param string $mdp New mdp (Hashed) of the user
	 * @param string $mdp_unashed New mdp (un-Hashed) of the user
	 * @return string the $msg that say if an error occurred
	 */
	public function setForgotMdp($id, $mdp,$mdp_unashed) {
		$sql="UPDATE intervenant SET member_password=? WHERE id=?";
		$msg="";
		if ($stmt = $this->conn->prepare($sql)) {
			$stmt->bind_param('si',$mdp,$id);
			$stmt->execute();
			$stmt->close();
			require_once('Controller/Email.php');
			$Email = new Email;
			if ($mail = $Email->updateMdpSuccess("",$this->getEmail($id), $mdp_unashed)) {
			}
		} else {
			$msg = error4;
		}
		return $msg;
	}
	
	/**
	 * Getter of first name
	 * @param int $id ID of the user
	 * @return string the first name of the user $id
	 */
	public function getFirstName($id) {
		$firstname="";
		$query = "SELECT first_name FROM `intervenant` WHERE id=? LIMIT 1";
		if ($stmt = $this->conn->prepare($query)) {
			$stmt->bind_param('i',$id);
			$stmt->execute();
			$stmt->bind_result($firstname);
			$stmt->fetch();
			$stmt->close();
		}
		
		return $firstname;
	}

	/**
	 * Getter of last name
	 * @param int $id ID of the user
	 * @return string the last name of the user $id
	 */
	public function getLastName($id) {
		$lastname="";
		$query = "SELECT last_name FROM `intervenant` WHERE id=? LIMIT 1";
		if ($stmt = $this->conn->prepare($query)) {
			$stmt->bind_param('i',$id);
			$stmt->execute();
			$stmt->bind_result($lastname);
			$stmt->fetch();
			$stmt->close();
		}
		
		return $lastname;
		
	}

	/**
	 * Getter of email
	 * @param int $id ID of the user
	 * @return string the email of the user $id
	 */
	public function getEmail($id) {
		$member_email="";
		$query = "SELECT member_email FROM `intervenant` WHERE id=? LIMIT 1";
		if ($stmt = $this->conn->prepare($query)) {
			$stmt->bind_param('i',$id);
			$stmt->execute();
			$stmt->bind_result($member_email);
			$stmt->fetch();
			$stmt->close();
		}
		
		return $member_email;
		
	}

	/**
	 * Getter of id
	 * @param string $mail E-mail of the user
	 * @return string the id of the user that have the mail $mail
	 */
	public function getId($mail) {
		$id="";
		$query = "SELECT id FROM `intervenant` WHERE member_email=? LIMIT 1";
		if ($stmt = $this->conn->prepare($query)) {
			$stmt->bind_param('s',$mail);
			$stmt->execute();
			$stmt->bind_result($id);
			$stmt->fetch();
			$stmt->close();
		}
		
		return $id;
		
	}

	/**
	 * Getter of code
	 * @param string $mail E-mail of the user
	 * @return string the code of the user that have the mail $mail
	 */
	public function getCode($mail) {
		$member_forgot="";
		$query = "SELECT member_forgot FROM `intervenant` WHERE member_email=? LIMIT 1";
		if ($stmt = $this->conn->prepare($query)) {
			$stmt->bind_param('s',$mail);
			$stmt->execute();
			$stmt->bind_result($member_forgot);
			$stmt->fetch();
			$stmt->close();
		}
		
		return $member_forgot;
		
	}

	/**
	 * Update of code
	 * @param string $mail E-mail of the user
	 * @return boolean Say if the function work
	 */
	public function newCode($email) {
		if (!$this->validateEmailAddress($email)) {
			return false;
		}
		$code=hash_pbkdf2("sha256",mt_rand(111111,999999), "salt", 1000, 20);
		$sql = "UPDATE intervenant SET member_forgot='$code' WHERE member_email=?";
		
		if ($stmt = $this->conn->prepare($sql)) {
			$stmt->bind_param('s',$email);
			$stmt->execute();
			$stmt->close();
		}
	}

	/**
	 * Say if a mail is valide
	 * @param string $mail E-mail of the user
	 * @return boolean Say if the mail is valide
	 */
	public function valideMail($email) {
		if (!$this->validateEmailAddress($email)) {
			return false;
		}
		$sql = "SELECT * FROM intervenant WHERE member_email = ? LIMIT 1";
		
		if ($stmt = $this->conn->prepare($sql)) {
			$stmt->bind_param('s',$email);
			$stmt->execute();
			$stmt->store_result();
			$count = $stmt->num_rows;
			if($count >= 1) {
				$stmt->close();
				return true;
			} else {
				return false;
			}
		}
		
		return false;
	}

	/**
	 * Delete a user
	 * @param int $id ID of the user
	 * @return string Say if the mail is valide
	 */
	public function delete($id) {
		$sql = "DELETE i FROM `intervention` i WHERE EXISTS (SELECT 1 FROM `dossier` d WHERE d.`id`=i.`id_dossier` AND EXISTS (SELECT 1 FROM `intervenant` u WHERE d.`id_intervenant`=u.`id` AND u.`id` = $id))";
		$stmt = $this->conn->query($sql);
		if ($stmt) {
			$sql = "DELETE f FROM `files` f WHERE EXISTS (SELECT 1 FROM `dossier` d WHERE d.`id`=f.`id_dossier` AND EXISTS (SELECT 1 FROM `intervenant` u WHERE d.`id_intervenant`=u.`id` AND u.`id` = $id))";
			$stmt = $this->conn->query($sql);
			if ($stmt) {
				$sql = "DELETE d FROM `dossier` d WHERE EXISTS (SELECT 1 FROM `intervenant` u WHERE d.`id_intervenant`=u.`id` AND u.`id` = $id)";
				$stmt = $this->conn->query($sql);
				if ($stmt) {
					$sql = "DELETE FROM `intervenant` WHERE `id` = $id";
					$stmt = $this->conn->query($sql);
					if ($stmt) {
						return $stmt;
						$stmt->close();
					}
				}
			}
		}
		return "error";
	}

	/**
	 * Say if the user have a complete profil
	 * @param int $id ID of the user
	 * @return boolean Say if the user have a complete profil
	 */
	public function hasCompleteProfil($id) {
		//$sql = "SELECT * FROM `intervenant` WHERE `id`=$id AND `civilite`!='' AND `born_date`!='0000-00-00' AND `born_country`!=''AND `nationality`!='' AND `first_name`!='' AND `last_name`!='' AND (`ss`!=0 OR `siret`!=0)";
		$sql = "SELECT * FROM `intervenant` WHERE `id`=$id AND `civilite`!='' AND `born_date`!='0000-00-00' AND `born_country`!=''AND `nationality`!='' AND `first_name`!='' AND `last_name`!=''";
		if ($stmt = $this->conn->query($sql)) {
			if(!empty($stmt->fetch_assoc()))
				return true;
			$stmt->close();
		}
		return false;
	}

	/**
	 * Say if the user can reset password
	 * @param string $email E-mail of the user
	 * @param string $code Code of the user
	 * @return boolean Say if the user can reset password
	 */
	public function canResetPassword($email, $code) {
		if (!$this->validateEmailAddress($email)) {
			return false;
		}
		$sql = "SELECT member_email,member_forgot FROM intervenant WHERE member_email = ? AND member_forgot = ? LIMIT 1";
		
		if ($stmt = $this->conn->prepare($sql)) {
			$stmt->bind_param('ss',$email,$code);
			$stmt->execute();
			$stmt->store_result();
			$count = $stmt->num_rows;
			if($count >= 1) {
				$stmt->bind_result($email,$code);
				$stmt->fetch();
				$stmt->close();
				return true;
			} else {
				return false;
			}
		}
		
		return false;
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
	 * Close the connection to the database.
	 **/ 
	public function __destruct(){
		if ($this->conn->close())
			return true;
	}
}
?>