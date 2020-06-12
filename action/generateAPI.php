<?php
    require_once 'database.php';
    $username = $_SESSION['username'];
    if(isset($_REQUEST['pro_id'])){
        $projectID = $_REQUEST['pro_id'];
    }    
    $private_key = "GLS";

    // $project = $conn->query($sql1);

    
        if($projectID!=""){
            $sql1 = mysqli_query($conn,"SELECT `id`,`project_name` FROM `projects` WHERE `id`= '".$projectID."'");
            $row = mysqli_fetch_row($sql1);
            // echo "<pre>".$projectID;
            $projectName = $row[1];
            $key = generateAPI($username,$projectName,$private_key);
            echo $key;
        }else {
            // echo "Select project first".$_REQUEST['pro_id'];
        }
    
    

    function generateAPI($name,$project,$pkey){
        $name = strtoupper($name);
        $project = strtoupper($project);
        $date = date("H:i:s");
        $keyString = $pkey.",".$name.",".$project.",".$date;
        $key = md5($keyString);
        return $key;
    }

    $conn->close();