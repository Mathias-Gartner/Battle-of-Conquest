<?php include 'header.php' ?>

	<script type='application/javascript' src='res/attacks.js'></script>

	<div class='title flex_centered'>Attack overview</div>

	<div class='flex_hor linkbar'>
		<div class='flex_centered'>
			<a href='javascript:showCurrent();' class='bigbutton'><span>Aktuell</span></a>
		</div>
		<div class='flex_centered'>
			<a href='javascript:showPast();' class='bigbutton'><span>Vergangene</span></a>
		</div>
	</div>
    
	<div id="attacksListContainer" class='flex_centered'>
		<div id='headerLine'>
			<span>Von</span>
			<span>Ziel</span>
			<span></span>
		</div>

		<div id='noAttacksDiv' style='display:none;'>
			Keine Angriffe.
		</div>
		<div id='attackListDiv'>

		</div>
	</div>

<?php include 'footer.php' ?>
