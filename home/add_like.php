<?php
	session_start();
	$id = $_GET["id"];
	require_once('connection_db.php');
	$db = connect_db();
	$request = $db->query('SELECT * FROM likes WHERE id_post = '.$id.' AND id_liker = '.$_SESSION["id"].';');
	if(!($request->rowCount())){
		$db->query('INSERT INTO likes (id_post,id_liker) VALUES ('.$id.','.$_SESSION["id"].');');
	}
	$request = $db->query('SELECT * FROM likes WHERE id_post ='.$id.';');
	echo $request->rowCount();

