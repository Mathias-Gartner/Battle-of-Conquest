<?php include 'header.php' ?>

  <div class='cont shadow grid middle'>
    <div class='centered user'><?php echo $PAGEDATA['targetCityName']; ?> angreifen!</div>
    <div>
      <?php if (count($PAGEDATA['units']) == 0) { ?>
      	<p>
      		Hauptmann: In unserer Stadt stehen uns keine M&auml;nner zur Verf&uuml;gung.
      	</p>
      	<a href='javascript:history.back();'>Zur&uuml;ck</a>
      <?php } else { ?>
		    <p>Hauptmann: <span class='quote'>Herr, in welcher St&auml;rke sollen wir marschieren?</span></p>
		    
		    <form action='?action=startAttack' method='POST'>
		    <input type='hidden' name='sourceId' value='<?php echo $PAGEDATA['sourceId']; ?>' />
		    <input type='hidden' name='targetId' value='<?php echo $PAGEDATA['targetId']; ?>' />

		    <?php foreach ($PAGEDATA['units'] as $unit) { ?>
			    <p>
			      <span><?php echo $unit['name'] ?>: </span>
			      <input type='number' name='unit_<?php echo $unit['id']; ?>' value='0' min='0' max='<?php echo $unit['max']; ?>' />
			      <span>von <?php echo $unit['max']; ?></span>
			    </p>
			  <?php } ?>

		    <input type='submit' value='Angriff!' />
		    </form>
		  <?php } ?>
    </div>
  </div>

<?php include 'footer.php' ?>
