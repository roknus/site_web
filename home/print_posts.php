<?php
	require_once('connection_db.php');
	require_once('print_comments.php');
	require_once('temps_post.php');
	require_once('get_profile_picture.php');

	function get_likes($id){
		 $db = connect_db();
		 $request = $db->query('SELECT * FROM likes WHERE id_post = '.$id.' ;');
		 if($request->rowCount()) return $request->rowCount();
		 else return 0;
	}

	function print_posts(){
		if(!isset($_GET["page"]))$page = 1;
		else $page = $_GET["page"];
	 	$id = $_GET["id"];
		$db = connect_db();
		$request = $db->prepare('SELECT *,posts.id AS postID, posts.id_owner AS ownerID FROM posts,membre WHERE posts.id_owner = membre.id AND posts.id_wall = :id  ORDER BY creation_time DESC LIMIT '.(($page-1)*10).',10;');
		$request->execute(array('id'=>$id));		
		while($data = $request->fetch()){
			echo
			'<div id="'.$data["postID"].'" class="post">
				<table>
					<tr>
						<td rowspan="4" class="post_user_picture">	
							<img src="img/'.get_profile_pic_path($data["ownerID"]).'" height="45" width="45"/>
						</td>
						<td class="user_name"><strong>'.$data["login"].'</strong></td>
					</tr>				
					<tr>';
						if($data["event"] != 0){
							$request2 = $db->query('SELECT * FROM evenements WHERE id = '.$data["event"].' ;');
							$data2 = $request2->fetch();
						
							echo '<td><div class="evenement_post"><strong>'.$data2["nom"].'</strong><br/><i>'.$data2["description"].'</i><br/>à '.$data2["lieu"].' le '.$data2["date"].'</div>
							     
							<div class="geo_event" id="geo_event'.$data2["id"].'"><script>ma_map = initialize("geo_event'.$data2["id"].'");codeLatLng("'.$data2["ll"].'",ma_map);</script></div>
							</td>';						
						}
						else{
							echo '<td>'.$data["content"].'</td>';
						}
					echo '</tr>
					<tr>';
					
					if($data["picture"] != 0){
						$request2 = $db->query('SELECT * FROM pictures WHERE id = '.$data["picture"].' ;');
						$data2 = $request2->fetch();
						echo '
						<td>
							<table>
								<tr>
									<td><img class="post_picture" src="img/'.$data["picture"].'.'.$data2["type"].'" />
								</tr>
								<tr class="picture_title">
									<td>- '.$data2["title"].' -</td>
								</tr> 
							</table>
						</td>';
					}
					
					echo '
					</tr>
					<tr>
						<td class="post_time">
							<button class="button_like" onclick="like('.$data["postID"].',this)"><span>'.get_likes($data["postID"]).'</span></button>
							-
							<span class="comments_button" onclick="ouvrirCommentaire(this);">Commenter</span>
							-
							il y a '.tempsPost(time()-strtotime($data["creation_time"])).'
							<table class="comment_table">'.print_comments($data["postID"]).'
								<tr id="comment_input">
                                   	                                <td><img src="img/'.get_profile_pic_path($_SESSION["id"]).'" height="30" width="30"/></td>
									<td>
										<textarea class="comment_post" cols="46" rows="2" style="border: 1px solid rgb(200,200,250);" placeholder="Ecrire un commentaire...">
										</textarea>
									</td>
								</tr>
							</table>
						</td>
					</tr>

				</table>
			</div>';	
		}
	}
	
	function print_page(){
		 if(isset($_GET["page"])) $page = $_GET["page"];
		 else $page = 1;
		 
		 $db = connect_db();
		 $id = $_GET["id"];
		 $request = $db->query('SELECT * FROM posts WHERE id_wall = '.$id.';');
		 $nb = $request->rowCount();
		 $nb = ceil($nb/10);
		 $pages = '<div id="pages">';
		 if($page != 1) $pages .= '<a href="./?id='.$id.'&page='.($page-1).'" ><<</a> ';
		 for($i = 1;$i<=$nb;$i++){
		 	$pages .= '<a href="./?id='.$id.'&page='.$i.'" >'.$i.'</a> ';
		 }
		 if($page != ($i-1)) $pages .= '<a href="./?id='.$id.'&page='.($page+1).'" >>></a>';
		 $pages .= '</div>';
		 echo $pages;
	}