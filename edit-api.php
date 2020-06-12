<?php 
  require_once 'action/database.php';
  $uname = $_SESSION['username'];
  $uid = $_SESSION['user_id'];
  $credentials = "SELECT * FROM `credentials` WHERE `user_id`=".$uid;
  // $cred_count = $conn->query("SELECT COUNT(id) FROM `credentials`");
  // $cred_Name = "Cred_".$cred_count+1;
  $sql1 = "SELECT * FROM `projects` WHERE `user_id`= '".$uid."'";
?>
<style type="text/css">
	#credKey {
	    border: #cecece 1px solid;
	    height: 2rem;
	    line-height: 1.7;
	    max-width: 350px;
	}
</style>
<div class="container-fluid">
  <h1 class="mt-4">Create credentials for API</h1><hr>
  <div class="row">
  	<div class="col-md-12">
  		<!-- <form id="cred-form"> -->
  			<div class="form-group">
  				<label for="credName">Credential Name<i style="color: red;">*</i></label>
  				<input type="text" id="credName">
  			</div>
  			<div class="form-group">
  				<label for="credKey">Key<i style="color: red;">*</i></label>
  				<div id="credKey" class="inputBorder"></div>
  				<button id="generateKey" class="mt-2">create KEY</button>
  			</div>
  			<div class="form-group">
  				<label for="proj_id">Project<i style="color: red;">*</i></label>
  				<?php
  					$projects = $conn->query($sql1);
  					if ($projects->num_rows > 0) {
			      echo "<select id='proj_id'>";
			      echo "<option value=\"none\" selected disabled hidden> Select an Option </option> ";    
			      while($row = $projects->fetch_assoc()) { ?>
			          <option value = '<?php echo $row['id']; ?>'><?php echo $row['project_name']; ?></option>  
			          <?php          
			      }
			      echo "</select>";
			      
			    } ?>
  				<!-- <input type="hidden" name="pro_id" id="pro_id" value=""> -->
  			</div>
  			<button class="bton save">Save</button>
  			<button class="bton1">Back</button>
  		<!-- </form> -->
    </div>
  </div> 

</div>

<script type="text/javascript">
	$("button.bton1").click(function(){
		$("#main").load("credentials.php");
	});
	$("button#generateKey").click(function(){
		var pro_id = $("#proj_id").val();
		$.post(
			"action/generateAPI.php",
			{pro_id: pro_id},
			function(response){
				$('#credKey').html(response);
			}
		)
	});
	$("button.save").click(function(){
		var cred_Name = $("#credName").val();
		var cred_key = $("#credKey").text();
		var pro_id = $("#proj_id").val();
		console.log(cred_Name+" "+cred_key+" "+pro_id);
		$.post(
			"action/create_api.php",
			{cred_Name: cred_Name, cred_key: cred_key, pro_id: pro_id},
			function(response){
				console.log(response);				
				if(response=="success"){
					$("#main").load("credentials.php");
				}else{
					alert(response);
				}
			}
		)
	});

</script>