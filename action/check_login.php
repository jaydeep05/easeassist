<?php
require 'database.php';
$log_uname = $_POST['log_uname'];
$log_pass = $_POST['log_pass'];


$user_check_query = "SELECT * FROM users WHERE username='".$log_uname."' OR password='".$log_pass."'";
$result = mysqli_query($conn, $user_check_query);
$user = mysqli_fetch_assoc($result);
if (isset($user)) { // if user exists
    if ($user['username'] == $log_uname  & $user['password'] == $log_pass) {
    	$_SESSION['username'] = $log_uname;
    	$_SESSION['user_id'] = $user['id'];
        header("location: ../dashboard.php");
    	}
    	else{
    		echo "<script>alert('username or password not match!')</script>";
    		header('location: ../login.php');  
    	}
}
else{
		echo "<script>alert('username or password not match!')</script>";
		header('location: ../login.php');  
	}
