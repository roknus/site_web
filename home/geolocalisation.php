
<!doctype html public "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr">
<head>
	<meta charset="utf-8">
	<title>Carte Google</title>
    <link rel="stylesheet" href="style.css" />
    
    <style type="text/css">
		html {height: 100%;}
		body {height: 100%; margin:0px; padding:0px} 
		#positionCarte {height: 100%;margin-left:100px;}
		#main{width:400px; padding:30px; margin:auto; background-color:#EEE;}
		ul{list-style-type:none;}
		h1{margin-top:0;}
	</style>
 
 	<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false">					
    </script>
    
    <script src="jquery-1.9.1.min.js" type="text/javascript"></script>
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

 
 	
</head>


<body onLoad="initialize()">
	
    <div id="main"> 
      latitude, longitude : <input id="latlng" type="text" value="48.3906042,-4.4869013">
      <input type="button" value="Obtenir la ville à partir de la latitude et longitude" onclick="retrieve()"><br/><br/>
      
      Ville / adresse : <input id="adr" type="text" value=""><br/>
      Code postal : <input id="cp" type="text" value=""><br/>
      Département : <input id="dpt" type="text" value=""><br/>
      Pays : <input id="pays" type="text" value="">
  	  <input type="button" value="Obtenir le CP, département et pays à partir de l'adresse" onclick="codeAddress()"><br/>	
        
	</div>
    
    <div id="positionCarte"></div>


</body>
</html>




