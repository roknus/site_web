<?php 
	include_once('refresh_derniere_action.php');
	action();
	function addPost($post,$wall,$pic,$event){	
	
		$bdd = connect_db();
		$request = $bdd->prepare('INSERT INTO posts (id_wall,id_owner,content,picture,event,creation_time) 
						VALUES (:wall, :owner, :content, :picture, :event, :creation_time);');
		$request->execute(array(
			'wall'=>$wall,
			'owner'=>$_SESSION["id"],
			'content'=>$post,
			'picture'=>$pic,
			'event'=>$event,
			'creation_time'=>date("Y-m-d H:i:s",time())));
		$request = $bdd->query('SELECT MAX(id) AS max_id FROM posts WHERE id_wall='.$wall.';');
		$data = $request->fetch();
		return $data["max_id"];
	}