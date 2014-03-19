		<!-- end of content div -->
		</div>
		<div class='foot outer flex_hor'>
			<a href="?action=footer&foot=fh">FH Technikum</a>
			<a href="?action=footer&foot=team">Team</a>
			<a href="?action=footer&foot=help">Help</a>
			<a href="?action=footer&foot=imp">Impressum</a>
			<?php if (isset($_SESSION['username']) && $_SESSION['username'] != '') { ?>
				<a href="?action=logout">Logout</a>
			<?php } ?>
		</div>
	</body>
</html>
