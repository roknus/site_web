<?php
	$db = connect_db();
	$request = $db->query('SELECT * FROM amis,pictures,membre WHERE amis.id1='.$_GET["id"].' AND amis.id2 = membre.id AND membre.image_profil = pictures.id;');
?>

<table id="friend_table">
	<tr>
		<td id="friend_table_title"><strong>Amis</strong></td>
	</tr>
	<tr>
		<td id="friend_number">Vous avez ... PAS d'amis AHAHAH</td>
	</tr>
	<tr>
		<td>
			<div id="friends">
			     <?php
				while($data = $request->fetch()){
					echo '<img src="img/'.$data["image_profil"].'.'.$data["type"].'" width="50" height="50"/>';
				}
			     ?>
			</div>		
		</td>		
	</tr>
</table>