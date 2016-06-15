<?php
	session_start();
	require_once('modules/language-selector/selector.php');
	setLanguage();
	if(!($lang = getBlockVariables('header'))) echo 'Error';
?>
<!DOCTYPE html>
<html>
	<head>
		<title>CMS <?php echo $lang['title']; ?></title>
		<link type="text/css" href="styles/<?php if(isset($_GET['style'])) echo $_GET['style'].'css'; else echo 'style.css'; ?>" rel="stylesheet">
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
