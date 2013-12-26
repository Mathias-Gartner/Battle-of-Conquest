<?php
     if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      session_start();

      $username = $_POST['username'];
      $password = $_POST['password'];

      $hostname = $_SERVER['HTTP_HOST'];
      $path = dirname($_SERVER['PHP_SELF']);

      // Benutzername und password werden überprüft
      if ($username == 'benjamin' && $password == 'geheim') {
       $_SESSION['loggedIn'] = true;

       // Weiterleitung zur geschützten Startseite
       if ($_SERVER['SERVER_PROTOCOL'] == 'HTTP/1.1') {
        if (php_sapi_name() == 'cgi') {
         header('Status: 303 See Other');
         }
        else {
         header('HTTP/1.1 303 See Other');
         }
        }

       header('Location: http://'.$hostname.($path == '/' ? '' : $path).'/index.php');
       exit;
       }
      }
?>

  <form action="login.php" method="post">
   Username: <input type="text" name="username" /><br />
   Password: <input type="password" name="password" /><br />
   <input type="submit" value="Login" />
  </form>