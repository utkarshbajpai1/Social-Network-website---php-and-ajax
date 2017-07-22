<!doctype html>
<html>
	<head>
		<title>php-Social Network</title>
		<script src="https://use.fontawesome.com/920a43d2cd.js"></script>
		<link rel="stylesheet" href="css/styles.css">
		<link rel="stylesheet" href="css/signup.css">
		<script src="js/main.js"></script>
		<script src="js/ajax.js"></script>
		<script src="js/signup.js"></script>
	</head>
	<body>
		<?php include_once("template_pageTop.php"); ?>

		<div id="pageMiddle">

			 <h3 style="margin-left: 350px;">Sign Up Here</h3>

			  <form name="signupform" id="signupform" onsubmit="return false;">

			    <div>Username: </div>
			    <input id="username" type="text" onblur="checkusername()" onkeyup="restrict('username')" maxlength="16">
			    <span id="unamestatus"></span>
			    <div>Email Address:</div>
			    <input id="email" type="text" onfocus="emptyElement('status')" onkeyup="restrict('email')" maxlength="88">
			    <div>Create Password:</div>
			    <input id="pass1" type="password" onfocus="emptyElement('status')" maxlength="16">
			    <div>Confirm Password:</div>
			    <input id="pass2" type="password" onfocus="emptyElement('status')" maxlength="16">
			    <div>Gender:</div>
			    <select id="gender" onfocus="emptyElement('status')">
			      <option value=""></option>
			      <option value="m">Male</option>
			      <option value="f">Female</option>
			    </select>
			    <div>Country:</div>
			    <select id="country" onfocus="emptyElement('status')">
			      <?php include_once("template_country_list.php"); ?>
			    </select>
			    <div>
			      <a href="#" onclick="return false" onmousedown="openTerms()">
			        View the Terms Of Use
			      </a>
			    </div>
			    <div id="terms" style="display:none;">
			      <h3>Web Intersect Terms Of Use</h3>
			      <p>1. Play nice here.</p>
			      <p>2. Take a bath before you visit.</p>
			      <p>3. Brush your teeth before bed.</p>
			    </div>
			    <br /><br />
			    <button id="signupbtn" onclick="signup()">Create Account</button>
			    <span id="status"></span>

			  </form>

		</div>

		<?php include_once("template_pageBottom.php"); ?>
	</body>
</html>