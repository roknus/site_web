<?php
	session_start();
	require_once('connection_db.php');
	require_once('add_comment.php');
	require_once('get_profile_picture.php');	
	date_default_timezone_set('Europe/Berlin');
	
	$comment = $_GET["comment"];
        $id_post = $_GET["id_post"];
        $id = addComment($id_post,$comment);
	$db = connect_db();
	$request = $db->query('SELECT *,posts.id AS postsID FROM posts,comments WHERE comments.id_post = posts.id AND posts.id = '.$id_post.' GROUP BY id_poster;');
	$data = $request->fetch();
	$notif = $comment;
	if(strlen($notif) > 50){
		$notif = substr($notif,0,50);
		$notif .= "...";
	}
	if($data["id_owner"] != $_SESSION["id"]){
			     $db->query('INSERT INTO notifications (type,id_profile,id_poster,content,checked,ancre) VALUES ("3","'.$data["id_owner"].'","'.$_SESSION["id"].'","'.$notif.'","0","?id='.$data["id_wall"].'#'.$data["postsID"].'");');
	}
	if($data["id_wall"] != $_SESSION["id"] AND $data["id_wall"] != $data["id_owner"]){
			     $db->query('INSERT INTO notifications (type,id_profile,id_poster,content,checked,ancre) VALUES ("3","'.$data["id_wall"].'","'.$_SESSION["id"].'","'.$notif.'","0","?id='.$data["id_wall"].'#'.$data["postsID"].'");');
	}
	do{
		if($data["id_poster"] != $_SESSION["id"] AND $data["id_poster"] != $data["id_owner"] AND $data["id_poster"] != $data["id_wall"]){
			$db->query('INSERT INTO notifications (type,id_profile,id_poster,content,checked,ancre) VALUES ("3","'.$data["id_poster"].'","'.$_SESSION["id"].'","'.$notif.'","0","?id='.$data["id_wall"].'#'.$data["postsID"].'");');
		}
	}while($data = $request->fetch());

        echo'<td class="post_user_picture"><img src="img/'.get_profile_pic_path($_SESSION["id"]).'" height="30" width="30" /></td>
		<td><span class="user_name"><strong>'.$_SESSION["login"].'</strong></span> '.$comment.'
		<br/><span class="post_time">il y a un instant</span>
		-
		<button class="button_like" onclick="like('.$id.',this)">0</button>
		</td>';