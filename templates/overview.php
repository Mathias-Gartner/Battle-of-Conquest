<?php include 'header.php' ?>

  <div class='cont shadow grid middle'>
    <div class='tit shadow'>Willkommen <?php echo $_SESSION['username']; ?>!</div>
    <div class='centered linkbar'>
      <a href='?action=buildings' class='box-padding'>
        <div class='shadow grid centered' style='height: 2em;'>Meine Stadt</div>
      </a>
      <a href='?action=map' class='box-padding'>
        <div class='shadow grid centered' style='height: 2em;'>Zur Karte</div>
      </a>
    </div>
    <p>
      Du hast derzeit
      <?php
        if ($PAGEDATA['districtsCount'] == 1)
          echo 'eine Stadt';
        else
          echo $PAGEDATA['districtsCount'].' St&auml;dte';
      ?>.
      Dir stehen insgesamt
      <?php
        if ($PAGEDATA['unitsCount'] == 1)
          echo 'eine Einheit';
        else
          echo $PAGEDATA['unitsCount'].' Einheiten';
      ?>
      f&uuml;r den Kampfeinsatz zur Verf&uuml;gung.
    </p>
  </div>

<?php include 'footer.php' ?>
