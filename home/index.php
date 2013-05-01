<?php
	session_start();
	date_default_timezone_set('Europe/Berlin');
        include_once('connection_db.php');
        include_once('print_posts.php');?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
    <head>
        <title>inTouch</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" type="text/css" href="style.css" />
		<link rel="stylesheet" href="/~flucia/geekbook/jquery-ui-1.10.2.custom/development-bundle/themes/flick/jquery.ui.all.css" />
	
		<script type="text/javascript" src="/inTouch/jquery-1.9.1.min.js"></script>
		<script src="/inTouch/jquery-ui-1.10.2.custom/development-bundle/ui/jquery.ui.core.js"></script>
		<script src="/inTouch/jquery-ui-1.10.2.custom/development-bundle/ui/jquery.ui.widget.js"></script>
		<script src="/inTouch/jquery-ui-1.10.2.custom/development-bundle/ui/jquery.ui.mouse.js"></script>
		<script src="/inTouch/jquery-ui-1.10.2.custom/development-bundle/ui/jquery.ui.tabs.js"></script>
		
		<script type="text/javascript">
		<!--
		
		function print_comments(){
			
		}
		
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
						$(".comment_post").bind('keydown',function(event){
							if(event.keyCode == 13){
									 nouveauCommentaire(this);
							}
						});
					}
				});
			}
		}	
		
		function nouveauCommentaire(obj){
			var commentaire = $(obj).val();
			var id_post = $(obj).parents("div").attr('id');
			if(commentaire != ""){
			  var data = { comment : commentaire, id_post : id_post};
				$.ajax({
					url: "nouveau_commentaire.php",
					data : data,
					complete : function(xhr, result){
						if(result != "success") return; 
						var response = xhr.responseText;
						var parent = $(obj).parents("#comment_input");
						$("<tr class='comments'></tr>").html(response).insertBefore(parent);
						$(".comment_post").val("");
						
					}
				  });
			}
		}
		
		function ouvrirCommentaire(obj){
			$(obj).next("#comment_table").toggle();
		}	

		function find_people(){				 
			 var search = $("#search_bar_input").val();
			 var data = { search : search };			
			     $.ajax({
				url: "recherche_personne.php",
				data : data,
				complete : function(xhr, result){
					if(result != "success") return; 
					var response = xhr.responseText;
					$("#search_bar ul").empty();
					$(response).appendTo("#search_bar ul");
					$("#search_bar ul").show();
					
				}
			  });	 
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

		function notifications_amis(){
			 if($("#notifications_list").html() == ""){
			 	var data = { id : <?php echo $_GET["id"]; ?>};
			 	$.ajax({
					url: "friend_notifications.php",
					data : data,
					complete : function(xhr, result){
						 if(result != "success") return; 
						 var response = xhr.responseText;
						 $(response).appendTo("#notifications_list");							 }
			  	});
			}
			else{
				$("#notifications_list").empty();	
			}
		}

		function friend_notification_accept(id_notif){
			 var data = { id : id_notif };
			 $.ajax({
				url: "friend_notification_accept.php",
				data : data,
				complete : function(xhr, result){
					 if(result != "success") return; 
					 var response = xhr.responseText;
					 $(location).attr('href',"./?id=<?php echo $_GET["id"]; ?>");					 
				 }
		  	});
		}
		
		//-->
		</script>
		
    </head>
    <body>
		<script>
		<!--
		
			$(document).ready(function(){
				$("#tabs").tabs();
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
						$(this).find('#comment_table').hide();
					}
				});
				
			});			
		
		//-->
		</script>
		
		<?php
			require_once('nav.php');
		?>
		
		<div id="page">
			<table id="wrapper">
				<tr>
					<td id="info_perso">
					<?php include_once('profile_block.php'); ?>
					<br/>
					<?php
						if($_SESSION["id"] != $_GET["id"]){// A refaire
								   echo '<input type="button" value="Ajouter..." onclick="javascript:friend_request_popup();" />';
						}
					?>
					</td>
					<td rowspan="3" id="mur"> 
						<div id="post_box">
						   <div id="tabs">
								<ul>
									<li><a href="#tab1"><strong>Status</strong></a></li>
									<li><a href="#tab2"><strong>Photo</strong></a></li>	
									<li><a href="#tab3"><strong>Lieu</strong></a></li>
									<li><a href="#tab4"><strong>Ev&#232;nement</strong></a></li>
								</ul>
								<div id="tab1">
									<table id="post_border" >
										<tr>
											<td>
												<textarea id="publication" cols="65" rows="4" maxlength="255" placeholder="Exprimez-vous">

												</textarea>
											</td>
										</tr>
										<tr>
											<td id="submit_post">
												<input type="button" value="Publier" onclick="javascript:nouvellePublication()"/>
											</td>
										</tr>
									</table>
								</div>
								<div id="tab2">
									<table id="post_border">
										<tr>
											<td>
												<form enctype="multipart/form-data" method="post" action="upload_picture.php" id="picture_post" >
													<input type="hidden" name="MAX_FILE_SIZE" value="2000000" />
													<input type="hidden" name="wall" value="<?php echo $_GET["id"]; ?>" />
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
								<div id="tab3">onglet 3</div>
								<div id="tab4">onglet 4</div>
							</div>
						</div>

						<div id="mes_publications">
							<?php
								print_posts();
							?>
						</div>
					
					</td>
				</tr>

				<tr>
					<td id="amis"><?php include_once('friends_block.php'); ?></td>
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
