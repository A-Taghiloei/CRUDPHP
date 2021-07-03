<?php

define('DB_SERVER', 'localhost');
define('DB_USERNAME', '290083');
define('DB_PASSWORD', 'scd874332PL');
define('DB_NAME', '290083');

$dataLink = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
if($dataLink === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>