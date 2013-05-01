<div id="nav">
     <ul>
	<li>
		<table id="notifications">
			<tr>
				<td id="friend_notifications"><button class="button_friends" onclick="javascript:notifications_amis();">1</button></td>
				<td id="post_notifications"><button class="button_posts" onclick="javascript:notifications_amis();">2</button></td>
				<td id="comment_notifications"><button class="button_comments" onclick="javascript:notifications_amis();">0</button></td>
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