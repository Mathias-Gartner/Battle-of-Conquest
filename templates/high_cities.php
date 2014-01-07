<?php include "header.php"; ?>

<div class='flex_centered title'>High cities</div>

<div id="map" class="map">

	<img src="res/BOC_High_Cities.png" alt="high_cities" name="high_cities" usemap="#high_cities_map" class="mapBoxShadow" />
	
	<div class='flex_hor linkbar'>	
		<div class='flex_centered'>
			<a href='?action=buildings' class='bigbutton'>Your city</a>
		</div>
		
		<div class='flex_centered'>
			<a href='javascript:history.back()' class='bigbutton'>To map</a>
		</div>
	</div>
	
</div>

<?php include "footer.php"; ?>
