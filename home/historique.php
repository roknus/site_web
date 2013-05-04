<?php
	session_start();	
	require_once('connection_db.php');


	$id = $_SESSION["id"];
	$id_from = $_GET["id"];

	$db = connect_db();
	$request = $db->query('SELECT *,messages.id AS messagesID, membre.id AS membreID FROM membre,messages WHERE messages.id_from = membre.id AND ((messages.id_to = '.$id.' AND messages.id_from = '.$id_from.') OR (messages.id_to = '.$id_from.' AND messages.id_from = '.$id.')) AND messages.checked = "1" AND membre.derniere_connexion > messages.time ORDER BY messages.time ASC;');
	
	$message = "";
	while($data = $request->fetch()){
		    $message .= '<span class="user_name">'.$data["login"].' : </span>'.$data["content"].'<br/>';
	}
	echo $message;