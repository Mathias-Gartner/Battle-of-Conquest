<?php include 'header.php' ?>

<article id="home" class="panel">
        <header>
            <h3 class='flex_centered'>units</h3>
            <h4 class='flex_centered'>Build units</h4>
        </header>

		<div>
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
	</article>
<?php include 'footer.php' ?>
