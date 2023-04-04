<?php
/**
 * @package Files model
 * @author Eliot Masset <eliotmasset@gmail.com>
 * @copyright Eliot Masset 2021
 **/
if(file_exists ('../../config/config.php')) // prevent ajax call
	require('../../config/config.php');
else
	require('config/config.php');

/**
 * class files (Model)
 */

class Files {
	
	protected $conn; // the connection variable to database
	
	/**
	 * constructor of class
	 */
	public function __construct() {
		$this->conn = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME) //try to connect to database
			or die('I\'m sorry but the server has died. Please check your database credentials.');
	}

	/**
	 * Check if a file exist
	 * @param string $correspondance the name of the type of the file (ex: RIB)
	 * @param int $intervenant ID of the intervenant
	 * @param int $dossier ID of the dossier
	 * @return boolean Say if the file exist
	 */
    public function docgenexist($correspondance,$intervenant) {
        $sql = "SELECT * FROM `files` WHERE `correspondance`='$correspondance' AND `id_intervenant`='$intervenant'";
        $stmt = $this->conn->query($sql);
        if ($stmt) {
            if(!empty($stmt->fetch_assoc()))
                return true;
            $stmt->close();
        }
        return false;
    }
    
   
     public function exist($correspondance,$intervenant,$dossier) {
        $sql = "SELECT * FROM `files` WHERE `correspondance`='$correspondance' AND `id_intervenant`='$intervenant' AND `id_dossier`='$dossier'";
        $stmt = $this->conn->query($sql);
        if ($stmt) {
            if(!empty($stmt->fetch_assoc()))
                return true;
            $stmt->close();
        }
        return false;
    }
   
	public function existCoIn($correspondance, $intervenant){
		$sql = "SELECT * FROM `files` WHERE `correspondance`='$correspondance' AND `id_intervenant`='$intervenant'";
		$stmt = $this->conn->query($sql);
		if ($stmt) {
			if(!empty($stmt->fetch_assoc()))
				return true;
			$stmt->close();
		}
		return false;
	}
    
    public function existOLD($correspondance,$intervenant) {
        $sql = "SELECT * FROM `files` WHERE `correspondance`='$correspondance' AND `id_intervenant`='$intervenant' ORDER BY `id` DESC LIMIT 1";
        $stmt = $this->conn->query($sql);
        if ($stmt) {
            if(!empty($stmt->fetch_assoc()))
                return true;
            $stmt->close();
        }
        return false;
    }

    

	/**
	 * Getter
	 * @param string $thing The thing to get (name of a collumn)
	 * @param int $id_dossier ID of the dossier
	 * @param int $id_intervenant ID of the intervenant
	 * @param string $correspondance the name of the type of the file (ex: RIB)
	 * @return object the $thing to get
	 */
	public function get($thing,$id_dossier, $id_intervenant, $correspondance) {
		$ret="";
		$query = "SELECT $thing FROM `files` WHERE `id_dossier`=? AND `id_intervenant`=? AND `correspondance`=? LIMIT 1";
		if ($stmt = $this->conn->prepare($query)) {
			$stmt->bind_param('iis',$id_dossier,$id_intervenant, $correspondance);
			$stmt->execute();
			$stmt->bind_result($ret);
			$stmt->fetch();
			$stmt->close();
		}
		
		return $ret;
		
	}
	

	/**
	 * Getter of all administratives files of a folder
	 * @param int $id_dossier ID of the dossier
	 * @param int $id_intervenant ID of the intervenant
	 * @return object files to get
	 */
	public function getAllAdministrativesFiles($id_dossier, $id_intervenant)
	{
		$query = "SELECT `id`,`name`,`real_name` FROM `files` WHERE `id_dossier`=$id_dossier AND `id_intervenant`=$id_intervenant AND `correspondance`='FILE' ORDER BY 1 DESC";
		if ($stmt = $this->conn->query($query)) {
			return $stmt;
			$stmt->close();
		}
		
		return false;
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