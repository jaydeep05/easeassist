<?php

$uploads_dir = '../uploads'; //'/Applications/XAMPP/xamppfiles/htdocs/php/SGH000699/Hackathon_php/ease/uploads';
print_r($_FILES);
//this will print out the received name, temp name, type, size, etc. 
$input = $_FILES['audio_data']['tmp_name']; //get the temporary name that PHP gave to the uploaded file 
$output = $_FILES['audio_data']['name'].".wav"; //letting the client control the filename is a rather bad idea 
//move the file from temp name to local folder using $output name 
rename($input, $uploads_dir."/test.wav");//"/Applications/XAMPP/xamppfiles/htdocs/php/SGH000699/Hackathon_php/ease/uploads/test.wav");

chmod("/Applications/XAMPP/xamppfiles/htdocs/php/easeassist/uploads/test.wav", 0777);
echo "success";
// echo shell_exec('~/opt/anaconda3/python.app/Contents/MacOS/python /Applications/XAMPP/htdocs/php/easeassist/py/gSTT.py "/Applications/XAMPP/htdocs/php/easeassist/uploads/test.wav" 2>&1'); 
