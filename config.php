<?php
	$conn = new mysqli("localhost","root","","beosound");
	if($conn->connect_error){
		die("Connection Failed!".$conn->connect_error);
	}
?>