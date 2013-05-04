<?php
   session_start();
   require_once('connection_db.php');
   include_once('refresh_derniere_action.php');
   action();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
    <head>
        <title>inTouch</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" type="text/css" href="style.css" />
		<link rel="stylesheet" href="/inTouch/jquery-ui-1.10.2.custom/development-bundle/themes/custom-theme/jquery.ui.all.css" />
	
		<script type="text/javascript" src="/inTouch/jquery-1.9.1.min.js"></script>
		<script src="/inTouch/jquery-ui-1.10.2.custom/development-bundle/ui/jquery.ui.core.js"></script>
		<script src="/inTouch/jquery-ui-1.10.2.custom/development-bundle/ui/jquery.ui.widget.js"></script>
		<script src="/inTouch/jquery-ui-1.10.2.custom/development-bundle/ui/jquery.ui.mouse.js"></script>
		<script src="/inTouch/jquery-ui-1.10.2.custom/development-bundle/ui/jquery.ui.tabs.js"></script>
		<script src="/inTouch/jquery-ui-1.10.2.custom/development-bundle/ui/jquery.ui.button.js"></script>
		
	</head>

<body> 
       

       <?php require_once('nav.php'); ?>

       	<script>
	<!--		
		$(document).ready(function(){
			$(".button_friends").button({icons:{primary:"ui-icon-person"},text:true});
			$(".button_posts").button({icons:{primary:"ui-icon-document-b"},text:true});
			$(".button_comments").button({icons:{primary:"ui-icon-comment"},text:true});
			check_notifications();
			
			setInterval(function(){
						check_notifications();							
						},1000);

			<?php
				foreach($_SESSION["chats"] as $login => $id){
					echo 'start_chat("'.$id.'","'.$login.'");';
				}
			?>
		});

	//-->
	</script> 

<div id="page">
     <table id="wrapper">
     		<tr>
			<td id="info_perso">
				<?php include_once('profile_block.php'); ?>
				<br/>
				<?php
					if($_SESSION["id"] != $_GET["id"]){// A refaire
						echo '<input type="button" value="Ajouter..." onclick="javascript:friend_request_popup();" />';
					}
				?>
			</td>			
			<td rowspan="2" id="mur">
			    <?php
				$db = connect_db();
				$request = $db->query('SELECT * FROM pictures WHERE id_owner = '.$_GET["id"].';');
				while($data = $request->fetch()){
					    echo '<img src="img/'.$data["id"].'.'.$data["type"].'" style="max-width:200px;max-height:200px;" />';
				}echo '1';
			    ?>				         
            		</td>     	
	 	</tr>
		<tr>
			<td id="amis"><?php include_once('friends_block.php'); ?></td>
		</tr>
    </table>

        
</div>
<?php
	require_once('chat_nav.php');    
?>
</body>
</html>
