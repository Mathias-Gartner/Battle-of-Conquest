<?php include 'header.php' ?>

  <div class='cont shadow grid middle'>
    <div class='centered user'><?php echo $PAGEDATA['targetCityName']; ?> angreifen!</div>
    <div>
      <?php if (isset($PAGEDATA['success'])) { ?>
      
        <p>Hauptmann: <span class='quote'>M&auml;nner bereit zum Kampf! Wir greifen an!</span></p>
        <a href="?action=attacks">Weiter</a>

      <?php } else {
      
        if (isset($PAGEDATA['notEnoughUnits'])) { ?>
          <p>Hauptmann: <span class='quote'>Herr, wir haben nicht so viele M&auml;nner.</span></p>
        <?php } else if (isset($PAGEDATA['noUnitsSelected'])) { ?>
          <p>Hauptmann: <span class='quote'>Herr, bitte sagt mir welche Einheiten angreifen sollen.</span></p>
        <?php } ?>
        
        <a href='javascript:history.back();'>Nochmal probieren</a>
        
      <?php } ?>
  </div>

<?php include 'footer.php' ?>
