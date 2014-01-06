<?php include "header.php"; ?>

<script src="res/jquery-1.10.2.min.js"></script>
<script type="application/javascript" src="res/jquery.imagemapster.min.js"></script>
<script type="application/javascript" src="res/map_script.js"></script>

<div class='flex_centered title'>Great Canyons</div>

<div id="map" class="map">
	<img src="res/BOC_Great_Canyons.png" alt="great_canyons" name="great_canyons" usemap="#great_canyons_map"  id="boc_great_canyons_id" class="boc_mapster mapBoxShadow"/>
	<map id="great_canyons_map" name="great_canyons_map">
		<area shape="circle" coords="392,345,8" href="#" alt="city" title="city" data-group="city1" />
		<area shape="circle" coords="395,424,8" href="#" alt="city" title="city" data-group="city2" />
		<area shape="circle" coords="443,419,8" href="#" alt="city" title="city" data-group="city3" />
		<area shape="circle" coords="425,453,8" href="#" alt="city" title="city" data-group="city4" />
		<area shape="circle" coords="401,487,8" href="#" alt="city" title="city" data-group="city5" />
		<area shape="circle" coords="433,486,8" href="#" alt="city" title="city" data-group="city6" />
		<area shape="circle" coords="464,456,8" href="#" alt="city" title="city" data-group="city7" />
		<area shape="circle" coords="492,422,8" href="#" alt="city" title="city" data-group="city8" />
		<area shape="circle" coords="542,401,8" href="#" alt="city" title="city" data-group="city9" />
		<area shape="circle" coords="499,374,8" href="#" alt="city" title="city" data-group="city10" />
		<area shape="circle" coords="478,347,8" href="#" alt="city" title="city" data-group="city11" />
		<area shape="circle" coords="426,323,8" href="#" alt="city" title="city" data-group="city12" />
		<area shape="circle" coords="474,311,8" href="#" alt="city" title="city" data-group="city13" />
		<area shape="circle" coords="507,324,8" href="#" alt="city" title="city" data-group="city14" />
		<area shape="circle" coords="534,343,8" href="#" alt="city" title="city" data-group="city15" />
		<area shape="circle" coords="563,361,8" href="#" alt="city" title="city" data-group="city16" />
		<area shape="circle" coords="463,390,8" href="#" alt="city" title="city" data-group="city17" />
		<area shape="circle" coords="406,390,8" href="#" alt="city" title="city" data-group="city18" />
		<area shape="circle" coords="434,362,8" href="#" alt="city" title="city" data-group="city19" />
	</map>

	<div class='flex_hor linkbar'>
		<div class='flex_centered'>
			<a href='?action=buildings' class='bigbutton'>Your City</a>
		</div>

		<div class='flex_centered'>
			<a href='javascript:history.back()' class='bigbutton'>To Map</a>
		</div>
	</div>
</div>

<?php include "footer.php"; ?>
