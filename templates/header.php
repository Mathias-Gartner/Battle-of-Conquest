<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="res/main.css" />
	
	<title>Battle of Conquest</title>
</head>

<body class='site text_style flex_vert'>

	<div class='nav outer flex_hor'>
		<a href="index.php">Home</a>
		<a href="?action=attacks">Attacks</a>
		<a href="?action=map">Maps</a>
		<a href="?action=buildings">Buildings</a>
		<a href="?action=units">Units</a>
		<?php if (isset($_SESSION['username'])) { ?>
			<a href="?action=overview">Overview</a>
		<?php } else { ?>
			<a href="?action=login">Login</a>
		<?php } ?>
	</div>

	<div class='logo middle flex_centered'>
		<span class="logofont">battle of conquest</span>
	</div>

	<!-- Start of content div -->
	<div class='content middle flex_grow'>
