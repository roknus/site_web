<?php 

session_start();

$co=mysql_connect('localhost', 'root', 'azerty') or die('erreur connexion');
$base=mysql_select_db('intouch', $co) or die('bdd incorrecte');
 


// on teste si notre variable est déclarée
if (isset($_SESSION['login']) && isset($_POST['mdp'])) {  


	// lancement de la requête
	$sql = 'SELECT login, mdp FROM membre WHERE login = "'.$_SESSION['login'].'" and mdp = "'.sha1($_POST['mdp']).'"';
 
	// on lance la requête (mysql_query) et on impose un message d'erreur si la requête ne se passe pas bien (or die)
	$req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());  
	// on récupère le résultat sous forme d'un tableau
	$data = mysql_fetch_array($req);  
 
	// on libère l'espace mémoire alloué pour cette interrogation de la base
	mysql_free_result($req);  
 
	// on teste si les variables (mdp, new_pass et new_pass_conf) du formulaire sont déclarées (&& isset($_POST['mail2']) && isset($_POST['nom2']) && isset($_POST['prenom2']) && isset($_POST['sexe2']) && isset($_POST['jour2']) && isset($_POST['mois2']) && isset($_POST['annee2']) && isset($_POST['situation']) )
	if (isset($_POST['mdp']) && isset($_POST['new_pass']) && isset($_POST['new_pass_conf'])){																
		// on teste les deux mots de passe
		if ($_POST['new_pass'] == $_POST['new_pass_conf']) {  
								
			if ($_POST['mdp'] != $_POST['new_pass']) {

			// lancement de la requête
			$sql = 'UPDATE membre SET mdp="'.sha1($_POST['new_pass']).'" WHERE login="'.$_SESSION['login'].'"';  

			// on exécute la requête (mysql_query) et on affiche un message au cas où la requête ne se passait pas bien (or die)
			mysql_query($sql) or die('Erreur SQL !'.$sql.'<br />'. mysql_error());  
			
			
			echo '<script>alert("Vous avez bien modifié les champs saisis !");</script>';
			require_once("modifPerso.php");
			
			}  
		require_once("modifPerso.php");
		}	
	}

	
		
	if (isset($_POST['mail2']) AND ($_POST['mail2'] != "")){
		$sql = 'SELECT mail FROM membre WHERE login="'.$_SESSION['login'].'"'; 
		$var = mysql_query($sql) or die('Erreur SQL !'.$sql.'<br />'. mysql_error());
		$data = mysql_fetch_array($var);
		if ($data != $_POST['mail2']) {
			$sql = 'UPDATE membre SET mail="'.$_POST['mail2'].'" WHERE login="'.$_SESSION['login'].'"';
			mysql_query($sql) or die('Erreur SQL !'.$sql.'<br />'. mysql_error());
			echo '<script>alert("Vous avez bien modifié les champs saisis !");</script>';
			require_once("modifPerso.php");
		} 
	}
	
	if (isset($_POST['nom2']) AND ($_POST['nom2'] != "")){
		$sql = 'SELECT nom FROM membre WHERE login="'.$_SESSION['login'].'"'; 
		$var = mysql_query($sql) or die('Erreur SQL !'.$sql.'<br />'. mysql_error());
		$data = mysql_fetch_array($var);
		if ($data != $_POST['nom2']) {
			$sql = 'UPDATE membre SET nom="'.$_POST['nom2'].'" WHERE login="'.$_SESSION['login'].'"';  
			mysql_query($sql) or die('Erreur SQL !'.$sql.'<br />'. mysql_error());
			echo '<script>alert("Vous avez bien modifié les champs saisis !");</script>';
			require_once("modifPerso.php");
		}
		
	}
	
	if (isset($_POST['prenom2']) AND ($_POST['prenom2'] != "")){
		$sql = 'SELECT prenom FROM membre WHERE login="'.$_SESSION['login'].'"'; 
		$var = mysql_query($sql) or die('Erreur SQL !'.$sql.'<br />'. mysql_error());  
		$data = mysql_fetch_array($var);
		if ($data != $_POST['prenom2']) {
			$sql = 'UPDATE membre SET prenom="'.$_POST['prenom2'].'" WHERE login="'.$_SESSION['login'].'"'; 
			mysql_query($sql) or die('Erreur SQL !'.$sql.'<br />'. mysql_error());
			echo '<script>alert("Vous avez bien modifié les champs saisis !");</script>';
			require_once("modifPerso.php");
		}
	}
	
	if (isset($_POST['jour2']) AND ($_POST['jour2'] != "")){
		$sql = 'SELECT jour FROM membre WHERE login="'.$_SESSION['login'].'"'; 
		$var = mysql_query($sql) or die('Erreur SQL !'.$sql.'<br />'. mysql_error());  
		$data = mysql_fetch_array($var);
		if ($data != $_POST['jour2']) {
			$sql = 'UPDATE membre SET jour="'.$_POST['jour2'].'" WHERE login="'.$_SESSION['login'].'"';  
			mysql_query($sql) or die('Erreur SQL !'.$sql.'<br />'. mysql_error());
			echo '<script>alert("Vous avez bien modifié les champs saisis !");</script>';
			require_once("modifPerso.php");
		}
	}
	
	if (isset($_POST['mois2']) AND ($_POST['mois2'] != "")){
		$sql = 'SELECT mois FROM membre WHERE login="'.$_SESSION['login'].'"'; 
		$var = mysql_query($sql) or die('Erreur SQL !'.$sql.'<br />'. mysql_error());  
		$data = mysql_fetch_array($var);
		if ($data != $_POST['mois2']) {
			$sql = 'UPDATE membre SET mois="'.$_POST['mois2'].'" WHERE login="'.$_SESSION['login'].'"'; 
			mysql_query($sql) or die('Erreur SQL !'.$sql.'<br />'. mysql_error());
			echo '<script>alert("Vous avez bien modifié les champs saisis !");</script>';
			require_once("modifPerso.php");
		}
	}
	
	if (isset($_POST['annee2']) AND ($_POST['annee2'] != "")){
		$sql = 'SELECT annee FROM membre WHERE login="'.$_SESSION['login'].'"'; 
		$var = mysql_query($sql) or die('Erreur SQL !'.$sql.'<br />'. mysql_error());  
		$data = mysql_fetch_array($var);
		if ($data != $_POST['annee2']) {
			$sql = 'UPDATE membre SET annee="'.$_POST['annee2'].'" WHERE login="'.$_SESSION['login'].'"';
			mysql_query($sql) or die('Erreur SQL !'.$sql.'<br />'. mysql_error());
			echo '<script>alert("Vous avez bien modifié les champs saisis !");</script>';
			require_once("modifPerso.php");
		}
	}
	
	if (isset($_POST['situation']) AND ($_POST['situation'] != "")){
		$sql = 'SELECT situation FROM membre WHERE login="'.$_SESSION['login'].'"'; 
		$var = mysql_query($sql) or die('Erreur SQL !'.$sql.'<br />'. mysql_error());  
		$data = mysql_fetch_array($var);
		if ($data != $_POST['situation']) {
			$sql = 'UPDATE membre SET situation="'.$_POST['situation'].'" WHERE login="'.$_SESSION['login'].'"';
			mysql_query($sql) or die('Erreur SQL !'.$sql.'<br />'. mysql_error());
			echo '<script>alert("Vous avez bien modifié les champs saisis !");</script>';
			require_once("modifPerso.php");
		}
	}
	
	if (isset($_POST['adresse']) AND ($_POST['adresse'] != "")){
		$sql = 'SELECT adresse FROM membre WHERE login="'.$_SESSION['login'].'"'; 
		$var = mysql_query($sql) or die('Erreur SQL !'.$sql.'<br />'. mysql_error());  
		$data = mysql_fetch_array($var);
		if ($data != $_POST['adresse']) {
			$sql = 'UPDATE membre SET adresse="'.$_POST['adresse'].'" WHERE login="'.$_SESSION['login'].'"';
			mysql_query($sql) or die('Erreur SQL !'.$sql.'<br />'. mysql_error());
			echo '<script>alert("Vous avez bien modifié les champs saisis !");</script>';
			require_once("modifPerso.php");
		}
	}
	
	if (isset($_POST['adresse2']) AND ($_POST['adresse2'] != "")){
		$sql = 'SELECT adresse2 FROM membre WHERE login="'.$_SESSION['login'].'"'; 
		$var = mysql_query($sql) or die('Erreur SQL !'.$sql.'<br />'. mysql_error());  
		$data = mysql_fetch_array($var);
		if ($data != $_POST['adresse2']) {
			$sql = 'UPDATE membre SET adresse2="'.$_POST['adresse2'].'" WHERE login="'.$_SESSION['login'].'"';
			mysql_query($sql) or die('Erreur SQL !'.$sql.'<br />'. mysql_error());
			echo '<script>alert("Vous avez bien modifié les champs saisis !");</script>';
			require_once("modifPerso.php");
		}
	}
	
	if (isset($_POST['ville']) AND ($_POST['ville'] != "")){
		$sql = 'SELECT ville FROM membre WHERE login="'.$_SESSION['login'].'"'; 
		$var = mysql_query($sql) or die('Erreur SQL !'.$sql.'<br />'. mysql_error());  
		$data = mysql_fetch_array($var);
		if ($data != $_POST['ville']) {
			$sql = 'UPDATE membre SET ville="'.$_POST['ville'].'" WHERE login="'.$_SESSION['login'].'"';
			mysql_query($sql) or die('Erreur SQL !'.$sql.'<br />'. mysql_error());
			echo '<script>alert("Vous avez bien modifié les champs saisis !");</script>';
			require_once("modifPerso.php");
		}
	}
	
	if (isset($_POST['CP']) AND ($_POST['CP'] != "")){
		$sql = 'SELECT CP FROM membre WHERE login="'.$_SESSION['login'].'"'; 
		$var = mysql_query($sql) or die('Erreur SQL !'.$sql.'<br />'. mysql_error());  
		$data = mysql_fetch_array($var);
		if ($data != $_POST['CP']) {
			$sql = 'UPDATE membre SET CP="'.$_POST['CP'].'" WHERE login="'.$_SESSION['login'].'"';
			mysql_query($sql) or die('Erreur SQL !'.$sql.'<br />'. mysql_error());
			echo '<script>alert("Vous avez bien modifié les champs saisis !");</script>';
			require_once("modifPerso.php");
		}
	}
	
	if (isset($_POST['pays']) AND ($_POST['pays'] != "")){
		$sql = 'SELECT pays FROM membre WHERE login="'.$_SESSION['login'].'"'; 
		$var = mysql_query($sql) or die('Erreur SQL !'.$sql.'<br />'. mysql_error());  
		$data = mysql_fetch_array($var);
		if ($data != $_POST['pays']) {
			$sql = 'UPDATE membre SET pays="'.$_POST['pays'].'" WHERE login="'.$_SESSION['login'].'"';
			mysql_query($sql) or die('Erreur SQL !'.$sql.'<br />'. mysql_error());
			echo '<script>alert("Vous avez bien modifié les champs saisis !");</script>';
			require_once("modifPerso.php");
		}
	}
	
}

?> 