<?php 
  include_once 'action/database.php';
  $uname = $_SESSION['username'];
  $uid = $_SESSION['user_id'];
  print_r($_SESSION);
  // echo $uid.$uname;
  $sql1 = "SELECT * FROM `projects` WHERE `user_id`= '".$uid."'";
  
  $projects = $conn->query($sql1);
  if(isset($_REQUEST['pname'])){
    $sql = "SELECT (`id`) FROM `projects` WHERE `project_name`= '".$_REQUEST['pname']."' and `user_id`= '".$uid."'";
    echo $sql;
    $proj = $conn->query($sql);
    if ($proj->num_rows > 0) {
      while($row = $proj->fetch_assoc()) {
          $project = $row['id'];
      }
      $_SESSION['pid'] = $project;
    }
  }else{
    if ($projects->num_rows > 0) {
      echo "<div class='col-md-6'>";
        echo "<form method='POST'>Select project:<br><select id=\"pro_id\" name=\"projects\">";
          echo '<option value="" selected >Select Project</option>';
          while($row = $projects->fetch_assoc()) { ?>
              <option value = '<?php echo $row['id']; ?>'><?php echo $row['project_name']; ?></option>  
              <?php          
          }
        echo "</select></form>";
        if(isset($_POST['projects'])){
          $_SESSION['pid'] = $_POST['projects'];
          $project = $_SESSION['pid'];
        }
      echo "</div>";
    }
  }
  // print_r($project);
?>
<div class="container-fluid">
  <h1 class="mt-4">Choose Response Type</h1><hr>
  <div>
    <p>You can choose option to create
        your project. while choosing prebuild response you can our prebuild
        response directory and custom response will let you create you create
        your own set of response</p>
  </div>
  <div class="row">
    <div class="col-md-12">
      <ol class="col-md-12 response">
        <li class="col-md-4 col-md-3 response-list">
          <label class="response-lbl">Prebuilt Response</label>
          <div class="response-input right">
            <input id="response" name="response" value="prebuilt" type="radio" />
          </div>
        </li>
        <li class="col-md-4 col-md-3 response-list">
          <label class="response-lbl">Custom Response</label>
          <div class="response-input right">
            <input id="response" name="response" value="custom" type="radio" />
          </div>
        </li>
      </ol>
      <div class="col-md-12">
        <div class="">          
          <a id="responsebtn" href="#"><button class="bton" name="Next" type="button">Next</button></a>
          <button name="Back" class="bton1" type="button">Back</button>
        </div>
      </div>
    </div>
  </div>
  <input type="hidden" id="uid" value="<?php echo $uid; ?>" name="">
  <input type="text" id="pid" value="<?php if(isset($project)){ echo $project; } ?>" name="">
  

  <!-- <img class="img" src='C:/Users/vrajm/Pictures/bg.png'> -->
</div>

<script>
  $(document).ready(function(){
        var response;
        $("input[type='radio']").click(function(){
          var radioValue = $("input[name='response']:checked").val();
          if(radioValue){
              response = radioValue;
          }
        });
        $("#responsebtn").click(function(){
          var uid = $('#uid').val();
          var pid = $('#pro_id').val();
          var str = {'uid':uid,'pid':pid, 'addMethod':response}
          // alert(str);
          $("#main").load("addCustom.php",str);
          return false;
        });
        $(".bton1").click(function(){$("#main").load("dashboard_in.php");});
    });
</script>
