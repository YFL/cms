<?php
	$lang = "";
	require_once('connection.php');
	require_once('language-selector/selector.php');
	if(!($lang = getBlockVariables('reg'))) {
		die('Error');
	}
	require_once('functions/validators.php');
	require_once('functions/security.php');

	class RegisteringUser {
		public function __construct($un, $pwd, $pwdver, $eml) {
			$name = "";
			$password = "";
			$pwdverify = "";
			$email = "";
			if(is_string($un)) {
				$name = (string)$un;
			}
			if(is_string($pwd)) {
				$password = (string)$pwd;
			}
			if(is_string($pwdver)) {
				$pwdverify = (string)$pwdver;
			}
			if(is_string($eml)) {
				$email = (string)$eml;
			}
		}

		public function checkData() {
			$result = [];

			/* Checking POST */
			if(!isset($_POST))
			{
				$result['error'] = $lang['e'];
				return $result;
			}

			/* Checking Username */
			if(empty($username))
			{
				$result['username'] = $lang['uname_empty_e'];
			}
			else
			{
				if(strlen($username) > 32) $result['username'] = $lang['uname_long_e'];
				else if(!checkUserInput($username)) $result['username'] = $lang['invalid_ui_e'];
				else if(!usernameCheck($username))
				{
					$result['username'] =  $lang['bad_uname_e'];
				}
				else
				{
					$stmt = $pdo->prepare('SELECT * FROM users WHERE username= :username');
					$stmt->execute(array(':username' => $username));
					if($stmt->rowCount() > 0) $result['username'] = $lang['existing_username_e'];
					$stmt = null;
				}
			}

			/* Checking Password */
			if(empty($password))
			{
				$result['password'] = $lang['pass_empty_e'];
			}
			else
			{
				if(strlen($password) > 32) $result['password'] = $lang['password_long_e'];
				if(strlen($password) < 8) $result['password'] = $lang['short_pass_e'];
				if(!checkUserInput($password)) $result['password'] = $lang['invalid_ui_e'];
				if(!passCheck($password)) $result['password'] = $lang['invalid_pass_e'];
			}
			if($pwdverify !== $password) $result['pwdverify'] = $lang['no_match_e'];

			/* Checking Email */
			if(empty($email))
			{
				$result['email'] = $lang['mail_empty_e'];
			}
			else
			{
				if(strlen($email) > 64) $result['email'] = $lang['email_long_e'];
				if(!checkUserInput($email)) $result['email'] = $lang['invalid_ui_e'];
				else {
					$check = emailCheck($email);
					if($check == 0) $result['email'] = $lang['invalid_email_e'];
					else {
						$qry = 'SELECT * FROM users WHERE email = :email';
						$stmt = $pdo->prepare($qry);
						$stmt->execute(array(':email' => $email));
						if($stmt->rowCount() > 0) $result['email'] = $lang['existing_email_e'];
						$stmt = null;
					}
				}
			}

			if(!empty($result)) // If there were errors, return them
			{
				return $result;
			}

			$password = password_hash($password, PASSWORD_BCRYPT);
			return true;
		}

		public function register() {
			if(($username !== "") && ($password !== "") && ($email !== "")) {
				$stmt = null;
				try {
					$stmt = $pdo->prepare('INSERT INTO users (username, email, password, reg_date) VALUES (:name, :email, :password, :reg_date)');
					if($stmt !== null) {
						try {
							//$retVal = $stmt->execute(array(':name' => $name, ':email'->$email, ':password' => $password, date('jS \of F Y h:i:s A')));
							if(!$retVal) {
								throw new Exception('Execute failed!');
							}
							else {
								$stmt = null;
								$pdo = null;
								sleep(60);
								return true;
							}
						}
						catch(Exception $e) {
							echo 'Failed to register!<br>';
							return false;
						}
					}
				}
				catch(PDOException $e) {
					echo 'Couldn\'t prepare statement! PDOException Message: '.$e->message;
					return false;
				}
			}
			return false;
		}

		private $username;
		private $password;
		private $pwdverify;
		private $email;
	}
?>
