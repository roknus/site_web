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
			<div id="profile_description"></div>		
		</td>		
	</tr>
</table>