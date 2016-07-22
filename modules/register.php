<?php
	if(!($lang = getBlockVariables('reg'))) echo 'Error';
	$result =
	[
		'e' => [],
		'w' => []
	];
	if(!isset($_POST))
	{
		$result['e'][] = $lang['e'];
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
		$result['e'][] = $lang['uname_empty_e'];
	}
	else
	{
		if(!checkUserInput($username)) $result['e'][] = $lang['invalid_ui_e'];
		if(!preg_match('/^[a-zA-Z0-9_]+?/', $username));
		{
			$result['e'][] =  $lang['bad_uname_e'];
		}

	}
	if(empty($password))
	{
		$result['e'][] = $lang['pass_empty_e'];
	}
	else
	{
		if(strlen($password) < 8) $result['e'][] = $lang['short_pass_e'];
		if(!checkUserInput($password)) $result['e'][] = $lang['invalid_ui_e'];
		if(!passCheck($password)) $result['e'][] = $lang['invalid_pass_e'];
	}
	if(empty($pwdverify))
	{
		$result['e'][] = $lang['no_match_e'];
	}
	else
	{
		if($pwdverify !== $pasword) $result['e'][] = $lang['no_match_e'];
	}
	if(empty($email))
	{
		$result['e'][] = $lang['mail_empty_e'];
	}
	else
	{
		if(!checkUserInput($email)) $result['e'][] = $lang['invalid_ui_e'];
		$check = emailCheck($email);
		if($check == -1) $result['w'][] = $lang['email_w'];
		else if($check == 0) $result['e'][] = $lang['invalid_email_e'];
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
