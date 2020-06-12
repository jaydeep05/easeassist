 
 <!DOCTYPE html>
<html lang="en">
<head>
    <title>EaseAssist</title>
    <style type="text/css">
    	body{
    		background-image: url('Home.png');
    		background-repeat: no-repeat;
			background-position: bottom;
			height: 100vh;	
    	}
    	.form-signin{
    		width: 100%;
		    max-width: 330px;
		    padding: 15px;
		    margin: 0 auto;	
    	}
    	.login-btn{
    		width: 100px;
			background: #f79940;
			color: white;
    	}
    	.card-header, .card-body{
    		border-block-color: unset;
    	}
    	input{
    		width: 100%;
    	}
    </style>
</head>
<body>
	<?php include 'header.php';?>
	<div class="body-content">
		<div class="container">
			<div class="card mt-5 form-signin" style="background-color: #eaeaea5e;">
				<div class="card-header">
					<h1>Login</h1>
				</div>
				<div class="card-body">
					<form action="action/check_login.php" method="POST">
						<div class="form-group">
							<label for="username">Username</label>
							<input type="text" name="log_uname" id="username" placeholder="Username" required>
						</div>
						<div class="form-group">
							<label for="password">Password</label>
							<input type="password" name="log_pass" id="password" placeholder="Password" required>
						</div>
						<button class="btn login-btn mb-3">Login</button>
					</form>
					<a href="register.php">Not Registered?</a>
				</div>
			
			</div>
		</div>
	</div>
</body>
</html>