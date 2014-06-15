<?php include "header.php"; ?>

<script type="application/javascript" src="res/jquery-1.10.2.min.js"></script>
<script type="application/javascript" src="res/jquery.imagemapster.min.js"></script>
<script type="application/javascript" src="res/buildings.js"></script>

<div class='flex_centered title'>My city</div>

<?php
echo ('<div id="map" class="map"');
if (isset($_GET['district'])) {
  echo (' data-district="');
  echo $_GET['district'];
  echo ('"');
}
echo ('>');
?> 
<img src="res/BOC_District_Blank.png" id="boc_my_district_id"
     usemap="#boc_my_district_map" alt="my_district" name="my_district"
     class="boc_mapster mapBoxShadow" />
<map name="boc_my_district_map">
  <area shape="poly" href="blank_district.html"
        coords="624,99,636,118,609,137,588,131,580,116,595,96" id="2" />
  <area shape="poly" href="blank_district.html"
        coords="665,303,680,327,657,350,620,349,601,326,622,298" id="1" />
  <area shape="poly" href="blank_district.html"
        coords="176,381,191,405,168,428,131,427,112,404,133,376" id="3" />
</map>
<div id="box" class="mapBoxShadow">
  <span class="box_top" id="box_label"></span>
  <span class="box_bottom" id="build_button">Create</span>
</div>
<div id="building1" class="building_image"></div>
<div id="building2" class="building_image"></div>
<div id="building3" class="building_image"></div>
</div>

<script type="application/javascript">
  init();
</script>

<?php include "footer.php"; ?>
