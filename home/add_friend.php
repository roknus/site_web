<?php
	session_start();
	include_once('refresh_derniere_action.php');
	action();
	if(isset($_GET["poster"]) AND ($_GET["poster"] != "") AND isset($_GET["profile"]) AND ($_GET["profile"] != "")){
		require_once('connection_db.php');
		if(isset($_GET["message"]) AND ($_GET["message"] != "")){
			$message = $_GET["message"];
		}
		else $message = "";
	
		$db = connect_db();
		$request = $db->prepare('INSERT INTO notifications (type,id_profile,id_poster,content,checked) VALUES ("1", :profile, :poster, :content, "0");');
		$request->execute(array(
				"profile"=>$_GET["profile"],
				"poster"=>$_GET["poster"],
				"content"=>$message
				));

	}