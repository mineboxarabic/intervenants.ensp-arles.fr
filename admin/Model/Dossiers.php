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
 * class dossiers (Model)
 */

class Dossiers {
	
	protected $conn; // the connection variable to database
	
	/**
	 * constructor of class
	 */
	public function __construct() {
		$this->conn = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME) //try to connect to database
			or die('I\'m sorry but the server has died. Please check your database credentials.');
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

	/**
	 * Function for add a row into the dossiers table.
	 * Create a new folder with few datas.
	 * @param string $year Year of the folder (ex: 2021-2022)
	 * @param string $title Title of the folder
	 * @param int $intervenant ID of the intervenant
	 * @param string $remun Type of remuneration of the folder (ex: Facture)
	 * @param string $msg a msg to return
	 * @return string the $msg that say if an error occurred
	 */
	public function add($year, $title, $intervenant, $remun, $msg) {

		$sql="INSERT INTO `dossier` (`id`,`year`, `title`, `id_intervenant`, `remuneration`,`created_user`) VALUES (NULL,?, ?, ?, ?, ".$_SESSION["member_id"].");";
		if ($stmt = $this->conn->prepare($sql)) {
			$stmt->bind_param('ssis',$year,$title,$intervenant,$remun);
			if(!$stmt->execute())
				return "Error : Data update Fail!";
			$id=$stmt->insert_id;
			
			

			/*
			require_once('Controller/Email.php');
			$Email = new Email;
			*/
			require_once('Model/User.php');
			$User = new User;
			//$Email->newFolder($User->get("first_name", $intervenant)." ".$User->get("last_name", $intervenant),$User->get("member_email", $intervenant), $title, $year, $stmt->insert_id);
			$stmt->close();
			return $id;
		} else {
			$msg = "Error : Data update Fail!";
		}

		return $msg;
	}
	
	/**
	 * Getter of all folder in dossiers table
	 * @return array all folder
	 */
	public function getAll() {
		//$sql = "SELECT d.`id`,`title` as 'Titre',`id_intervenant`,CONCAT(`first_name`,' ', `last_name`) as 'Intervenant',`year` as 'Année',`remuneration`,d.`phone`,d.`member_email` as `mail`,d.`address` as 'adresse',d.`CP`,d.`city`,d.`live_country`,`siren`,`statut_social`,`employeur`,`statut` FROM `dossier` d INNER JOIN `intervenant` i ON `id_intervenant`=i.`id` INNER JOIN `intervention` J ON `id_dossier`=J.`id_dossier`  ";
		
		$sql = "SELECT d.`id`,d.`title` as 'Titre',`id_intervenant`,CONCAT(`first_name`,' ', `last_name`) as 'Intervenant',`year` as 'Année',`remuneration`,d.`phone`,d.`member_email` as `mail`,d.`address` as 'adresse',d.`CP`,d.`city`,d.`live_country`,`siren`,`statut_social`,`employeur`,d.`statut`,DATE_FORMAT(J.`date_begin`,'%d/%m/%Y') as '1ere inter.' FROM `dossier` d INNER JOIN `intervenant` i ON `id_intervenant`=i.`id` INNER JOIN `intervention` J ON d.`id`=J.`id_dossier` GROUP BY  d.`id` ";
		$stmt = $this->conn->query($sql);
		if ($stmt) {
			return $stmt;
			$stmt->close();
		}
		return false;
	}

