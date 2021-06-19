<?php

$host = "62.149.150.106";
$username = "Sql304856";
$password = "8ea304b4";
$dbname = "Sql304856_3";

$connection= mysql_connect ($host, $username, $password);
if (!$connection)
{
    http_response_code(500);
    exit ('Could not connect:' . mysql_error());
}
mysql_select_db($dbname, $connection);

$directory = "../images";
$images = glob($directory . "/*.png");
$length = count($images);
echo "Inserimento di $length immagini\n\n";

$counter = 0;
foreach($images as $image)
{
    $image = preg_replace('/.*\//','',$image);
    $image = str_ireplace('.png','',$image);
    $image = str_ireplace("'","\'",$image);
    $filename = preg_replace('/\s\(\d\)/','',$image);
    $names = explode('_', $filename);
    $name = $names[0];
    $synonymous = implode(',', $names);
    $sql = "INSERT INTO comaut_figure (filename, name) VALUES ('$image', '$name')";

    $result = mysql_query ($sql);
    echo " Inserisco $names[0]: ";
    if (!$result) {
        echo "  [ERROR] " . mysql_error() ."\n"."\t$sql\n";
    }
    else {
        echo "  [OK]\n";
        $counter++;
    }
    flush();
}
    echo "\nInserite $counter immagini.\n";

?>