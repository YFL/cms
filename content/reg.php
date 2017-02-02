<?php if(!($lang = getBlockVariables('reg'))) echo 'Error'; ?>
<form name="registrer_form" id="regform" method="POST" action="modules/register.php">
	<label>Username: </label><input type="text" name="username" placeholder="<?php echo $lang['username']; ?>"><br>
	<label>Email: </label><input type="email" name="email" placeholder="<?php echo $lang['email']; ?>"><br>
	<label>Password: </label><input type="password" name="password" placeholder="<?php echo $lang['password']; ?>"><br>
	<label>Verify password: </label><input type="password" name="pwdverify" placeholder="<?php echo $lang['pwdverify']; ?>"><br>
	<input type="submit" name="submit" value="<?php echo $lang['submit']; ?>">
</form>
