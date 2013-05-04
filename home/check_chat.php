<?php
	session_start();	
	require_once('connection_db.php');

	$id = $_SESSION["id"];

	$db = connect_db();
	$request = $db->query('SELECT *,membre.id AS membreID FROM membre,messages WHERE messages.id_from = membre.id AND messages.id_to = '.$id.' AND checked = "0" GROUP BY messages.id_from;');
	$message ="";
	while($data = $request->fetch()){
		    $message .= $data["membreID"].'&'.$data["login"].'&';
	}
	echo $message;