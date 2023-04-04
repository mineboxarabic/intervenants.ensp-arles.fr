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
 * class dossier (Model)
 */
class Ticket {
	
	protected $conn; // the connection variable to database
	
	/**
	 * constructor of class
	 */

	public function __construct() {
		$this->conn = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME) //try to connect to database
			or die('I\'m sorry but the server has died. Please check your database credentials.');
	}

    /**
	 * create a new ticket
	 * @param string $message message of the ticket
	 * @param int $id_dossier ID of the folder
	 * @param int $id_user ID of the user that send the mail
	 * @return boolean that say if the function work fine
	 */
    public function new($message,$id_dossier,$id_user) {
		$sql="INSERT INTO `ticket` (message, id_dossier,id_intervenant,date) VALUES (?,?,?,CURRENT_TIMESTAMP)";
		if ($stmt = $this->conn->prepare($sql)) {
			$stmt->bind_param('sii',$message,$id_dossier,$id_user);
            if(!$stmt->execute())
                return "insertion impossible";
			$stmt->close();
            $email="";
            $query = "SELECT m.email FROM `dossier` d INNER JOIN `membres` m ON d.created_user=m.id WHERE d.id=$id_dossier LIMIT 1";
            if ($stmt = $this->conn->prepare($query)) {
                $stmt->execute();
                $stmt->bind_result($email);
                $stmt->fetch();
                $stmt->close();
                require_once('Controller/Email.php');
                $Email = new Email;
                require_once('Model/User.php');
                $User = new User;
                if ($mail = $Email->newTicket($message,$email,$User->get("CONCAT(`last_name`,' ',`first_name`)",$id_user))) {
                    return "";
                }
                return "insertion impossible";
            } else {
                return $this->conn->error;
            }
		} else {
			$msg = "Error : Data update Fail !";
		}
		return $msg;
    }

	/**
	 * Getter of all tickets
	 * @return array all tickets
	 */
	public function getAll($id_user) {
		$sql = "SELECT * FROM `ticket` WHERE id_dossier IN (SELECT id FROM dossier WHERE created_user=$id_user) ORDER BY `date` DESC";
		if ($stmt = $this->conn->query($sql)) {
			return $stmt;
			$stmt->close();
		}
		return false;
	}
	/**
	 * Getter of all tickets
	 * @return array all tickets
	 */
	public function getAllByMonth() {
		$sql = "SELECT COUNT(*),MONTH(`date`) FROM `ticket` WHERE YEAR(`date`)=YEAR(NOW()) GROUP BY MONTH(`date`)";
		if ($stmt = $this->conn->query($sql)) {
			return $stmt;
			$stmt->close();
		}
		return false;
	}
	/**
	 * Getter of all tickets
	 * @return array all tickets
	 */
	public function getAllByMonthByUser($id_user) {
		$sql = "SELECT COUNT(*),MONTH(`date`)  FROM `ticket` WHERE YEAR(`date`)=YEAR(NOW()) AND id_dossier IN (SELECT id FROM dossier WHERE created_user=$id_user) GROUP BY MONTH(`date`)";
		if ($stmt = $this->conn->query($sql)) {
			return $stmt;
			$stmt->close();
		}
		return false;
	}
	/**
	 * Getter of all tickets
	 * @return array all tickets
	 */
	public function getAllByMonthByUserToComplete($id_user) {
		$sql = "SELECT COUNT(*),MONTH(`date`)  FROM `ticket` WHERE YEAR(`date`)=YEAR(NOW()) AND id_dossier IN (SELECT id FROM dossier WHERE created_user=$id_user) AND statut=0 GROUP BY MONTH(`date`)";
		if ($stmt = $this->conn->query($sql)) {
			return $stmt;
			$stmt->close();
		}
		return false;
	}

    public function updateState($id) {
        $sql="UPDATE ticket SET statut=1 WHERE id=?";
        if ($stmt = $this->conn->prepare($sql)) {
            $stmt->bind_param('i',$id);
            $stmt->execute();
            $stmt->close();
        } else {
            return false;
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