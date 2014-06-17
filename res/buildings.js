(function($) {
  var mapClickPolygons = $('#map').children('area');

//  getAllBuildings();

  loadCityTitle();
  loadBuiltBuildings();

  var areaID = undefined;
  $('.boc_mapster').mapster({
    noHrefIsMask: false,
    fillColor: 'EBEBEB',
    fillOpacity: 0.3,
    onClick: function(event) {
      areaID = this.id;
//      setBuildingNameAndImage(this.id);
//      setBoxPosition(this);
//      showBox();
      buildBuilding(areaID);
    }
  });

//  $('#build_button').click(function(event) {
//    createBuilding(targetID);
//  });

//  function getAllBuildings() {
//    var currentDistrict = $('#map').data('districtid');
//    $.ajax({
//      url: 'index.php?action=buildings',
//      type: 'post',
//      data: {getAllBuildingNames: true, districtID: currentDistrict},
//      success: function(response) {
//        var buildingNamesArray = JSON.parse(response);
//        createBuildList(buildingNamesArray);
//      },
//      error: function(response) {
//        console.log("Failed AJAX request (getAllBuildings).");
//      }
//    });
//  }

//  function createBuildList(buildingNamesArray) {
//  }

  function loadCityTitle() {
    var currentDistrict = $('#map').data('districtid');
    $.ajax({
      url: 'index.php?action=buildings',
      type: 'post',
      data: {
        districtID: currentDistrict,
        loadCityName: true
      },
      success: function(response) {
        var cityName = response;
        document.getElementById('districtTitle').innerHTML = cityName;
      },
      error: function(response) {
        document.getElementById('districtTitle').innerHTML = 'My City!';
        console.log("Failed AJAX request (getDistrictBuildings).");
      }
    });
  }

  function loadBuiltBuildings() {
    var currentDistrict = $('#map').data('districtid');
    $.ajax({
      url: 'index.php?action=buildings',
      type: 'post',
      data: {
        districtID: currentDistrict,
        loadBuildings: true
      },
      success: function(response) {
        var buildingsArray = JSON.parse(response);
        loadBuildingImages(buildingsArray);
      },
      error: function(response) {
        console.log("Failed AJAX request (getDistrictBuildings).");
      }
    });
  }

  function loadBuildingImages(buildingsArray) {
    for (var i = 0; i < buildingsArray.length; i += 1) {
      var image = document.getElementById('building' + buildingsArray[i].buildingID);
      showBuilding(image, buildingsArray[i].buildingName);
    }
  }

  function showBuilding(e, name) {
    var path = 'url(res/' + name + '.png)';
    e.style.backgroundImage = path;
    //e.style.visibility = 'visible';
    //e.style.opacity = '1';
    //e.style.webkitTransform = 'scale(1,1)';
  }

  function buildBuilding(areaID) {
    var currentDistrict = $('#map').data('districtid');
    $.ajax({
      url: 'index.php?action=buildings',
      type: 'post',
      data: {
        districtID: currentDistrict,
        buildingID: areaID,
        build: true
      },
      success: function(response) {
        loadBuiltBuildings();
      },
      error: function(response) {
        console.log("Failed AJAX request (buildBuilding).");
      }
    });
  }

  function hideBuilding(e) {
    e.style.backgroundImage = 'url(res/rocks.png)';
//	e.style.visibility = "hidden";
//	e.style.opacity = "0";
//	e.style.webkitTransform = 'scale(4,4)';
  }

  function setBuildingNameAndImage(buildingID) {
    $.ajax({
      url: 'index.php?action=buildings',
      type: 'post',
      data: {
        getName: true,
        buildingID: buildingID
      },
      success: function(response) {
        var buildingName = response;
        document.getElementById('box_label').innerHTML = buildingName;
        var image = document.getElementById('building' + buildingID);
        showBuilding(image, buildingName);
      },
      error: function(response) {
        console.log("Failed AJAX request (setBuildingNameAndImage).");
      }
    });
  }

//  function createBuilding(id) {
//    var url = 'index.php?action=buildings&build=true&id=' + id;
//    var xmlhttp = new XMLHttpRequest();
//    xmlhttp.open('GET', url, true);
//    xmlhttp.onreadystatechange = function() {
//      if (xmlhttp.readyState === 4) {
//        var response = xmlhttp.responseText;
//        if ('err' === response) {
//          var image = document.getElementById('building' + id);
//          hideBuilding(image);
//        } else if ('false' === response) {
//          // already built, how to disable one area onlick?
//        }
//        hideBox();
//      }
//    };
//    xmlhttp.send();
//  }

//  function setBoxPosition(obj) {
//    var position = $(obj).attr('coords').split(',');
//    var x = position[0];
//    var y = position[1] - 580; //image height + box height - delay
//    document.getElementById("box").style.top = y + "px";
//    document.getElementById("box").style.left = x + "px";
//  }

//  function setBoxTitle(id) { //TODO Set page title id = districtTitle
//    var url = "index.php?action=cityname&id=" + id;
//    var xmlhttp = new XMLHttpRequest();
//    xmlhttp.open("GET", url, true);
//    xmlhttp.onreadystatechange = function() {
//      if (xmlhttp.readyState === 4) {
//        document.getElementById("box_label").innerHTML = xmlhttp.responseText;
//      }
//    };
//    xmlhttp.send();
//  }

//  function showBox() {
//    document.getElementById("box").style.visibility = "visible";
//  }

//  function hideBox() {
//    document.getElementById("box").style.visibility = "hidden";
//  }
}(jQuery));
