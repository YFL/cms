<?php
	require_once('functions/validators.php');
	require_once('functions/security.php');

	//RegisteringUser class for input validation
	class RegisteringUser {
		public function __construct() {
			$name = "";
			$password = "";
			$email = "";
			$pwdverify = "";
		}

		public function setName($name) {
			if(is_string($name)) {
				$this->name = (string)$name;
			}
		}

		public function getName() {
			return $this->name;
		}


		public function setEmail($email) {
			if(is_string($email)) {
				$this->email = (string)$email;
			}
		}

		public function getemail() {
			return $this->email;
		}

		public function setPassword($password) {
			if(is_string($password)) {
				$this->password = (string)$password;
			}
		}

		public function setPwdVerify($pwdverify) {
			if(is_string($pwdverify)) {
				$this->pwdverify = (string)$pwdverify;
			}
		}

		public function getPassword() {
			return $this->password;
		}

		public function getPwdverify() {
			return $this->pwdverify;
		}

		public function emptyUsername() {
			return empty($name);
		}

		public function emptyPass() {
			return empty($password);
		}

		public function emptyMail() {
			return empty($email);
		}

		public function checkStuff() {
			$result =
			[
				'e' => [],
				'w' => []
			];

			if(!isset($_POST))
			{
				$result['e'][] = $lang['e'];
				return $result;
			}

			if($this->emptyUsername())
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
			if($this->emptyPass())
			{
				$result['e'][] = $lang['pass_empty_e'];
			}
			else
			{
				if(strlen($password) < 8) $result['e'][] = $lang['short_pass_e'];
				if(!checkUserInput($password)) $result['e'][] = $lang['invalid_ui_e'];
				if(!passCheck($password)) $result['e'][] = $lang['invalid_pass_e'];
			}

			if($this->pwdverify !== $this->password) $result['e'][] = $lang['no_match_e'];

			if($this->emptyMail())
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
				return $result;
			}

			$pwdverify = "";
			$password = password_hash($password, PASSWORD_BCRYPT);

			return true;
		}

		private $name;
		private $password;
		private $pwdverify;
		private $email;
	}
?>
