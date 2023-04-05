<?php
session_start();
require('../config/config.php');
$conn = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
$currentUser = $_SESSION['member_id'];
$RIBFile = $_FILES['RIB'];
$SSFile = $_FILES['SS'];
$CIFile = $_FILES['CI'];

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



//================ Process RIB File ==================//


    //Check if the file was uploaded
    if($RIBFile['name'] != "") {
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



        if(checkIfExists('RIB',$currentUser ,$conn)){
            $sql = "INSERT INTO `files` (`name`, `real_name`, `id_intervenant`,`id_dossier`, `correspondance`) VALUES ('" . $RIBUniqueName . "', '" . $RIBFile['name'] . "', " . $currentUser . ", 23, 'RIB')";
            addToDb($sql, $conn);
        }


        //loop through all files in the directory to check if there is a RIB file
        $files = scandir($uploadDir);
        foreach ($files as $file) {
          if ($file !== '.' && $file !== '..') {
            if(getDocType($file) == 'RIB'){
                unlink($uploadDir.$file); //if there is a RIB file delete it
                move_uploaded_file($RIBFile['tmp_name'], $RIBUploadPath); //upload the new RIB file
            }else{
                move_uploaded_file($RIBFile['tmp_name'], $RIBUploadPath);} //otherwise upload the new RIB file
          }
        }
    }

//=============== Process SS File ==================//

// Check if the file was uploaded
    if($SSFile['name'] != "")
    {
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

        if(checkIfExists('SS',$currentUser ,$conn)){
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
            }else{
                move_uploaded_file($SSFile['tmp_name'], $SSUploadPath);} //otherwise upload the new SS file
          }
        }

    }





//=============== Process CI File ==================//

if($CIFile['name'] != "")
{
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


    if(checkIfExists('CI',$currentUser ,$conn)){
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
        }else{
            move_uploaded_file($CIFile['tmp_name'], $CIUploadPath);} //otherwise upload the new CI file
      }
    }
}


//go to the previous page
//header("Location: " . $_SERVER["HTTP_REFERER"]);
//exit;
?>