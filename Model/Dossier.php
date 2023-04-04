<?php
/**
 * @package Dossiers model
 * @author Eliot Masset <eliotmasset@gmail.com>
 * @copyright Eliot Masset 2021
 **/
if(file_exists ('../../config/config.php')) // prevent ajax call
	require('../../config/config.php');
else
	require('config/config.php');

/**
 * class dossier (Model)
 */
class Dossier {
	
	protected $conn; // the connection variable to database
	
	/**
	 * constructor of class
	 */

	public function __construct() {
		$this->conn = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME) //try to connect to database
			or die('I\'m sorry but the server has died. Please check your database credentials.');
	}

	/**
	 * Getter of all folder of a user in dossiers table
	 * @param int $id ID of a user
	 * @return array all folder
	 */
	public function getAll($id) {
		$sql = "SELECT `id` as 'N°',`title` as 'Titre',`year` as 'Année',`statut` as 'Statut du dossier' FROM `dossier` WHERE `id_intervenant`=$id ORDER BY 2 DESC";
		$stmt = $this->conn->query($sql);
		if ($stmt) {
			return $stmt;
			$stmt->close();
		}
		return false;
	}

	/**
	 * Getter to the database
	 * @param string $thing The thing to get
	 * @param int $id ID of the dossier
	 * @return object the $thing of the folder $id
	 */
	public function get($thing,$id) {
		$ret="";
		$query = "SELECT $thing FROM `dossier` WHERE id=$id LIMIT 1";
		if ($stmt = $this->conn->prepare($query)) {
			$stmt->execute();
			$stmt->bind_result($ret);
			$stmt->fetch();
			$stmt->close();
		}
		return $ret;
		
	}
	
	public function getmail($created_user) {
		$created_mail="";
		$query = "SELECT email FROM `membres` WHERE id=$created_user LIMIT 1";
		if ($stmt = $this->conn->prepare($query)) {
			$stmt->execute();
			$stmt->bind_result($created_mail);
			$stmt->fetch();
			$stmt->close();
		}
		return $created_mail;
		
	}

	/**
	 * Check if the folder have to be complete
	 * @param int $id ID of the dossier
	 * @return boolean say if the folder have to be complete
	 */
	public function haveToComplete($id) {
		$sql = "SELECT * FROM `dossier` WHERE `id_intervenant`=$id AND `statut`=0";
		$stmt = $this->conn->query($sql);
		if ($stmt) {
			return $stmt->num_rows;
			$stmt->close();
		}
		return 0;
	}

	/**
	 * Update the profil part of a folder
	 * @param int $id_dossier ID of the folder
	 * @param string $email Email of the user
	 * @param string $phone Phone number of the user
	 * @param string $adresse Adresse of the user
	 * @param string $cp CP of the user
	 * @param string $city City of the user
	 * @param string $live_country Live Country of the user
	 * @param boolean $rqth Say if the user is rqth
	 * @return string the $msg that say if an error occurred
	 */
	public function update($id_dossier,$email,$phone,$adresse,$cp,$city,$live_country,$rqth,$msg) {
		if (!$this->validateEmailAddress($email)) {
			$msg = "Adresse mail invalide";
		}
		$sql="UPDATE dossier SET member_email=?, phone=?, address=?, CP=?, city=?,live_country=?, rqth=$rqth WHERE id=?";
		if ($stmt = $this->conn->prepare($sql)) {
			$stmt->bind_param('sssissi',$email,$phone,$adresse,$cp,$city,$live_country,$id_dossier);
			$stmt->execute();
			$stmt->close();
		} else {
			$msg = "Error : Data update Fail !";
		}
		return $msg;
	}

	/**
	 * Check if the profil of a folder is complete
	 * @param int $id ID of the folder
	 * @return boolean Say if the profil is complete
	 */
	public function isProfilComplete($id) {
		$sql = "SELECT * FROM `dossier` WHERE `id`=$id AND `phone`!='' AND `member_email`!='' AND `address`!=''AND `CP`!=0 AND `city`!='' AND `live_country`!='' ORDER BY 2 DESC";
		$stmt = $this->conn->query($sql);
		if ($stmt) {
			if(!empty($stmt->fetch_assoc()))
				return true;
			$stmt->close();
		}
		return false;
	}

	/**
	 * Check if the additionals datas of a folder is complete
	 * @param int $id ID of the folder
	 * @return boolean Say if the additionals datas are complete
	 */
	public function isDataComplete($id) {
		//$sql = "SELECT * FROM `dossier` WHERE `id`=$id AND ((`remuneration`='Facture' AND `siren`!='') OR (`remuneration`!='Facture')) AND ((`statut_social`='Salarie du secteur public' AND `employeur`!='') OR (`statut_social`!='Salarie du secteur public')) AND (`statut_social`!='' AND `remuneration`!='') ORDER BY 2 DESC";
		$sql = "SELECT * FROM `dossier` WHERE `id`=$id AND ((`remuneration`='Facture' AND `siren`!='') OR (`remuneration`!='Facture')) AND ((`statut_social`='Salarie du secteur public' AND `employeur`!='') OR (`statut_social`!='Salarie du secteur public')) AND `remuneration`!='' ORDER BY 2 DESC";
		$stmt = $this->conn->query($sql);
		if ($stmt) {
			if(!empty($stmt->fetch_assoc()))
				return true;
			$stmt->close();
		}
		return false;
	}

	/**
	 * Update the SIREN number of a folder
	 * @param int $id ID of the folder
	 * @param string $siren SIREN number
	 * @param string $msg a msg to return
	 * @return string the $msg that say if an error occurred
	 */
	public function updateSIREN($id, $siren, $msg) {
		$sql="UPDATE `dossier` SET `siren`=? WHERE `id`=?";
		if ($stmt = $this->conn->prepare($sql)) {
			$stmt->bind_param('si', $siren, $id);
			$stmt->execute();
			$stmt->close();
		} else {
			$msg = "Error : Data update Fail!";
		}

		return $msg;
	}

	/**
	 * Update the state of a folder
	 * @param int $id ID of the folder
	 * @param string $state the state
	 * @param string $msg a msg to return
	 * @return string the $msg that say if an error occurred
	 */
	public function updateState($id, $state, $msg) {
		$sql="UPDATE `dossier` SET `statut_social`=? WHERE `id`=?";
		if ($stmt = $this->conn->prepare($sql)) {
			$stmt->bind_param('si', $state, $id);
			$stmt->execute();
			$stmt->close();
		} else {
			$msg = "Error : Data update Fail!";
		}

		return $msg;
	}
	
	/**
	 * Update the NOM STRUCTURE number of a folder
	 * @param int $id ID of the folder
	 * @param string $siren SIREN number
	 * @param string $msg a msg to return
	 * @return string the $msg that say if an error occurred
	 */
	public function updatenomStructure($id, $nomStructure, $msg) {
		$sql="UPDATE `dossier` SET `nomStructure`=? WHERE `id`=?";
		if ($stmt = $this->conn->prepare($sql)) {
			$stmt->bind_param('si', $nomStructure, $id);
			$stmt->execute();
			$stmt->close();
		} else {
			$msg = "Error : Data update Fail!";
		}

		return $msg;
	}
	
	/**
	 * Update the employer's name of a folder
	 * @param int $id ID of the folder
	 * @param string $name the employer's name
	 * @param string $msg a msg to return
	 * @return string the $msg that say if an error occurred
	 */
	public function updateEmployeur($id, $name, $msg) {
		$sql="UPDATE `dossier` SET `employeur`=? WHERE `id`=?";
		if ($stmt = $this->conn->prepare($sql)) {
			$stmt->bind_param('si', $name, $id);
			$stmt->execute();
			$stmt->close();
		} else {
			$msg = "Error : Data update Fail!";
		}

		return $msg;
	}

	/**
	 * Update the folder to 'sans emploi'
	 * @param int $id ID of the folder
	 * @param string $msg a msg to return
	 * @return string the $msg that say if an error occurred
	 */
	public function toSansEmploi($id,$msg) {
		$sql="UPDATE `dossier` SET `employeur`='' WHERE `id`=?";
		if ($stmt = $this->conn->prepare($sql)) {
			$stmt->bind_param('i', $id);
			$stmt->execute();
			$stmt->close();
			
			$name="";
			$id_user=0;
			$query = "SELECT name,id_intervenant FROM `files` WHERE id_dossier=? AND correspondance='CE'  LIMIT 1";
			if ($stmt = $this->conn->prepare($query)) {
				$stmt->bind_param('i',$id);
				$stmt->execute();
				$stmt->bind_result($name,$id_user);
				$stmt->fetch();
				$stmt->close();
			}
            $personnal_key="";
			$query = "SELECT personnal_key FROM `intervenant` WHERE id=$id_user LIMIT 1";
			if ($stmt = $this->conn->prepare($query)) {
				$stmt->execute();
				$stmt->bind_result($personnal_key);
				$stmt->fetch();
				$stmt->close();
			}
			$file="upload/" . $id_user."-".$personnal_key."/".$id. "/" . $name;
			if(file_exists($file) && !empty($id_user)) {
				unlink($file);
			}
			$sql="DELETE FROM `files` WHERE id_dossier=? AND correspondance='CE' ";
			if ($stmt = $this->conn->prepare($sql)) {
				$stmt->bind_param('i',$id);
				$stmt->execute();
				$stmt->close();
			} else {
				$msg = "Error : Data update Fail!";
			}
		} else {
			$msg = "Error : Data update Fail!";
		}

		return $msg;

	}
	

	/**
	 * Update the folder to 'Complet'
	 * @param int $id ID of the folder
	 * @return boolean that say if the function work fine
	 */
	public function setComplete($id,$id_i) {
		$sql = "SELECT * FROM `dossier` WHERE `id`=$id AND `statut`=0";
		$stmt = $this->conn->query($sql);
		if ($stmt) {
			if(!empty($stmt->fetch_assoc()))
			{
				$stmt->close();
				$sql="UPDATE dossier SET statut=1 WHERE id=?";
				if ($stmt = $this->conn->prepare($sql)) {
					$stmt->bind_param('i',$id);
					$stmt->execute();
					$stmt->close();
					
					include("admin/config/Mailjet/php-mailjet-v3-simple.class.php");
					
					$apiKey = '796120ead20556203da028d5843d4b7a';
					$secretKey = '19a3b02d8633de6f0622122fb65d5994';

					$mj = new Mailjet('334ed6fd723964363a5f3398c2d7622e', '997609099c64f1b139cbb2681d80a591');		
					$params = array(
    					"method" => "POST",
    					"from" => "support@ensp-arles.fr",
    					"to" => "chantal.castagno@ensp-arles.fr",
    					"CC" => "b.martinez@ensp-arles.fr",
    					"Bcc" => "elodie.veyrier@ensp-arles.fr",
    					"subject" => "ENSP Intervenants || Nouveau dossier en attente de validation",
   						"html" => "Bonjour,<br><br>
   						Un intervenant a soumis son dossier pour validation,
   						Merci de vous rendre sur la plateforme <a href='https://intervenants.ensp-arles.fr/admin/dossier.php?id_d=".$id."&id_i=".$id_i."' target='_blank'>https://intervenants.ensp-arles.fr/admin/dossier.php?id_d=".$id."&id_i=".$id_i."</a><br>
   						afin de vérifier la conformité des informations.<br><br>
   						Bonne journée.
   						<br><br>
   						**** Ceci est un mail automatique ne pas répondre *****
						",);
					$result = $mj->sendEmail($params);
					if ($mj->_response_code == 200)
    					echo "success - email sent";
					else
    				echo "error - " . $mj->_response_code;
	

					/*
					require_once('Controller/Email.php');
					$Email = new Email;
					require_once('Model/User.php');
					$User = new User;
					if ($mail = $Email->dossierComplete($this->get("title",$id),$this->get("year",$id),$User->get("CONCAT(`last_name`,' ',`first_name`)",$this->get("id_intervenant",$id)),$id,$this->get("id_intervenant",$id))) {
						return true;
					}
					*/
					return false;
				} else {
					return false;
				}
			}
		}
		return false;
		
	}
	
	/**
	 * Check if the e-mail is valide
	 * @param string $email Mail to check
	 * @return boolean that say if the mail is valide
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