<?php

	session_start();
	include_once('refresh_derniere_action.php');
	action();
	$id_notif = $_GET["id"];
	require_once('connection_db.php');
	$db = connect_db();
	$request = $db->query('SELECT * FROM notifications WHERE id='.$id_notif.';');
	$data = $request->fetch();
	$request = $db->query('INSERT INTO amis (id1,id2) VALUES ('.$data["id_profile"].','.$data["id_poster"].');');
	$request = $db->query('INSERT INTO amis (id1,id2) VALUES ('.$data["id_poster"].','.$data["id_profile"].');');
	$request = $db->query('UPDATE notifications SET checked="1" WHERE id='.$id_notif.';');