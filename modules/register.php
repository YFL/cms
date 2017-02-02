<?php
	require_once('language-selector/selector.php');
	if(!($lang = getBlockVariables('reg'))) echo 'Error';

	require_once('registerObjects.php');
	$username = $_POST['username'];
	$password = $_POST['password'];
	$pwdverify = $_POST['pwdverify'];
	$email = $_POST['email'];

//----------Validation----------//
	$user = new RegisteringUser();

	$user->setName($username);
	$user->setPassword($password);
	$user->setEmail($email);

	if(($result = $user->checkStuff()) !== true) {
		echo json_encode($result);
		exit();
	}

//----------Registration----------//

	require_once('modules/connection.php');
	$stmt = $pdo->prepare("INSERT INTO 'users' ('username', 'email', 'password') VALUES (':username', ':email', ':password')");

	$stmt->execute(array(':username' => $user->getUsername(), ':email' => $user->getEmail(), ':password' => $user->getPassword()));

	if($stmt->rowCount == 0) {
		$stmt = null;
		$pdo = null;
		echo 'Query failed!\n';
		exit();
	}
	$stmt = null;
	$pdo = null;

	echo 'Successful registration!<br>';
?>
