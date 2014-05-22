<?php include 'header.php' ?>

<article id="welcome" class="panel" >
			<header>
				<h2>Attack on <?php echo $PAGEDATA['targetCityName']; ?>!</h2>
			</header>

		<div id="sladi_start_attack">
			<?php if (isset($PAGEDATA['success'])) { ?>
				<p><span class='quote'>To battle, and victory!</span></p>
				<div>
					<a href='?action=attacks' class='bigbutton'>Next</a>
				</div>
			<?php } else {

			if (isset($PAGEDATA['notEnoughUnits'])) { ?>
				<p><span class='quote'>We don't have enough warriors, commander.</span></p>
			<?php } else if (isset($PAGEDATA['noUnitsSelected'])) { ?>
				<p><span class='quote'>With all due respect commander, you did not select any units.</span></p>
			<?php } ?>
		</div>

		<div>
			<a href='javascript:history.back();' class='bigbutton'>Try again</a>
		</div>
</article>

<?php } ?>

</div>

<?php include 'footer.php' ?>
