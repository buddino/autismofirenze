<?php
$filename = $_GET['img'];
$path = 'figures/'.$filename;
if (file_exists($path)) {
    //Set the content-type header as appropriate
    $image_info = getimagesize($path);
    switch ($image_info[2]) {
        case IMAGETYPE_JPEG:
            header("Content-Type: image/jpeg");
            break;
        case IMAGETYPE_GIF:
            header("Content-Type: image/gif");
            break;
        case IMAGETYPE_PNG:
            header("Content-Type: image/png");
            break;
        default:
            header($_SERVER["SERVER_PROTOCOL"] . " 500 Internal Server Error");
            break;
    }
    header('Content-Length: ' . filesize($path));
    readfile($path);
}
else { // Image file not found
    header($_SERVER["SERVER_PROTOCOL"] . " 404 Not Found");
}