<?php

$host = "localhost";
$username = "root";
$password = "";
$database = "userandstudent_management_system1";

$conn = mysqli_connect(
    $host,
    $username,
    $password,
    $database
);

if(!$conn){
    die("Connection Failed");
}

?>