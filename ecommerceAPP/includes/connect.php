<?php
// Enable error reporting
error_reporting(-1);
ini_set('display_errors', TRUE);

// AWS SDK autoloader
require '/var/www/html/vendor/autoload.php';

use Aws\SecretsManager\SecretsManagerClient;
use Aws\Exception\AwsException;

try {
    // Create a Secrets Manager Client
    $client = new SecretsManagerClient([
        'version' => 'latest',
        'region'  => 'us-east-1'
    ]);

    // Get the secret value
    $result = $client->getSecretValue([
        'SecretId' => 'ecommerce/rds/credentials2'
    ]);

    if (isset($result['SecretString'])) {
        $secret = json_decode($result['SecretString'], true);
        
        // Extract database credentials
        $servername = $secret['RDS_HOST'];
        $username = $secret['RDS_USER'];
        $password = $secret['RDS_PASSWORD'];
        $dbname = $secret['RDS_DBNAME'];
        
        // Create database connection
        $con = mysqli_init();
        mysqli_options($con, MYSQLI_OPT_CONNECT_TIMEOUT, 30);
        
        if (!mysqli_real_connect($con, $servername, $username, $password, $dbname)) {
            throw new Exception("Database connection failed: " . mysqli_connect_error());
        }
        
        // Set charset after successful connection
        if (!$con->set_charset("utf8mb4")) {
            throw new Exception("Error loading character set utf8mb4: " . $con->error);
        }
    }
    
} catch (AwsException $e) {
    die("Error retrieving secret: " . $e->getMessage());
} catch (Exception $e) {
    die("Error: " . $e->getMessage());
}

// Your application code goes here...
?>