<?php
	setcookie('username', '', 1);
	setcookie('id', '', 1);
	$url = $_SERVER['DOCUMENT_ROOT'].'/cms';
	header('Location: /cms');
?>
