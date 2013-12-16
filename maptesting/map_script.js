function init(){
	$('.boc_mapster').mapster({
		noHrefIsMask: false,
        fillColor: 'EBEBEB',
        fillOpacity: 0.3,
        mapKey: 'data-group',
		onClick: function (e) {
			window.location.href = this.href;
		}
    });
	setMyDistrict();
}

function setMyDistrict(){
	
}