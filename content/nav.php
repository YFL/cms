<?php if(!($lang = getBlockVariables('nav'))) echo 'Error'; ?>
<div class="flex fw-contianer">
	<nav>
		<div class="nav-item flex-item main-item"><?php echo $lang['item1']; ?></div>
		<div class="nav-item flex-item main-item"><?php echo $lang['item2']; ?></div>
	</nav>
</div>
