	<?php include 'header.php'; ?>
	<div class="container body-content">
		<div class="container">
			<div class="row justify-content-center" style="padding-top:65px;">
				<div class="row justify-content-center" style="padding-top:30px;">
					<h3><b style="color:#4090ce;">Create New Project</b></h3>
				</div>
			</div>
			<div class="row justify-content-center" style="padding-left:18px;">
					<form action="create_project.php" method="POST">

					<input type="text" name="project_name" style="padding: 10px 30px;">
				</div>
			<div class="row justify-content-center" style="padding-top:35px;">
					<input type="submit" value="Start" style="border-radius:20px; font-weight:bold; font-size:18px; width:150px; height:60px; background: #f79940; color: white;">
				</form>
			</div>
			<div id="box">
				<a href="#" onClick="<?php $_REQUEST['PHP_SELF'];?>"><img src="image/game.jpeg" id="plus"></a>
				<a href="#" onClick="<?php $_REQUEST['PHP_SELF'];?>"><img src="image/ship.png" id = "plus"></a>
			</div>

		</div>
	</div>
</body>
</html>