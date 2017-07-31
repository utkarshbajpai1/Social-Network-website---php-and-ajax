function friendToggle(type, user, elem){
	var conf = confirm(" Do u want to confirm ' "+type+" ' action for user <?php echo $u;?> .");
	if (conf != true) {
		return false;
	}
	_(elem).innerHTML = 'PLEASE WAIT...';
	var ajax = ajaxObj("POST", "php_parsers/friend_system.php");
	ajax.onreadystatechange = function(){
		if(ajaxReturn(ajax) == true){
			if (ajax.responseText == "friend request sent") {
				_(elem).innerHTML='OK friend request sent';
			}else if(ajax.responseText == "unfriend_ok"){
				_(elem).innerHTML = '<button onclick="friendToggle(\'friend\',\'<?php echo $u; ?>\',\'friendBtn\')">Request As Friend</button>';
			} else {
				alert(ajax.responseText);
				_(elem).innerHTML = 'Try again later';
			}
			}	
		}
		ajax.send("type="+type+"&user="+user);
	}
	
	