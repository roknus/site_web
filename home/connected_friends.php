<?php
	session_start();
	include_once('refresh_derniere_action.php');
	action();
	require_once('connection_db.php');
	$db = connect_db();
	$request = $db->query('SELECT *,membre.id AS membreID FROM membre,amis,pictures WHERE amis.id1 = '.$_SESSION["id"].' AND membre.image_profil = pictures.id AND amis.id2 = membre.id AND derniere_action > '.(time()-(20*60)).';');
	$message="";
	while($data = $request->fetch()){
		$message .='<li><table onclick="start_chat(\''.$data["membreID"].'\',\''.$data["login"].'\')"><tr><td><img src="img/'.$data["image_profil"].'.'.$data["type"].'" width="40" height="40"/></td><td><span class="user_name"><strong>'.$data["login"].'</strong></span></td></tr></table></li>';
	}
	echo $message;