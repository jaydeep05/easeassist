<div class="container-fluid">
  <h1 class="mt-4">Choose Response Type</h1><hr>
  <?php
  	session_start();
  	print_r($_SESSION); 
  	$addMethod = $_REQUEST['addMethod'];
  	// $addMethod = "prebuilt";
  ?>
  <?php if($addMethod == "custom") { ?>
  	<div class="row">
	    <div class="col-md-12">
			<form method="POST"> <!-- add_qa.php -->
				<div class="row col-md-12">
					<div id="QA">
						<div>
							<input class="linput" id="q1" type="text" name="q1" placeholder="Add Query">&nbsp;
							<input class="linput" id="a1" type="text" name="a1" placeholder="Add Expected Response">
							<input type="hidden" id="uid" value="<?php echo $_SESSION['user_id'] ?>" name="user_id">
							<input type="hidden" id="pid" value="<?php echo $_SESSION['pid'] ?>" name="pid">
						</div>
					</div>
				</div>
				<div class="" style="">
					<input type="button" id="addRes" class="addbtn" name="que_fileds" onclick="" value="+">
				</div>
					
				<button class="bton mr-top" id="submit">Next</button>
				<button name="Back" class="bton1" type="button">Back</button>
			</form>
		</div>
	</div>
  <?php }elseif($addMethod == "prebuilt"){ ?>
  		<div id="page" class="row">
	  		<div class="col-md-12">
	  			<h4>prebuilt</h4>
	  		</div>
	  		<div class="col-md-12">
	  			<div class="pt-3">
	  				<form>
	  					<div class="form-group">
	  						<label></label>
	  						<input type="text" placeholder="affirm" name="">
	  					</div>
	  					<div class="form-group">
	  						<label></label>
	  						<input type="" placeholder="deny" name="">
	  					</div>
	  					<div class="form-group">
	  						<label></label>
	  						<input type="" placeholder="greet" name="">
	  					</div>
	  					<div class="form-group">
	  						<label></label>
	  						<input type="" placeholder="inform" name="">
	  					</div>
	  				</form>
	  				<button name="Back" class="bton1" type="button">Back</button>
	  			</div>
	  		</div>
	  	</div>
  <?php }else{
  	echo "<p class='pt-5 pl-3 pr-3'>Method did not specified please go back</p>";
  	echo '<button name="Back" class="bton1" type="button">Back</button>';
  } ?>
</div>

<script type="text/javascript">
	// $(".reload").click(function(){$("#page").load("#page");});
	$(".bton1").click(function(){$("#main").load("select_response.php");});
	$("#submit").click(function(){$("#main").load("last_page.php");});
	$("#addRes").click(function(){
		var q1 = $('#q1').val();
		var a1 = $('#a1').val();
		var uid = $('#uid').val();
		var pid = $('#pid').val();
		var str = 'q1='+q1+'&a1='+a1+'&uid='+uid+'&pid='+pid;
		console.log(str);
		// if(q1!="" && q2!="" && ui)
		$.ajax({
            type: "POST",
            url: "action/add_queries.php",
            data: str,
            cache: false,
            success: function(result){
            	// $('#q1').val() = ""
            	// $('#a1').val() = ""
            	alert("success");
            }
        });
	});
	// $("#submit").click(function(){$("#main").load("test.php");});
</script>