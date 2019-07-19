<?php

$servername = "localhost";
$username = "autismo";
$password = "autismo";
$dbname = "autismo";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 


$directory = "images";
$images = glob($directory . "/*.png");

foreach($images as $image)
{
    $image = preg_replace('/.*\//','',$image);
    $filename = str_ireplace('.png','',$image);
    $filename = preg_replace('/\s\(\d\)/','',$filename);
    $names = explode('_', $filename);
    $name = $names[0];
    $synonymous = implode(',', $names);
    $sql = "INSERT INTO figures (filename, word, synonymous) VALUES ('$image', '$name', '$synonymous')";
    if ($conn->query($sql) === TRUE) {
        echo "Inserisco $names[0]\n";
    } else {
        echo "Error: " . $sql . "\n" . $conn->error;
    }
}
?>