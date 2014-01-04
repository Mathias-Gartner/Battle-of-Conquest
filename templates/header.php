<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" type="text/css" href="res/main.css" />
    <link rel="stylesheet" type="text/css" href="res/overview.css" />
    <link rel="stylesheet" type="text/css" href="res/login.css" />
    <link rel="stylesheet" type="text/css" href="res/map.css" />
  </head>
  
  <body class='site'>
    <div class='nav outer' id="navi">
      <a href="index.php"><div class=' grid centered'>Home</div></a>
      <a href="?action=attacks"><div class=' grid centered'>Attacks</div></a>
      <a href="?action=map"><div class=' grid centered'>Maps</div></a>
      <a href="?action=buildings"><div class=' grid centered'>Buildings</div></a>
      <a href="?action=units"><div class=' grid centered'>Units</div></a>
      <?php if (isset($_SESSION['username'])) { ?>
      <a href="?action=overview"><div class=' grid centered'>Overview</div></a>
      <?php } else { ?>
      <a href="?action=login"><div class=' grid centered'>Login</div></a>
      <?php } ?>
    </div>
  
  <div class='head grid outer centered logo'>
    <span class="logofont">battle of conquest</span>
  </div>
