<?php
include_once("php_includes/check_login_status.php");
// If user is already logged in, header that weenis away
if($user_ok == true){
	header("location: user.php?u=".$_SESSION["username"]);
    exit();
}
?>
<?php 
	if (isset($_POST['e'])) {
		include_once('php_includes/db_conx.php');
		$e = mysqli_real_escape_string($db_conx, $_POST['e']);

		include_once('php_includes/crypt.php');
		$p = md5($_POST['p']);

		$ip = preg_replace('#[^0-9.]#', '', getenv('REMOTE_ADDR'));

		if ($e == "" || $p == "") {
			echo 'login_failed';
			exit();
		}else{

			$sql = "SELECT id, username, password 
					FROM users 
					WHERE email='$e'
					LIMIT 1";
			$query = mysqli_query($db_conx, $sql);
			$row   = mysqli_fetch_row($query);
			$db_id 			= $row[0];
			$db_username 	= $row[1];
			$db_pass_str	= $row[2];

			if ($p != $db_pass_str) {
				echo 'login_failed';
				exit();
			}else{
				$_SESSION['userid'] 	= $db_id;
				$_SESSION['username'] 	= $db_username;
				$_SESSION['password'] 	= $db_pass_str;

				setcookie("id", $db_id, strtotime( '+30 days' ), "/", "", "", TRUE);
				setcookie("user", $db_username, strtotime( '+30 days' ), "/", "", "", TRUE);
	    		setcookie("pass", $db_pass_str, strtotime( '+30 days' ), "/", "", "", TRUE);

	    		$sql = "UPDATE users SET ip='$ip', lastlogin=now() WHERE username='$db_username' LIMIT 1";
	            $query = mysqli_query($db_conx, $sql);
				echo $db_username;
			    exit();
 			}

		}
 	}
?>

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
