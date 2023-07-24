<?php
require_once __DIR__ . './env.php';
// // Create connection
// $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
// // Check connection
// if ($conn->connect_error) {
// 	die("Connection failed: " . $conn->connect_error);
// }

function DBConnection(){
	
	$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die("Connection Failed: ". $conn -> error);

	return $conn;
}

function CloseConnection($conn){
	$conn->close();
}