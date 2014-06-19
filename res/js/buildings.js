(function($) {
  var builtBuildings = new Array();
  var currentDistrict = $('#map').data('districtid');

  init();

  function init() {
    loadDistrictTitle();
    loadBuiltBuildings();

    $('.boc_mapster').mapster({
      noHrefIsMask: false,
      fillColor: 'EBEBEB',
      fillOpacity: 0.3
    });

    var mapClickPolygons = $('#map').children('area');
    $.each(mapClickPolygons, function(intIndex, area) {
      $(area).bind('click.build', function(event) {
        event.stopPropagation();
        setBoxPosition(this);
        showBuildMenu();
      })
    });

    $('#buildButton').click(function(event) {
      buildBuilding();
    });
  }

  function setBoxPosition(area) {
    var position = $(area).attr('coords').split(',');
    var x = parseInt(position[0]) - 100;
    var y = parseInt(position[1]) + 70;
    document.getElementById('buildMenu').style.top = y + "px";
    document.getElementById('buildMenu').style.left = x + "px";
  }

  function loadDistrictTitle() {
    $.ajax({
      url: 'index.php?action=buildings',
      type: 'post',
      data: {
        districtID: currentDistrict,
        loadDistrictName: true
      },
      success: function(response) {
        var districtName = response;
        document.getElementById('districtTitle').innerHTML = districtName;
      },
      error: function(response) {
        document.getElementById('districtTitle').innerHTML = 'My District!';
        console.log("Failed AJAX request (getDistrictBuildings).");
      }
    });
  }

  function loadBuiltBuildings() {
    $.ajax({
      url: 'index.php?action=buildings',
      type: 'post',
      data: {
        districtID: currentDistrict,
        loadBuildings: true
      },
      success: function(response) {
        var builtBuildingsArray = JSON.parse(response);
        builtBuildings = new Array();
        for (var i = 0; i < builtBuildingsArray.length; i += 1) {
          builtBuildings.push(builtBuildingsArray[i].buildingID);
          var image = document.getElementById('building' + builtBuildingsArray[i].buildingID);
          showBuilding(image, builtBuildingsArray[i].buildingName);
          $('#' + builtBuildingsArray[i].buildingID).unbind('click.build');
        }
        loadAvailbleBuildings();
      },
      error: function(response) {
        console.log("Failed AJAX request (getDistrictBuildings).");
      }
    });
  }

  function showBuilding(e, name) {
    var path = 'url(res/' + name + '.png)';
    e.style.backgroundImage = path;
    //e.style.visibility = 'visible';
    //e.style.opacity = '1';
    //e.style.webkitTransform = 'scale(1,1)';
  }

  function hideBuilding(e) {
    e.style.backgroundImage = 'url(res/rocks.png)';
    e.style.visibility = "hidden";
    e.style.opacity = "0";
    e.style.webkitTransform = 'scale(4,4)';
  }

  function loadAvailbleBuildings() {
    $.ajax({
      url: 'index.php?action=buildings',
      type: 'post',
      data: {getAllBuildings: true, districtID: currentDistrict},
      success: function(response) {
        var buildingsList = $('#buildingsList');
        buildingsList.empty();
        var allBuildingsArray = JSON.parse(response);
        for (var i = 0; i < allBuildingsArray.length; i += 1) {
          if (-1 === $.inArray(allBuildingsArray[i].buildingID, builtBuildings)) {
            var option = new Option(allBuildingsArray[i].buildingName, allBuildingsArray[i].buildingID);
            buildingsList.append(option);
          }
        }
      },
      error: function(response) {
        console.log("Failed AJAX request (loadAvailableBuildings).");
      }
    });
  }

  function buildBuilding() {
    var buildingID = $("#buildingsList").val();
    $.ajax({
      url: 'index.php?action=buildings',
      type: 'post',
      data: {
        districtID: currentDistrict,
        buildingID: buildingID,
        build: true
      },
      success: function(response) {
        loadBuiltBuildings();
        loadAvailbleBuildings();
        hideBuildMenu();
      },
      error: function(response) {
        console.log("Failed AJAX request (buildBuilding).");
      }
    });
  }

  function showBuildMenu() {
    document.getElementById("buildMenu").style.visibility = "visible";
  }

  function hideBuildMenu() {
    document.getElementById("buildMenu").style.visibility = "hidden";
  }
}(jQuery));
