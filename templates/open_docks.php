<?php include "header.php"; ?>

<script type="application/javascript" src="res/jquery-1.10.2.min.js"></script>
<script type="application/javascript" src="res/jquery.imagemapster.min.js"></script>
<script type="application/javascript" src="res/map_script.js"></script>

<div class='flex_centered title'>Open Docks</div>

<div id="map" class="map">
	<img src="res/BOC_Open_Docks.png" alt="open_docks" name="open_docks" usemap="#open_docks_map" id="boc_open_docks_id" class="boc_mapster mapBoxShadow" />
	<a href="?action=buildings"><img src="res/flag.png" alt="flag" id="flag" style="position:relative;left:376px;top:-236px;" /></a>
    <input type="hidden" value="a" id="district_ids" />
	
	<!-- Image Maps for other cities -->
	<map id="open_docks_map_id" name="open_docks_map">
		<area shape="circle" coords="392,345,8" href="index.php?action=buildings" alt="city" id="1" title="city" data-group="city1" id="my_district" />
		<area shape="circle" coords="395,424,8" href="blank_district.html" id="2" alt="city" title="city" data-group="city2" />
		<area shape="circle" coords="443,419,8" href="blank_district.html" id="3" alt="city" title="city" data-group="city3" />
		<area shape="circle" coords="425,453,8" href="blank_district.html" id="4" alt="city" title="city" data-group="city4" />
		<area shape="circle" coords="401,487,8" href="blank_district.html" id="5" alt="city" title="city" data-group="city5" />
		<area shape="circle" coords="433,486,8" href="blank_district.html" id="6" alt="city" title="city" data-group="city6" />
		<area shape="circle" coords="464,456,8" href="blank_district.html" id="7"alt="city" title="city" data-group="city7" />
		<area shape="circle" coords="492,422,8" href="blank_district.html" id="8"alt="city" title="city" data-group="city8" />
		<area shape="circle" coords="542,401,8" href="blank_district.html" id="9"alt="city" title="city" data-group="city9" />
		<area shape="circle" coords="499,374,8" href="blank_district.html" id="10"alt="city" title="city" data-group="city10" />
		<area shape="circle" coords="478,347,8" href="blank_district.html" id="11"alt="city" title="city" data-group="city11" />
		<area shape="circle" coords="426,323,8" href="blank_district.html" id="12"alt="city" title="city" data-group="city12" />
		<area shape="circle" coords="474,311,8" href="blank_district.html" id="13"alt="city" title="city" data-group="city13" />
		<area shape="circle" coords="507,324,8" href="blank_district.html" id="14"alt="city" title="city" data-group="city14" />
		<area shape="circle" coords="534,343,8" href="blank_district.html" id="15"alt="city" title="city" data-group="city15" />
		<area shape="circle" coords="563,361,8" href="blank_district.html" id="16"alt="city" title="city" data-group="city16" />
		<area shape="circle" coords="463,390,8" href="blank_district.html" id="17"alt="city" title="city" data-group="city17" />
		<area shape="circle" coords="406,390,8" href="blank_district.html" id="18"alt="city" title="city" data-group="city18" />
		<area shape="circle" coords="434,362,8" href="blank_district.html" id="19"alt="city" title="city" data-group="city19" />
	</map>
	
	<div id="box" class="mapBoxShadow"><div class="box_top" id="box_label"></div><span class="box_bottom" id="attack_button">Attack!</span></div>    
	
	<div class='flex_hor linkbar'>	
		<div class='flex_centered'>
			<a href='?action=buildings' class='bigbutton'>Your City</a>
		</div>
		
		<div class='flex_centered'>
			<a href='javascript:history.back()' class='bigbutton'>To Map</a>
		</div>
	</div>
</div>


<script type="application/javascript">
	init();
    $('#boc_open_docks_id').click(function(event){
        hideBox();
    });
</script>

<?php include "footer.php"; ?>
