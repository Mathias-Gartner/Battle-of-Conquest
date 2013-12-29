function init(){
	$('.boc_mapster').mapster({
		noHrefIsMask: false,
        fillColor: 'EBEBEB',
        fillOpacity: 0.3,
        mapKey: 'data-group',
		onClick: function (e) {
			if(this.id=="my_district"){
				window.location.href = this.href;
			}else{
				setShowBox(this);
			}
		}
    });
	setMyDistrict();
	$('#boc_open_docks_id').click(function(event){
		hideBox();
	});
}

function setMyDistrict(){
	
}

function setShowBox(obj){
	var position = $(obj).attr('coords').split(',');
	var x = position[0];
	var y = position[1]-580; //image height + box height - delay
	document.getElementById("box").style.top = y+"px";
	document.getElementById("box").style.left = x+"px";
	$('#attack_button').click(function(event){
		window.location.href = "?action=prepareAttack&sourceId=1&targetId=" + obj.id;
	});
	showBox();
}

function showBox(){
	document.getElementById("box").style.visibility = "visible";
}

function hideBox(){
	document.getElementById("box").style.visibility = "hidden";
}
