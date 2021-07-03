<?php

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'user');
define('DB_PASSWORD', 'pass');
define('DB_NAME', 'dbname');
// user pass and db name should set by the user and changed for uploading here
$dataLink = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
if($dataLink === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>
