<?php include 'header.php' ?>

<article id="home" class="panel">
        <header>
            <h2 class='flex_centered'>Build units</h2>
        </header>

    <?php if (isset($PAGEDATA['success'])) { ?>
    <p><span style="color: green; font-weight: bold;">Your units have finished their training.</span><p>
    <?php } ?>

    <p><span class='quote'>How many soldiers shall we train, commander?</span></p>

    <form class='flex_vert' action='?action=units&method=createUnits' method='POST'>
      <input type='hidden' id='districtId' name='districtId' value='<?php echo $PAGEDATA['districtId']; ?>' />

      <?php foreach ($PAGEDATA['units'] as $unit) { ?>
      <p>
        <span><?php echo $unit['name'].' ' ?>: </span>
        <input type='number' class='unitNumber' onchange='unitNumberChanged()' name='unit_<?php echo $unit['id']; ?>' value='0' min='0' max='<?php echo $unit['max']; ?>' />
        <span> of <?php echo $unit['max']; ?></span>
      </p>
      <?php } ?>

      <p id='distanceParagraph' style='visibility: hidden;'>We will need <span id='resourcesRequiredLabel'></span> of our resources to train these men.</p>

      <input type='submit' value='Begin your work!' />
    </form>

	</article>
<?php include 'footer.php' ?>
