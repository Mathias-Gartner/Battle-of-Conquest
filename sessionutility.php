<?php

class SessionUtility
{
  public static function isLoggedin()
  {
    return (isset($_SESSION['username']) && $_SESSION['username'] != '');
  }
}

?>
