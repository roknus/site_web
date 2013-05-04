<?php
	if(isset($_GET["id"]) AND ($_GET["id"] != "")){
	session_start();
	require_once('connection_db.php');
	
	$db = connect_db();
	$request = $db->prepare('SELECT *,notifications.id AS notifID FROM membre,notifications WHERE notifications.id_poster = membre.id AND id_profile = :id AND checked=0 AND type=3;');
		$request->execute(array(
		"id"=>$_GET["id"]
		));
	$message = "";
	while($data = $request->fetch()){
		    $message .= '<li><span class="user_name">'.$data["login"].'</span> a commenté un de vos posts.<br/><i>"'.$data["content"].'"</i> <a class="notifications_button" onclick="javascript:post_viewed('.$data["notifID"].');">Voir</a></li>';
	}
	echo $message;	
}