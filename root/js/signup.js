var user = document.getElementById('username');
	user.addEventListener('blur',checkusername,false);
	user.addEventListener('keyup', function restrict(){

		var tf 	   = _('username');
		var rx 	   = new RegExp;
			rx 	   = /[^a-z0-9]/gi;
		tf.value   = tf.value.replace(rx, "");

	}, false);

var email = document.getElementById("email");
	email.addEventListener("focus", emptyElement, false);
	email.addEventListener("keyup", function restrict(){

		var tf 		= _('email');
		var rx 		= new RegExp;
			rx 		= /[^a-z0-9]/gi;
		tf.value 	= tf.value.replace(rx, "");

	}, false);

var pass1 	= document.getElementById('pass1');
	pass1.addEventListener("focus", emptyElement, false);	

var pass2 	= document.getElementById('pass2');
	pass2.addEventListener("focus", emptyElement, false);

var gender 	= document.getElementById("gender");
	gender.addEventListener("focus", emptyElement, false);		

var country = document.getElementById("country");
	country.addEventListener("focus", emptyElement, false);			

function emptyElement(){
	_('status').innerHTML = "";
}
function checkusername(){
	var u = _("username").value; // defined for input fields
	if(u != ""){
		_("unamestatus").innerHTML = 'checking ...';
		var ajax = ajaxObj("POST", "signup.php");
        ajax.onreadystatechange = function() {
	        if(ajaxReturn(ajax) == true) {
	            _("unamestatus").innerHTML = ajax.responseText;
	        }
        }
        ajax.send("usernamecheck="+u);  // need to see
	}
}

function signup(){
	var u 	= _("username").value;
	var e 	= _("email").value;
	var p1 	= _("pass1").value;
	var p2 	= _("pass2").value;
	var c 	= _("country").value;
	var g 	= _("gender").value;
	var status = _("status");
	if(u == "" || e == "" || p1 == "" || p2 == "" || c == "" || g == ""){
		status.innerHTML = "Fill out all of the form data";
	} else if(p1 != p2){
		status.innerHTML = "Your password fields do not match";
	} else if( _("terms").style.display == "none"){
		status.innerHTML = "Please view the terms of use";
	} else {
		_("signupbtn").style.display = "none";
		status.innerHTML = 'please wait ...';
		var ajax = ajaxObj("POST", "signup.php");
        ajax.onreadystatechange = function() {
	        if(ajaxReturn(ajax) == true) {
	            if(ajax.responseText != "signup_success"){
					status.innerHTML = ajax.responseText;
					_("signupbtn").style.display = "block";
				} else {
					window.scrollTo(0,0);
					_("signupform").innerHTML = "OK "+u+", check your email inbox and junk mail box at <u>"+e+"</u> in a moment to complete the sign up process by activating your account. You will not be able to do anything on the site until you successfully activate your account.";
				}
	        }
        }
        ajax.send("u="+u+"&e="+e+"&p="+p1+"&c="+c+"&g="+g);
	}
}
function openTerms(){
	_("terms").style.display = "block";
	emptyElement("status");
}
/* function addEvents(){
	_("elemID").addEventListener("click", func, false);
}
window.onload = addEvents; */