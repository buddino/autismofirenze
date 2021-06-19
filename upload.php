<?php
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);

require 'includes/connection.php';

$ds = DIRECTORY_SEPARATOR;
$storeFolder = 'images';

if (!empty($_FILES)) {
    $tempFile = $_FILES['file']['tmp_name'];    
    $targetPath = dirname( __FILE__ ) . $ds. $storeFolder . $ds;
    $filename =  renameFile($_FILES['file']['name']);
    $word = fname2word($filename);
    $filename = uniqid('',true) . "_" . $filename;
    $targetFile =  $targetPath . $filename;

   if (addToDb($filename, $word, $conn)){
      $uploaded = move_uploaded_file($tempFile,$targetFile);
      if($uploaded != 1){
         exit("Errore");
      }
     } else {
        echo $conn->error;
        if(strpos($conn->error, "Duplicate") !== false){
         http_response_code(409);
         exit("Conflitto");
        }
   }
}


function renameFile($fname){
    $fname = preg_replace("/\s?\(\d+\)/i", "", $fname);
    $fname = str_replace(" ", "_", $fname);
    $fname = strtolower($fname);
    return $fname;
 }

 function fname2word($fname){
    $word =  preg_replace("/\..*/", "", $fname);
    $word =  str_replace("_", " ", $word);
    return $word;
 }

 function checkIfFileExists($fname){
   return file_exists($fname);
 }

 function addToDb($fname, $word, $conn){
    //Controllare se vuooto
    //Controllare se filename esiste già (che fare?)
    $sql = "INSERT INTO comaut_figure (filename, word) VALUES ('$fname', '$word')";
    $result = $conn->query($sql);
    return $result;
 }

 function onError($fname, $word, $conn){
   //Controllare se vuooto
   //Controllare se filename esiste già (che fare?)
   $sql = "DELETE FROM comaut_figure WHERE filename='$fname' AND word='$word'";
   $result = $conn->query($sql);
   return $result;
}


 $conn->close();


?>     