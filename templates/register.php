<?php include "header.php" ?>

<article id="home" class="panel">
	<header>
		<h2 class='flex_centered'>Enter your credentials here.</h2>
	</header>
	<div id="loginBox">
		<form action="index.php?action=register" method="POST">
			<div id="loginFields" class='flex_vert'>
				<input type="text" id="username" name="username" placeholder="Username" required autofocus />
	            <br>
	            <input type="email" id="mail" name="mail" placeholder="EMail" required />
	            <br>
	            <input type="number" id="age" name="age" placeholder="Age" min="18" max="100" required />
				<br>
				<input type="password" id="password" name="password" placeholder="Password" required />
				<br>
				<input type="submit" id="register" name="register" value="Register" />
				<?php if (isset($PAGEDATA["registerError"]) && $PAGEDATA["registerError"]) { ?>
					<span class="errorMessage"><?php echo $PAGEDATA["errormsg"]; ?></span>
				<?php } ?>
			</div>
		</form>
	</div>
</article>

<?php include "footer.php" ?>
