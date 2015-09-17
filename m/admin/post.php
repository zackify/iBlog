<?php
require('../../connect.php');
$result = mysql_query("SELECT * FROM siteinfo");
$info = mysql_fetch_array($result);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="yes" name="apple-mobile-web-app-capable" />
<meta content="index,follow" name="robots" />
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<link href="../pics/homescreen.gif" rel="apple-touch-icon" />
<meta content="minimum-scale=1.0, width=device-width, maximum-scale=0.6667, user-scalable=no" name="viewport" />
<link href="../css/style.css" rel="stylesheet" media="screen" type="text/css" />
<script src="../javascript/functions.js" type="text/javascript"></script>
<title><?php echo $info['name'];?>
</title>
<link href="../pics/startup.png" rel="apple-touch-startup-image" />
<meta content="iPod,iPhone,Webkit,iWebkit,Website,Create,mobile,Tutorial,free" name="keywords" />
<meta content="Try out all the new features of iWebKit 5 with a simple touch of a finger and a smooth screen rotation!" name="description" />
</head>

<body>

<div id="topbar">
	<div id="title">
		<?php echo $info['name'];?></div>
		</div>
<div id="tributton">
	<div class="links">
		<a  href="../">Home</a><a id="pressed" href="index.php">Admin</a><a href="help.php">Help</a></div>
</div>
<div id="content">
<form method="post">
		<fieldset><span class="graytitle">New Post</span>
		<ul class="pageitem">
			<li class="bigfield"><input placeholder="Title" type="text" /></li>
			<li class="textbox"><textarea name="body" rows="10"></textarea></li>
		</ul>
		</fieldset></form>

</div>
<div id="footer">
	<!-- Support iWebKit by sending us traffic; please keep this footer on your page, consider it a thank you for my work :-) -->
	<p class="noeffect">Powered by <a class="noeffect" href="http://zachs.co/iblog">iBlog</a> & <a class="noeffect" href="http://snippetspace.com">iWebKit</a></p></div>

</body>

</html>