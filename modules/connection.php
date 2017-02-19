<?php
	try{
		$pdo = new PDO("mysql:host=localhost;dbname=cms", "root", "");
		// if($pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false)) echo 'Successful attribute set PDO::ATTR_ENMULATE_PREPARES<br>';
		// else echo 'Couldn\'t set PDO::ATTR_EMULATE_PREPARES<br>';

		// if($pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION)) echo 'Successful attribute set PDO::ATTR_ERRMODE<br>';
		// else echo 'Couldn\'t set PDO::ATTRERRMODE<br>';
	}catch (PDOException $e) {
		die ('Failed to connect to mysql server. Error: '.$e->getMessage().'<br>');
	}
?>