	/** 
	 * Getter of all folder for one intervenant
	 * @param int $id ID of the intervenant
	 * @return array all folder of the intervenant $id
	 */
	public function getAllById($id) {
		$sql = "SELECT `id`,`statut`,`title`,`year` FROM `dossier` WHERE `id_intervenant`=$id ORDER BY 4 DESC";
		$stmt = $this->conn->query($sql);
		if ($stmt) {
			return $stmt;
			$stmt->close();
		}
		return false;
	}
	
	
	public function getDateById($id) {
		$sql = "SELECT `date_begin` FROM `intervention` WHERE `id_dossier`=$id ORDER by date_begin ASC LIMIT 1 ";
		$stmt = $this->conn->query($sql);
		if ($stmt) {
			return $stmt;
			$stmt->close();
		}
		return false;
	}

	
	/**
	 * Update the state of a folder to 'Validé'
	 * @param int $id ID of the folder
	 * @return boolean Say if an error occurred
	 */
	public function Validate($id, $emailreferent,$id_i) {
		//$sql = "SELECT * FROM `dossier` WHERE `id`=$id AND `statut`='1'";
		$sql = "SELECT * FROM `dossier` WHERE `id`=$id AND `statut`='1' OR `statut`='2'";
		$stmt = $this->conn->query($sql);
		if ($stmt) {
			if(!empty($stmt->fetch_assoc()))
			{
				$stmt->close();
				$sql="UPDATE dossier SET statut='2' WHERE id=?";
				if ($stmt = $this->conn->prepare($sql)) {
					$stmt->bind_param('i',$id);
					$stmt->execute();
					$stmt->close();
					
					require_once('Model/User.php');
					
					
					include("../config/Mailjet/php-mailjet-v3-simple.class.php");
					
					$apiKey = '796120ead20556203da028d5843d4b7a';
					$secretKey = '19a3b02d8633de6f0622122fb65d5994';

					$mj = new Mailjet('334ed6fd723964363a5f3398c2d7622e', '997609099c64f1b139cbb2681d80a591');		
					$params = array(
    					"method" => "POST",
    					"from" => "support@ensp-arles.fr",
    					"to" => "chantal.castagno@ensp-arles.fr",
    					"CC" => $emailreferent,
    					"subject" => "ENSP Intervenants || Nouveau contrat en attente de signature",
   						"html" => "Bonjour,<br><br>
   						Un dossier a été validé par le service RH.<br>
						Le contrat est prêt pour la signature sur la plateforme <a href='https://intervenants.ensp-arles.fr/admin/dossier.php?id_d=".$id."&id_i=".$id_i."' target='_blank'>https://intervenants.ensp-arles.fr/admin/dossier.php?id_d=".$id."&id_i=".$id_i."</a>.<br>
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
					*/
					
					/*
					if ($mail = $Email->dossierValidate($this->get("title",$id),$this->get("year",$id),$User->get("CONCAT(`last_name`,' ',`first_name`)",$this->get("id_intervenant",$id)),$id,$User->get("`member_email`",$this->get("id_intervenant",$id)))) {
						return true;
					}
					*/
					return true;
				} else {
					return false;
				}
			}
		}
		return false;
	}
	
	/**
	 * Update the state of a folder to 'A compléter'
	 * @param int $id ID of the folder
	 * @param string $message Message destinate to the intervenant (send by mail)
	 * @return boolean Say if an error occurred
	 */
	public function Unvalidate($id, $message) {
		$sql = "SELECT * FROM `dossier` WHERE `id`=$id AND `statut`='1'";
		$stmt = $this->conn->query($sql);
		if ($stmt) {
			if(!empty($stmt->fetch_assoc()))
			{
				$stmt->close();
				$sql="UPDATE dossier SET statut='0' WHERE id=?";
				if ($stmt = $this->conn->prepare($sql)) {
					$stmt->bind_param('i',$id);
					$stmt->execute();
					$stmt->close();

					require_once('Controller/Email.php');
					$Email = new Email;
					require_once('Model/User.php');
					$User = new User;
					if ($mail = $Email->dossierUnvalidate($this->get("title",$id),$this->get("year",$id),$User->get("CONCAT(`last_name`,' ',`first_name`)",$this->get("id_intervenant",$id)),$id,$User->get("`member_email`",$this->get("id_intervenant",$id)),$message)) {
						return true;
					}
					return true;
				} else {
					return false;
				}
			}
		}
		return false;
	}

	/**
	 * Update the state of a folder to 'Archiver'
	 * @param int $id ID of the folder
	 * @return boolean Say if an error occurred
	 */
	public function Archive($id) {
		$sql = "SELECT * FROM `dossier` WHERE `id`=$id AND `statut`='2'";
		$stmt = $this->conn->query($sql);
		if ($stmt) {
			if(!empty($stmt->fetch_assoc()))
			{
				$stmt->close();
				$sql="UPDATE dossier SET statut='3' WHERE id=?";
				if ($stmt = $this->conn->prepare($sql)) {
					$stmt->bind_param('i',$id);
					$stmt->execute();
					$stmt->close();
					return true;
				} else {
					return false;
				}
			}
		}
		return false;
	}
	
	/**
	 * Update the state of a folder to 'Archiver'
	 * @param int $id ID of the folder
	 * @return boolean Say if an error occurred
	 */
	public function retour($id) {
		$sql = "SELECT * FROM `dossier` WHERE `id`=$id AND `statut`='2'";
		$stmt = $this->conn->query($sql);
		if ($stmt) {
			if(!empty($stmt->fetch_assoc()))
			{
				$stmt->close();
				$sql="UPDATE dossier SET statut='1' WHERE id=?";
				if ($stmt = $this->conn->prepare($sql)) {
					$stmt->bind_param('i',$id);
					$stmt->execute();
					$stmt->close();
					return true;
				} else {
					return false;
				}
			}
		}
		return false;
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
	 * Delete a folder from the dossiers table
	 * @param int $id ID of the folder
	 * @return boolean Say if an error occurred
	 */
	public function delete($id) {
		require_once('../../Model/User.php');
		$User = new User;
		$email=$User->get("member_email",$this->get("id_intervenant",$id));
		$name=$User->get("CONCAT(`first_name`,' ', `last_name`)",$this->get("id_intervenant",$id));
		$title=$this->get("title",$id);
		$sql = "DELETE FROM `intervention` WHERE `id_dossier`=$id";
		$stmt = $this->conn->query($sql);
		if ($stmt) {
			$sql = "DELETE FROM `files` WHERE `id_dossier` = $id";
			$stmt = $this->conn->query($sql);
			if ($stmt) {
				$sql = "DELETE FROM `dossier` WHERE `id` = $id";
				$stmt = $this->conn->query($sql);
				if ($stmt) {
					//require_once('../../Controller/Email.php');
					//$Email = new Email;
					/* if ($mail = $Email->dossierSuppr($email,$name,$title)) {
						return $stmt;
					} */
					$stmt->close();
				}
			}
		}
		return false;

	}
	
	/**
	 * Update the profil part of a folder
	 * @param int $id ID of the folder
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
		$sql="UPDATE dossier SET member_email=?, phone=?, address=?, CP=?, city=?,live_country=?, rqth=$rqth WHERE id=?";
		if ($stmt = $this->conn->prepare($sql)) {
			$stmt->bind_param('sssissi',$email,$phone,$adresse,$cp,$city,$live_country,$id_dossier);
			$stmt->execute();
			$stmt->close();
		} else {
			$msg = "Error : Data update Fail!";
		}
		return $msg;
	}

	/**
	 * Update the type of remuneration of a folder
	 * @param string $remun Type of remuneration (ex: Facture)
	 * @param int $id ID of the folder
	 * @param string $msg a msg to return
	 * @return string the $msg that say if an error occurred
	 */
	public function updateRemun($remun, $id, $msg) {
		$sql="UPDATE `dossier` SET `remuneration`=? WHERE `id`=?";
		if ($stmt = $this->conn->prepare($sql)) {
			$stmt->bind_param('si', $remun, $id);
			$stmt->execute();
			$stmt->close();
		} else {
			$msg = "Error : Data update Fail!";
		}

		return $msg;
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
	 * Update the SIREN number of a folder
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
	 * Get number of folders
	 * @return int number of folders
	 */
	public function number() {
		$ret="";
		$sql = "SELECT COUNT(*) FROM `dossier` ";
		if ($stmt = $this->conn->prepare($sql)) {
            $stmt->execute();
            $stmt->bind_result($ret);
            $stmt->fetch();
			$stmt->close();
		}
		
		return $ret;
	}
	
	/**
	 * Get number of folders
	 * @return int number of folders
	 */
	public function numberToComplete() {
		$ret="";
		$sql = "SELECT COUNT(*) FROM `dossier` WHERE `statut`<'2' ";
		if ($stmt = $this->conn->prepare($sql)) {
            $stmt->execute();
            $stmt->bind_result($ret);
            $stmt->fetch();
			$stmt->close();
		}
		
		return $ret;
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
			$file="upload/" . $id."/".$id_user. "/" . $name;
			if(file_exists($file) && !empty($id_user)) {
				unlink($file);
			}
			$sql="DELETE FROM `files` WHERE id_dossier=? AND correspondance='CE' ";
			if ($stmt = $this->conn->prepare($sql)) {
				$stmt->bind_param('i',$id);
				$stmt->execute();
				$stmt->close();
			} else {
				echo "Error : Data update Fail!";
			}
		} else {
			$msg = "Error : Data update Fail!";
		}

		return $msg;

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