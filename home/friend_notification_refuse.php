<?php

	session_start();
	$id_notif = $_GET["id"];
	require_once('connection_db.php');
	$db = connect_db();
	$request = $db->query('SELECT * FROM notifications WHERE id='.$id_notif.';');
	$data = $request->fetch();
	$request = $db->query('UPDATE notifications SET checked="1" WHERE id='.$id_notif.';');