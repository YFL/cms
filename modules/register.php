<?php
	require_once('classes.php');

	$username = $_POST['username'];
	$password = $_POST['password'];
	$pwdverify = $_POST['pwdverify'];
	$email = $_POST['email'];

//----------Validation & Registration----------//
	$user = new RegisteringUser($username, $password, $pwdverify, $email);
	if($user->checkData()) {
		if($user->register()) {
			echo 'Successful registration!<br>';
		}
		else echo 'Registration failed!<br>';
	}

	echo 'Successful registration!<br>';
?>
