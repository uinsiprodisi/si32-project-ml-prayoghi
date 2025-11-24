<?php

$servername = "localhost";
$database = "uinsi_nim";
$username = "root";
$password = "";
 
// Create connection
 
$conn = mysqli_connect($servername, $username, $password, $database);
 
// Check connection
 
if (!$conn) {
 
    die("Connection failed: " . mysqli_connect_error());
 
}

?>
