<?php
	include 'database.php';
	$q = $_POST['q1'];
	$a = $_POST['a1'];
	$user_id = $_POST['uid'];
	$pro_id = $_POST['pid'];
	echo "<script>alert('".$q." ' ".$a.")</script>";
	$sql="INSERT INTO `queries` (`ques`,`replys`,`user_id`,`pro_id`) VALUES('".$q."','".$a."','".$user_id."','".$pro_id."')";
	if(!$conn->query($sql)){
		echo "Error: " . $sql . "<br>" . $conn->error;
	}
$conn->close();

?>