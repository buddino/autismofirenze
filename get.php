<?php

$host = "62.149.150.106";
$username = "Sql304856";
$password = "8ea304b4";
$dbname = "Sql304856_3";

if(isset( $_GET['q']) && $_GET['q']!=''){
    $query = strtoupper($_GET['q']);
    }
else {
    http_response_code(400);
    exit("Query param needed (q)");
}

$connection= mysql_connect ($host, $username, $password);
if (!$connection)
{
    http_response_code(500);
    exit ('Could not connect:' . mysql_error());

}
mysql_select_db($dbname);

$sql = "SELECT * FROM comaut_figure WHERE name like '$query%'";
$result = mysql_query($sql, $connection);
if(!$result) {
    http_response_code(500);
    exit("Database query failed: " . mysql_error());
}

$json = array();
while($figure = mysql_fetch_array($result)) { // go through each row that was returned in $result
    array_push($json,$figure['filename']);
}
echo json_encode($json);
?>