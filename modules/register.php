<?php

	$username = $_POST['username'];
	$password = $_POST['password'];
	$pwdverify = $_POST['pwdverify'];
	$email = $_POST['email'];

//----------Validation----------//


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
