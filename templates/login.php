<?php include "header.php" ?>

<div class='title flex_centered'>Please login.</div>

<div id="loginBox">
	<form action="index.php?action=login" method="POST">
		<div id="loginFields" class='flex_vert'>
			<input type="text" id="username" name="username" placeholder="Username" required autofocus />
			<input type="password" id="password" name="password" placeholder="Passwort" required />
			<input type="submit" id="login" name="login" value="Login" />
			<?php if (isset($PAGEDATA["loginError"]) && $PAGEDATA["loginError"]) { ?>
				<span class="errorMessage">Login failed. Please check username and password.</span>
			<?php } ?>
		</div>
	</form>
</div>

<?php include "footer.php" ?>
