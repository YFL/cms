<?php
	if(!($lang = getBlockVariables('login'))) echo 'Error';
	if(!isset($_COOKIE['username']) && !isset($_COOKIE['id']))
	{
?>
	<div class="flex container">
		<div class="flex flex-item">
			<div class="flex form-table login center">
				<label class="success" id="success"></label>
				<label class="error" id="error"></label>
				<form method="POST" action="" id="loginform">
					<table>
						<tr><td><input type="text" name="username" placeholder="<?php echo $lang['username']; ?>"><label class="error" id="username"></label><br></td></tr>
						<tr><td><input type="password" name="password" placeholder="<?php echo $lang['password']; ?>"><Label class="error" id="password"></label><br></td></tr>
						<tr><td><input type="submit" name="submit" value="<?php echo $lang['submit']; ?>"></td></tr>
					</table>
				</form>
			</div>
		</div>
	</div>
<?php } else header('Location: ./index.php?c=profile'); ?>
