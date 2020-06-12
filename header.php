<?php include 'action/database.php'; ?>
<?php if(isset($_SESSION['username'])){
    // header('Location=dashboard.php');
}else{
    
} ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width" />
    <title>EaseAssist</title>   
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/all.css">
 </head>
<body>
    <div id="main_header" class="row header">
    	<div class="col-md-4 header_cols">
    		<div class="col-md-12">
                <img src="EA_Logo.png">
            </div>
    	</div>
    	<div class="col-md-3 header_cols">
    		<div>	</div>
    	</div>
    	<div class="col-md-5 header_cols">
    		<div class="col-md-2 header_links">
                <a href="index.php">Home</a>
            </div>
            <div class="col-md-3 header_links">
                <a href="#">About Us</a>
            </div>
            <div class="col-md-3 header_links">
                <a href="#">Contact us</a>
            </div>
            <div class="col-md-4 header_links_last">
               	<a class="dashlink" href="<?php if(isset($_SESSION['username'])){ echo "dashboard.php"; }else{ echo "login.php"; } ?>">Go to Dashboard</a>
            </div>
    	</div>
    </div>
</body>