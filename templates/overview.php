<?php include 'header.php' ?>

<div class='flex_centered title'>
	Welcome <?php echo $_SESSION['username']; ?>!
</div>

 <article id="home" class="panel">

	<div class='linkbar'>

		<div class='flex_centered'>
			<a href='?action=buildings' class='bigbutton'>Your City</a>
		</div>

		<div class='flex_centered' >
			<a href='?action=map' class='bigbutton'>Show World</a>
		</div>

	</div>

	<p>
		You are in control of
		<?php
		if ($PAGEDATA['districtsCount'] == 1)
			echo 'one city';
		else
			echo $PAGEDATA['districtsCount'].' cities';
		?>.
	</p>
	
	<p>
		You have
		<?php
		if ($PAGEDATA['unitsCount'] == 1)
			echo 'one warrior unit';
		else
			echo $PAGEDATA['unitsCount'].' warriors';
		?>
		under your command.
	</p>
</article>

<?php include 'footer.php' ?>
