<?php include 'header.php' ?>

	<script type='application/javascript' src='res/attacks.js'></script>

	<article id="home" class="panel">
		<header>
			<h2 class='flex_centered'>Overview of your attacks</h2>
		</header>

		<div id="attacksListContainer">

			<div class='flex_hor linkbar'>
				<div class='flex_centered'>
					<a href='javascript:showCurrent();' class='bigbutton'><span>Ongoing</span></a>
				</div>
				<div class='flex_centered'>
					<a href='javascript:showPast();' class='bigbutton'><span>Recent</span></a>
				</div>
			</div>

			<!--<div id='headerLine'>
				<span>Base</span>
				<span>Target</span>
				<span></span>
			</div>-->

			<div id='noAttacksDiv' style='display:none;'>No attacks.</div>
			<div id='loadingDiv'>Loading...</div>
			<div id='attackListDiv'></div>
		</div>
	</article>

<?php include 'footer.php' ?>
