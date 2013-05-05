    <script type="text/javascript">

		
	/* Déclaration des variables  */
	var geocoder;
	var map;
	var infowindow = new google.maps.InfoWindow();
	var marker;
	

	/* Fonction d'initialisation de la map appelée au chargement de la page  */
	function initialize() {
		geocoder = new google.maps.Geocoder();
		var latlng = new google.maps.LatLng(46.227638, 2.213749);
		var myOptions = {
			zoom: 5,
			center: latlng,
			mapTypeId: google.maps.MapTypeId.ROADMAP
		}
		map = new google.maps.Map(document.getElementById("positionCarte"), myOptions);
	}

		
		
	/* Fonction chargée de géocoder l'adresse  */
	function codeAddress() {
		var address = document.getElementById("adr").value;
		geocoder.geocode( { 'address': address + ' France'}, function(results, status) {
			if (status == google.maps.GeocoderStatus.OK) {
				var coords = results[0].geometry.location
				map.setCenter(coords);
					var marker = new google.maps.Marker({
					map: map,
					position: coords
				});
				document.getElementById('latlng').value = coords.lat()+','+coords.lng();
				codeLatLng(coords.lat()+','+coords.lng());
			} 
			else {
				alert("Le geocodage n\'a pu etre effectue pour la raison suivante: " + status);
			}
		});
	}


	/* Fonction de géocodage inversé (en fonction des coordonnées de l'adresse)  */
	function codeLatLng(input) {
		var latlngStr = input.split(",",2);
		var lat = parseFloat(latlngStr[0]);
		var lng = parseFloat(latlngStr[1]);
		var latlng = new google.maps.LatLng(lat, lng);
		geocoder.geocode({'latLng': latlng}, function(results, status) {
			if (status == google.maps.GeocoderStatus.OK) {
				if (results[0]) {
					map.setZoom(11);
					marker = new google.maps.Marker({
					position: latlng,
					map: map
				});
				var elt = results[0].address_components;
				for(i in elt){
					if(elt[i].types[0] == 'postal_code')
					document.getElementById('cp').value = elt[i].long_name;
					if(elt[i].types[0] == 'locality')
					document.getElementById('adr').value = elt[i].long_name;
					if(elt[i].types[0] == 'administrative_area_level_2')
					document.getElementById('dpt').value = elt[i].long_name;
					if(elt[i].types[0] == 'country')
					document.getElementById('pays').value = elt[i].long_name;
				}
				infowindow.setContent(results[0].formatted_address);
				infowindow.open(map, marker);
				map.setCenter(latlng);
			}
		} 
		else {
			alert("Geocoder failed due to: " + status);
		}
	});
}

	function retrieve(){
		var input = document.getElementById("latlng").value;
		codeLatLng(input);
	}		
		
		
		
	</script>