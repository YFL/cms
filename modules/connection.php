<?php
	$mysqli = new mysqli("localhost", "root", "", "cms");
	if($mysqli->connect_errno) echo 'Failed to connect to mysql server';
?>
