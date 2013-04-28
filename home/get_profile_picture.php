<?php

	function get_profile_pic_path($id){
		 $db = connect_db();
		 $request = $db->prepare('SELECT * FROM membre,pictures WHERE membre.image_profil = pictures.id AND membre.id = :id;');
		 $request->execute(array('id'=>$id));
		 $data = $request->fetch();
		 return $data["image_profil"].'.'.$data["type"];
	}