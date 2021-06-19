<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');

require('connection.php');

$result = $conn->query("SELECT count(*) FROM comaut_figure");
echo $result->num_rows;
echo "<br>";
echo "count: ".$result->fetchColumn();


if(isset( $_GET['q']) && $_GET['q']!=''){
    $query =  $_GET['q'];
    $query = renameFile($query);
    echo "Result: ".$query."<br>";
    }
else {
    http_response_code(400);
    exit("Query param needed (q)");
}

function renameFile($fname){
    echo "Filename: ".$fname."<br>";
    $fname =  preg_replace(["/_\d+/i", "/\..*/"], "", $fname);
    $fname =  str_replace("_", " ", $fname);
    return $fname;
         }

?>