<?php
	require_once('connection_db.php');
	require_once('temps_post.php');
	
	function print_comments($post_id){
		$db = connect_db();
		$request = $db->query('SELECT * FROM comments,membre,pictures  WHERE comments.id_poster = membre.id AND membre.image_profil = pictures.id AND id_post='.$post_id.' ORDER BY creation_time ASC;');
		$mess = "";
		while($data = $request->fetch()){
			$mess .='
				<tr class="comments">
					<td class="post_user_picture"><img src="img/'.$data["image_profil"].'.'.$data["type"].'" height="30" width="30" /></td>
					<td><span class="user_name"><strong>'.$data["login"].'</strong></span> '.$data["content"].'
					<br/><span class="post_time">il y a '.tempsPost(time()-strtotime($data["creation_time"])).'</span>
					-
					<button class="button_like">0</button>
					</td>
				</tr>';
		}
		return $mess;
	}
