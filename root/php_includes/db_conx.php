<?php 
	
	$db_conx = mysqli_connect('localhost', 'root', '', 'socialNetwork');

	if (mysqli_connect_errno()) {
		echo mysqli_connect_error();
		exit();
	}else{
		echo "database connection suucessfully established";
	}
?>