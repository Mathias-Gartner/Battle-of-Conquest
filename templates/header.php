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
      <a href="index.php" class=' grid centered'><div >Home</div></a>
      <a href="?action=overview" class=' grid centered'><div >Overview</div></a>
      <a href="?action=map" class=' grid centered'><div >Maps</div></a>
      <a href="?action=buildings" class=' grid centered'><div >Buildings</div></a>
      <a href="?action=units" class=' grid centered'><div >Units</div></a>
      <a class='grid centered' href="?action=<?php if (isset($_SESSION['username'])) { 
    			echo 'overview';
    		} else {
    			echo 'login';
  			}
			?>">
  			<div >
  	    	<?php if (isset($_SESSION['username']) && $_SESSION['username'] != '') 
          { 
  	        echo 'Profil';
  	       } else { 
  	        echo 'Login';
  	      } ?>
      	</div>
    	</a>
    </div>
  
  <div class='head grid outer centered logo'>
    <span class="logofont">battle of conquest</span>
  </div>
