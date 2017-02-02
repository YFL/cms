<div id="topbar">
	<div class="flex fw-container">
		<div class="flex">
			<div class="flex-item" style="margin-right: 5px;"><?php if(!isset($_COOKIE['username']) && !isset($_COOKIE['id'])) { ?><a href="?c=login">LogIn</a><?php } else { ?><a href="?c=logout">LogOut</a><?php } ?></div>
			<div class="flex-item" style="margin-right: 5px;"><a href="?c=reg">Register</a></div>
		</div>
	</div>
</div>
