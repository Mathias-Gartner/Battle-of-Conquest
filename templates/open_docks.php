<?php include "header.php"; ?>

<script type="application/javascript" src="res/jquery-1.10.2.min.js"></script>
<script type="application/javascript" src="res/jquery.imagemapster.min.js"></script>
<script type="application/javascript" src="res/map_script.js"></script>

<div class='flex_centered title'>Open Docks</div>

<div id="map" class="map">
	<img src="res/BOC_Open_Docks.png" alt="open_docks" name="open_docks" usemap="#open_docks_map" id="boc_open_docks_id" class="boc_mapster mapBoxShadow" />

	<!-- Image Maps for other cities -->
    <map id="open_docks_map_id" name="open_docks_map">
    <?php
		$coordsArr = array("392,345,8","395,424,8","443,419,8","425,453,8","401,487,8","433,486,8","464,456,8","492,422,8","542,401,8","499,374,8","478,347,8","426,323,8","474,311,8","507,324,8","534,343,8","563,361,8","463,390,8","406,390,8","434,362,8");
		
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
			$x = substr($coordsArr[$b],0,3) -15;
			$y = substr($coordsArr[$b],4,3) - 30;
			echo "<a href='?action=buildings' style='position:absolute;z-index:99;left:" . $x . "px;top:" . $y . "px;'><img src='res/flag.png' alt='flag' id='flag' /></a>";
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


<script type="application/javascript">
	init();
    $('#boc_open_docks_id').click(function(event){
        hideBox();
    });
</script>

<?php include "footer.php"; ?>
