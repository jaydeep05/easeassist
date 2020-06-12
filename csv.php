<?php
$ques = $_POST['que'];
$message=$ques;
$qacsv_file="testdata.csv";
$text_UserInuput = 'http://127.0.0.1:8000/phpmessage?type=text&message=';
$text_UserInuput .= $message;
$text_UserInuput .='&qacsv=';
$text_UserInuput .= $qacsv_file;
$temp = "Location: ";
$temp .= $text_UserInuput;
header($temp, TRUE,301);
#Gettin the value from the Django.
// if(isset($_GET['val3']))
// {
//    echo "ID : ",$_GET['val1'],"Question : ",$_GET['val2'],"Ans : ",$_GET['val3'];
// }
// else
// {
//    echo $_GET['val1'];
// }
