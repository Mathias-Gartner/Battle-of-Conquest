<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" type="text/css" href="res/main.css" />
    <link rel="stylesheet" type="text/css" href="res/login.css" />
  </head>
  
  <body class='site'>
    <div class='nav outer' id="navi">
      <a href="index.php"><div class=' grid centered'>Home</div></a>
      <a href="?action=overview"><div class=' grid centered'>Overview</div></a>
      <a href="?action=map"><div class=' grid centered'>Maps</div></a>
      <a href="?action=buildings"><div class=' grid centered'>Buildings</div></a>
      <a href="?action=units"><div class=' grid centered'>Units</div></a>
      <a href="?action=
      <?php if (isset($_SESSION['username'])) { 
    			echo 'overview';
    		} else {
    			echo 'login';
  			}
			?>">
				<div class=' grid centered'>
		    	<?php if (isset($_SESSION['username']) && $_SESSION['username'] != '') { ?>
		        Profil
		      <?php } else { ?>
		        Login<
		      <?php } ?>
      	</div>
    	</a>
    </div>
  
  <div class='head grid outer centered'>
    <span class="logofont">battle of conquest</span>
  </div>
