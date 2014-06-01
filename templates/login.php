<?php include "header.php" ?>

<article id="login" class="panel">
	<header>
		<h2 class='flex_centered'>Please login!</h2>
	</header>

	<div id="loginBox">
		<form action="index.php?action=login" method="POST">
			<div id="loginFields" class='flex_vert'>
				<input type="text" id="username" name="username" placeholder="Username" required autofocus />
				<input type="password" id="password" name="password" placeholder="Password" required />
				<input type="submit" id="login" name="login" value="Login" />
				<?php if (isset($PAGEDATA["loginError"]) && $PAGEDATA["loginError"]) { ?>
					<span class="errorMessage">Login failed. Please check username and password.</span>
				<?php } ?>
			</div>
		</form>
	</div>

	<div id="loginBox">
		<div id="loginFields" class='flex_vert'>
			<input type="button" onClick="window.location='?action=register'" value="Or register here" />
	    </div>
	</div>
</article>

<?php include "footer.php" ?>
