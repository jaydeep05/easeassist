<?php
	session_start();
	$conn = mysqli_connect('localhost', 'root', '', 'easeassist');
	if(!$conn)
		die("Please check your connection");

?>