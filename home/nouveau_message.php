<?php 
      	session_start();
	require_once('connection_db.php');
	include_once('refresh_derniere_action.php');
	action();
	
	$message = $_GET["message"];
	$id = $_GET["id"];
	
	$db = connect_db();
	$db->query('INSERT INTO messages (id_from,id_to,content,time,checked) VALUES ("'.$_SESSION["id"].'","'.$id.'","'.$message.'","'.time().'","0");');
	echo '<span class="user_name">'.$_SESSION["login"].' : </span>'.$message.'<br/>';

	