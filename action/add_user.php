<?php
// session_start();
require 'database.php';
$email = $_POST['reg_email'];
$username = $_POST['reg_uname'];
$password = $_POST['reg_pass'];

$user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email'";
$result = mysqli_query($conn, $user_check_query);
$user = mysqli_fetch_assoc($result);
if ($user) { // if user exists
    if ($user['username'] === $username || $user['email'] === $email) 
    	{ 
    		echo "<script>alert('username or mail already exists!')</script>";
    		header('location: ../register.php');  
    }
}
else{

$sql="INSERT INTO users(email,username,password) VALUES('$email','$username','$password')";
if ($conn->query($sql) == TRUE) { header('location: ../login.php');} 
else { echo "Error: " . $sql . "<br>" . $conn->error; }}
$_SESSION['login'] = $username; 
$conn->close();

?>