<?php
include_once("php_includes/check_login_status.php");

	$u = "";
	$sex = "Male";
	$userlevel = "";
	$country = "";
	$joindate = "";
	$lastsession = "";

if(isset($_GET["u"])){
	$u = preg_replace('#[^a-z0-9]#i', '', $_GET["u"]);
} else {
    header("location: http://localhost/social-Network-website---php-and-ajax/root");
    exit();	
}
// Select the member from the users table
$sql = " SELECT * FROM users WHERE username='$u' LIMIT 1";
$user_query = mysqli_query($db_conx, $sql);
// Now make sure that user exists in the table
$numrows = mysqli_num_rows($user_query);
if($numrows < 1){
	echo "That user does not exist or is not yet activated, press back";
    exit();	
}
// Check to see if the viewer is the account owner
$isOwner = "no";
if($u == $log_username && $user_ok == true){ // $u present in the url matches or not with variable stored in the session when the user is loggedin
	$isOwner = "yes";
}
// Fetch the user row from the query above
while ($row = mysqli_fetch_array($user_query, MYSQLI_ASSOC)) {
	$profile_id = $row["id"];
	$gender = $row["gender"];
	$country = $row["country"];
	$userlevel = $row["userlevel"];
	$signup = $row["signup"];
	$lastlogin = $row["lastlogin"];
	$joindate = strftime("%b %d, %Y", strtotime($signup));
	$lastsession = strftime("%b %d, %Y", strtotime($lastlogin));
	if($gender == "f"){
		$sex = "Female";
	}
}
?>

<?php

$isFriend 		  = false;
$ownerBlockViewer = false;
$viewerBlockOwner = false;
if($u != $log_username && $user_ok == true){
	$friend_check = "SELECT id FROM friends WHERE user1='$log_username' AND user2='$u' AND accepted='1' OR user1='$u' AND user2='$log_username' AND accepted='1' LIMIT 1";
	if(mysqli_num_rows(mysqli_query($db_conx, $friend_check)) > 0){
        $isFriend = true;
    }
	$block_check1 = "SELECT id FROM blockedusers WHERE blocker='$u' AND blockee='$log_username' LIMIT 1";
	if(mysqli_num_rows(mysqli_query($db_conx, $block_check1)) > 0){
        $ownerBlockViewer = true;
    }
	$block_check2 = "SELECT id FROM blockedusers WHERE blocker='$log_username' AND blockee='$u' LIMIT 1";
	if(mysqli_num_rows(mysqli_query($db_conx, $block_check2)) > 0){
        $viewerBlockOwner = true;
    }
}

?>

<?php 
$friend_button = '<button disabled> Request As Friend </button>';
$block_button  = '<button disabled> Block User </button>';

if($isFriend == true){

	$friend_button = '<button onclick="friendToggle(\'unfriend\',\''.$u.'\',\'friendBtn\')">Unfriend</button>';

} 
else if($user_ok == true && $u != $log_username && $ownerBlockViewer == false){

	$friend_button = '<button onclick="friendToggle(\'friend\',\''.$u.'\',\'friendBtn\')">Request As Friend</button>';

}

if($viewerBlockOwner == true){

	$block_button = '<button onclick="blockToggle(\'unblock\',\''.$u.'\',\'blockBtn\')">Unblock User</button>';

} 
else if($user_ok == true && $u != $log_username){

	$block_button = '<button onclick="blockToggle(\'block\',\''.$u.'\',\'blockBtn\')">Block User</button>';
	
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title><?php echo $u; ?></title>
<link rel="icon" href="favicon.ico" type="image/x-icon">
<link rel="stylesheet" href="css/styles.css">
<script src="js/main.js"></script>
<script src="js/ajax.js"></script>
<script src="js/friendSystem.js "></script>
</head>
<body>
<?php include_once("template_pageTop.php"); ?>
<div id="pageMiddle" style="margin-left: 350px;">
  <h3><?php echo $u; ?></h3>
  <p>Is the viewer the page owner, logged in and verified? <b><?php echo $isOwner; ?></b></p>
  <p>Gender: <?php echo $sex; ?></p>
  <p>Country: <?php echo $country; ?></p>
  <p>User Level: <?php echo $userlevel; ?></p>
  <p>Join Date: <?php echo $joindate; ?></p>
  <p>Last Session: <?php echo $lastsession; ?></p>
</div>
	
  <p>Friend Button: <span id="friendBtn"><?php echo $friend_button; ?></span></p>
  <p>Block Button: <span id="blockBtn"><?php echo $block_button; ?></span></p>

<?php include_once("template_pageBottom.php"); ?>
</body>
</html>