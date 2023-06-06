<?php
session_start();
require('../config/config.php');
$conn = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
$currentUser = $_SESSION['member_id'];




$maxFileSize = 20 * 1024 * 1024; 

$uploadDir = '../upload/';
$uploadDir = $uploadDir . '/'.$currentUser . '/';

if(!file_exists($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}


function checkExtension($file) {
    $fileName = $file['name'];
    $fileExt = pathinfo($fileName, PATHINFO_EXTENSION);
    $validExts = array('jpg', 'jpeg', 'png', 'gif', 'pdf');
    if(!in_array(strtolower($fileExt), $validExts)) {
        return false;
    }
    return true;
}
function checkFileSize($file) {
    $maxFileSize = 20 * 1024 * 1024; 
    if($file['size'] > $maxFileSize) {
        return false;
    }
    return true;
}

function addToDb($sql = "", $conn) {
    if ($stmt = $conn->prepare($sql)) {
        $stmt->execute();
        $stmt->close();
    } else {
        echo "Error : Data update Fail!";
    }
}
function getDocType($filename){

    if(strpos($filename, 'RIB') !== false){
        return 'RIB';
    }
    //if file name contain SS return SS

    if(strpos($filename, 'SS') !== false){
        return 'SS';
    }
    //if file name contain CI return CI
    if(strpos($filename, 'CI') !== false){
        return 'CI';
    }
    return '';
}
function checkIfExists($type,$currentUser ,$conn){
    $sql = "SELECT * FROM `files` WHERE `id_intervenant` =" . $currentUser . " AND `correspondance` = '".$type."'";
    $result = $conn->query($sql);
    if($result->num_rows == 0){
        return false;
    }
    return true;
}

function renameFile($fileName)
{
    $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    //if charactere is not in the chars remove it
    $fileExtention = pathinfo($fileName, PATHINFO_EXTENSION);
    $fileName = preg_replace('/[^A-Za-z0-9\-]/', '', $fileName);
    //if file name is empty return empty string
    if($fileName == ''){
        return '';
    }
    //if file name is not empty
    $fileName = str_replace(' ', '_', $fileName);
    $fileName = str_replace('__', '_', $fileName);

    $fileName = substr($fileName, 0, 20);
    $fileName = $fileName . '_' . substr(str_shuffle($chars), 0, 5);
    return $fileName . '.' . $fileExtention;

}

//================ Process RIB File ==================//
$RIBFile = array();
if(isset($_FILES['RIB']['name']) && !empty($_FILES['RIB']['name'])) {
    $RIBFile = $_FILES['RIB'];
}
    //Check if the file was uploaded

    if(!empty($RIBFile)) {
        $RIBFile['name'] = renameFile($RIBFile['name']);
        // Check if the file was uploaded without errors
        if($RIBFile['error'] == 1) {
            echo "Please upload a RIB file.";
            exit;
        }

        // Check if the file has a valid extension
        if(!checkExtension($RIBFile)) {
            echo "Invalid RIB file type. Please upload a JPG, JPEG, PNG, GIF, or PDF file.";
            exit;
        }

        // Check if the file is not too big
        if(checkFileSize($RIBFile) == false) {
            echo "RIB File size exceeds limit. Please upload a file smaller than 20 MB.";
            exit;
        }

        $RIBUniqueName = uniqid('', true) . '.'.'RIB'. '.' . pathinfo($RIBFile['name'], PATHINFO_EXTENSION);
        $RIBUploadPath = $uploadDir . $RIBUniqueName;
        

        if(!checkIfExists('RIB',$currentUser ,$conn)){
            $sql = "INSERT INTO `files` (`name`, `real_name`, `id_intervenant`,`id_dossier`, `correspondance`) VALUES ('" . $RIBUniqueName . "', '" . $RIBFile['name'] . "', " . $currentUser . ", 23, 'RIB')";
            addToDb($sql, $conn);
        }


        //loop through all files in the directory to check if there is a RIB file
        $files = scandir($uploadDir);
        var_dump($files);
        foreach ($files as $file) {
          if ($file !== '.' && $file !== '..') {
            if(getDocType($file) == 'RIB'){
                echo getDocType($file);
                unlink($uploadDir.$file); //if there is a RIB file delete it
            }
        }
    }
    move_uploaded_file($RIBFile['tmp_name'], $RIBUploadPath);}

//=============== Process SS File ==================//
    
        
// Check if the file was uploaded
$SSFile = array();
if(isset($_FILES['SS']['name']) && !empty($_FILES['SS']['name'])) {
    $SSFile = $_FILES['SS'];
}

    if(!empty($SSFile))
    {
        $SSFile['name'] = renameFile($SSFile['name']);
        // Check if the file was uploaded without errors
        if($SSFile['error'] == 1) {
            echo "Please upload a numero de securite social file.";
            exit;
        }
        // Check if the file has a valid extension
        if(!checkExtension($SSFile)) {
            echo "Invalid Cart vital file type. Please upload a JPG, JPEG, PNG, GIF, or PDF file.";
            exit;
        }
        // Check if the file is not too big
        if(checkFileSize($SSFile) == false) {
            echo "Cart vital File size exceeds limit. Please upload a file smaller than 20 MB.";
            exit;
        }



        $SSUniqueName = uniqid('', true) . '.'.'SS'. '.' . pathinfo($SSFile['name'], PATHINFO_EXTENSION);
        $SSUploadPath = $uploadDir . $SSUniqueName;

        if(!checkIfExists('SS',$currentUser ,$conn)){
            $sql = "INSERT INTO `files` (`name`, `real_name`, `id_intervenant`,`id_dossier`, `correspondance`) VALUES ('" . $SSUniqueName . "', '" . $SSFile['name'] . "', " . $currentUser . ", 23, 'SS')";
            addToDb($sql, $conn);
        }

        //loop through all files in the directory to check if there is a SS file
        $files = scandir($uploadDir);
        foreach ($files as $file) {
          if ($file !== '.' && $file !== '..') {
            if(getDocType($file) == 'SS'){
                unlink($uploadDir.$file); //if there is a SS file delete it
                move_uploaded_file($SSFile['tmp_name'], $SSUploadPath); //upload the new SS file
            }
        }


    }
    move_uploaded_file($SSFile['tmp_name'], $SSUploadPath);}





//=============== Process CI File ==================//
    $CIFile = array();
if(isset($_FILES['CI']['name']) && !empty($_FILES['CI']['name'])) {
    $CIFile = $_FILES['CI'];
}

if(!empty($CIFile))
{
    $CIFile['name'] = renameFile($CIFile['name']);
    // Check if the file was uploaded without errors
    if($CIFile['error'] == 1) {
        echo "Please upload a Cart d'identite file.";
        exit;
    }
    // Check if the file has a valid extension
    if(!checkExtension($CIFile)) {
        echo "Invalid Cart d'identite file type. Please upload a JPG, JPEG, PNG, GIF, or PDF file.";
        exit;
    }
    // Check if the file is not too big
    if(checkFileSize($CIFile) == false) {
        echo "Cart d'identite File size exceeds limit. Please upload a file smaller than 20 MB.";
        exit;
    }

    $CIUniqueName = uniqid('', true) . '.'.'CI'. '.' . pathinfo($CIFile['name'], PATHINFO_EXTENSION);
    $CIUploadPath = $uploadDir . $CIUniqueName;


    if(!checkIfExists('CI',$currentUser ,$conn)){
        $sql = "INSERT INTO `files` (`name`, `real_name`, `id_intervenant`,`id_dossier`, `correspondance`) VALUES ('" . $CIUniqueName . "', '" . $CIFile['name'] . "', " . $currentUser . ", 23, 'CI')";
        addToDb($sql, $conn);
    }

    //loop through all files in the directory to check if there is a CI file
    $files = scandir($uploadDir);
    foreach ($files as $file) {
      if ($file !== '.' && $file !== '..') {
        if(getDocType($file) == 'CI'){
            unlink($uploadDir.$file); //if there is a CI file delete it
            move_uploaded_file($CIFile['tmp_name'], $CIUploadPath); //upload the new CI file
        }
    }

}
move_uploaded_file($CIFile['tmp_name'], $CIUploadPath);}

//====================== Process Autre File ==================//
$AutreFile = array();
if(isset($_FILES['Autre']['name']) && !empty($_FILES['Autre']['name'])) {
    $AutreFile = $_FILES['Autre'];
}

if(!empty($AutreFile))
{
    $AutreFile['name'] = renameFile($AutreFile['name']);
    // Check if the file was uploaded without errors
    if($AutreFile['error'] == 1) {
        echo "There was an error uploading your document file.";
        exit;
    }
    // Check if the file has a valid extension
    if(!checkExtension($AutreFile)) {
        echo "Invalid document file type. Please upload a JPG, JPEG, PNG, GIF, or PDF file.";
        exit;
    }
    // Check if the file is not too big
    if(checkFileSize($AutreFile) == false) {
        echo "document File size exceeds limit. Please upload a file smaller than 20 MB.";
        exit;
    }

    $AutreUniqueName = uniqid('', true) . '.'.'Autre'. '.' . pathinfo($AutreFile['name'], PATHINFO_EXTENSION);
    $AutreUploadPath = $uploadDir . $AutreUniqueName;

    
    $sql = "INSERT INTO `files` (`name`, `real_name`, `id_intervenant`,`id_dossier`, `correspondance`) VALUES ('" . $AutreUniqueName . "', '" . $AutreFile['name'] . "', " . $currentUser . ", 23, 'Autre')";
    addToDb($sql, $conn);
    

    //loop through all files in the directory to check if there is a Autre file
    $files = scandir($uploadDir);
    foreach ($files as $file) {
      if ($file !== '.' && $file !== '..') {
        if(getDocType($file) == 'Autre'){
            unlink($uploadDir.$file); //if there is a Autre file delete it
            move_uploaded_file($AutreFile['tmp_name'], $AutreUploadPath); //upload the new Autre file
        }
    }
}
move_uploaded_file($AutreFile['tmp_name'], $AutreUploadPath);} //otherwise upload the new Autre file

//go to the previous page
//header("Location: " . $_SERVER["HTTP_REFERER"]);
//exit;
?>