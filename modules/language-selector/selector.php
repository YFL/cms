<?php
	function setLanguage()
	{
		if(isset($_GET['lang'])) $_SESSION['lang'] = $_GET['lang'];
		else $_SESSION['lang'] = 'en';
	}

	function getBlockVariables($block)
	{
		if(isset($_SESSION['lang'])){ include('languages/'.$_SESSION['lang'].'_'.$block.'.php'); return true; }
		return false;
	}
?>
