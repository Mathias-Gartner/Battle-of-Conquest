function init(){
	$('.boc_mapster').mapster({
		noHrefIsMask: false,
        fillColor: 'EBEBEB',
        fillOpacity: 0.3,
        mapKey: 'data-group',
		onClick: function (e) {
			if(this.id=="my_district"){  // if clicked on this city circle in open_docs.php, open 'index.php?action=buildings'
				window.location.href = this.href;
			}else{
				switch(document.getElementById("attack_button").innerHTML){
				case 'Create': 
					createBuildingByID(this.id);
					break;
					
				case 'Attack!':
					setCityNameByID(this.id);
					break;
				}
				setShowBox(this);
			}
		}
    });
	$('#boc_open_docks_id').click(function(event){ hideBox(); });
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

function createBuildingByID(id) {
	var url = "index.php?action=buildings&id=" + id;
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("GET", url, true);
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4) {
            document.getElementById("box_label").innerHTML = xmlhttp.responseText;
        }
    };
    xmlhttp.send();
}

function setShowBox(obj){
	var position = $(obj).attr('coords').split(',');
	var x = position[0];
	var y = position[1]-580; //image height + box height - delay
	document.getElementById("box").style.top = y+"px";
	document.getElementById("box").style.left = x+"px";
	$('#attack_button').click(function(event){
		window.location.href = "?action=prepareAttack&sourceId=1&targetId=" + obj.id;console.log(obj.id);
	});
	showBox();
}

function showBox(){
	document.getElementById("box").style.visibility = "visible";
}

function hideBox(){
	document.getElementById("box").style.visibility = "hidden";
}
