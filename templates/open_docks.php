<?php include "header.php"; ?>

<script type="application/javascript" src="res/jquery-1.10.2.min.js"></script>
<script type="application/javascript" src="res/jquery.imagemapster.min.js"></script>
<script type="application/javascript" src="res/map_script.js"></script>

<article id="home" class="panel">
	<header>
		<h2 class='flex_centered'>Open Docks</h2>
	</header>

<div id="map" class="map">
	<img src="res/BOC_Open_Docks.png" alt="open_docks" name="open_docks" usemap="#boc_map" class="boc_mapster mapBoxShadow bocMapImage" />

	<!-- Image Maps for other cities -->
    <map id="boc_map_id" name="boc_map">
    <?php
		$coordsArr = array("392,345,8","395,424,8","443,419,8","425,453,8","401,487,8","433,486,8","464,456,8","492,422,8","542,401,8","499,374,8","478,347,8","426,323,8","474,311,8","507,324,8","534,343,8","563,361,8","463,390,8","406,390,8","434,362,8","318,429,8","296,449,8","319,469,8","338,445,8","343,490,8","709,72,8","744,83,8","716,112,8","696,148,8","662,186,8","612,177,8","628,141,8","670,117,8","669,77,8","634,88,8","595,71,8","583,113,8","565,155,8","533,170,8","557,209,8","594,210,8","582,246,8","622,224,8","677,228,8","653,259,8","608,284,8","577,304,8","545,277,8","509,267,8","507,242,8","513,202,8","485,167,8","493,134,8","529,126,8","552,84,8","498,65,8","492,96,8","471,86,8","446,160,8","439,122,8","434,86,8","394,107,8","398,141,8","370,136,8","376,167,8","350,158,8","307,194,8","293,180,8","314,133,8","267,139,8","221,169,8","240,188,8","263,207,8","217,238,8","202,264,8","183,216,8","167,260,8","151,230,8","304,271,8","270,277,8","290,303,8","261,356,8","240,333,8","119,292,8","164,330,8","204,369,8","230,389,8","333,357,8","318,375,8","298,397,8");
		
		//make areas		
		for($i=0;$i<sizeof($coordsArr);$i++){
			$id = $i+1;
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
				$x = substr($coordsArr[$b],0,3) -15+50;
				$y = substr($coordsArr[$b],4,3) - 30+135;
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
</article>


<script type="application/javascript">
	init();
</script>

<?php include "footer.php"; ?>
