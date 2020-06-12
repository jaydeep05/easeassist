<?php
    include 'server.php';
    
    $userActualKey = "f0f83fe3b809bda906c094076e25c8ec";
    if(isset($_REQUEST['key'])){
        echo "key set ".$_REQUEST['key'];
        $userEnteredKey = $_REQUEST['key'];
        $sql = "SELECT * FROM  `credentials` WHERE `credential_key`='".$_REQUEST['key']."'";
        $data = $conn->query($sql);
    }
    if(isset($data)){
        if ($data->num_rows > 0) {
            // output data of each row
            while($row = $data->fetch_assoc()) {
                echo "id: " . $row["id"]. " - Name: " . $row["credential_name"]. " " . $row["credential_key"]." ".$row["user_id"]." ".$row["project_id"]." ".$row["date_created"];
            }
        } else {
            echo "0 results";
        }
    }
    $conn->close();
    $validate = "FALSE";
    if(isset($userEnteredKey)){
        echo "<br>key set ".$userActualKey;
        if($userActualKey == $userEnteredKey){
            echo " session approved ";
            $validate = "TRUE";
        }
    }else{
        $validate = "FALSE";
    }
    
    echo "<br>".$validate;

    if($validate == "TRUE"){
        include_once('modules.php');
    }
