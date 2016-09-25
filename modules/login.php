<?php
	require_once('connection.php');
	require_once('functions/security.php');
	require_once('language-selector/selector.php');
	if(!($lang = getBlockVariables('login'))) echo 'Error';
	if(!isset($_POST))
	{
		$result['error'] = $lang['e'];
		echo json_encode($result);
		exit();
	}
	//----------Validation----------//
	$username = $_POST['username'];
	$password = $_POST['password'];
	$id = '';
	$result = [];
	if(!empty($username) && !empty($password))
	{
		if(!checkUserInput($username) || !checkUserInput($password)) $result['username'] = $lang['invalid_ui_e'];
		else
		{
			$qry = "SELECT * FROM users WHERE username = '$username'";
			$link = $mysqli->query($qry);
			if(!$link) $result['error'] = $lang['db_conn_e'];
			if($link->num_rows < 1) $result['error'] = $lang['bad_credentials1_e'];
			else
			{
				$row = $link->fetch_assoc();
				$id = $row['id'];
				if(!password_verify($password, $row['password'])) $result['error'] = $lang['bad_credentials2_e'];
				unset($row);
				$link->close();
			}

		}
	}
	else
	{
		if(empty($username)) $result['username'] = $lang['uname_empty_e'];
		if(empty($password)) $result['password'] = $lang['pass_empty_e'];
	}

	if(!empty($result))
	{
		echo json_encode($result);
		exit();
	}

	//----------LoggingIn----------//
	setcookie('username', $username, 0, "/cms");
	setcookie('id', $id, 0, "/cms");
	$date = date("r");
	$qry = "UPDATE users SET last_login = '$date' WHERE username = '$username'";
	$link = $mysqli->query($qry);
	if(!$link)
	{
		setcookie('username', $username, time()-200000);
		setcookie('id', $id, time()-200000);
		$result['error'] = 'Something happend to the database';
		echo json_encode($result);
		exit();
	}
	echo 'Logged in Successfully<br>Redirecting...';
?>
