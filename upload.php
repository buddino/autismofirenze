<?php
$ds = DIRECTORY_SEPARATOR;
$storeFolder = 'uploads';

if (!empty($_FILES)) {
    $tempFile = $_FILES['file']['tmp_name'];    
    $targetPath = dirname( __FILE__ ) . $ds. $storeFolder . $ds;
    $filename =  $_FILES['file']['name'];
    $targetFile =  $targetPath . $filename;

    //TODO Se formato non è PNG lo converto in PNG
    //TODO Aggiungo al database
    
    move_uploaded_file($tempFile,$targetFile);
}

?>     