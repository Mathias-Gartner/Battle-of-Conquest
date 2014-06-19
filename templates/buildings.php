<?php include "header.php"; ?>

<script type="application/javascript" src="res/jquery-1.10.2.min.js"></script>
<script type="application/javascript" src="res/jquery.imagemapster.min.js"></script>

<article id="home" class="panel">
  <header>
    <h2 id='districtTitle' class='flex_centered'></h2>
  </header>

  <div id='mapContainer' class="map">
    <img src="res/BOC_District_Blank.png"
         usemap="#boc_my_district_map" alt="my_district" name="my_district"
         class="boc_mapster mapBoxShadow" />
    <map id="map"
    <?php
    if (isset($_GET['mapid'])) {
      $districtID = $_GET['mapid'];
    } else {
      $districtID = 1;
    }
    echo (' data-districtid="' . $districtID . '" ');
    ?>
         name="boc_my_district_map">
      <area id="2" shape="poly" href="blank_district.html" coords="624,99,636,118,609,137,588,131,580,116,595,96" />
      <area id="1" shape="poly" href="blank_district.html" coords="665,303,680,327,657,350,620,349,601,326,622,298" />
      <area id="3" shape="poly" href="blank_district.html" coords="176,381,191,405,168,428,131,427,112,404,133,376" />
    </map>

    <div id="building1" class="building_image"></div>
    <div id="building2" class="building_image"></div>
    <div id="building3" class="building_image"></div>

    <div id="buildMenu" class="mapBoxShadow">
      <p>
        <select id=buildingsList></select>
      </p>
      <p id="buildingStats">
      </p>
      <span class="box_bottom" id="cancelButton">Cancel</span>
      <span class="box_bottom" id="buildButton">Build</span>
    </div>
  </div>
</article>

<script type="application/javascript" src="res/js/buildings.js"></script>

<?php
include "footer.php";
