

<?php	
	session_start();
	$syntaxeEmail='#^[\w.-]+@[\w.-]+\.[a-zA-Z]{2,5}$#';
	if(isset($_POST["login"]) AND 
		isset($_POST["mdp"]) AND 
		isset($_POST["nom"]) AND 
		isset($_POST["prenom"]) AND
		isset($_POST["mail"]) AND
		isset($_POST["sexe"]) AND 
		isset($_POST["jour"]) AND 
		isset($_POST["mois"]) AND 
		isset($_POST["annee"]))
	{	
		
		if(strlen($_POST["login"]) > 0 AND strlen($_POST["login"]) <= 30 AND
			strlen($_POST["mdp"]) > 0 AND strlen($_POST["mdp"]) <= 30 AND
			strlen($_POST["mail"]) > 0 AND strlen($_POST["mail"]) <= 50 AND preg_match($syntaxeEmail,$_POST["mail"]) AND
			$_POST["jour"] > 0 AND $_POST["jour"] <= 31 AND
			$_POST["mois"] > 0 AND $_POST["mois"] <= 12 AND
			$_POST["annee"] > 1899 AND $_POST["annee"] <= date("Y"))
		{

			
			$login = htmlspecialchars($_POST["login"]);
			$mdp = htmlspecialchars($_POST["mdp"]);
			$mail = htmlspecialchars($_POST["mail"]);
			$sexe = htmlspecialchars($_POST["sexe"]);
			$jour = htmlspecialchars($_POST["jour"]);
			$mois = htmlspecialchars($_POST["mois"]);
			$annee = htmlspecialchars($_POST["annee"]);
			$nom = htmlspecialchars($_POST["nom"]);
			$prenom = htmlspecialchars($_POST["prenom"]);
		
					
			//encrypter mdp
			$mdp = sha1($mdp);

			//connexion
			$co=mysql_connect('localhost', 'root', 'azerty') or die('erreur connexion');
			$base=mysql_select_db('intouch', $co) or die('bdd incorrecte');
			
			//la requete pour insérer le nouveau membre
			$signup = "INSERT into membre (login, mdp, nom, prenom, mail, sexe, jour, mois, annee) VALUES('$login', '$mdp', '$nom', '$prenom', '$mail', '$sexe', $jour, $mois, $annee)";
			
			//on regarde si le mail existe déjà dans la BDD
			$mail_existe = "SELECT mail FROM membre WHERE mail='$mail'";
			if (!mysql_query($mail_existe)) { 
    			echo '<script>alert("Erreur: votre mail existe déjà dans la base de données!");</script>';
				require_once("inscription_form.php");
			}
			else { 
				$result = mysql_query($signup);
				if (!$result) {
    				die('Requête invalide : ' . mysql_error());
				}
			
				if($signup){	
					echo '<script>alert("Vous êtes inscrit !");</script>';
					require_once("index.html");
				}
				else{
					require_once("inscription_form.php");
					echo 'Erreur inscription';
				}
			}
		}
		
		else{
			require_once("inscription_form.php");
			echo '<script>alert("Une erreur s\'est produite.\nVeuillez verifier les champs de saisie");</script>';
		}
	}
	
	else{
		require_once("inscription_form.php");
	}
	
?>