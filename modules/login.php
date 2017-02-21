<?php
	require_once('classes.php');
	if(!isset($_POST))
	{
		$result = array();
		$result['error'] = $lang['e'];
		echo json_encode($result);
		exit();
	}
	//----------Validation & LoggingIn----------//
	$username = $_POST['username'];
	$password = $_POST['password'];
	$loginHandler = new LoginHandler((string)$username, (string)$password);
	if(($result = $loginHandler->checkData()) === true) {
		if($loginHandler->logIn() === true) {
			echo 'Logged in successfuly! Redirecting...<br>';
		}
		else {
			$result = array('error' => 'Something went wrong!');
			echo json_encode($result);
		}
	}
	else {
		echo json_encode($result);
		exit();
	}

?>
