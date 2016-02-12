var map, markers =[];

function google_map_initialize() {
	
	var lat = $('#latitude_text').val();
	var lng = $('#longitude_text').val();
	if(lat==''){
		lat = '13.726044748874747';
	}
	if(lng==''){
		lng = '100.50704956054688';
	}
		mapOptions = {
			mapTypeId: google.maps.MapTypeId.ROADMAP,
			center: { lat: parseFloat(lat), lng: parseFloat(lng)},
			zoom: 6
		},
		map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);


	if(lat!='' && lng!=''){
	var marker = new google.maps.Marker({
		position: map.getCenter(),
		map: map,
		title: 'Click to zoom'
	});
	markers.push(marker);
	}
	var geocoder = new google.maps.Geocoder();



	google.maps.event.addListener(map, 'click', function(event) {
		DeleteMarkers();
		placeMarker(event.latLng);
		get_content(event.latLng);
		//$('#pac-input').val('');
	});
	

	function placeMarker(location) {
		var marker = new google.maps.Marker({
				position: location,
				map: map
			});
		markers.push(marker);
	}
	function DeleteMarkers() {
		for (var i = 0; i < markers.length; i++) {
			markers[i].setMap(null);
		}
		markers = [];
	};
	function get_content(latlng){
		$('#latitude_text').val(latlng.lat());
		$('#longitude_text').val(latlng.lng());
	}
}

google.maps.event.addDomListener(window, 'load', google_map_initialize);