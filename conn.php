<?php


$host="localhost";
$User="root";
$password="";
$db="test";

// Create connection
$conn = new mysqli($host, $User, $password, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$conn->set_charset("utf8");

error_reporting(0);



?>