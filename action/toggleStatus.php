<?php

	include_once 'database.php';

    $pro_id = $_REQUEST['proid'];
    $status = $_REQUEST['staus'];
    // echo "<script> console.log('in next php'); </script>";
    if(isset($pro_id) && isset($status)){
    	if($status=="enable"){
    		$sql = "UPDATE `projects` SET `status`=1 WHERE `id`=".$pro_id;
    		if($conn->query($sql)){
    			echo "status changed";
    		}else{
    			echo "error in sql";
    		}    		
    	}
    	if($status=="disable"){
    		$sql = "UPDATE `projects` SET `status`=0 WHERE `id`=".$pro_id;
    		if($conn->query($sql)){
    			echo "status changed";
    		}else{
    			echo "error in sql";
    		}
    	}
    }else {
    	echo "Request failed";
    }

$conn->close();