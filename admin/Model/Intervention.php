<?php
/**
 * @package Intervention model
 * @author Eliot Masset <eliotmasset@gmail.com>
 * @copyright Eliot Masset 2021
 **/
if(file_exists ('../../../config/config.php')) // prevent ajax call
	require('../../../config/config.php');
else
	require('../config/config.php');

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
	 * Function for add a row into the intervention table.
	 * Create a new intervention.
	 * @param string $title Title of the intervention
	 * @param string $date_begin The begin date of the intervention
	 * @param string $date_end The end date of the intervention
	 * @param double $price The price of the intervention
	 * @param boolean $travel Say if transport costs are supported
	 * @param string $travel_text if transport costs are supported : the text contain why is supported, else the text is empty
	 * @param int $id_dossier ID of the folder
	 * @param string $cursus The cursus of the intervention (ex: 1ère année)
	 * @param double $hours Numbre of hours of the intervention
	 * @param string $type Type of the intervention (ex: Conférence)
	 * @param int $id ID of the referant
	 * @return string a msg that say if an error occurred
	 */
	public function add($title, $date_begin, $date_end, $price, $travel,$travel_text, $id_dossier, $cursus, $hours, $type, $id, $previ_date) {
		$date_begin=implode('-',array_reverse  (explode('/',$date_begin)));
		$date_end=implode('-',array_reverse  (explode('/',$date_end)));
		$previ_date=implode('-',array_reverse  (explode('/',$previ_date)));
		$msg="";

		$sql="INSERT INTO `intervention` (`id`,`title`, `date_begin`, `date_end`, `price`, `travel`, `travel_text`, `id_dossier`, `cursus`, `hours`, `type`, `id_referant`, `statut`, `date_previsionnelle_de_payement`) VALUES (NULL,?, ?, ?, ?, $travel, ?, ?, ?, ?, ?, ?,'Programmée', ?);";
		if ($stmt = $this->conn->prepare($sql)) {
			if(!$stmt->bind_param('sssdsisdsis',$title,$date_begin,$date_end,$price,$travel_text,$id_dossier, $cursus, $hours, $type, $id, $previ_date))
				$msg = "Error : Data update Fail !";
			if(!$stmt->execute())
				$msg = "Error : Data update Fail!";
			
			/*
			require_once('Controller/Email.php');
			$Email = new Email;
			*/
			require_once('Model/User.php');
			$User = new User;
			require_once('Model/Dossiers.php');
			$Dossiers = new Dossiers;
			$id_intervenant= $Dossiers->get("id",$id_dossier);
			//$Email->newIntervention($User->get("first_name", $id_intervenant)." ".$User->get("last_name", $id_intervenant),$User->get("member_email", $id_intervenant), $Dossiers->get("title",$id_dossier), $Dossiers->get("year",$id_dossier), $stmt->insert_id);
			$stmt->close();
		} else {
			$msg = "Error : Data update Fail!";
		}

		return $msg;
	}

	/**
	 * Update an interventionv
	 * @param string $title Title of the intervention
	 * @param string $date_begin The begin date of the intervention
	 * @param string $date_end The end date of the intervention
	 * @param double $price The price of the intervention
	 * @param boolean $travel Say if transport costs are supported
	 * @param string $travel_text if transport costs are supported : the text contain why is supported, else the text is empty
	 * @param int $id_dossier ID of the folder
	 * @param string $cursus The cursus of the intervention (ex: 1ère année)
	 * @param double $hours Numbre of hours of the intervention
	 * @param string $type Type of the intervention (ex: Conférence)
	 * @param int $id ID of the referant
	 * @return string a msg that say if an error occurred
	 */
	public function update($title, $date_begin, $date_end, $price, $travel,$travel_text, $id_dossier, $cursus, $hours, $type, $state, $previ_date, $id) {
		$date_begin=implode('-',array_reverse  (explode('/',$date_begin)));
		$date_end=implode('-',array_reverse  (explode('/',$date_end)));
		$previ_date=implode('-',array_reverse  (explode('/',$previ_date)));
		$msg="";

		$sql="UPDATE `intervention` SET `title`=?, `date_begin`=?, `date_end`=?, `price`=?, `travel`=$travel, `travel_text`=?, `id_dossier`=?, `cursus`=?, `hours`=?, `type`=?, `statut`=?, `date_previsionnelle_de_payement`=? WHERE `id`=?";
		if ($stmt = $this->conn->prepare($sql)) {
			$stmt->bind_param('sssdsisdsssi', $title, $date_begin, $date_end, $price, $travel_text, $id_dossier, $cursus, $hours, $type, $state, $previ_date, $id);
			$stmt->execute();
			$stmt->close();
		} else {
			$msg = "Error : Data update Fail!";
		}

		return $msg;
	}
	
	/**
	 * Update the state
	 * @param string $state State of the intervention
	 * @param int $id ID of the intervention
	 */
	public function updateState($state, $id) {
		$sql="UPDATE `intervention` SET `statut`=? WHERE `id`=?";
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
	 * Getter to the database
	 * @param string $thing The thing to get
	 * @param int $id ID of the intervention
	 * @return object the $thing of the folder $id
	 */
	public function get($thing,$id) {

		$ret="";
		$query = "SELECT $thing FROM `intervention` WHERE id=$id LIMIT 1";
		if ($stmt = $this->conn->prepare($query)) {
			$stmt->execute();
			$stmt->bind_result($ret);
			$stmt->fetch();
			$stmt->close();
		}
		
		return $ret;
		
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
	 * Getter of all intervention in intervention table of a folder
	 * @param int $id ID of a folder
	 * @return array all intervention
	 */
	public function getAll() {
		$sql = "SELECT `id`, `id_dossier` as 'dossier', CONCAT(DATE_FORMAT(`date_begin`,'%d/%m/%Y'),' -> ',DATE_FORMAT(`date_end`,'%d/%m/%Y')) as 'year',`title`,`type`, `price` as `Prix de rémunération`,`statut` FROM `intervention` ORDER BY 2 DESC";
		$stmt = $this->conn->query($sql);
		if ($stmt) {
			return $stmt;
			$stmt->close();
		}
		return false;
	}

	/**
	 * Getter of all intervention in intervention table of an intervenant
	 * @param int $id ID of the intervenant
	 * @return array all intervention
	 */
	public function getAllById($id) {
		$sql = "SELECT i.`id` as 'intervenant', d.`id` as 'dossier', i.`title` as 'intervention', d.`title` as 'titre_dossier',CONCAT(DATE_FORMAT(`date_begin`,'%d/%m/%Y'),' -> ',DATE_FORMAT(`date_end`,'%d/%m/%Y')) as 'year' FROM `intervention` i INNER JOIN `dossier` d ON i.id_dossier=d.id WHERE `id_intervenant`=$id ORDER BY 3 DESC";
		$stmt = $this->conn->query($sql);
		if ($stmt) {
			return $stmt;
			$stmt->close();
		}
		return false;
	}

	/**
	 * Delete an intervention from the intervention table
	 * @param int $id ID of the intervention
	 * @return boolean Say if an error occurred
	 */
	public function delete($id) {
		$sql = "DELETE FROM `intervention` WHERE `id` = $id";
		$stmt = $this->conn->query($sql);
		if ($stmt) {
			return $stmt;
			$stmt->close();
		}
		return "error";

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