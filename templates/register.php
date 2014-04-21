<?php include "header.php" ?>

<div class='title flex_centered'>Enter your credentials here.</div>

<div id="loginBox">
	<form action="index.php?action=register" method="POST">
		<div id="loginFields" class='flex_vert'>
			<input type="text" id="username" name="username" placeholder="Username" required autofocus />
            <input type="email" id="mail" name="mail" placeholder="EMail" required />
            <input type="number" id="age" name="age" placeholder="Age" min="18" max="100" required />
			<input type="password" id="password" name="password" placeholder="Password" required />
			<input type="submit" id="register" name="register" value="Register" />
			<?php if (isset($PAGEDATA["registerError"]) && $PAGEDATA["registerError"]) { ?>
				<span class="errorMessage"><?php echo $PAGEDATA["errormsg"]; ?></span>
			<?php } ?>
		</div>
	</form>
</div>

<?php include "footer.php" ?>
