<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" type="text/css" href="res/main.css" />
    <script type='application/javascript' src='res/common.js'></script>
    <title>Battle of Conquest</title>
  </head>

  <body class='site text_style flex_vert'>

    <div class='nav outer flex_hor'>
      <a href="index.php">Home</a>
      <?php
      if (isset($_SESSION['username'])) {
        echo ('<a href="?action=attacks">Attacks</a>');
        echo ('<a href="?action=map">Maps</a>');
        echo ('<a href="?action=buildings&district=');
        echo getStartDistrict();
        echo ('">Buildings</a>');
        echo ('<a href="?action=units">Units</a>');
        echo ('<a href = "?action=overview">Overview</a>');
      } else {
        echo ('<a href = "?action=login">Login</a>');
      }
      ?>
    </div>

    <div class='logo middle flex_centered'>
      <span class="logofont">battle of conquest</span>
    </div>

    <!-- Start of content div -->
    <div class='content middle flex_grow'>

      <?php

      function getStartDistrict() {
        $user = \Classes\User::where(array('username' => $_SESSION['username']));
        $userID = $user->next()->getUserId();
        $districts = \Classes\District::where(array('owner_id' => $userID));
        $districtID = 0;
        if (null != $districts) {
          if (0 < $districts->count()) {
            $districtID = $districts->next()->getDistrictId();
          }
        }
        return $districtID;
      }
      