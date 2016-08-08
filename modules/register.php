<?php
	require_once('language-selector/selector.php');
	if(!($lang = getBlockVariables('reg'))) echo 'Error';
	$result = [];
	if(!isset($_POST))
	{
		$result['error'] = $lang['e'];
		echo json_encode($result);
		exit();
	}
	require_once('functions/validators.php');
	require_once('functions/security.php');
	$username = $_POST['username'];
	$password = $_POST['password'];
	$pwdverify = $_POST['pwdverify'];
	$email = $_POST['email'];

//----------Validation----------//
	if(empty($username))
	{
		$result['username'] = $lang['uname_empty_e'];
	}
	else
	{
		if(!checkUserInput($username)) $result['username'] = $lang['invalid_ui_e'];
		if(!preg_match('/^[a-zA-Z0-9_]+?/', $username));
		{
			$result['username'] =  $lang['bad_uname_e'];
		}

	}
	if(empty($password))
	{
		$result['password'] = $lang['pass_empty_e'];
	}
	else
	{
		if(strlen($password) < 8) $result['password'] = $lang['short_pass_e'];
		if(!checkUserInput($password)) $result['password'] = $lang['invalid_ui_e'];
		if(!passCheck($password)) $result['password'] = $lang['invalid_pass_e'];
	}
	if(empty($pwdverify))
	{
		$result['pwdverify'] = $lang['no_match_e'];
	}
	else
	{
		if($pwdverify !== $password) $result['pwdverify'] = $lang['no_match_e'];
	}
	if(empty($email))
	{
		$result['email'] = $lang['mail_empty_e'];
	}
	else
	{
		if(!checkUserInput($email)) $result['email'] = $lang['invalid_ui_e'];
		$check = emailCheck($email);
		if($check == 0) $result['email'] = $lang['invalid_email_e'];
	}
	if(!empty($result))
	{
		echo json_encode($result);
		exit();
	}

//----------Registration----------//

	require_once('modules/connection.php');
	$password = password_hash($password, PASSWORD_BCRYPT);
	$link = $mysqli->query("INSERT INTO 'users' ('username', 'email', 'password') VALUES ($username, $email, $password)");
	if(!$link)
	{
		$link->close();
		$mysqli->close();
		echo 'Query failed';
		exit();
	}
	$link->close();
	$mysqli->close();

	echo 'Successful registration!<br>';
?>
