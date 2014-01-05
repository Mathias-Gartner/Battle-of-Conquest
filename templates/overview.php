<?php include 'header.php' ?>

<div class='flex_centered title'>
	Willkommen <?php echo $_SESSION['username']; ?>!
</div>

<div class='flex_hor linkbar'>

	<div class='flex_centered'>
	<a href='?action=buildings' class='bigbutton'>Meine Stadt</a>
	</div>

	<div class='flex_centered' >
	<a href='?action=map' class='bigbutton'>Zur Karte</a>
	</div>

</div>

<div class="flex_centered" id="overview">
	Du hast derzeit
	<?php
		if ($PAGEDATA['districtsCount'] == 1)
		echo 'eine Stadt';
		else
		echo $PAGEDATA['districtsCount'].' St&auml;dte';
	?>.
	<br>
	Dir stehen insgesamt
	<?php
		if ($PAGEDATA['unitsCount'] == 1)
		echo 'eine Einheit';
		else
		echo $PAGEDATA['unitsCount'].' Einheiten';
	?>
	f&uuml;r den Kampfeinsatz zur Verf&uuml;gung.
</div>

<?php include 'footer.php' ?>
