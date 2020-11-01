<?php 
	session_start();
	unset($_SESSION['role']);
	unset($_SESSION['username']);
	$_SESSION['start']="no";
	header('location:login.php');
	die();
?>