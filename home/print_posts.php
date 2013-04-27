<?php
	require_once('connection_db.php');
	require_once('print_comments.php');
	require_once('temps_post.php');

	function print_posts(){
	        $id = $_GET["id"];
		$db = connect_db();
		$request = $db->prepare('SELECT *,posts.id AS postID FROM posts,pictures,membre WHERE posts.picture = pictures.id AND posts.id_owner = membre.id AND posts.id_wall = :id  ORDER BY creation_time DESC LIMIT 0,10;');
		$request2 = $db->prepare('SELECT * FROM pictures WHERE id = :id');
		$request->execute(array('id'=>$id));		
		while($data = $request->fetch()){
		        $request2->execute(array('id'=>$data["image_profil"]));
			$data2 = $request2->fetch();
			echo
			'<div id="'.$data["postID"].'" class="post">
				<table>
					<tr>
						<td rowspan="4" class="post_user_picture">	
							<img src="img/'.$data2["id"].'.'.$data2["type"].'" height="45" width="45"/>
						</td>
						<td class="user_name"><strong>'.$data["login"].'</strong></td>
					</tr>	
					<tr>
						<td>'.$data["content"].'</td>
					</tr>
					<tr>';
					
					if($data["picture"] != '1'){
						echo '
						<td>
							<table>
								<tr>
									<td><img class="post_picture" src="img/'.$data["picture"].'.'.$data["type"].'" />
								</tr>
								<tr class="picture_title">
									<td>- '.$data["title"].' -</td>
								</tr> 
							</table>
						</td>';
					}
					
					echo '
					</tr>
					<tr>
						<td class="post_time">
							<span class="comments_button" onclick="ouvrirCommentaire(this);">Commenter</span>
							-
							il y a '.tempsPost(time()-strtotime($data["creation_time"])).'
							<table id="comment_table">'.print_comments($data["postID"]).'
								<tr id="comment_input">
                                   	                                <td><img src="default.jpg" height="30" width="30"/></td>
									<td>
										<textarea class="comment_post" cols="40" rows="2" style="border: 1px solid rgb(200,200,250);" placeholder="Ecrire un commentaire...">
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
	
