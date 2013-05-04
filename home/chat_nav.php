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

	function start_chat(id,login){
		$("#connected_friends_content").empty();
		$('#connected_friends_block').hide();
		$("#connected_friends").css("top","-25px");

		$("<li><div class='friend_chat_block'><div class='friend_chat_title'><strong>"+login+"</strong></div><div class='friend_chat_content'></div><div class='chat_input' name='"+id+"'><textarea rows='2' cols='30'></textarea></div></div><div class='friend_chat' onclick='toggle_friend_chat(this)'><strong>"+login+"</strong></div></li>").appendTo("#chat_bar");	
	}

	function toggle_friend_chat(obj){
		 var id = $(obj).parent().find(".chat_input").attr("name");
		 if($(obj).prev().css("display") == "none"){
		 	clearInterval(interval);
		 	$(obj).prev().show();
			$(obj).css("top","-307px");
			$(obj).parent().find(".chat_input").bind('keydown',function(event){
				if(event.keyCode == 13){
					nouveauMessage(this);
				}
			});
			historique(id,obj);
			var interval = setInterval(function(){
			    	var data = {id : id};
				$.ajax({
					url: "check_message.php",
					data : data,
					complete : function(xhr, result){
						if(result != "success") return; 
						var response = xhr.responseText;					
						$(obj).parent().find('.friend_chat_content').append(response);
						var scroll = $(obj).parent().find(".friend_chat_content").scrollTop();
						$(obj).parent().find(".friend_chat_content").scrollTop(scroll +100);	
					}
			  	});	 
			},1000);
		 }
		 else{
			$(obj).prev().hide();
			$(obj).css("top","-25px");
			$(obj).find(".chat_input").unbind();
		 }
	}

	function historique(id,obj){
		var data = { id : id };
		$.ajax({
			url: "historique.php",
			data : data,
			complete : function(xhr, result){
				if(result != "success") return; 
				var response = xhr.responseText;					
				$(obj).parent().find('.friend_chat_content').append(response);
				var scroll = $(obj).parent().find(".friend_chat_content").scrollTop();
				$(obj).parent().find(".friend_chat_content").scrollTop(scroll +100);					
			}
		  });	 
	}

	function nouveauMessage(obj){
		var mess = $(obj).find("textarea").val();
		var id = $(obj).attr("name");
		if(mess != ""){
			var data = {id : id, message : mess };
			$.ajax({
				url: "nouveau_message.php",
				data : data,
				complete : function(xhr, result){
					if(result != "success") return; 
					var response = xhr.responseText;					
					$(obj).parent().find('.friend_chat_content').append(response);
					$(obj).find("textarea").val("");
					var scroll = $(obj).parent().find(".friend_chat_content").scrollTop();
					$(obj).parent().find(".friend_chat_content").scrollTop(scroll +100);					
				}
			  });
		}
	}
	
	function isChat(login){
		 for(var j=0;j<chats.length;j++){
		 	 if(chats[j] == login){	
			 	   return true;
			 }
		 }
	}

//-->
</script>

<script type="text/javascript">
<!--
	var chats = new Array();
	var chat = setInterval(function(){
			$.ajax({
				url: "check_chat.php",
				complete : function(xhr, result){
					if(result != "success") return; 
					var response = xhr.responseText;
					if(response != ""){
						    var res = response.split('&');
						    var i = 0;
						    while(res[i]){
								if(!isChat(res[i+1])){
									start_chat(res[i],res[i+1]);
									chats.push(res[i+1]);
								}
						    		i = i+2;
						    }
					}					
				}
		  	});	 
		},1000);

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
