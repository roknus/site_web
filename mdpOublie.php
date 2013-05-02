<!doctype html>
<html lang="en-US">
<head>
	<meta charset="utf-8">

	<title>Page d'accueil</title>

   <link rel="stylesheet" href="style.css" />
   
</head>





<body>

<p style="text-align:center;"><img src="images(site)/Logo.png"/></p>

		<table class="tborder">
        	<tr>
				<td class="ttitle" style="text-align:center;"><strong><h1>Mot de passe oublié?</h1></strong></td>
            </tr>           
        </table>   


<div id="login">
        <form action="mdpOublie.php" method="post">
            
            <fieldset class="clearfix">
            <legend class="legend">Mot de passe oublié</legend>	
				<p>Vous devrez entrer votre e-mail et votre mot de passe sera envoyé dans votre boîte mail.</p>

                <p><span><img src="images(site)/Icon-mail.png"></span><input type="text" value="Entrez votre email" name="mail" size="25" maxlength="50"onBlur="if(this.value == '') this.value = 'mail'" onFocus="if(this.value == 'mail') this.value = ''" required></p>
                
                <p><input type="submit" value="Envoyer"></p>
            </fieldset>
        </form>
        
     
     
        
<?php


if (isset($_POST['mail'])){
	$mail = $_POST['mail'];
	
	if (!empty($_POST['mail'])){
		$co=mysql_connect('localhost', 'root', '') or die('erreur connexion');
		$base=mysql_select_db('bdd', $co) or die('bdd incorrecte');
 		if ($base) {
			$sql = 'SELECT mdp FROM membre WHERE mail = "'.$_POST['mail'].'"';
			$resultat = mysql_query($sql);
			if (!$resultat){
				echo '<script>alert("mail entré n\'existe pas;")</script>';
			}
			else {
				$row = mysql_fetch_array($resultat);
				$mdp = $row[0];
				
				//----------------------------------------------- 
				//DECLARE LES VARIABLES 
				//----------------------------------------------- 	
				$destinataire = $mail;
				
				$email_reply='email_de_reponse@intouch.com';
				$email_expediteur='responsables du site inTouch';
				$message_texte='Bonjour,'."\n\n".'Voici votre mot de passe :'.$mdp; 
				$message_html='<html> <head><title>Titre</title></head>	<body>Test de message</body> </html>'; 
				
				//----------------------------------------------- 
				//GENERE LA FRONTIERE DU MAIL ENTRE TEXTE ET HTML 
				//----------------------------------------------- 
				$frontiere = '-----=' . sha1(uniqid(mt_rand())); 
				
				//----------------------------------------------- 
				//HEADERS DU MAIL 
				//----------------------------------------------- 
					
				$headers = 'From: "Nom" <'.$email_expediteur.'>'."\n"; 
				$headers .= 'Return-Path: <'.$email_reply.'>'."\n"; 
				$headers .= 'MIME-Version: 1.0'."\n"; 
				$headers .= 'Content-Type: multipart/alternative; boundary="'.$frontiere.'"'; 
				
				//----------------------------------------------- 
				//MESSAGE TEXTE 
				//----------------------------------------------- 
				$message = 'This is a multi-part message in MIME format.'."\n\n"; 
				$message .= '--'.$frontiere.'--'."\n"; 
				$message .= 'Content-Type: text/plain; charset="iso-8859-1"'."\n"; 
				$message .= 'Content-Transfer-Encoding: 8bit'."\n\n"; 
				$message .= $message_texte."\n\n"; 
				
				//----------------------------------------------- 
				//MESSAGE HTML 
				//----------------------------------------------- 
				$message .= '--'.$frontiere.'--'."\n";
				$message .= 'Content-Type: text/html; charset="iso-8859-1"'."\n"; 
				$message .= 'Content-Transfer-Encoding: 8bit'."\n\n"; 
				$message .= $message_html."\n\n"; 
				
				$message .= '--'.$frontiere.'--'."\n"; 
				
				if(mail($destinataire,$message,$headers)) { 
					echo 'Le mail a été envoyé';
				} 
				else { 
					echo 'Le mail n\'a pu être envoyé'; 
				}				
			}
		}
		else {
			echo "<p class='p'>Un probleme de connection à la base de données</p>";
		}
	}
	else {
			echo  "<p class='p'>vous avez oublié de remplir le champ</p>";
	}
}
else {
	echo  "<p class='p'>Il faut remplir le champ indiqué</p>";
}


?>        
        
     
</div>


</body>
</html>