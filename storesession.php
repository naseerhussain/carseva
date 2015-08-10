<?php
	//echo $_POST['mobile'];
	session_start();
	$_SESSION['mobile'] = $_POST['mobile'];
	$_SESSION['pwd'] = $_POST['pwd'];
	echo $_SESSION['mobile'];
?>