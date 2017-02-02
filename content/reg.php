<?php if(!($lang = getBlockVariables('reg'))) echo 'Error'; ?>
<div class="flex fw-container">
	<div class="flex form-table">
		<label class="success" id="success"></label>
		<label class="error" id="error"></label>
		<form name="registrer_form" id="regform" method="POST" action="modules/register.php">
			<table>
				<tr><td><label>Username: </label></td><td><input type="text" name="username" placeholder="<?php echo $lang['username']; ?>"><label class="error" id="username"></label></td></tr>
				<tr><td><label>Email: </label></td><td><input type="email" name="email" placeholder="<?php echo $lang['email']; ?>"><label class="error" id="email"></label></td></tr>
				<tr><td><label>Password: </label></td><td><input type="password" name="password" placeholder="<?php echo $lang['password']; ?>"><label class="error" id="password"></label></td></tr>
				<tr><td><label>Verify password: </label></td><td><input type="password" name="pwdverify" placeholder="<?php echo $lang['pwdverify']; ?>"><label class="error" id="pwdverify"></label></td></tr>
				<tr><td colspan="2"><input type="submit" name="submit" value="<?php echo $lang['submit']; ?>"></td></tr>
			</table>
		</form>
	</div>
</div>
