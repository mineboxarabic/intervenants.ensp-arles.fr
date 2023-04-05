<?php 
require('../../config/config.php');
$conn = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);


$id_user = $_POST['id_user'];
$fileName = $_POST['hasheName'];
$type = $_POST['type'];

$dir = "../../upload/".$id_user;

//delete file from directory

if(file_exists($dir.'/'.$fileName)){
    unlink($dir.'/'.$fileName);
}

//delete file from database
$sql = "DELETE FROM files WHERE `name` = '$fileName' AND `id_intervenant` = '$id_user' AND `correspondance` = '$type'";

if ($stmt = $conn->prepare($sql)) {
    $stmt->execute();
    $stmt->close();
} else {
    echo "Error : Data update Fail!";
}

echo "Supprimé !";

?>
