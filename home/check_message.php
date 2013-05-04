<?php
	session_start();	
	require_once('connection_db.php');

	$chats = $_SESSION["chats"];

	$id = $_SESSION["id"];
	$id_from = $_GET["id"];

	$db = connect_db();
	$request = $db->query('SELECT *,messages.id AS messagesID, membre.id AS membreID FROM membre,messages WHERE messages.id_from = membre.id AND messages.id_to = '.$id.' AND messages.id_from = '.$id_from.' AND checked = "0";');
	
	$message = "";
	while($data = $request->fetch()){
		    if(!(in_array($data["login"],$chats))){
			$chats[$data["login"]] = $data["membreID"];
		    }
		    $db->query('UPDATE messages SET checked ="1" WHERE id ='.$data["messagesID"].';');
		    $message .= '<span class="user_name">'.$data["login"].' : </span>'.$data["content"].'<br/>';
	}
	$_SESSION["chats"] = $chats;
	echo $message;