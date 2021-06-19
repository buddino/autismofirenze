<?php
require_once 'includes/connection.php';

if(isset( $_GET['q']) && $_GET['q']!=''){
    $query = strtolower($_GET['q']);
    }
else {
    http_response_code(400);
    exit("Query param needed (q)");
}

$sql = "SELECT * FROM comaut_figure WHERE word like '$query%'";
$result = $conn->query($sql);
if(!$result) {
    http_response_code(500);
    exit("Database query failed: " . mysql_error());
}

$json = array();
while($figure = $result->fetch_array()) { // go through each row that was returned in $result
    array_push($json,$figure['filename']);
}
echo json_encode($json);
?>