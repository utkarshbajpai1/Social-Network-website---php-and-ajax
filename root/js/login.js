function empty(){
	_('status').innerHTML = "";
}

_('email').addEventListener('focus', empty, false);
_('password').addEventListener('focus', empty, false);

function login(){
	var e = _('email').value,
		p = _('password').value;

	if (e == "" || p == "") {
		_('status').innerHTML = "FILL OUT ALL THE LOGIN DATA";
	}else {
		_('loginbtn').style.display = "none";
		_('status').innerHTML = "please wait ...."
		// start of ajax
		var ajax = ajaxObj('POST','login.php');

		ajax.onreadystatechange = function(){
			if (ajaxReturn(ajax) == true) {
				if (ajax.responseText == "login_failed") {
					_('status').innerHTML = " Login unsuccessfull , please try again ";
					_('loginbtn').style.display = 'block';
				}else{
					window.location = 'user.php?u='+ajax.responseText; 
				}
			}
		}
		
		ajax.send('e='+e+ '&p='+p);

		// end of ajax

	}	

}

_('loginbtn').addEventListener('click', login, false);
