<?php

// Enable error reporting
error_reporting(-1);
ini_set('display_errors', TRUE);

// Define database connection variables (these will be set by UserData)
$servername = '';
$username = '';
$password = '';
$dbname = '';

// Creating a new MySQLi connection
$con = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

// Your application code goes here...

?>
