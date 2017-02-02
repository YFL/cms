<?php
	function setLanguage()
	{
		if(isset($_GET['lang'])) setcookie('lang', $_GET['lang']);
		else setcookie('lang', 'en');
	}

	function getBlockVariables($block)
	{
		if(!isset($_COOKIE['lang']))
		{
			include_once($_SERVER['DOCUMENT_ROOT'].'/cms/languages/en_'.$block.'.php');
			return $lang;
		}
		else {
			include_once($_SERVER['DOCUMENT_ROOT'].'/cms/languages/'.$_COOKIE['lang'].'_'.$block.'.php');
			return $lang;
		}
		return false;
	}
?>
