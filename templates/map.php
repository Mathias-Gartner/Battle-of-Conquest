<?php include "header.php"; ?>

<script src="res/jquery-1.10.2.min.js"></script>
<script type="application/javascript" src="res/jquery.imagemapster.min.js"></script>
<script type="application/javascript" src="res/mapster_script.js"></script>

<div id="map">
	<img src="res/BOC_Map.png" alt="map" name="map" usemap="#boc_map" id="boc_img_id" class="boc_mapster" />
    <map name="boc_map">
    	<area shape="poly" coords="481,214,467,217,460,225,448,223,444,230,431,230,419,234,411,242,390,245,383,254,378,263,381,278,379,289,374,294,364,301,357,311,343,321,329,331,315,346,304,349,294,354,280,365,268,359,269,346,258,339,249,333,238,327,226,320,209,308,202,304,193,299,196,291,184,285,171,280,158,265,147,268,139,264,140,256,130,244,120,242,121,234,113,222,117,216,120,203,126,195,141,193,147,183,155,180,171,162,183,159,198,161,205,155,216,150,222,144,236,140,245,138,262,133,272,132,285,131,296,123,316,117,335,116,350,111,363,119,377,106,392,106,393,117,409,121,420,112,433,117,448,114,472,116,491,113,512,112,528,112,528,150,534,160,522,165,504,166,494,169,483,176,480,188,475,198," href="?action=map&terrain=open_docks" alt="open_docks" title="open_docks" data-group="open_docks" />
    	<area shape="poly" coords="414,282,372,300,348,322,327,340,302,353,283,367,290,387,297,430,314,458,336,471,384,485,432,480,455,468,486,450,516,427,538,416,569,386,546,366,516,346,480,332,447,304," href="?action=map&terrain=great_canyons" alt="great_canyons" title="great_canyons" data-group="great_canyons" />
        <area shape="poly" coords="578,383,544,365,510,340,477,325,443,296,430,281,414,238,456,229,485,216,510,230,548,230,570,224,593,227,613,214,599,188,572,170,537,159,531,154,534,115,565,117,598,123,635,138,669,167,676,207,676,246,668,294,652,322,626,345,603,364," href="?action=map&terrain=high_cities" alt="high_cities" title="high_cities" data-group="high_cities" />
	</map>
</div>

<script type="application/javascript">
	init();
</script>

<?php include "footer.php"; ?>
