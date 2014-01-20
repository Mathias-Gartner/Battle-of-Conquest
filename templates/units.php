<?php include 'header.php' ?>

<div class='title flex_centered'>Units</div>

<div class='flex_centered title'>Build units</div>

<div class='flex_vert'>
	<?php if (isset($PAGEDATA['success'])) { ?>
	<span style="color: green; font-weight: bold;">10 Units added</span>
	<?php } ?>
	<form class='flex_vert' action='?action=units&perform=debugAdd' method='POST'>
		<select name='city'>
		<?php foreach ($PAGEDATA['cities'] as $city) { ?>
			<option value='<?php echo $city['id']; ?>'><?php echo $city['name']; ?></option>
		<?php } ?>
		</select>
		<input type='submit' value='Add 10 units' />
	</form>
</div>

<?php include 'footer.php' ?>
