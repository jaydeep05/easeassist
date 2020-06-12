<?php //include "sidebar.php"; 
session_start(); 
if(!$_SESSION['username'])
{    
    header("Location: ../login.php");
}
else
	header("Location: ../dashboard.php")

?>