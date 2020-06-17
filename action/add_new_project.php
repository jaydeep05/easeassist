<?php
	include 'database.php';
	$pname = $_POST['pname'];
	$cname = $_POST['cname'];
	$dname = $_POST['dname'];
	$ptype = $_POST['ptype'];
	$uid = $_POST['uid'];
	$sql = "INSERT INTO `projects` (`project_name`, `company_name`, `developer_name`, `project_type`, `user_id`) VALUES ('".$pname."','".$cname."','".$dname."','".$ptype."','".$uid."')";
	if(!$conn->query($sql)){
		echo "Error ".$sql."<br>".$conn->error;
	}else{
		echo "<script>alert('success')</script>";
	}

	$conn->close();
