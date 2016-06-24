<?php if(!($lang = getBlockVariables('nav'))) echo 'Error'; ?>
<div class="flex fw-contianer">
	<nav>
		<div id="item1" class="nav-item flex-item main-item"><?php echo $lang['item1']; ?></div>
		<div id="item2" class="nav-item flex-item main-item"><a href="?c=content"><?php echo $lang['item2']; ?></a></div>
	</nav>
	<div class="dropdown" id="dd1">
		<div class="flex-item dd-item"><a href="?c=content"><?php echo $lang['item3']; ?></a></div>
		<div class="flex-item dd-item"><a href="?c=content"><?php echo $lang['item4']; ?></a></div>
	</div>
</div>
