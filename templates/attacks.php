<?php include 'header.php' ?>

	<script type='application/javascript' src='res/attacks.js'></script>

	<div class='title flex_centered'>Overview of your attacks</div>
    
	<div id="attacksListContainer" class='flex_centered'>
	
	<div class='flex_hor linkbar'>
		<div class='flex_centered'>
			<a href='javascript:showCurrent();' class='bigbutton'><span>Ongoing</span></a>
		</div>
		<div class='flex_centered'>
			<a href='javascript:showPast();' class='bigbutton'><span>Recent</span></a>
		</div>
	</div>
	
		<div id='headerLine'>
			<span>Base</span>
			<span>Target</span>
			<span></span>
		</div>

		<div id='noAttacksDiv' style='display:none;'>No attacks.</div>
		<div id='loadingDiv'>Loading...</div>
		<div id='attackListDiv'>

		</div>
	</div>

<?php include 'footer.php' ?>
