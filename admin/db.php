<?php
$server = 'localhost';
$username = 'root';
$password = '';
$database = 'tendencie-db';

try{
	$conn = new PDO("mysql:host=$server;dbname=$database;", $username, $password);
} catch(PDOExeption $e){
	die("connection failed ". $e->getMessage());
}
?>