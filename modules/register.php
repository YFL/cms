<?php
	require_once('connection.php');
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
		else if(!usernameCheck($username))
		{
			$result['username'] =  $lang['bad_uname_e'];
		}
		else
		{
			$qry = "SELECT * FROM 'users' WHERE 'username' = $username";
			$stmt = $mysqli->query("SELECT * FROM users WHERE username='$username'");
			if($stmt->num_rows > 0) $result['username'] = $lang['existing_username_e'];
			$stmt->close();
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
		$qry = "SELECT * FROM users WHERE email = '$email'";
		$stmt = $mysqli->query($qry);
		if($stmt->num_rows > 0) $result['email'] = $lang['existing_email_e'];
		$stmt->close();
	}
	if(!empty($result))
	{
		echo json_encode($result);
		exit();
	}

//----------Registration----------//

	$password = password_hash($password, PASSWORD_BCRYPT);
	$date = date("r");
	$link = $mysqli->query("INSERT INTO users (username, email, password, reg_date) VALUES ('$username', '$email', '$password', '$date')");
	if(!$link)
	{
		$mysqli->close();
		echo 'Query failed';
		exit();
	}
	$mysqli->close();

	echo 'Successful registration!<br>';
?>
