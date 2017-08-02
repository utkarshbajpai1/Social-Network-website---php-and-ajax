<!-- there must be check login status file -->

<?php 

$envelope = '<img src="images/note_dead.jpg" width="40" height="20" alt="Notes" title="This envelope is for logged in members">';
$loginLink = '<a href="login.php">Log In</a> &nbsp; | &nbsp; <a href="signup.php">Sign Up</a>';

if ($user_ok == true) {

	$sql = "SELECT notescheck
			FROM users
			WHERE username = '$log_username'
			LIMIT 1
			";
	$query = mysqli_query($db_conx, $sql);
	$row = mysqli_fetch_row($query);
	$notescheck = $row[0];

	$sql = "SELECT id 
			FROM notifications
			WHERE username = '$log_username' AND date_time > '$notescheck'
			LIMIT 1
			";
	$query = mysqli_query($db_conx, $sql);
	$numrows = mysqli_num_rows($query);

	if ($numrows == 0) {

		$envelope = '<a href="notifications.php" title="Your notifications and friend requests"><img src="images/note_still.jpg" width="22" height="12" alt="Notes"></a>';

	}else{

		$envelope = '<a href="notifications.php" title="You have new notifications"><img src="images/note_flash.gif" width="22" height="12" alt="Notes"></a>';

	}			


	$loginLink = '<a href="user.php?u='.$log_username.'">'.$log_username.'</a> &nbsp; | &nbsp; <a href="logout.php"> Logout </a>';
}
?>

<div id="pageTop">
			<div id="pageTopWrap">
 
				<div id="pageTopLogo">
					<a href="http:\\www.google.com"> <img src="images/logo.jpg" alt="logo"> </a>
				</div>

				<div id="pageTopRest">
					<div id="menu1">
						<div>
							<?php echo $envelope; ?> &nbsp; &nbsp;	<?php echo $loginLink;?>
 						</div>
					</div>
					<div id="menu2">
						<div>
							<a href="#"> <i class="fa fa-home fa-2x" aria-hidden="true"></i> </a>
							<a href="#"> Menu_Item_1 </a>
							<a href="#"> Menu_Item_2 </a>
						</div>
					</div>
				</div>

			</div>
</div>