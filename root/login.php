<!DOCTYPE html>
<html>
	<head>
		<title> login-page </title>
		<link rel="stylesheet" href="css/styles.css">
		<link rel="stylesheet" href="css/login.css">
	</head>	

	<body>
		<?php include_once("template_pageTop.php"); ?>
		
		<div id="pageMiddle" style="margin-left: 400px;">
			  <h3>Log In Here</h3>
			  <!-- LOGIN FORM -->
			  <form id="loginform" onsubmit="return false;">
				    <div>Email Address:</div>
				    <input type="text" id="email" maxlength="88">
				    <div>Password:</div>
				    <input type="password" id="password" maxlength="100">
				    <br /><br />
				    <button id="loginbtn">Log In</button> 
				    <p id="status"></p>
				    <a href="#">Forgot Your Password?</a>
			  </form>
			  <!-- LOGIN FORM -->
		</div>

		<?php include_once("template_pageBottom.php"); ?>
		<script src="js/main.js"></script>	
		<script src="js/ajax.js"></script>	
		<script src="js/login.js"></script>	
	</body>
</html>		
