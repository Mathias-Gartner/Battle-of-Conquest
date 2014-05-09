<?php include "header.php"; ?>

<script type="application/javascript" src="res/jquery-1.10.2.min.js"></script>
<script type="application/javascript" src="res/jquery.imagemapster.min.js"></script>
<script type="application/javascript" src="res/map_script.js"></script>

<div class='flex_centered title'>Great Canyons</div>

<div id="map" class="map">
	<img src="res/BOC_Great_Canyons.png" alt="great_canyons" name="great_canyons" usemap="#boc_map" class="boc_mapster mapBoxShadow bocMapImage"/>

	<!-- Image Maps for other cities -->
    <map id="boc_map_id" name="boc_map">
    <?php
		$coordsArr = array("423,354,8","465,250,8","524,326,8","583,385,8","508,382,8","456,425,8","388,414,8","315,434,8","342,376,8","291,324,8","347,286,8","321,253,8","359,253,8","361,187,8","416,165,8","458,199,8","514,230,8","554,271,8","610,295,8","638,329,8","670,364,8","721,351,8","694,333,8","667,294,8","641,253,8","625,221,8","580,225,8","544,194,8","515,166,8","481,133,8","440,112,8","407,90,8","360,77,8","317,86,8","331,140,8","248,157,8","231,269,8","192,208,8","130,249,8","172,300,8","130,358,8","114,414,8","146,443,8","163,403,8","207,412,8","221,470,8","271,492,8","323,494,8","379,502,8","429,487,8","464,251,8","412,293,8","047,298,8","090,335,8","083,375,8");
		
		//make areas
		$offset = 138; //+138 because there are 138 cities in the first two maps (great_canyons and high_cities)
		
		for($i=0;$i<sizeof($coordsArr);$i++){
			$id = $i+1+$offset;
			echo "<area shape='circle' coords='" . $coordsArr[$i] . "' id='" . $id . "' title='city' href='blank_district.html' data-group='city" . $id . "' ";
			if (isset($PAGEDATA['districtsIDArr'])){
				foreach($PAGEDATA['districtsIDArr'] as $mapid){
					if($mapid==$id){
						echo "alt='my_district'";
						break;
					}
				}
			}
			echo " />";
		}
		
		echo "</map>";
		
		//make flags
		foreach($PAGEDATA['districtsIDArr'] as $id){
			$b = $id-1-$offset;
			$size=sizeof($coordsArr);
			if($b<$size && $b>0){
				$x = substr($coordsArr[$b],0,3) -15;
				$y = substr($coordsArr[$b],4,3) - 30;
				echo "<a href='?action=buildings' style='position:absolute;z-index:99;left:" . $x . "px;top:" . $y . "px;'><img src='res/flag.png' alt='flag' id='flag' /></a>";
			}
		}
	?>

	<div id="box" class="mapBoxShadow">
		<div class="box_top" id="box_label"></div>
		<span class="box_bottom" id="attack_button">Attack!</span>
	</div>
    
	<div class='flex_hor linkbar'>
		<div class='flex_centered'>
			<a href='?action=buildings' class='bigbutton'>Your city</a>
		</div>

		<div class='flex_centered'>
			<a href='javascript:history.back()' class='bigbutton'>To map</a>
		</div>
	</div>
</div>

<script type="application/javascript">
	init();
</script>

<?php include "footer.php"; ?>
