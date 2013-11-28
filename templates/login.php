<?php include "header.php" ?>
<div id="loginBox">
	<form action="index.php?action=login" method="POST">
		<?php if (isset($PAGEDATA["loginError"]) && $PAGEDATA["loginError"]) { ?>
		<div>
			<span class="errorMessage">Login fehlgeschlagen. Benutzername oder Passwort ung&uuml;ltig.</span>
		</div>
		<?php } ?>
		<div>
			<input type="text" id="username" name="username" placeholder="Username" />
		</div>
		<div>
			<input type="password" id="password" name="password" placeholder="Passwort" />
		</div>
		<div>
			<input type="submit" id="login" name="login" value="Login" />
		</div>
	</form>
</div>
<?php include "footer.php" ?>
