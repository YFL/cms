<?php if(!($lang = getBlockVariables('login'))) echo 'Error'; ?>
<div class="container">
	<form method="POST" action="">
		<input type="text" name="username" placeholder="<?php echo $lang['username']; ?>"><label class="error"></label><br>
		<input type="password" name="password" placeholder="<?php echo $lang['password']; ?>"><label class="error"></label><br>
		<input type="submit" name="submit" value="<?php echo $lang['submit']; ?>">
	</form>
</div>
