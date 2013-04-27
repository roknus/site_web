<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
    <head>
        <title>Inscription</title>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<link rel="stylesheet" href="style.css" />
        
        <script type="text/javascript" src="jquery-1.9.1.min.js"></script>
		
		<script>
			function verif_mdp(mdp_1, mdp_2){
				if (document.getElementById(mdp_1).value != document.getElementById(mdp_2).value){
					alert('Les deux mots de passe ne correspondent pas');
					return false;	
				}
				else {
					return true;
				}
			}
			
			
					
		</script>
		
    </head>

    
    
    
    
    <body>
    
   
    
    <p style="text-align:center;"><img src="Logo.png"/></p>
    </br>
    

    
    
    	<table class="tborder">
			<tr>
				<td class="ttitle" style="text-align:center;"><strong><h1>INSCRIPTION</h1></strong></td>
            </tr>
            
           
        </table>

    
    
    <div id="login">


           <form name="form" action="inscription.php" method="post" onsubmit="javascript: return verif_mdp('mdp_1', 'mdp_2');">  
         
             <fieldset class="clearfix">

                <legend class="legend"> Login et Mot de passe</legend>
                
                <p><input type="text" value="Login" name="login"><sup>*</sup></p> 
                <p><input type="password" value="Nouveau mot de passe" name="mdp" id="mdp_1" size="25" maxlength="30"><sup>*</sup></p>                 
                <p><input type="password" value="Confirmez votre mot de passe" name="mdp" id="mdp_2" size="25" maxlength="30"><sup>*</sup></p> 
 
            </fieldset>


       
            <fieldset class="clearfix">
                
                <legend class="legend"> Informations personnelles</legend>
                <p><input id="Nom" type="text" value="Nom" name="nom"><sup>*</sup></p>
                
                <p><input id="Prenom" type="text" value="Prenom"  name="prenom"><sup>*</sup></p> 
                
                <p><input id="sign_up_email" type="text" value="Email" name="mail" size="25" maxlength="50"><sup>*</sup></p>
                
				<p><input id="sign_up_email_confirm" type="text" value="Confirmez votre email" name="mail" size="25" maxlength="50"><sup>*</sup></p>
                
				<p><input id="Sexe" type="text" value="Sexe" name="sexe"><sup>*</sup></p> 



                <!--<input id="sexe" type="radio" value="sexe" name="sexe">Homme

                <input id="sexe" type="radio" value="sexe" name="sexe">Femme-->
                

                 
            <p>	
            <h3> Date de naissance : </h3></p> 
            <table>
            <tr>
				<td rowspan=3></td>
			</tr>
       
			<tr>
                <td>
					<strong>Jour :</strong><br />
						<select name="jour">
							<option></option>
								<?php for($i=1;$i<=31;$i++){
									echo "<option value=\"{$i}\">{$i}</option>";
								}?>
						</select>
				</td>
   
                <td>
					<strong>Mois :</strong><br />
						<select name="mois">
							<option></option>
								<?php 
									$months = array('Janvier','Fevrier','Mars','Avril','Mai','Juin','Juillet','Aout','Septembre','Octobre','Novembre','Decembre');
									$i = 0;
									foreach($months as $mois){
										$i = $i+1;
										echo "<option value=\"{$i}\">{$mois}</option>";
									}	
								?>
						</select>
				</td>

                <td>
					<strong>Annee :</strong><br />
						<select name="annee">
							<option></option>
								<?php for($i=date("Y");$i>=1900;$i--){
									echo "<option value=\"{$i}\">{$i}</option>";
								}?>
						</select>
				</td>
                
          </tr>
          </table>
          
          
          	<!-- vérification des deux mots de passe -->
            <?php
    		if(!empty($_POST)){
    			if($_POST['mdp_1'] != $_POST['mdp_2']){
    				echo 'Erreur de mot de passe';
   				}
    			else{
    				echo 'Le mot de passe a été correctement saisi';
    			}
				echo '<br /><br />';
			}
    		?>
            
                
          <p><input type="submit" value="Inscription" /></p>
	</fieldset>
</form>
        
    </div> 
    


	<p class="p"> Les champs obligatoire sont signales par *.</p>
    

    
    
</body>
</html>
    
