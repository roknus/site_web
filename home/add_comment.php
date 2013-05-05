<?php
	include_once('refresh_derniere_action.php');
	action();
	function addComment($id_post,$comment){
  	$bdd = connect_db();
  	$request = $bdd->prepare('INSERT INTO comments (id_post,id_poster,content,creation_time) VALUES (:post, :poster, :content, :creation_time);');
	$date = date("Y-m-d H:i:s", time());
  	$request->execute(array(
			  'post'=>$id_post,
			  'poster'=>$_SESSION["id"],
			  'content'=>$comment,
			  'creation_time'=>$date
			  ));
	$request = $bdd->query('SELECT * FROM comments WHERE id_post = '.$id_post.' AND id_poster = '.$_SESSION["id"].' ORDER BY creation_time DESC ;');
	$data = $request->fetch();
	return $data["id"];
}