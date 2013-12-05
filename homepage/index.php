<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<script type="text/javascript" src="js/jquery-2.0.2.min.js"></script>
</head>
<body>
<?php
//Banner
include_once("pages/banner.php");
?>

<div id="content">
<?php
if (isset($_GET['p']))
{
	switch($_GET['p']) {
	case "home":
		include("pages/home.php");
		break;
	default:
		include("pages/home.php");
		break;
	}
} else
{
	include("pages/home.php");
}
?>
</div>

<div id="footer">
	<?php 
		include("pages/footer");
	 ?>
</div>
</body>
</html>