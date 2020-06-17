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
	}else{
		function raw_csv(){
			$conn = mysqli_connect('localhost', 'root', '', 'easeassist');
			if(!$conn)
				die("Please check your connection");
			#array->csv
			$sql="SELECT id,ques,replys from queries";
			if(!$conn->query($sql))
			{
				echo "Error: " . $sql . "<br>" . $conn->error;
			}
			$result = $conn->query($sql);
			$qacsv = array();
			if ($result->num_rows > 0)
			{
				$j=0;
				while($row = $result->fetch_assoc())
				{
					echo $row['id'],$row['ques'],$row['replys'];
					echo "<br>";
					$qacsv[] = array($row['id'],$row['ques'],$row['replys']);
				}
				return $qacsv;	
			}
			$conn->close();
		}
		function final_csv($filename){
			$data = raw_csv();
			$file_path="../files/";
			$file_name = strval($filename);
			$file_name .= ".csv";
			$file_path .= $file_name;
			$fp = fopen($file_path,'w');   
			foreach ($data as $fields) 
			{
				fputcsv($fp, $fields); 
			}
			fclose($fp); 	
		}
		
		final_csv("newtestdata");
		
	}
$conn->close();

?>