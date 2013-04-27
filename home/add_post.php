<?php 
	function addPost($post,$wall,$pic){	
	
		$bdd = connect_db();
		$request = $bdd->prepare('INSERT INTO posts (id_wall,id_owner,content,picture,creation_time) 
						VALUES (:wall, :owner, :content, :picture, :creation_time);');
		$request->execute(array(
			'wall'=>$wall,
			'owner'=>$_SESSION["id"],
			'content'=>$post,
			'picture'=>$pic,
			'creation_time'=>date("Y-m-d H:i:s",time())));
		$request = $bdd->query('SELECT MAX(id) AS max_id FROM posts WHERE id_wall='.$_SESSION["id"].';');
		$data = $request->fetch();
		return $data["max_id"];
	}