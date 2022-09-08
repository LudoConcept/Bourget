<?php

	// dev
	$servername = "localhost";
	$username = "bourget";
	$password = "test";
	$dbname = "bourget";
	
	// prod
	$servername = "acrcugpcity.mysql.db";
	$username = "acrcugpcity";
	$password = "Evasi0n73";
	$dbname = "acrcugpcity";
	
	$sql = "";
	$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>