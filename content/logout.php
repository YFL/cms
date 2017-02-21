<?php
	if(!setcookie('username', FALSE, time()-3600, "/cms") || !setcookie('id', FALSE, time() - 3600, "/cms")) {
		die('Couldn\'t unset cookies');
	}
	$url = $_SERVER['DOCUMENT_ROOT'].'/cms';
	header('Location: /cms');
?>
