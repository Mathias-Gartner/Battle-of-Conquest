<?php include 'header.php' ?>

<div class='flex_centered title'>
	Attack on <?php echo $PAGEDATA['targetCityName']; ?>!
</div>

<div class="flex_vert" id="sladi_start_attack">
	<?php if (isset($PAGEDATA['success'])) { ?>
		<p><span class='quote'>To battle, and victory!</span></p>
		<a href="?action=attacks">Next</a>
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

<?php } ?>

<?php include 'footer.php' ?>
