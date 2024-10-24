<?php
// Enable error reporting
error_reporting(-1);
ini_set('display_errors', TRUE);

// Define database connection variables
$servername = '';
$username = '';
$password = '';
$dbname = '';

// Set the charset explicitly
mysqli_set_charset($con, 'utf8mb4');

// Creating a new MySQLi connection with charset specification
$con = mysqli_init();
mysqli_options($con, MYSQLI_OPT_CONNECT_TIMEOUT, 30);
mysqli_real_connect($con, $servername, $username, $password, $dbname);

// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

// Set the charset after connection
$con->set_charset("utf8mb4");

// Your application code goes here...
?>