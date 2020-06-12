<?php
// requires php5
// define('UPLOAD_DIR', 'uploads/');
// $img = $_POST['wavBase64'];
// $img = str_replace('data:audio/wav;base64,', '', $img);
// $img = str_replace(' ', '+', $img);
// $data = base64_decode($img);
// $file = UPLOAD_DIR . uniqid() . '.wav';
// $success = file_put_contents($file, $data);
// print $success ? $file : 'Unable to save the file.';



$uploads_dir = '/Applications/XAMPP/xamppfiles/htdocs/php/SGH000699/Hackathon_php/ease/uploads';
print_r($_FILES);
//this will print out the received name, temp name, type, size, etc. 
$input = $_FILES['audio_data']['tmp_name']; //get the temporary name that PHP gave to the uploaded file 
$output = $_FILES['audio_data']['name'].".wav"; //letting the client control the filename is a rather bad idea 
//move the file from temp name to local folder using $output name 
rename($input, "/Applications/XAMPP/xamppfiles/htdocs/php/SGH000699/Hackathon_php/ease/uploads/test.wav");

// chmod("/Applications/XAMPP/xamppfiles/htdocs/php/SGH000699/Hackathon_php/ease/uploads/test.wav", 0777);

echo shell_exec('~/opt/anaconda3/python.app/Contents/MacOS/python /Applications/XAMPP/htdocs/php/SGH000699/Hackathon_php/ease/py/gSTT.py "/Applications/XAMPP/htdocs/php/SGH000699/Hackathon_php/ease/uploads/test.wav" 2>&1'); 
