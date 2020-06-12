<?php
    
    include 'action/database.php';
    $sql = "SELECT * FROM `projects` WHERE `user_id`= '".$_SESSION['user_id']."'";
    // print_r($_SESSION);
    
?>
<main id="main">
    <div class="container-fluid">
        <h1 class="mt-4">Dashboard</h1><hr>
        <div class="row new-col">
            <span class="col-md-12 reminder_span">Reminders</span>    
        </div>
        <div class="row">
            <?php if(1){ ?>

            <?php }else{ ?>

            <?php } ?>
            <ol class="col-md-12 reminders_olist">
                <li class="col-md-3 reminders_list">
                    <a href="#">
                        <i class="fa fa-times right" id="remove" data-value="1" aria-hidden="true"></i>
                    </a>
                    <a href="#">
                        <div class="reminder_title">
                            <span>reminder 1</span>
                        </div>
                        <div class="reminder_detail">
                            <p>resxtrcytvybiunoiibuyvctrxe x s sd sdcsdvssfgvdvv d f vx  x x</p>
                        </div>
                    </a>
                </li>
                <li class="col-md-3 reminders_list">
                    <a href="#">
                        <i class="fa fa-times right" id="remove" data-value="2" aria-hidden="true"></i>
                    </a>
                    <a href="#">
                        <div class="reminder_title">
                            <span>reminder 1</span>
                        </div>
                        <div class="reminder_detail">
                            <p>resxtrcytvybiunoiibuyvctrxe x s sd sdcsdvssfgvdvv d f vx  x x</p>
                        </div>
                    </a>
                </li>
                <li class="col-md-3 reminders_list">
                    <a href="#">
                        <i class="fa fa-times right" id="remove" data-value="3" aria-hidden="true"></i>
                    </a>
                    <a href="#">
                        <div class="reminder_title">
                            <span>reminder 1</span>
                        </div>
                        <div class="reminder_detail">
                            <p>resxtrcytvybiunoiibuyvctrxe x s sd sdcsdvssfgvdvv d f vx  x x</p>
                        </div>
                    </a>
                </li>
                <li class="add_project">
                    <a href="#">
                        <i class="fa fa-plus" style="color: black;" aria-hidden="true"></i>
                    </a>
                </li>
            </ol>
        </div>
        <div class="row new-col">
            <span class="col-md-12 reminder_span">Projects</span>    
        </div>
        <div class="row col-md-12" id="project_list">
            <?php
            $proj = $conn->query($sql);
                if ($proj->num_rows > 0) {
                        // output data of each row
                        $count = 1; ?>
                <table class="table">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Name</th>
                            <th>Type</th>
                            <th>Status</th>
                            <th>Remove</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php    
                        while($row = $proj->fetch_assoc()) { ?>
                            <tr>
                                <td><?php echo $count; ?></td>
                                <td><?php echo $row['project_name']; ?></td>
                                <td><?php echo $row['project_type']; ?></td>
                                <td><i class="fa fa-circle" style="color: <?php if($row['status']==1){ echo "#20e120"; }else{ echo "#e12020"; } ?>" aria-hidden="true"></i>&nbsp;<a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item status" id="statusToggle[<?php echo $row['id']; ?>]" at="<?php echo $row['id']; ?>" href="#"><?php if($row['status']==1){ echo "disable"; }else{ echo "enable"; } ?></a>
                                    <!-- <input type="hidden" name="currentRow" id="row"> -->
                                </div></td>
                                <td><a class="deleteProject" id="<?php echo $row['id']; ?>"><i class="fa fa-trash" style="color:red;"></i></a></td>
                            </tr>
                            <?php $count = $count + 1; ?>
                    <?php } ?>
                    
                    </tbody>
                </table>
            <?php $conn->close();
                    }else{
                echo "<div class='pl-3 pr-3'><p> Create project first </p></div>";
            } ?>
        </div>
        <!-- <div id='response'></div> -->
    </div>
</div>
<script type="text/javascript">
    $("a.deleteProject").click(function(){
        if(confirm("Confirm delete project")){
            var id = $(this).attr("id");
            // console.log(id);
            $.ajax({
                type: 'POST',
                url: "action/deleteProject.php",
                data: {pro_id : id},
                success: function(response){
                    alert(response);                
                },
                complete: function(response){
                    $( "#project_list" ).load(window.location.reload());
                }
            });
        }        
    });
    $("a.status").click(function(){
        var status = $(this).text();
        var pro_id = $(this).attr('at');
        $.post(
            "action/toggleStatus.php",
            {proid : pro_id, staus : status},
            function(response){
                $( "#project_list" ).load(window.location.reload());
            }
        )
    });
</script>