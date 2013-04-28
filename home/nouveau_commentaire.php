<?php
	session_start();
	require_once('connection_db.php');
	require_once('add_comment.php');
	require_once('get_profile_picture.php');	
	date_default_timezone_set('Europe/Berlin');
	
	$comment = $_GET["comment"];
        $id_post = $_GET["id_post"];
        addComment($id_post,$comment);
        echo'<td class="post_user_picture"><img src="img/'.get_profile_pic_path($_SESSION["id"]).'" height="30" width="30" /></td>
		 <td><span class="user_name"><strong>'.$_SESSION["login"].'</strong></span> '.$comment.'
		<br/><span class="post_time">il y a un instant
		</td>';