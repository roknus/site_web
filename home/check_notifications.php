<?php
	session_start();
	include_once('refresh_derniere_action.php');
	action();
	$id = $_GET["id"];
	require_once("connection_db.php");
	$db = connect_db();
	$request = $db->query('SELECT * FROM notifications WHERE id_profile = '.$id.' AND checked = 0;');
	$friends = 0;
	$posts = 0;
	$comments = 0;
	while($data = $request->fetch()){
		    switch($data["type"]){
			case "1":
			{
				$friends += 1;
				break;		
			}
			case "2":
			{
				$posts += 1;	
				break;
			}
			case "3":
			{
				$comments += 1;
				break;
			}
		    }
	}
	echo $friends.'&'.$posts.'&'.$comments;