<div id="nav">
     <ul>
	<li>
		<table>
			<tr>
				<td id="friend_notifications"><span id="friend_notifications_button" onclick="javascript:notifications_amis();">Amis</span></td>
				<td><div>Posts</div></td>
				<td><div>comments</div></td>
			</tr>
		</table>
		<ul id="notifications_list"></ul>
	</li>
	<li>
		<img src="intouch.png" alt="inTouch logo" width="150" height="30" />
	</li>
	<li id="search_bar">
	    <input type="text" placeholder="Chercher des personnes que vous connaissez peut-être..." name="search_bar" id="search_bar_input" size="40" onkeyup="javascript:find_people();" onblur="javascript:setTimeout(function(){$('#search_bar ul').empty().hide()},200);"/>
	    <ul></ul>		
	</li>
	<li>
		<table id="nav_button">
			<tr>
				<td>
					<a href="/inTouch/home/?id=<?php echo $_SESSION["id"];?>"><?php echo $_SESSION["login"]; ?></a>
				</td>
				<td>
					<a href="/inTouch/modifPerso.php">Profil</a>
				</td>
				<td>
					<a href="/inTouch/deconnexion.php">Deconnexion</a>
				</td>
			</tr>
		</table>
	</li>
     </ul>
</div>