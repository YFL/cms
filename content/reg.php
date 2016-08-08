<?php if(!($lang = getBlockVariables('reg'))) echo 'Error'; ?>
<label id="success"></label>
<div class="form-table">
	<form name="registrer_form" id="regform" method="POST" action="modules/register.php">
		<label>Username: </label><input type="text" name="username" placeholder="<?php echo $lang['username']; ?>"><label class="error" id="username"></label><br>
		<label>Email: </label><input type="email" name="email" placeholder="<?php echo $lang['email']; ?>"><label class="error" id="email"></label><br>
		<label>Password: </label><input type="password" name="password" placeholder="<?php echo $lang['password']; ?>"><label class="error" id="password"></label><br>
		<label>Verify password: </label><input type="password" name="pwdverify" placeholder="<?php echo $lang['pwdverify']; ?>"><label class="error" id="pwdverify"></label><br>
		<input type="submit" name="submit" value="<?php echo $lang['submit']; ?>">
	</form>
</div>
