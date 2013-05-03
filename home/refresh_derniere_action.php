<?php
	require_once('connection_db.php');
	function action(){
		 $db = connect_db();
		 $db->query('UPDATE membre SET derniere_action = '.time().' WHERE id = '.$_SESSION["id"].';');
	}