<!DOCTYPE html>
<html class='flex_vert'>
  <head>
    <link rel="stylesheet" type="text/css" href="res/main.css" />
    <link rel="stylesheet" type="text/css" href="res/overview.css" />
    <link rel="stylesheet" type="text/css" href="res/login.css" />
    <link rel="stylesheet" type="text/css" href="res/map.css" />
  </head>
  
  <body class='site text_style flex_vert'>
    <div class='nav outer flex_hor'>
      <a href="index.php"><div class=' grid flex_centered'>Home</div></a>
      <a href="?action=attacks"><div class=' grid flex_centered'>Attacks</div></a>
      <a href="?action=map"><div class=' grid flex_centered'>Maps</div></a>
      <a href="?action=buildings"><div class=' grid flex_centered'>Buildings</div></a>
      <a href="?action=units"><div class=' grid flex_centered'>Units</div></a>
      <?php if (isset($_SESSION['username'])) { ?>
      <a href="?action=overview"><div class=' grid flex_centered'>Overview</div></a>
      <?php } else { ?>
      <a href="?action=login"><div class=' grid flex_centered'>Login</div></a>
      <?php } ?>
    </div>
  
  <div class='head grid middle centered logo'>
    <span class="logofont">battle of conquest</span>
  </div>
