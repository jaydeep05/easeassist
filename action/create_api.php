<?php
    require_once 'database.php';
    $projectID = $_REQUEST['pro_id'];
    $username = $_SESSION['username'];
    $cred_key = $_REQUEST['cred_key'];
    $userID = $_SESSION['user_id'];
    $credName = $_REQUEST['cred_Name'];

    if($projectID!=""){
        $check_query = "SELECT * FROM credentials WHERE proj_id='".$projectID."' LIMIT 1";
        $check = $conn->query($check_query);
        if($check->num_rows == 0){
            if($cred_key!=""){
                if($credName!=""){
                    $result = $conn->query("INSERT INTO `credentials`(`cred_name`, `cred_key`, `proj_id`, `user_id`) VALUES ('".$credName."','".$cred_key."','".$projectID."','".$userID."')");
                    if($result){
                        echo "success";
                    }
                }else{
                    echo "credential name required";
                }
            }else{
                echo "key required";
            }
        }
        if($check->num_rows > 0){
            echo "One key already exist in project";
        }
        
    }else{
        echo "project name is required";
    }

    $conn->close();
