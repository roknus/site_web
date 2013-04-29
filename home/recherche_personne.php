<?php
	session_start();
	if(isset($_GET["search"]) AND ($_GET["search"] != "")){
		require_once('connection_db.php');
		$search = $_GET["search"];
		$search = htmlspecialchars($search);
		
		$db = connect_db();
		$request = $db->query("SELECT *,membre.id AS membreID FROM membre,pictures WHERE membre.image_profil = pictures.id AND login LIKE '".$search."%';");
		$result = "";

		while($data = $request->fetch()){
			    $result .= '<a href="./?id='.$data["membreID"].'"><li>
						<table>
							<tr>
							    <td rowspan="3" class="image_search_bar"><img src="img/'.$data["image_profil"].'.'.$data["type"].'" width="48" height="48"/></td>
							    <td><span class="user_name"><strong>'.$data["login"].'</strong></span></td>
							</tr>
							<tr>
							    <td>'.$data["prenom"].' '.$data["nom"].'</td>
							</tr>
							<tr>
							    <td class="search_bar_result">'.$data["ville"].'</td>
							</tr>
						</table>
					</li></a>';
		}
		echo $result;		
	}