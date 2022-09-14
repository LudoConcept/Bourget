<?php

	if ($_SERVER['HTTP_HOST'] == "jeuext.la-grande-evasion.com") { // on est en prod
		$servername = "acrcugpcity.mysql.db";
		$username = "acrcugpcity";
		$password = "Evasi0n73";
		$dbname = "acrcugpcity";
	} else { // on est en dev
		$servername = "localhost";
		$username = "bourget";
		$password = "test";
		$dbname = "bourget";
	}
	
	
	$sql = "";
	$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>