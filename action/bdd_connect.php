<?php
	$servername = "localhost";
	$username = "bourget";
	$password = "test";
	$dbname = "bourget";
	
	$sql = "";
	$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>