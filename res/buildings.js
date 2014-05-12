var targetId = undefined;

function init() {
  loadBuildings();
  $('#build_button').click(function(event) {
    createBuilding(targetId);
  });
  $('.boc_mapster').mapster({
    noHrefIsMask: false,
    fillColor: 'EBEBEB',
    fillOpacity: 0.3,
    onClick: function(event) {
      targetId = this.id;
      setBuildingNameAndImage(targetId);
      setShowBox(this);
    }
  });
  $('#boc_my_district_id').click(function(event) {
    hideBox();
  });
}

function loadBuildings() {
  var url = 'index.php?action=buildings&list=true&id=0';
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.open('GET', url, true);
  xmlhttp.onreadystatechange = function() {
    if (xmlhttp.readyState === 4) {
      var response = xmlhttp.responseText;
      if ('err' === response) {
        var image = document.getElementById('building' + id);
        hideBuilding(image);
      } else if ('false' === response) {
        // already built, how to disable one area onlick?
      }
      hideBox();
    }
  };
  xmlhttp.send();
}

function createBuilding(id) {
  var url = 'index.php?action=buildings&build=true&id=' + id;
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.open('GET', url, true);
  xmlhttp.onreadystatechange = function() {
    if (xmlhttp.readyState === 4) {
      var response = xmlhttp.responseText;
      if ('err' === response) {
        var image = document.getElementById('building' + id);
        hideBuilding(image);
      } else if ('false' === response) {
        // already built, how to disable one area onlick?
      }
      hideBox();
    }
  };
  xmlhttp.send();
}

function setBuildingNameAndImage(id) {
  var url = 'index.php?action=buildings&id=' + id;
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.open('GET', url, true);
  xmlhttp.onreadystatechange = function() {
    if (xmlhttp.readyState === 4) {
      var buildingName = xmlhttp.responseText;
      document.getElementById('box_label').innerHTML = buildingName;
      var image = document.getElementById('building' + id);
      showBuilding(image, buildingName);
    }
  };
  xmlhttp.send();
}

function showBuilding(e, name) {
  e.style.backgroundImage = 'url(res/' + name + '.png)';
  //e.style.visibility = 'visible';
  //e.style.opacity = '1';
  //e.style.webkitTransform = 'scale(1,1)';
}

function hideBuilding(e) {
  e.style.backgroundImage = 'url(res/rocks.png)';
//	e.style.visibility = "hidden";
//	e.style.opacity = "0";
//	e.style.webkitTransform = 'scale(4,4)';
}

function setShowBox(obj) {
  var position = $(obj).attr('coords').split(',');
  var x = position[0];
  var y = position[1] - 580; //image height + box height - delay
  document.getElementById("box").style.top = y + "px";
  document.getElementById("box").style.left = x + "px";
  showBox();
}

function setCityNameByID(id) {
  var url = "index.php?action=cityname&id=" + id;
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.open("GET", url, true);
  xmlhttp.onreadystatechange = function() {
    if (xmlhttp.readyState === 4) {
      document.getElementById("box_label").innerHTML = xmlhttp.responseText;
    }
  };
  xmlhttp.send();
}

function showBox() {
  document.getElementById("box").style.visibility = "visible";
}

function hideBox() {
  document.getElementById("box").style.visibility = "hidden";
}
