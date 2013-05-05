<?php
	session_start();
	if(!(isset($_SESSION["id"]))){
		header('Location:../');
	}
	date_default_timezone_set('Europe/Berlin');
        include_once('connection_db.php');
        include_once('print_posts.php');
	include_once('refresh_derniere_action.php');
	action();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
    <head>
        <title>inTouch</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" type="text/css" href="style.css" />
		<link rel="stylesheet" href="/inTouch/jquery-ui-1.10.2.custom/development-bundle/themes/custom-theme/jquery.ui.all.css" />

		<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
		<script type="text/javascript" src="/inTouch/jquery-1.9.1.min.js"></script>
		<script src="/inTouch/jquery-ui-1.10.2.custom/development-bundle/ui/jquery.ui.core.js"></script>
		<script src="/inTouch/jquery-ui-1.10.2.custom/development-bundle/ui/jquery.ui.widget.js"></script>
		<script src="/inTouch/jquery-ui-1.10.2.custom/development-bundle/ui/jquery.ui.mouse.js"></script>
		<script src="/inTouch/jquery-ui-1.10.2.custom/development-bundle/ui/jquery.ui.tabs.js"></script>
		<script src="/inTouch/jquery-ui-1.10.2.custom/development-bundle/ui/jquery.ui.button.js"></script>
		<script src="/inTouch/jquery-ui-1.10.2.custom/development-bundle/ui/jquery.ui.datepicker.js"></script>

		
		<script type="text/javascript">
		<!--
		
		function nl2br (str, is_xhtml) {
		  // http://kevin.vanzonneveld.net
		  // +   original by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
		  // +   improved by: Philip Peterson
		  // +   improved by: Onno Marsman
		  // +   improved by: Atli ��r
		  // +   bugfixed by: Onno Marsman
		  // +      input by: Brett Zamir (http://brett-zamir.me)
		  // +   bugfixed by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
		  // +   improved by: Brett Zamir (http://brett-zamir.me)
		  // +   improved by: Maximusya
		  // *     example 1: nl2br('Kevin\nvan\nZonneveld');
		  // *     returns 1: 'Kevin<br />\nvan<br />\nZonneveld'
		  // *     example 2: nl2br("\nOne\nTwo\n\nThree\n", false);
		  // *     returns 2: '<br>\nOne<br>\nTwo<br>\n<br>\nThree<br>\n'
		  // *     example 3: nl2br("\nOne\nTwo\n\nThree\n", true);
		  // *     returns 3: '<br />\nOne<br />\nTwo<br />\n<br />\nThree<br />\n'
		  var breakTag = (is_xhtml || typeof is_xhtml === 'undefined') ? '<br ' + '/>' : '<br>'; // Adjust comment to avoid issue on phpjs.org display

		  return (str + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1' + breakTag + '$2');
		}

		
		
		function nouvellePublication(){
			var publication = $("#publication").val();
			if(publication != ""){
				var data = { post : publication, wall : <?php echo $_GET["id"]; ?>};
				$.ajax({
					url : "nouvelle_publication.php",
					data : data,
					complete : function(xhr, result){
						if(result != "success") return; 
						var response = xhr.responseText;
						$("#publication").val("");
						$(response).hide().prependTo("#mes_publications").slideDown(1000);
						$(".comment_post").val("");
						$(".comment_post").unbind('keydown');
						$(".comment_post").bind('keydown',function(event){
							if(event.keyCode == 13){
									 nouveauCommentaire(this);
							}
						});						
						$(".button_like").button({icons:{primary:"ui-icon-star"},text:true});
					}
				});
			}
		}
		
		function nouvelEvenement(){
			var nomEvenement = $("#nomEvenement").val();
			var descriptionEvenement = $("#descriptionEvenement").val();
			var dateEvenement = $("#datepicker").val();
			var lieuEvenement = $("#adr").val();
			var latitudeLongitude = $("#latlng").val();
			if(nomEvenement != "" && dateEvenement != "" && lieuEvenement != "" && latitudeLongitude != ""){
				var data = { nom : nomEvenement, desc : descriptionEvenement, date : dateEvenement, lieu : lieuEvenement, ll : latitudeLongitude};
				$.ajax({
					url : "nouvel_evenement.php",
					data : data,
					complete : function(xhr, result){
						if(result != "success") return; 
						var response = xhr.responseText;
						$("#nomEvenement").val("");
						$("#descriptionEvenement").val("");
						$("#datepicker").val("");
						$("#adr").val("");
						$("#latlng").val("48.3906042,-4.4869013");
						$(response).hide().prependTo("#mes_publications").slideDown(1000);
						$(".comment_post").val("");
						$(".comment_post").unbind('keydown');
						$(".comment_post").bind('keydown',function(event){
							if(event.keyCode == 13){
									 nouveauCommentaire(this);
							}
						});						
						$(".button_like").button({icons:{primary:"ui-icon-star"},text:true});
					}
				});			
			}
		}	
		
		function nouveauCommentaire(obj){
			var commentaire = $(obj).val();
			var id_post = $(obj).parents("div").attr('id');
			if(commentaire != ""){
			  var data = { comment : commentaire, id_post : id_post };
				$.ajax({
					url: "nouveau_commentaire.php",
					data : data,
					complete : function(xhr, result){
						if(result != "success") return; 
						var response = xhr.responseText;
						var parent = $(obj).parents("#comment_input");
						$("<tr class='comments'></tr>").html(response).insertBefore(parent);
						$(".comment_post").val("");
						$(".button_like").button({icons:{primary:"ui-icon-star"},text:true});		
					}
				  });
			}						
		}
		
		function ouvrirCommentaire(obj){
			$(obj).next(".comment_table").toggle();
			
		}	
		
		function friend_request_popup(){
			 var id = <?php echo $_GET["id"]; ?>;
			 var data = { id : id };
			 $.ajax({
				url: "friend_request.php",
				data : data,
				complete : function(xhr, result){
					if(result != "success") return; 
					var response = xhr.responseText;
					$(response).appendTo("html");
					$("#add_friend_description textarea").val("");					
				}
			  });	
		}
		
		function remove_friend_popup(){
			 $("#add_friend_window").remove();
			 $("#add_friend_popup").remove();
		}

		function add_friend(){
			 var message=$("#add_friend_description textarea").val();
			 var data = {message : message, poster : <?php echo $_SESSION["id"]; ?>, profile : <?php echo $_GET["id"]; ?>};
			 $.ajax({
				url: "add_friend.php",
				data : data,
				complete : function(xhr, result){
					if(result != "success") return; 
					var response = xhr.responseText;
					remove_friend_popup();				
				}
			  });	
			 
		}

		function like(id,obj){
			 var data = {id : id};
			 $.ajax({
				url: "add_like.php",
				data : data,
				complete : function(xhr, result){
					if(result != "success") return; 
					var response = xhr.responseText;
					$(obj).find("span").html(response);			
				}
			  }); 
		  }


		  /* Déclaration des variables  */
		  var geocoder;
		  var map;
		  var infowindow = new google.maps.InfoWindow();
		  var marker;
	
		  /* Fonction d'initialisation de la map appelée au chargement de la page  */
		  function initialize(obj) {
		  	   geocoder = new google.maps.Geocoder();
			   var latlng = new google.maps.LatLng(46.227638, 2.213749);
			   var myOptions = {
			       zoom: 4,
			       center: latlng,
			       mapTypeId: google.maps.MapTypeId.ROADMAP
			   }
			   map = new google.maps.Map(document.getElementById(obj), myOptions);
		  }

		
		
		  /* Fonction chargée de géocoder l'adresse  */
		  function codeAddress() {
		  	   var address = document.getElementById("adr").value;
			   geocoder.geocode( { 'address': address + ' France'}, function(results, status) {
			   	if (status == google.maps.GeocoderStatus.OK) {
				   var coords = results[0].geometry.location;
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
		//-->
		</script>
		
    </head>
    <body>
		
		<?php
			require_once('nav.php');
		?>

		<script>
		<!--
		
			$(document).ready(function(){
				$("#tabs").tabs();	
				$("title").html("inTouch | <?php echo $_SESSION["login"]; ?>");	
				check_notifications();
				$("#datepicker").datepicker({dateFormat: 'dd/mm/yy'});
				$(".button_friends").button({icons:{primary:"ui-icon-person"},text:true});
				$(".button_posts").button({icons:{primary:"ui-icon-document-b"},text:true});
				$(".button_comments").button({icons:{primary:"ui-icon-comment"},text:true});
				$(".button_like").button({icons:{primary:"ui-icon-star"},text:true});
				$("#publication").val("");
				$(".comment_post").val("");
				$(".comment_post").bind('keydown',function(event){
					if(event.keyCode == 13){
						nouveauCommentaire(this);
					}
				});
				$(".post").each(function(index){
					var nbNodes = $(this).find('.comments').length;
					if(nbNodes > 0){					
						var i;
						for(i = 0;i<nbNodes-3;i++){
							$(this).find('.comments').eq(i).hide();
						}
					}
					else{
						$(this).find('.comment_table').hide();
					}
				});
				setInterval(function(){
							check_notifications();							
							},1000);
				<?php
					foreach($_SESSION["chats"] as $login => $id){
						echo 'start_chat("'.$id.'","'.$login.'");';
					}
				?>

			});			
		
		//-->
		</script>
		
		<div id="page">
			<table id="wrapper">
				<tr>
					<td id="info_perso">
					<?php include_once('profile_block.php'); ?>
					<br/>
					<?php
						echo '<span style="margin-left:10px;">';
						if($_SESSION["id"] != $_GET["id"]){
								   $db = connect_db();
								   $request = $db->query('SELECT * FROM amis WHERE id1 = '.$_GET["id"].' AND id2 = '.$_SESSION["id"].';');
								   if($request->rowCount() == false){
									echo '<input type="button" value="Ajouter..." onclick="javascript:friend_request_popup();" />';			
								   }					   
						}
						echo '<input type="button" value="Photos" onclick="javascript:$(location).attr(\'href\',\'./photo.php?id='.$_GET["id"].'\')" />';	
						echo '</span>';
					?>
					</td>
					<td rowspan="3" id="mur"> 
						<div id="post_box">
						   <div id="tabs">
								<ul>
									<li><a href="#tab1"><strong>Status</strong></a></li>
									<li><a href="#tab2"><strong>Photo</strong></a></li>
									<?php if($_GET["id"] == $_SESSION["id"]) echo '<li onclick="javascript:initialize(\'positionCarte\')"><a href="#tab3"><strong>Ev&#232;nement</strong></a></li>'; ?>
								</ul>
								<div id="tab1">
									<table class="post_border" >
										<tr>
											<td>
												<textarea id="publication" cols="65" rows="4" maxlength="255" placeholder="Exprimez-vous">

												</textarea>
											</td>
										</tr>
										<tr>
											<td id="submit_post">
												<button onclick="javascript:nouvellePublication()">Publier</button>
											</td>
										</tr>
									</table>
								</div>
								<div id="tab2">
									<table class="post_border">
										<tr>
											<td>
												<form enctype="multipart/form-data" method="post" action="upload_picture.php" id="picture_post" >
													<input type="hidden" name="MAX_FILE_SIZE" value="2000000" />
		                                                                                        <input class="picture_description" name="picture_title_input" type="text" size="65" value="Titre" onfocus="javascript:if(this.value=='Titre')this.value='';" onblur="javascript:if(this.value=='')this.value='Titre';" />
		                                                                                        <textarea class="picture_description" name="picture_description" cols="65" rows="2" maxlength="255" placeholder="Description"></textarea>
													<input id="img_input_title" name="uploaded_picture" type="file" size="40"/> (2Mo max.)
												</form>
											</td>
										</tr>
										<tr>
											<td id="submit_post">
												<input type="button" value="Publier" onclick="javascript:$('#picture_post').submit()"/>
											</td>
										</tr>
									</table>
								</div>
								<?php if($_GET["id"] == $_SESSION["id"]) echo '<div id="tab3">
								     <table id="evenement">
									<tr>
										<td id="geolocalisation">
										    <input id="latlng" type="hidden" value="48.3906042,-4.4869013">
										    <table> 
										    <tr>
										    <td>Nom de l\'evenement :</td>
										    <td><input id="nomEvenement" type="text" size="40"></td>
										    </td>
										    </tr> 
										    <tr>
										    <td>Description de l\'evenement :</td>
										    <td><input id="descriptionEvenement" type="text" size="40"></td>
										    </td>
										    </tr>
										    <tr>
										    <td>Date :</td>
										    <td><input type="text" id="datepicker" /></td>
										    </td>
										    </tr>
										    <tr>
										    <td>Lieu :</td>
										    <td><input id="adr" type="text" size="40"></td>
										    <td><input type="button" value="Voir" onclick="codeAddress()"></td>
										    </tr>    
										    </table>
										</td>
									</tr>
									<tr>
										<td>
											<div id="positionCarte"></div>
										</td>
									</tr>
<tr>
											<td id="submit_post">
												<input type="button" value="Publier" onclick="javascript:nouvelEvenement();"/>
											</td>
										</tr>
								      </table>
								</div>'; ?>
							</div>
						</div>

						<div id="mes_publications">
							<?php
								print_posts();
								print_page();
							?>							
						</div>
					
					</td>
				</tr>

				<tr>
					<td id="amis"><?php require_once('friends_block.php'); ?></td>
				</tr>
				<tr>
				<td></td>
				</tr>
			</table>

		</div>

		<?php
			require_once('chat_nav.php'); 
		?>
		
	</body>
</html>
