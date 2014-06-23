function init(){
	$('.boc_mapster').mapster({
		noHrefIsMask: false,
        fillColor: 'EBEBEB',
        fillOpacity: 0.3,
        mapKey: 'data-group',
		onClick: function (e) {
			if(this.alt=="my_district"){  // TODO: if clicked on this city circle in open_docs.php, open 'index.php?action=buildings'
				window.location.href = "?action=buildings&mapid=" + targetId;
			}else{
				var targetId = this.id;
				switch(document.getElementById("attack_button").innerHTML){ // TODO: id too specific
				case 'Create':
					$('#attack_button').click(function(event){
						window.location.href = "?action=buildings&buildId=" +targetId;
					});
					console.log(this.id);
					prepareCreateBuildingByID(this.id);
					break;

				case 'Attack!':
					$('#attack_button').click(function(event){
						window.location.href = "?action=prepareAttack&sourceId=" + sourceId + "&targetId=" + targetId;
					});
					setCityNameByID(targetId);
					break;
				}
				setShowBox(this);
			}
		}
    });
	$('.bocMapImage').click(function(event){ hideBox(); });
}

function setCityNameByID(id)
{
	var url = "index.php?action=cityname&id=" + id;
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("GET", url, true);
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4) {
            document.getElementById("box_label").innerHTML = xmlhttp.responseText;
        }
    };
    xmlhttp.send();
}

function prepareCreateBuildingByID(id) {
	var url = 'index.php?action=buildings&id=' + id;
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.open('GET', url, true);
	xmlhttp.onreadystatechange = function() {
		if (xmlhttp.readyState == 4) {
			var buildingName = xmlhttp.responseText;
			document.getElementById('box_label').innerHTML = buildingName;
			var image_id = 'building' + id;
			var image = document.getElementById(image_id);
			showBuilding(image, buildingName);
		}
	};
	xmlhttp.send();;
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

function setShowBox(obj){
	var position = $(obj).attr('coords').split(',');
	var x = position[0];
	var y = position[1]-580; //image height + box height - delay
	document.getElementById("box").style.top = y+"px";
	document.getElementById("box").style.left = x+"px";
	showBox();
}

function showBox(){
	document.getElementById("box").style.visibility = "visible";
}

function hideBox(){
	document.getElementById("box").style.visibility = "hidden";
}
