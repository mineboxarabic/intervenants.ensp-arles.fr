<?php
require('../../config/config.php');
$conn = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
$id_user=$_POST['id_user'];
$id_dossier=$_POST["id_dossier"];
$correspondance=$_POST["correspondance"];
$personnal_key=$_POST["key"];
$name="";
$query = "SELECT name FROM `files` WHERE id_intervenant=? AND id_dossier=? AND correspondance=?  LIMIT 1";
if ($stmt = $conn->prepare($query)) {
    $stmt->bind_param('iis',$id_user,$id_dossier,$correspondance);
    $stmt->execute();
    $stmt->bind_result($name);
    $stmt->fetch();
    $stmt->close();
}
$file="../../upload/" . $id_user."-".$personnal_key."/".$id_dossier. "/" . $name;
if(file_exists($file)) {
	unlink($file);
}
$sql="DELETE FROM `files` WHERE id_intervenant=? AND id_dossier=? AND correspondance=? ";
if ($stmt = $conn->prepare($sql)) {
    $stmt->bind_param('iis',$id_user,$id_dossier, $correspondance);
    $stmt->execute();
    $stmt->close();
} else {
    echo "Error : Data update Fail!";
}
echo "Supprimé !";

?>