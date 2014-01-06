<?php include 'header.php' ?>

	<script type='application/javascript' src='res/attacks.js'></script>

	<div class='cont shadow grid middle'>
		<div class='centered user'>Angriffe</div>
		<div class='centered linkbar'>
			<a href='javascript:showCurrent();' class='bigbutton'><span>Aktuell</span></a>
			<a href='javascript:showPast();' class='bigbutton'><span>Vergangene</span></a>
		</div>
    
    <div id="attacksListContainer" class='centered cont overview'>
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
	</div>

<?php include 'footer.php' ?>
