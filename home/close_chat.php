<?php
	session_start();
	$login = $_GET["login"];
	$chats = $_SESSION["chats"];
	unset($chats[$login]);
	$_SESSION["chats"] = $chats;