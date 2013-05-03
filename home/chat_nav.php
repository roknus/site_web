<script type="text/javascript">
<!--

	function connected_friends(){			
		    $.ajax({
			url: "connected_friends.php",
			complete : function(xhr, result){
				if(result != "success") return; 
				var response = xhr.responseText;
				if($('#connected_friends_block').css("display") == "none"){
					$(response).appendTo("#connected_friends_content");
					$('#connected_friends_block').show();
					$("#connected_friends").css("top","-307px");
				}
				else{
					$("#connected_friends_content").empty();
					$('#connected_friends_block').hide();
					$("#connected_friends").css("top","-25px");	
				}
			}
		});
	}

//-->
</script>

<div id="chat_nav">
     <ul id="chat_bar">
	<li>
		<div id="connected_friends_block">
			<div><strong>Amis connectés</strong></div>
			<ul id="connected_friends_content"><li></li></ul>
		</div>
		<div id="connected_friends" onclick="connected_friends()">
			<strong>Discussion instantanée </strong><span class="ui-icon ui-icon-comment" style="display:inline-block;"></span>
		</div>
	</li>
     </ul>
</div>
