<?php
	require_once('classes.php');

	$username = $_POST['username'];
	$password = $_POST['password'];
	$pwdverify = $_POST['pwdverify'];
	$email = $_POST['email'];


	/* Checking POST */
	if(!isset($_POST))
	{
		$result['error'] = $lang['e'];
		echo json_encode($result);
		exit();
	}

//----------Validation & Registration----------//
	$user = new RegisteringUser($username, $password, $pwdverify, $email);
	$result = $user->checkData();
	if($result === true) {
		$user->hashPassword();
		if($user->register()) {
			echo 'Successful registration!<br>';
		}
		else {
			echo 'Registration Failed on Last moment!';
		}
	}
	else {
		echo $result;
	}

?>
