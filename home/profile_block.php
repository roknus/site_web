<?php
	require_once('connection_db.php');
	$db = connect_db();
	$request = $db->query('SELECT * FROM membre,pictures WHERE membre.image_profil = pictures.id AND membre.id = '.$_GET["id"].';');
	$data = $request->fetch();	
?>

<table id="friend_table">
	<tr>
		<td id="friend_table_title"><strong><?php echo $data['login'];?></strong></td>
	</tr>
	<tr>
		<td>
			<?php echo '<img src="img/'.$data["image_profil"].'.'.$data["type"].'" width="220" />'; ?>
		</td>
	</tr>
	<tr>
		<td>
			<div id="profile_description">
			     <?php
				if($data["nom"]!=NULL AND $data["prenom"]!=NULL){
					echo $data["nom"].' '.$data["prenom"].'<br/>';
				}
				if($data["jour"]!=NULL AND $data["mois"]!=NULL AND $data["annee"!=NULL]){
						       echo 'Date de naissance : '.$data["jour"].' / '.$data["mois"].' / '.$data["annee"].'<br/>';
				}
				if($data["ville"]!=NULL OR $data["pays"]!=NULL){
							if($data["ville"]!=NULL){
								echo 'Habite à : '.$data["ville"];
							}
							if($data["ville"]!=NULL AND $data["pays"]!=NULL){
								echo ' , ';
							}
						       	if($data["pays"]!=NULL){
								echo $data["pays"];
							}
							echo '<br/>';
				}
				if($data["adresse"]!=NULL OR $data["adresse2"]!=NULL){
					if($data["adresse"]!=NULL){
						echo 'Adresse : '.$data["adresse"].' ';
					}
					if($data["adresse2"]!=NULL){
						echo $data["adresse2"];
					}
					echo '<br/>';
				}
				if($data["situation"]!=NULL){
						       echo 'Situation amoureuse : '.$data["situation"].'<br/>';
				}
				if($data["mail"]!=NULL){
						       echo 'E-mail : '.$data["mail"].'<br/>';
				}
				?>
			</div>		
		</td>		
	</tr>
</table>