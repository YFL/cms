<?php
	try{
		$pdo = new PDO("mysql:host=localhost;dbname=cms", "root", "");
		//Set this to false, to make sure the statemnets aren't parsed by PHP
		$dbConnection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		//Set PDO Error Mode to Exception
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		echo 'Connected successfully';
	}
	catch(PDOException $e) {
		echo 'Failed to connect to mysql server';
	}
?>
