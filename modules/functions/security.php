<?php
	function checkUserInput($ui)
	{
		$i = 0;
		$strLen = strlen($ui);
		$allowedChars = ['@', '#', '$', '^', '*', '-', '_', '.', '?', ':'];
		for($i; $i < $strLen; $i++)
		{
			$char = substr($ui, $i, 1);
			if(!ctype_upper($char) && !ctype_lower($char) && !is_numeric($char) && $char != '_' && !in_array($char, $allowedChars)) return false;
		}
		return true;
	}
?>
