<?php
	session_start();
	include_once('refresh_derniere_action.php');
	action();
	if(isset($_GET["id"]) AND ($_GET["id"] != "")){
		require_once('connection_db.php');
		
		$db = connect_db();
		$request = $db->prepare('SELECT * FROM membre,pictures WHERE membre.image_profil = pictures.id AND membre.id = :id ;');
		$request->execute(array("id"=>$_GET["id"]));
		$data = $request->fetch();
	
		echo '<div id="add_friend_window">    
	    	      <div id="friend_popup_top">
		      	   <span>
				Demande d&rsquo;ajout en amis à '.$data["login"].'
			   </span>
	      	   	   <span class="close_button" onclick="javascript:remove_friend_popup();">
		   	   	<img src="cross.png" width="18" height="18" />
		  	   </span>
	     	      </div>
		      <div id="friend_popup_content">
				<table>
					<tr>
						<td rowspan=3"><img src="img/'.$data["image_profil"].'.'.$data["type"].'" alt="image de profil" width="45" height="45" /></td>
						<td class="user_name"><strong>'.$data["login"].'</strong></td>
					</tr>
					<tr>
						<td>'.$data["prenom"].' '.$data["nom"].'</td>
					</tr>
					<tr>
						<td>'.$data["ville"].'</td>
					</tr>
				</table>
				<div id="add_friend_description">
					<textarea cols="50" rows="3" maxlength="255" placeholder="Comment connaissez-vous cette personne...">
						
					</textarea>
				</div>
		      </div>
		      <div id="friend_popup_bottom">
				<span>
					<input type="button" value="Annuler" onclick="javascript:remove_friend_popup();"/>
					<input type="button" value="Envoyer" onclick="javascript:add_friend();"/>
				</span>
		      </div>
		 </div>
		 <div id="add_friend_popup"></div>';
}
	