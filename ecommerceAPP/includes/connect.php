<?php

//include('../../inc/dbinfo.php');

error_reporting(-1);
ini_set('display_errors',TRUE);

//include "../../inc/dbinfo.inc";

$con=new mysqli('ecommerce-db-instance.czg8cso4sgh8.us-east-1.rds.amazonaws.com', 'admin', 'ENPM818N|E-commerce','ecommerce');

//mysqli_connect('localhost','root','','ecommerce_1');
//$con = new mysqli('localhost','root','','ecommerce_1');

if(!$con){
    die(mysqli_error($con));
}




?>