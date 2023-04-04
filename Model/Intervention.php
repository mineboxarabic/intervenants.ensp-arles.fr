<?php
/**
 * @package Intervention model
 * @author Eliot Masset <eliotmasset@gmail.com>
 * @copyright Eliot Masset 2021
 **/
if(file_exists ('../../config/config.php')) // prevent ajax call
	require('../../config/config.php');
else
	require('config/config.php');

/**
 * class intervention (Model)
 */

class Intervention {
	
	protected $conn; // the connection variable to database
	
	/**
	 * constructor of class
	 */
	public function __construct() {
		$this->conn = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME) //try to connect to database
			or die('I\'m sorry but the server has died. Please check your database credentials.');
	}

	/**
	 * Getter of all intervention in intervention table of a folder
	 * @param int $id ID of a folder
	 * @return array all intervention
	 */
	public function getAll($id) {
		//$sql = "SELECT i.`id`,CONCAT(DATE_FORMAT(`date_begin`,'%d/%m/%Y'),' -> ',DATE_FORMAT(`date_end`,'%d/%m/%Y')) as 'Année',`title` as `Titre`,`travel` as  `Frais de déplacement`,`type`, `price` as `Prix de rémunération`, CONCAT(`last_name`,' ', `first_name`) as 'Référent' FROM `intervention` i LEFT JOIN `referant` r ON id_referant=r.id WHERE `id_dossier`=$id ORDER BY 2 DESC";
		$sql = "SELECT i.`id`,CONCAT(DATE_FORMAT(`date_begin`,'%d/%m/%Y'),' -> ',DATE_FORMAT(`date_end`,'%d/%m/%Y')) as 'Année',`title` as `Titre`,`travel` as  `Frais de déplacement`,`type`, `price` as `Prix de rémunération` FROM `intervention` i LEFT JOIN `referant` r ON id_referant=r.id WHERE `id_dossier`=$id ORDER BY 2 DESC";
		if ($stmt= $this->conn->query($sql)) {
			return $stmt;
			$stmt->close();
		}
		return false;
	}

    
	/**
	 * Getter of all intervention in intervention table of a folder
	 * @param int $id ID of a folder
	 * @return array all intervention
	 */
	public function getAllByDossier($id) {
		$sql = "SELECT `id`,CONCAT(DATE_FORMAT(`date_begin`,'%d/%m/%Y'),' -> ',DATE_FORMAT(`date_end`,'%d/%m/%Y')) as 'year',`title`,`type`, `price` as `Rémunération (€)`,`hours` as `Temps (h)`,`statut`,`travel_text`,`cursus` FROM `intervention` WHERE `id_dossier`=$id ORDER BY 2";
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
	 * @param int $id ID of the intervention
	 * @return object the $thing of the folder $id
	 */
	public function get($thing,$id) {
		$ret="";
		$query = "SELECT $thing FROM `intervention` WHERE id=? LIMIT 1";
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