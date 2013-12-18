<?php include "header.php" ?>
<div class="cont shadow grid middle">
  <div id="loginBox">
	  <form action="index.php?action=login" method="POST">
		  <?php if (isset($PAGEDATA["loginError"]) && $PAGEDATA["loginError"]) { ?>
		  <div>
			  <span class="errorMessage">Login fehlgeschlagen. Benutzername oder Passwort ung&uuml;ltig.</span>
		  </div>
		  <?php } ?>
		  <div id="loginFields">
		    <div>
			    <input type="text" id="username" name="username" placeholder="Username" required autofocus />
		    </div>
		    <div>
			    <input type="password" id="password" name="password" placeholder="Passwort" required />
		    </div>
		    <div>
			    <input type="submit" id="login" name="login" value="Login" />
		    </div>
		  </div>
	  </form>
  </div>
</div>
<?php include "footer.php" ?>
