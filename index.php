<?php

	require_once('modules/language-selector/selector.php');
	setLanguage();
	if(!($lang = getBlockVariables('header'))) echo 'Error';
?>
<!DOCTYPE html>
<html>
	<head>
		<title>CMS <?php echo $lang['title']; ?></title>
		<link type="text/css" href="styles/<?php if(isset($_GET['style'])) echo $_GET['style'].'css'; else echo 'style.css'; ?>" rel="stylesheet">
		<link type="text/css" href="styles/roll-down-nav.css" rel="stylesheet">
		<link type="text/css" href="styles/form-tables.css" rel="stylesheet">
		<script type="text/javascript" src="js/jquery-3.0.0.js"></script>
		<script type="text/javascript" src="js/plug-ins/roll-down-nav.js"></script>
		<script type="text/javascript" src="js/plug-ins/register.js"></script>
		<script type="text/javascript" src="js/js.js"></script>
	</head>
	<body>
		<?php
			require('content/topbar.php');
			require('content/header.php');
			require('content/nav.php');
			if(isset($_GET['c'])) require('content/'.$_GET['c'].'.php');
			else require('content/home.php');
			//if there is any aside element uncomment the following line
			//require('content/aside.php');
			require('content/footer.php');
		?>
	</body>
</html>
