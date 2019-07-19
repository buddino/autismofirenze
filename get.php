<?php

$servername = "localhost";
$username = "autismo";
$password = "autismo";
$dbname = "autismo";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

if(!empty($_GET) && $_GET["q"] != ""){
    $query = strtolower($_GET["q"]);
    $sql = "SELECT filename FROM figures WHERE lower(synonymous) like '%$query%'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $results = array();
        while($row = $result->fetch_assoc()) {
            array_push($results, $row['filename']);
        }
        echo json_encode($results);
    } else {
        echo "0 results";
    }
    $conn->close();
}
else {
    echo "No query";
}

?>