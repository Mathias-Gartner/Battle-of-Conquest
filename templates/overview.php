<?php include 'header.php' ?>

<h1>Login successful!</h1>

    <div class='cont shadow grid middle'>
      <div class='tit shadow'><?php echo $_SESSION['username']; ?></div>
      <div>
        <a href="?action=buildings"><div class='shadow grid'>Meine Stadt</div></a>
        <a href="?action=map"><div class='shadow grid'>Zur Karte</div></a>
      </div>
      <p>Du hast derzeit <?php echo $PAGEDATA['districtsCount']; ?> St&auml;dte. Dir stehen insgesamt <?php echo $PAGEDATA['unitsCount']; ?> Einheiten f&uuml;r den Kampfeinsatz zur Verf&uuml;gung.</p>
      <p><a href="?action=login">Login</a></p>
    </div>

<?php include 'footer.php' ?>
