<!doctype html>
<html lang="en-US">
<head>
	<meta charset="utf-8">

	<title>Page d'accueil</title>

   <link rel="stylesheet" href="style.css" />
</head>

<body>


<?php
session_start();    //on active le systeme session pour conserver des variables qu'on transmettra de page en page 

        
        require_once('home/connection_db.php');
	//on cree les variables d'identification login et mot de passe
	
	
	$login=$_POST['login'];      //login et mdp du membre
	$mdp=$_POST['mdp'];
	$mdp = sha1($mdp);

	
	
	//Connection à mysql et sélection de la base de données
	$co = mysql_connect('localhost', 'root', "azerty") or die(mysql_error());
 	mysql_select_db('intouch', $co) or die(mysql_error());
 
	 //Préparation de la requête
 	$query = "SELECT * FROM membre WHERE login='$login' AND mdp='$mdp'";
 
	//exécution de la requête et récupération du nombre de résultats
	$result = mysql_query($query, $co);
	$affected_rows = mysql_num_rows($result);
	
	//S'il y a exactement un résultat, l'utilisateur est authentifié, sinon, on l'empêche d'entrer
	if($affected_rows == 1) {
		$_SESSION['login'] = $login;
                $res = mysql_fetch_assoc($result);  
                $_SESSION["id"] = $res["id"];
                $_SESSION["chats"] = array();
                $db = connect_db();
                $db->query('UPDATE membre SET derniere_connexion = \''.date("Y-m-d H:i:s",time()).'\' WHERE id = \''.$_SESSION["id"].'\';');
		header("Location:home/?id=".$res["id"]);
	}
	else {
		echo '<script> alert("Accès refusé !"); </script>';
		require_once("index.html");
 	}
	
	
	
?>
 
 </body>
</html>
 
