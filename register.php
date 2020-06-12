<?php include 'header.php';?>
<style type="text/css">
    	body{
    		background-image: url('Home.png');
    		background-repeat: no-repeat;
  			background-size: 100% ;
  			background-attachment: fixed;
			background-position: bottom;

    	}
    </style>
	<div class="container body-content">
    	<body>
		<div class="container">
			<div class="row justify-content-center" style="padding-top:30px;">
				<h1><b style="color:#4090ce;">Register</b></h1>
			</div>
			<div class="row justify-content-center" style="display: flex; flex-flow: row wrap; align-items: center; padding-top:5px;">
				<!--?php  include  'error.php';?>-->
				<form action="action/add_user.php" method="POST">
				 <input type="text" placeholder="Email Address" name="reg_email" style="vertical-align: middle;padding: 5px;" required><br><br>	
					<input type="text" name="reg_uname" placeholder="Username" style="vertical-align: middle;padding: 5px;" required><br><br>
					<input type="password" name="reg_pass" placeholder="Password" style="vertical-align: middle;padding: 5px;padding-right: 10px;" required>
					<div class="row justify-content-center" style="padding-top:30px;">
						<input type="submit" value="Register" style="vertical-align: middle;border-radius: 20px; font-weight: bold; font-size: 18px; width:150px; height:60px; background: #f79940; color: white; vertical-align: middle;">
					</div>
				</form>
			</div>
		</div>

</html>