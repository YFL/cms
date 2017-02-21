<?php
	require_once('connection.php');
	require_once('language-selector/selector.php');
	require_once('functions/validators.php');
	require_once('functions/security.php');

	class RegisteringUser {
		public function __construct($un, $pwd, $pwdver, $eml) {
			$name = "";
			$password = "";
			$pwdverify = "";
			$email = "";
			if(is_string($un)) {
				$this->name = (string)$un;
			}
			if(is_string($pwd)) {
				$this->password = (string)$pwd;
			}
			if(is_string($pwdver)) {
				$this->pwdverify = (string)$pwdver;
			}
			if(is_string($eml)) {
				$this->email = (string)$eml;
			}
		}

		public function checkData() {
			$result = [];
			if(!($lang = getBlockVariables('reg'))) {
				die('Error');
			}
			global $pdo;

			/* Checking Username */
			if(empty($this->name))
			{
				$result['username'] = $lang['uname_empty_e'];
			}
			else
			{
				if(strlen($this->name) > 32) $result['username'] = $lang['uname_long_e'];
				else if(!checkUserInput($this->name)) $result['username'] = $lang['invalid_ui_e'];
				else if(!usernameCheck($this->name))
				{
					$result['username'] = $lang['bad_uname_e'];
				}
				else
				{
					$stmt = $pdo->prepare('SELECT * FROM users WHERE username= :username');
					$stmt->execute(array(':username' => $this->name));
					if($stmt->rowCount() > 0) $result['username'] = $lang['existing_username_e'];
					$stmt = null;
				}
			}

			/* Checking Password */
			if(empty($this->password))
			{
				$result['password'] = $lang['pass_empty_e'];
			}
			else
			{
				if(strlen($this->password) > 32) $result['password'] = $lang['password_long_e'];
				if(strlen($this->password) < 8) $result['password'] = $lang['short_pass_e'];
				if(!checkUserInput($this->password)) $result['password'] = $lang['invalid_ui_e'];
				if(!passCheck($this->password)) $result['password'] = $lang['invalid_pass_e'];
			}
			if($this->pwdverify !== $this->password) $result['pwdverify'] = $lang['no_match_e'];

			/* Checking Email */
			if(empty($this->email))
			{
				$result['email'] = $lang['mail_empty_e'];
			}
			else
			{
				if(strlen($this->email) > 64) $result['email'] = $lang['email_long_e'];
				if(!checkUserInput($this->email)) $result['email'] = $lang['invalid_ui_e'];
				else {
					$check = emailCheck($this->email);
					if($check == 0) $result['email'] = $lang['invalid_email_e'];
					else {
						$qry = 'SELECT * FROM users WHERE email = :email';
						$stmt = $pdo->prepare($qry);
						$stmt->execute(array(':email' => $this->email));
						if($stmt->rowCount() > 0) $result['email'] = $lang['existing_email_e'];
						$stmt = null;
					}
				}
			}

			if(!empty($result)) // If there were errors, return them
			{
				return json_encode($result);
			}

			return true;
		}

		public function hashPassword() {
			$this->password = password_hash($this->password, PASSWORD_BCRYPT);
		}

		public function register() {
			global $pdo;
			if(($this->name !== "") && ($this->password !== "") && ($this->email !== "")) {
				$stmt = null;
				try {
					$stmt = $pdo->prepare("INSERT INTO users (username, email, password, reg_date) VALUES (:name, :email, :password, :reg_date)");
					if($stmt !== null) {
						try {
							$retVal = $stmt->execute(array(':name' => $this->name, ':email' => $this->email, ':password' => $this->password, ':reg_date' => date('jS \of F Y h:i:s A')));
							if(!$retVal) {
								throw new Exception('Execute failed!');
							}
							else {
								$stmt = null;
								$pdo = null;
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


	class LoginHandler {
		public function __construct($username, $password) {
			if(is_string($username)) {
				$this->name = (string)$username;
			}
			if(is_string($password)) {
				$this->password = (string)$password;
			}
		}

		public function checkData() {
			$result = array();
			global $pdo;
			if(!($lang = getBlockVariables('login'))) die('Error');
			if(!empty($this->name) && !empty($this->password))
			{
				if(!checkUserInput($this->name) || !checkUserInput($this->password)) $result['username'] = $lang['invalid_ui_e'];
				else
				{
					$qry = "SELECT * FROM users WHERE username = :username";
					$stmt = $pdo->prepare($qry);
					$stmt->execute(array(':username' => $this->name));
					// if(!$link) $result['error'] = $lang['db_conn_e'];
					if($stmt->rowCount() < 1) $result['error'] = $lang['bad_credentials1_e'];
					else
					{
						$row = $stmt->fetch(PDO::FETCH_ASSOC);
						$this->id = $row['id'];
						if(!password_verify($this->password, $row['password'])) $result['error'] = $lang['bad_credentials2_e'];
						unset($row);
						$stmt = null;
					}

				}
			}
			else
			{
				if(empty($username)) $result['username'] = $lang['uname_empty_e'];
				if(empty($password)) $result['password'] = $lang['pass_empty_e'];
			}
			if(!empty($result)) return $result;
			return true;
		}

		public function logIn() {
			global $pdo;

			setcookie('username', $this->name, 0, "/cms");
			setcookie('id', $this->id, 0, "/cms");
			$date = date("jS \of F Y h:i:s A");
			$qry = "UPDATE users SET last_login = :date WHERE username = :username";
			$stmt = $pdo->prepare($qry);
			$stmt->execute(array(':date' => $date, ':username' => $this->name));
			if($stmt->rowCount() < 1)
			{
				setcookie('username', FALSE, time()-200000, "/cms");
				setcookie('id', FALSE, time()-200000, "/cms");
				return false;
			}
			$stmt = null;
			$pdo = null;
			return true;
		}

		private $id;
		private $name;
		private $password;
	}
?>
