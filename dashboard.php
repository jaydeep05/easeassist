<?php 
session_start();
$uname = $_SESSION['username'];
$uid = $_SESSION['user_id'];
if(!$_SESSION['username'])
{    
    header("Location: login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Dashboard - SB Admin</title>
        <link href="css/styles.css" rel="stylesheet" />
        <link href="css/all.css" rel="stylesheet" crossorigin="anonymous" />
        <script src="js/font-awesome.js" crossorigin="anonymous"></script>
        <script src="js/jquery.js"></script>

    </head>
    <body id="body" class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <a class="navbar-brand" href="index.php">EaseAssist</a>
            <ul class="nav-user navbar-nav ml-auto mr-0 mr-md-3 my-2 my-md-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="#">Settings</a><a class="dropdown-item" href="#">Activity Log</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="logout.php">Logout</a>
                    </div>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="new_pro_nav">
                                <a href="#" id="new-project">
                                    <button class="new_pro_btn">
                                        <span style="background-color: #3d71de;padding: 5px;border-radius: 45%;color: white;"><i class="fa fa-plus" aria-hidden="true"></i></span>&nbsp;&nbsp;New Project
                                    </button></a>
                            </div>
                            <div class="sb-sidenav-menu-heading">Core</div>
                            <a class="nav-link" href="#" id="Dashboard">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard</a>
                            <div class="sb-sidenav-menu-heading">Interface</div>
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts"
                                ><div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Projects
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav"><a class="nav-link" href="#" id="edit-project">Edit Project</a></nav>
                                <nav class="sb-sidenav-menu-nested nav"><a class="nav-link" href="#" id="credentials">Credentials</a></nav>
                            </div>
                            <div class="sb-sidenav-menu-heading">Test</div>
                            <a class="nav-link" href="#" id="test" 
                                ><div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                test projects</a
                            >
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        <?php echo $uname." ".$uid; ?>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main id="main">
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website <?php echo date("Y"); ?></div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        
        <script src="bootstrap/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script>
            $(window).on("load", function(){$("#main").load("dashboard_in.php");});
            // $(window).on("load", function(){$("#main").load("addResponse.php");});
            $("#Dashboard").click(function(){$("#main").load("dashboard_in.php");});
            $("#new-project").click(function(){$("#main").load("project.php");});
            $("#edit-project").click(function(){$("#main").load("select_response.php");});
            $("#custom").click(function(){$("#main").load("addCustom.php");});
            $("#test").click(function(){$("#main").load("last_page.php");});
            $("#credentials").click(function(){$("#main").load("credentials.php");});
        </script>
    </body>
</html>
