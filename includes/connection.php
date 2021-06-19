<?php 

$username = "Sql304856";
$password = "8ea304b4";
$dbname = "Sql304856_3";
// $host = "62.149.150.106";
$host = "localhost";


// Create connection
$conn = new mysqli($host, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

?>