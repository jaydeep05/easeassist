<?php session_start(); 
$uid = $_SESSION['user_id'];
?>
<head>
    <style type="text/css">
        .sideimg{
            background-image: url('image/New_BG.png');
            background-repeat: no-repeat;
            background-size: 28%;
            background-position-x: 90%;
            background-position-y: 70%;
          }
    </style>
</head>
<div class="container-fluid">
    <h2 class="mt-4">Start a New Project</h2><hr>
        <div class="row">
            <div class="col-md-12 sideimg">
                <!-- <form id="project_detail" method="POST" action="#"> -->
                    <ol class="col-md-12 response">
                        <li class="col-md-4 col-md-3 from-group">
                                <label for="pro" class="label"><b>Project Name</b> </label>
                                <input type="text" id="pro" name="project_name" class="linput" required>
                        </li>
                        <li class="col-md-4 col-md-3 mr-top from-group">
                                <label for="comp" class="label"><b>Company Name</b> </label>
                                <input type="text" id="comp" name="company_name" class="linput" required>
                        </li>
                        <li class="col-md-4 col-md-3 mr-top from-group">
                                <label for="dev" class="label"><b>Developer Name</b> </label>
                                <input type="text" id="dev" name="developer_name" class="linput required">
                        </li>
                        <li class="col-md-4 col-md-3 mr-top from-group">
                                <label for="type" class="label"><b>Project Type</b> </label>
                                <input type="text" id="type" name="project_type" class="linput" required>
                        </li>
                        <li class="col-md-4 col-md-3 from-group">
                                <input id="uid" type="hidden" name="uid" value="<?php echo $uid; ?>">
                                <button id="submit" name="pro_submit" class="bton mr-top">Get Started</button>
                                <button name="Back" class="bton1" type="button">Back</button>
                        </li>
                    </ol>
                <!-- </form>                 -->
            </div>
        </div> 
</div>

<script>
    $(document).ready(function(){
        $("#submit").click(function(){
            var pname = $("#pro").val();
            var cname = $("#comp").val();
            var dname = $("#dev").val();
            var ptype = $("#type").val();
            var uid = $("#uid").val();
            var dataString = 'pname='+ pname + '&cname='+cname+'&dname='+dname+'&ptype='+ptype+'&uid='+uid;
            var str = {'pname':pname,'cname':cname,'dname':dname,'ptype':ptype,'uid':uid};
            if(pname==''||cname==''||dname==''||ptype=='')
            {
                alert("Please Fill All Fields");
            }
            else
            {
                $.ajax({
                    type: "POST",
                    url: "action/add_new_project.php",
                    data: dataString,
                    cache: false,
                    success: function(result){
                        alert(dataString);
                        $("#main").load("select_response.php",str);
                    }
                });
            }
            return false;
        });
    });
</script>