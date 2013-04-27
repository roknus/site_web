<?php
	function connect_db(){
	
		try
		{
			$db = new PDO('mysql:host=localhost;dbname=intouch', 'root', 'azerty');
		}
		catch (Exception $e)
		{
				die('Erreur : ' . $e->getMessage());
		}
		
		return $db;
	}