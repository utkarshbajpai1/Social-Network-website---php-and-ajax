<?php 
	session_start();
	if(isset($_SESSION["username"])){
		header("location: message.php?msg=hello user is already logged in");
		exit();
	}
	
?>

<?php 

	if(isset($_POST["usernamecheck"])){
		include_once("php_includes/db_conx.php");
		$username = preg_replace('#[^a-z0-9]#i', '', $_POST['usernamecheck']);
		$sql = "SELECT id
				FROM users
				WHERE username='$username'
				LIMIT 1";
		$query 		 = mysqli_query($db_conx, $sql);
		$uname_check = mysqli_num_rows($query);	

		if (strlen($username) < 3 || strlen($username) > 16) {
				echo '<strong style="color:brown;"> 3-16 characters please </strong>';
				exit(); 
		}	

		if (is_numeric($username[0])) {
	    echo '<strong style="color:#F00;">Usernames must begin with a letter</strong>';
	    exit();
    	}
    	if ($uname_check < 1) {
	    echo '<strong style="color:#009900;">' . $username . ' is OK</strong>';
	    exit();
    } else {
	    echo '<strong style="color:#F00;">' . $username . ' is taken</strong>';
	    exit();
    }

	}
?>

<?php
	if(isset($_POST["u"])){
		include_once("php_includes/db_conx.php");
		$u = preg_replace('#[^a-z0-9]#i', '', $_POST['u']);
		$e = mysqli_real_escape_string($db_conx,$_POST['e']);
		$p = $_POST['p'];
		$g = preg_replace('#[^a-z]#i', '', $_POST['g']);
		$c = preg_replace('#[^a-z]#i', '', $_POST['c']);

		$ip = preg_replace('#[^0-9.]#', '', getenv('REMOTE_ADDR'));

		$sql = "SELECT id
				FROM users
				WHERE username = '$u'
				LIMIT 1";
		$query = mysqli_query($db_conx, $sql);
		$u_check = mysqli_num_rows($query);

		$sql = "SELECT id
				FROM users
				WHERE email='$e'
				LIMIT 1";
		$query = mysqli_query($db_conx, $sql);
		$e_check = mysqli_num_rows($query);	

		if($u == "" || $e == "" || $p == "" || $g == "" || $c == ""){
		echo "The form submission is missing values.";
        exit();
	} else if ($u_check > 0){ 
        echo "The username you entered is alreay taken";
        exit();
	} else if ($e_check > 0){ 
        echo "That email address is already in use in the system";
        exit();
	} else if (strlen($u) < 3 || strlen($u) > 16) {
        echo "Username must be between 3 and 16 characters";
        exit(); 
    } else if (is_numeric($u[0])) {
        echo 'Username cannot begin with a number';
        exit();
    } else{
    	// hashing and insertion of data
    	include_once("php_includes/crypt.php");
    	$cryptPass = cryptPass($p);

		$sql = "INSERT INTO users (username,email,password,gender, country, ip, signup, lastlogin, notescheck)       
		    VALUES('$u','$e','$cryptPass','$g','$c','$ip',now(),now(),now())";
		$query = mysqli_query($db_conx, $sql); 
		$uid = mysqli_insert_id($db_conx);  
		
		$sql = "INSERT INTO useroptions (id, username, background) VALUES ('$uid','$u','original')";
		$query = mysqli_query($db_conx, $sql);

		if (!file_exists("user/$u")) {
			mkdir("user/$u", 0755);
		}	

		echo "signup_success";
		exit();	
		} 

		exit(); 
    }

	
?>

<!DOCTYPE html>
<html>
	<head>
		<title>php-Social Network</title>
		<script src="https://use.fontawesome.com/920a43d2cd.js"></script>
		<link rel="stylesheet" href="css/styles.css">
		<link rel="stylesheet" href="css/signup.css">
		<script src="js/main.js"></script>
		<script src="js/ajax.js"></script>
		
	</head>
	<body>
		<?php include_once("template_pageTop.php"); ?>

		<div id="pageMiddle">

			 <h3 style="margin-left: 350px;">Sign Up Here</h3>

			  <form name="signupform" id="signupform" onsubmit="return false;">

			    <div>Username: </div>
			    <input id="username" type="text" maxlength="16">
			    <span id="unamestatus"></span>
			    <div>Email Address:</div>
			    <input id="email" type="text" maxlength="88">
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
		<script src="js/signup.js"></script>
	</body>
</html>