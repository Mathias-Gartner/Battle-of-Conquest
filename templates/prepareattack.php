<?php include 'header.php' ?>

<div class='flex_centered title'>
	<?php echo 'Prepare the attack on '.$PAGEDATA['targetCityName'].'!'; ?>
</div>

<div class='flex_vert'>
	<?php if (count($PAGEDATA['units']) == 0) { ?>
		<p>This city has no units! We are unable to attack, commander!</p>
		<a href='javascript:history.back();'>Back</a>
	<?php } else { ?>
		<p><span class='quote'>How many units will you dispatch, commander?</span></p>

		<form class='flex_vert' action='?action=startAttack' method='POST'>
			<input type='hidden' name='sourceId' value='<?php echo $PAGEDATA['sourceId']; ?>' />
			<input type='hidden' name='targetId' value='<?php echo $PAGEDATA['targetId']; ?>' />

			<?php foreach ($PAGEDATA['units'] as $unit) { ?>
			<p>
				<span><?php echo $unit['name'].' ' ?>: </span>
				<input type='number' name='unit_<?php echo $unit['id']; ?>' value='0' min='0' max='<?php echo $unit['max']; ?>' />
				<span> of <?php echo $unit['max']; ?></span>
			</p>
			<?php } ?>

			<input type='submit' value='Attack now!' />
		</form>
	<?php } ?>
</div>

<?php include 'footer.php' ?>
