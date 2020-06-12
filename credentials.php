<?php 
  include_once 'action/database.php';
  $uname = $_SESSION['username'];
  $uid = $_SESSION['user_id'];
  $credentials = "SELECT * FROM `credentials` WHERE `user_id`=".$uid;
?>
<div class="container-fluid">
  <h1 class="mt-4">Create credentials for API</h1><hr>
  <div>
    <p>You can choose option to create
        your project. while choosing prebuild response you can our prebuild
        response directory and custom response will let you create you create
        your own set of response</p>
  </div>
  <div class="row">
  	<div class="col-md-12">
  		<button class="bton mb-3" id="new_api">Create new credentials</button>
  	</div>
    <div class="col-md-12">
    	<?php
    		$cred = $conn->query($credentials);
    		if($cred->num_rows > 0){ 
    			$count = 1; ?>
    			<table class="table">
                    <thead>
                        <tr>
                        	<th>Sr.</th>
                        	<th>Cred Name</th>
                        	<th>Key</th>
                        </tr>
                    </thead>
                    <tbody>
                    	<?php    
                        while($row = $cred->fetch_assoc()) { ?>
                            <tr>
                    			<td><?php echo $count; ?></td>
                                <td><?php echo $row['cred_name']; ?></td>
                                <td><?php echo $row['cred_key']; ?></td>
                    		</tr>
                    		<?php $count = $count + 1; ?>
                    	<?php } ?>
                    </tbody>
    			</table>

    	<?php	}else{
    		echo "<p>create new API</p>";
    	}
    	?>
    </div>
  </div>
</div>

<script type="text/javascript">
	$("#new_api").click(function(){
		$("#main").load("edit-api.php");
	});
</script>