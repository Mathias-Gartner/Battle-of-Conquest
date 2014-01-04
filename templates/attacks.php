<?php include 'header.php' ?>

	<script type='application/javascript' src='res/attacks.js'></script>

	<div class='cont shadow grid middle'>
		<div class='tit shadow'>Angriffe</div>
		<div>
			<a href='javascript:showCurrent();'><span>Aktuell</span></a>
			<a href='javascript:showPast();'><span>Vergangene</span></a>
		</div>
    
    <div id="headerLine">
    	<span>Von</span>
			<span>Ziel</span>
			<span></span>
		</div>
    
    <div id="noAttacksDiv" style="display:none;">
    	Keine Angriffe.
    </div>
		<div id='attackListDiv'>
      
		</div>
	</div>

<?php include 'footer.php' ?>
