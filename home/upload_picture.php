<?php
	session_start();
	
	date_default_timezone_set('Europe/Berlin');
	require_once('connection_db.php');
	require_once('upload_picture_model.php');
	require_once('add_post.php');
	
	
if( isset($_POST['picture_title_input']) AND ($_POST['picture_title_input'] != "") AND (isset($_POST['wall'])) AND ($_POST['wall'] != "")) // si formulaire soumis
{
    $content_dir = 'img/'; // dossier où sera déplacé le fichier

    $tmp_file = $_FILES['uploaded_picture']['tmp_name'];

    if( !is_uploaded_file($tmp_file) )
    {
        header('Location:./?id='.$_POST["wall"]);
    }

    // on vérifie maintenant l'extension
    $type_file = $_FILES['uploaded_picture']['type'];

    if( !strstr($type_file, 'jpg') && !strstr($type_file, 'jpeg') && !strstr($type_file, 'bmp') && !strstr($type_file, 'gif') && !strstr($type_file, 'png'))
    {
	header('Location:./?id='.$_POST["wall"]);
    }

    // on copie le fichier dans le dossier de destination
	$type = strtok($_FILES['uploaded_picture']['type'],'/');
	$type = strtok('/');
        $name_file = checkAvailableName();

    if( !move_uploaded_file($tmp_file, $content_dir.$name_file.'.'.$type) )
    {
	header('Location:./?id='.$_POST["wall"]);
    }
	addPicture($_POST["wall"],$_FILES['uploaded_picture']['name'],$type,$_POST['picture_title_input']);
	addPost($_POST['picture_description'],$_POST["wall"],$name_file);
	if(isset($_POST["image_profil"]) AND ($_POST["image_profil"] == "1")){
	
		$db = connect_db();
		$request = $db->prepare("UPDATE membre SET image_profil = :img WHERE id = :id;");		
		$request->execute(array(
			"img"=>$name_file,
			"id"=>$_POST["wall"]
			));			
	}
	
	header('Location:./?id='.$_POST["wall"]);
}
else{
	header('Location:./?id='.$_POST["wall"]);
}