<?php
	function setLanguage()
	{
		if(isset($_GET['lang'])) $_SESSION['lang'] = $_GET['lang'];
		else $_SESSION['lang'] = 'en';
	}

	function getBlockVariables($block)
	{
		if(!isset($_SESSION['lang']))
		{
			include_once('languages/en_'.$block.'.php');
			return $lang;
		}
		else {
			include_once('languages/'.$_SESSION['lang'].'_'.$block.'.php');
			return $lang;
		}
		return false;
	}
?>
