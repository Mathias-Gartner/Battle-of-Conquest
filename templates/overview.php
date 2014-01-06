<?php include 'header.php' ?>

<div class='flex_centered title'>
	Welcome <?php echo $_SESSION['username']; ?>!
</div>

<div class='flex_hor linkbar'>

	<div class='flex_centered'>
		<a href='?action=buildings' class='bigbutton'>Your City</a>
	</div>

	<div class='flex_centered' >
		<a href='?action=map' class='bigbutton'>Show World</a>
	</div>

</div>

<div class="flex_vert" id="overview">

	<p>
	You are in control of
	<?php
		if ($PAGEDATA['districtsCount'] == 1)
		echo 'one city';
		else
		echo $PAGEDATA['districtsCount'].' cities';
	?>.
	</p>
	
	You have
	<?php
		if ($PAGEDATA['unitsCount'] == 1)
		echo 'one warrios unit';
		else
		echo $PAGEDATA['unitsCount'].' warriors';
	?>
	under your command.
	</p>
	
</div>

<?php include 'footer.php' ?>
