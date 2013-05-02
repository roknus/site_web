<?php
	$db = connect_db();
	$request = $db->query('SELECT * FROM amis,pictures,membre WHERE amis.id1='.$_GET["id"].' AND amis.id2 = membre.id AND membre.image_profil = pictures.id;');
?>

<table id="friend_table">
	<tr>
		<td id="friend_table_title"><strong>Amis</strong></td>
	</tr>
	<tr>
		<td id="friend_number"><?php echo $request->rowCount(); ?> amis</td>
	</tr>
	<tr>
		<td>
			<div id="friends">
			     <?php
				while($data = $request->fetch()){
					echo '<a href="./?id='.$data["id2"].'"><img src="img/'.$data["image_profil"].'.'.$data["type"].'" width="45" height="45" title="'.$data["login"].'"/></a>';
				}
			     ?>
			</div>		
		</td>		
	</tr>
</table>