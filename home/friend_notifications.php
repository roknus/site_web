<?php
	if(isset($_GET["id"]) AND ($_GET["id"] != "")){
	session_start();
	require_once('connection_db.php');
	
	$db = connect_db();
	$request = $db->prepare('SELECT *,notifications.id AS notifID FROM membre,notifications WHERE notifications.id_poster = membre.id AND id_profile = :id AND checked=0 AND type=1;');
		$request->execute(array(
		"id"=>$_GET["id"]
		));
	$message = "";
	while($data = $request->fetch()){
		    $message .= '<li><span class="user_name">'.$data["login"].'</span> vous à ajouter en tant qu&rsquo;amis.<br/><i>"'.$data["content"].'"</i><span class="notifications_button" onclick="javascript:friend_notification_accept('.$data["notifID"].');">Accepter</span> - <span class="notifications_button" onclick="javascriptfriend_notification_reject('.$data["notifID"].'):;">Refuser</span></li>';
	}
	echo $message;	
}