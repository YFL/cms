<?php
	function passCheck($str)
	{
		$i = 0;
		$lC = false;
		$uC = false;
		$n = false;
		$strLen = strlen($str);
		for($i; $i < $strLen; $i++)
		{
			$char = substr($str, $i, 1);
			if(ctype_upper($char)) $uC = true;
			if(ctype_lower($char)) $lC = true;
			if(is_numeric($char)) $n = true;
		}
		if($lC && $uC && $n) return true;
		return false;
	}

//----------Email checker----------//
//Returns 1 when everything's okay, 0 when it is sure, that the email address is invalid and -1 if it may be right and wrong too
	function emailCheck($email)
	{
		$i = 0;
		$dot = false;
		$str = explode('@', $email);
		if(count($str) != 2) return 0;
		$len = strlen($str[0]);

		for($i; $i < $len; $i++)
		{
			$char = substr($str[0], $i, 1);
			if($i == $len - 1 && ($char == '.' || $char == '-' || $char == '_')) return -1;
		}


		$len = strlen($str[1]);
		for($i = 0; $i < $len; $i++)
		{
			$char = substr($str[1], $i, 1);
			if($char == '.') $dot = true;
			if($i == ($len - 1) && ($char == '.' || $char == '-' || $char == '_')) return 0;
		}
		if($dot) return 1;
	}
?>
