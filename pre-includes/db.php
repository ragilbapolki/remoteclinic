<?php
// DATABASE CONNECTION //
@session_start();

$databaseHost = 'localhost';
$databaseName = 'remoteclinic';
$databaseUsername = 'root';
$databasePassword = '';
 
$con = mysqli_connect($databaseHost, $databaseUsername, $databasePassword, $databaseName); 
 
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}
