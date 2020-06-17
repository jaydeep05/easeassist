<?php

// function storing_data(){
// 	$conn = mysqli_connect('localhost', 'root', '', 'easeassist');
// 	if(!$conn)
// 		die("Please check your connection");
// 	$i=0;
// 	foreach ($_POST as $key => $value) 
// 	{	
// 		// echo $value."<br>";
// 		if($i%2==0){
// 			$q = $value;
// 		}elseif(isset($q)){
// 			$a = $value;
// 			echo "q ".$q."<br>"."a ".$a."<br>";
// 			$sql="INSERT INTO response (`question`,`answer`) VALUES('".$q."','".$a."')";
// 			if(!$conn->query($sql)){
// 				echo "Error: " . $sql . "<br>" . $conn->error;
// 			}
			
// 		}
// 		$i=$i+1;
// 	}
// 	$conn->close();
// }
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
	$file_path="./files/";
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
