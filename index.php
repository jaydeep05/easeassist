<?php include 'header.php';?>
<!DOCTYPE html>
<html>
<head>
<style type="text/css">
	body{
    		background-image: url('Home.png');
    		background-repeat: no-repeat;
			background-position: bottom;
			height: 100vh;

    	}
   /* img {
    	width: 4%;
	}*/
	.mic_img{
		padding: 2em;
		vertical-align :justify-content-center ;

	}
	.get_started_btn{
		background: #de993e;
	    color : #ffffff;
	    font-size: x-large;
	}
	.center{
		text-align: center;
	}
    .col
    {
    	height: 100px;
    	width:  50px;
    	float: left;
    	
    }
	.img {

    vertical-align: middle;
    border-style: none;
    opacity: 90%;

	}

</style>
</head>
<body>

	<div id="main_body" class="container">
		<div class="row center">
			<div class="mic_img col-12">
					<img src="mic.png">
			</div>
			<div class="col-12">
				<h1>A place to create your own <b><font color ="#3d71de">Voice Assistant</font></b></h1>
			</div>
			<div class="col">
				<a href="<?php if(isset($_SESSION['username'])){ echo "dashboard.php"; }else{ echo "login.php"; } ?>"><button class="btn get_started_btn mt-5" type="submit">Get Started</button></a>
			</div>
 		</div>
	</div>

	
</body>
</html>