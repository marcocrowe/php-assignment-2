<?php

require_once("CONFIG/config.php");

//Define Connection Parameters
//
$DBServer = 'localhost'; // e.g 'localhost' or '192.168.1.100'
//$DBUser = 'root';
$DBUser = 'hdip2016';

$DBPass = 'hdip2016';
//$DBPass = '';
$DBName = 'k00213234_itschool';
//$DBName = 'k0xxxxxx_itschool';

//connect using object oriented method
$conn = new mysqli($DBServer, $DBUser, $DBPass, $DBName);  //-->mysqli::__construct — Open a new connection to the MySQL server
// check connection
//
if ($conn->connect_error) {   //--->mysqli::$connect_errno — Returns the error code from last connect call
    if (__DEBUG == 1) {
        echo "<p>Database connection failed: $conn->connect_error, E_USER_ERROR";
    }
    exit("<p>PHP script terminated");
}
?>

