<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400" rel="stylesheet" />
    <script src="res/js/jquery.min.js"></script>
    <script src="res/js/skel.min.js"></script>
    <script src="res/js/init.js"></script>
    <noscript>
      <link rel="stylesheet" href='res/css/skel-noscript.css' />
      <link rel="stylesheet" href='res/css/style.css' />
      <link rel="stylesheet" href='res/css/style-desktop.css' />
      <link rel="stylesheet" href='res/css/noscript.css' />
    </noscript>

    <script type='application/javascript' src='res/common.js'></script>
    <title>Battle of Conquest</title>
  </head>

<body class="homepage">
  <!-- Wrapper-->
  <div id="wrapper">
    <!-- Logo -->
    <div id="logo">
      <p>battle of conquest</p>
    </div>

    <!-- Nav -->
    <nav id="nav">
        <a href="index.php" class="fa fa-home <?php if(!isset($_GET['action'])) echo "active"; ?>"><span>Home</span></a>
        <?php
        if (isset($_SESSION['username'])) {
          echo '<a href="?action=attacks" class="fa fa-rocket ';
                if(isset($_GET['action']) && $_GET['action'] === 'attacks') echo 'active';
                echo '"><span>Attacks</span></a>';
          echo ('<a href="?action=map" class="fa fa-map-marker ');
                if(isset($_GET['action']) && $_GET['action'] === 'map') echo 'active';
                echo ('"><span>map</span></a>');
          echo ('<a href="?action=buildings" class="fa fa-building ');
                if(isset($_GET['action']) && $_GET['action'] === 'buildings') echo 'active';
                echo ('"><span>Building</span></a>');
          echo ('<a href="?action=units" class="fa fa-flag-o ');
                if(isset($_GET['action']) && $_GET['action'] === 'units') echo 'active';
                echo ('"><span>units</span></a>');
          echo ('<a href="?action=overview" class="fa fa-list ');
                if(isset($_GET['action']) && $_GET['action'] === 'overview') echo 'active';
                echo ('"><span>Overview</span></a>');
        } else {
          echo ('<a href="?action=login" class="fa fa-sign-in ');
                if(isset($_GET['action']) && $_GET['action'] === 'overview') echo 'active';
                echo ('"><span>Login</span></a>');
        }
        ?>
    </nav>

    <!-- Start of content div -->
    <div id="main">

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
            