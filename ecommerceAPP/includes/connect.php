<?php

require 'vendor/autoload.php'; 

use Aws\SecretsManager\SecretsManagerClient;
use Aws\Exception\AwsException;

// Enable error reporting
error_reporting(-1);
ini_set('display_errors', TRUE);

$client = new SecretsManagerClient([
    'version' => 'latest',
    'region' => 'us-east-1', 
]);

try {
    $result = $client->getSecretValue([
        'SecretId' => 'ecommerce/rds/credentials2', 
    ]);
    
    // Decode the secret string into an associative array
    $secret = json_decode($result['SecretString'], true);
    
    // Use retrieved credentials
    $servername = $secret['RDS_HOST'];
    $username = $secret['RDS_USER'];
    $password = $secret['RDS_PASSWORD'];
    $dbname = $secret['RDS_DBNAME'];
    
} catch (AwsException $e) {
    // Error Handling in retrieving secret
    die("Error retrieving secret: " . $e->getMessage());
}

// Creating a new MySQLi connection
$con = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

// Your application code goes here...

?>
