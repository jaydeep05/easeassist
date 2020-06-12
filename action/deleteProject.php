<?php 
	require_once 'database.php';
	if($_REQUEST['pro_id']!=""){
		$project_id = $_REQUEST['pro_id'];
		$sql = "DELETE FROM `projects` WHERE `id`=".$project_id;
		if($conn->query($sql)){
			echo "project deleted";
		}else{
			echo "failes";
		}
	}

$conn-close();
