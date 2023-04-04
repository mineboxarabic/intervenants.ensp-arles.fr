<?php
// Initialize a file URL to the variable 
$id_dossier=$_GET['id_folder'];
$id_intervenant=$_GET['id_intervenant'];
$name=$_GET['name'];
//$real_name=$_GET['real_name'];
$personnal_key=$_GET['key'];
$url = '../../../upload/'.$id_intervenant."-".$personnal_key.'/'.$id_dossier.'/'.$name;

// Use basename() function to return the base name of file  
$file_name = basename($url);
if(file_exists($url)) {
    //Define header information
    header('Content-Description: File Transfer');
    // get the file mime type using the file extension
    switch(strtolower(substr(strrchr($file_name,'.'),1)))
    {
        case 'pdf': $mime = 'application/pdf'; break;
        case 'zip': $mime = 'application/zip'; break;
        case 'jpeg': $mime = 'image/jpg'; break;
        case 'jpg': $mime = 'image/jpg'; break;
        case 'png': $mime = 'image/png'; break;
        default: $mime = 'application/octet-stream';
    }
    header("Content-Type: $mime");
    header('Content-Disposition: attachment; filename="'.$name.'"');
    header('Pragma: public');
    header('Content-Length: ' . filesize($url));
    readfile($url);
}

exit;

?> 