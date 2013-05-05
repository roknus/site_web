<?php
	session_start();
	require_once('connection_db.php');
	require_once('add_post.php');
	date_default_timezone_set('Europe/Berlin');
	
	$nom = $_GET["nom"];
	$desc = $_GET["desc"];
	$lieu = $_GET["lieu"];
	$ll = $_GET["ll"];
	$date = $_GET["date"];

	$db = connect_db();
	$db->query('INSERT INTO evenements (nom,description,lieu,date,ll) VALUES ("'.$nom.'","'.$desc.'","'.$lieu.'","'.$date.'","'.$ll.'") ;');
	$request = $db->query('SELECT * FROM evenements ORDER BY id DESC;');
	$data = $request->fetch();
	$id_event = $data["id"];
	
	$id = addPost($desc,$_SESSION["id"],'0',$id_event	);

	$request = $db->prepare('SELECT * FROM membre,pictures WHERE membre.image_profil = pictures.id AND membre.id = :id');
	$request->execute(array('id'=>$_SESSION["id"]));
	$data = $request->fetch();
	echo '<div id="'.$id.'" class="post">
	     <table>
					<tr>
						<td rowspan="4" class="post_user_picture">	
							<img src="img/'.$data["image_profil"].'.'.$data["type"].'" height="45" width="45"/>
						</td>
						<td class="user_name"><strong>'.$_SESSION["login"].'</strong></td>
					</tr>	
					<tr>
						<td>
							<div class="evenement_post"><strong>'.$nom.'</strong><br/><i>'.$desc.'</i><br/>'.$lieu.'</div>
						</td>
					</tr>
					<tr>
					</tr>
					<tr>
						<td class="post_time">
							<button class="button_like" onclick="like('.$id.',this)"><span>0</span></button>
							-
							<span class="comments_button" onclick="ouvrirCommentaire(this);">Commenter</span>
							-
							il y a un instant
							<table class="comment_table" style="display:none">
								<tr id="comment_input">
									<td><img src="img/'.$data["image_profil"].'.'.$data["type"].'" height="30" width="30"/></td>
									<td>
										<textarea class="comment_post" cols="40" rows="2" style="border: 1px solid rgb(200,200,250);" placeholder="Ecrire un commentaire...">
										</textarea>
									</td>
								</tr>
							</table>
						</td>
					</tr>

				</table></div>
	';
	
	
