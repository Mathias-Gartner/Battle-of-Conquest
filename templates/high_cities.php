<?php include "header.php"; ?>

<script type="application/javascript" src="res/jquery-1.10.2.min.js"></script>
<script type="application/javascript" src="res/jquery.imagemapster.min.js"></script>
<script type="application/javascript" src="res/map_script.js"></script>

<article id="welcome" class="panel" >
			<header>
				<h2 class='flex_centered'>High cities</h2>
			</header>

<div id="map" class="map">
	<img src="res/BOC_High Cities.png" alt="high_cities" name="high_cities" usemap="#boc_map" class="boc_mapster mapBoxShadow bocMapImage"/>
	
	<!-- Image Maps for other cities -->
    <map id="boc_map_id" name="boc_map">
    <?php
		$coordsArr = array("722,333,8","678,333,8","687,386,8","626,432,8","604,371,8","589,315,8","636,274,8","556,253,8","583,152,8","740,293,8","701,242,8","758,211,8","739,140,8","693,187,8","626,216,8","670,118,8","642,63,8","594,96,8","562,38,8","515,71,8","486,32,8","439,247,8","500,314,8","538,384,8","491,450,8","451,396,8","388,462,8","363,371,8","402,315,8","380,258,8","315,333,8","276,439,8","243,408,8","235,368,8","175,401,8","173,337,8","237,303,8","279,257,8","314,213,8","362,144,8","300,100,8","271,125,8","168,190,8","167,258,8","231,212,8","129,197,8","084,203,8","105,298,8","077,251,8");
		
		//make areas
		$offset = 89; //+138 because there are 138 cities in the first two maps (great_canyons and high_cities)
		
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
			$b = $id-1;
			$size=sizeof($coordsArr);
			if($b<$size){
				$x = substr($coordsArr[$b],0,3) -15+59;
				$y = substr($coordsArr[$b],4,3) - 30+155;
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
			<a href='?action=buildings' class='bigbutton'>Your City</a>
		</div>

		<div class='flex_centered'>
			<a href='javascript:history.back()' class='bigbutton'>To Map</a>
		</div>
	</div>
</div>
</article>

<script type="application/javascript">
	init();
</script>

<?php include "footer.php"; ?>
