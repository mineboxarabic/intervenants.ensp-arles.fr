<?php
    require('../../../config/config.php');
    $conn = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
    $id_user=$_POST['id_user'];
    $id_dossier=$_POST["id_dossier"];
    $correspondance=$_POST["correspondance"];
    $personnal_key=$_POST["key"];
    if ($_FILES["file"]["size"] < 10000000000)
    {
        if ($_FILES["file"]["error"] > 0)
        {
            echo "Error : " . $_FILES["file"]["error"];
        }
        else
        {
            $path_parts = pathinfo($_FILES["file"]["name"]);
            $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $new_name = '';
            for($i=0; $i<15; $i++){
                $new_name .= $chars[rand(0, strlen($chars)-1)];
            }
            if(!empty($path_parts['extension']))
                $new_name.=".".$path_parts['extension'];
            if(!is_dir("../../../upload/" . $id_user."-".$personnal_key))
                mkdir("../../../upload/" . $id_user."-".$personnal_key, 0777, true);
            if(!is_dir("../../../upload/" . $id_user."-".$personnal_key."/".$id_dossier))
                mkdir("../../../upload/" . $id_user."-".$personnal_key."/".$id_dossier, 0777, true);
            if (file_exists("../../../upload/" . $id_user."-".$personnal_key."/".$id_dossier. "/" . $new_name))
            {
                echo " Le fichier ".$_FILES["file"]["name"] . "  existe déjà. ";
            }
            else
            {
                move_uploaded_file($_FILES["file"]["tmp_name"],"../../../upload/".$id_user."-".$personnal_key."/".$id_dossier."/".$new_name);
                $sql="INSERT INTO `files` (`name`, `real_name`, `id_intervenant`, `id_dossier`, `correspondance`) VALUES (?, ?, ?, ?, ?);";
                if ($stmt = $conn->prepare($sql)) {
                    $stmt->bind_param('ssiis',$new_name,$_FILES["file"]["name"],$id_user,$id_dossier, $correspondance);
                    $stmt->execute();
                    $stmt->close();
                } else {
                    echo "Error : Data update Fail!";
                }
                echo "Enregistré !";
            }
        }
    }
    else
    {
        echo "Fichier trop volumineux !!";
    }
  ?>