  <?php 
// session_start();
// $uname = $_SESSION['username'];
// $uid = $_SESSION['user_id'];
// if(!$_SESSION['username'])
// {    
//     header("Location: login.php");
// }
#Updating the CSV
#CSV Task Step 1
?>
<!-- User input for testing -->
<!-- <!DOCTYPE html> -->
<!-- <html lang="en"> -->
    <head>
        <!-- <meta charset="utf-8" /> -->
        <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge" /> -->
        <!-- <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" /> -->
        <!-- <meta name="description" content="" /> -->
        <!-- <meta name="author" content="" /> -->
        <!-- <title>Dashboard</title> -->
        <!-- <link href="css/styles.css" rel="stylesheet" /> -->
        <!-- <link href="css/all.css" rel="stylesheet" crossorigin="anonymous" /> -->
        <!-- <script src="js/font-awesome.js" crossorigin="anonymous"></script> -->
        <!-- <script src="js/jquery.js"></script> -->
        <script type="text/javascript" src="js/jquery.min.js"></script>
        <script src="js/recorder.js" type="text/javascript"></script>
        <style type="text/css">
          #layoutSidenav_content{
            background-image: url('image/New_BG.png');
            background-repeat: no-repeat;
            background-size: 28%;
            background-position-x: 90%;
            background-position-y: 70%;
          }
        </style>

    </head>
    <!-- <body id="body" class="sb-nav-fixed"> -->
        <!-- <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <a class="navbar-brand" href="index.php">EaseAssist</a>
            <ul class="nav-user navbar-nav ml-auto mr-0 mr-md-3 my-2 my-md-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="#">Settings</a><a class="dropdown-item" href="#">Activity Log</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="login.php">Logout</a>
                    </div>
                </li>
            </ul>
        </nav> -->
        <!-- <div id="layoutSidenav"> -->
            <!-- div id="layoutSidenav_nav">
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
                            <a class="nav-link" href="#" id="Dashboard" 
                                ><div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard</a
                            >
                            <div class="sb-sidenav-menu-heading">Interface</div>
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts"
                                ><div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Projects
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div
                            ></a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav"><a class="nav-link" href="#" id="edit-project">Edit Project</a></nav>
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
                        <?php //echo $uname." ".$uid; ?>
                    </div>
                </nav>
            </div> -->
            <!-- <div id="layoutSidenav_content"> -->
                <!-- <main id="main"> -->
                <div class="container-fluid">
                  <h2 class="mt-4">Input Query</h2><hr>
                  <div class="row">
                      <div class="col-md-6">

                          <button id="testrecord" onclick="startRecording(this);"><i class="fa fa-microphone"></i></button>
                          <button onclick="stopRecording(this);" disabled><i class="fa fa-microphone-slash"></i></button>

                          <h2>Recordings</h2>
                          <ul id="recordingslist"></ul>

                          <h2>Log</h2>
                          <pre id="log"></pre>
                      </div>
                        <div class="col-md-6 sideimg">
                            <!-- <img src="image/New_BG.png"> -->
                              <form action="#last_page.php" method="POST">
                                <ol class="col-md-12 response">
                                   <li class="">
                                         <label class="label"><b>input Query</b> </label>
                                         <input type="text" name="user_input" class="linput" required>
                                         <!-- <input type="text" id="pro" name="project_name" class="linput" required> -->
                                   </li>
                                </ol>
                               <br>
                              <button type="submit" name="submit" class="bton mr-top">CONFIRM</button>
                              </form>
                              <?php
                              if(isset($_POST['user_input']))
                              {
                                 $message=$_POST['user_input'];
                                 $qacsv_file="testdata.csv";
                                 $text_UserInuput = 'http://127.0.0.1:8000/phpmessage?type=text&message=';
                                 $text_UserInuput .= $message;
                                 $text_UserInuput .='&qacsv=';
                                 $text_UserInuput .= $qacsv_file;
                                 echo "<a href='".$text_UserInuput."'><button class=\"bton mr-top\">Send the Request submit</button></a>";
                              }
                              elseif(isset($_POST['voice_input']))
                              {
                                 $audio_filepath = $_POST['voice_input'];
                                 $qacsv_file="testdata.csv";
                                 $voice_UserInuput = 'http://127.0.0.1:8000/phpmessage?type=voice&audio_path=';
                                 $voice_UserInuput .= $audio_filepath;
                                 $voice_UserInuput .='&qacsv'+$qacsv_file;
                                 echo "<a href='".$voice_UserInuput."'><button>Voice submit</button></a>";
                              }
                              ?>

                           </div>
                          <div class="col-md-6 ">
                           <?php
                            if(isset($_GET['val3']))
                            {?>
                            <fieldset>
                            <legend>Response</legend>
                               <?php
                                  echo " ID : ",$_GET['val1'],"  Question : ",$_GET['val2'],"  Ans : ",$_GET['val3'];
                                  ?>
                            </fieldset>
                            <?php
                            }
                            elseif (isset($_GET['val1']))
                            {
                               echo $_GET['val1'];
                            }
                            else
                            {
                               echo " ⚠️ NOT ABLE TO CONNECT TO BACKEND⚠️","<br>"," 😞 TRY AGAIN LATER😞";
                            }
                            ?>
                        </div>
                  </div> 
                </div>
                  
                  
               <!-- </main> -->
                <!-- <footer class="py-4 bg-light mt-auto">
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
                </footer> -->
            <!-- </div> -->
        <!-- </div> -->
        <script src="bootstrap/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script>
            // $(window).on("load", function(){$("#main").load("dashboard_in.php");});
            // $(window).on("load", function(){$("#main").load("addResponse.php");});
            // $("#Dashboard").click(function(){$("#main").load("dashboard_in.php");});
            // $("#new-project").click(function(){$("#main").load("project.php");});
            // $("#edit-project").click(function(){$("#main").load("select_response.php");});
            // $("#custom").click(function(){$("#main").load("addCustom.php");});
            // $("#test").click(function(){$("#main").load("test.php");});
        </script>
        <iframe src="http://localhost/php/SGH000699/Hackathon_php/qa%232.php" style="display:none";></iframe>
<script>

// $('#testrecord').clickToggle(function() {
// init();
// $('.fa').addClass('fa-microphone-slash');
// startRecording(this);
// },
// function() {
// $('.fa').addClass('fa-microphone');
// stopRecording(this);  
// });

function __log(e, data) {
log.innerHTML += "\n" + e + " " + (data || '');
}
var audio_context;
var recorder;
function startUserMedia(stream) {
var input = audio_context.createMediaStreamSource(stream);
__log('Media stream created.');
// Uncomment if you want the audio to feedback directly
//input.connect(audio_context.destination);
//__log('Input connected to audio context destination.');

recorder = new Recorder(input);
__log('Recorder initialised.');
}
function startRecording(button) {
recorder && recorder.record();
button.disabled = true;
button.nextElementSibling.disabled = false;
__log('Recording...');
}
function stopRecording(button) {
recorder && recorder.stop();
button.disabled = true;
button.previousElementSibling.disabled = false;
__log('Stopped recording.');

// create WAV download link using audio data blob
createDownloadLink();
recorder.stop();
recorder.clear();
}

// function createiframefortext(txt){
//     var ifr = document.createElement('iframe');
//     ifr.src = 'http://127.0.0.1:8000/message_from_php?type=text&text='+txt;
//     ifr.style = 'display: block;';
// }

function createDownloadLink() {
recorder && recorder.exportWAV(function(blob) {
var url = URL.createObjectURL(blob);
var li = document.createElement('li');
var au = document.createElement('audio');
var hf = document.createElement('a');


au.controls = true;
au.src = url;
hf.href = url;
hf.download = new Date().toISOString() + '.wav';
hf.innerHTML = hf.download;
li.appendChild(au);
li.appendChild(hf);
recordingslist.appendChild(li);

<?php //echo shell_exec('~/opt/anaconda3/python.app/Contents/MacOS/python py/gSTT.py '.escapeshellarg('url').'2>&1'); ?>

var filename = new Date().toISOString();
//filename to send to server without extension 
//upload link 
var upload = document.createElement('a');
upload.href = "#";
upload.innerHTML = "Upload";
upload.addEventListener("click", function(event) {
    var xhr = new XMLHttpRequest();
    xhr.onload = function(e) {
        if (this.readyState === 4) {
            console.log("Server returned: ", e.target.responseText);
        }
    };
    var fd = new FormData();
    fd.append("audio_data", blob, filename);
    xhr.open("POST", "uploadWav.php", true);
    xhr.send(fd);
})
li.appendChild(document.createTextNode(" ")) //add a space in between 
li.appendChild(upload) //add the upload link to li


});
}

window.onload = function init() {
try {
// webkit shim
window.AudioContext = window.AudioContext || window.webkitAudioContext;
                navigator.getUserMedia = ( navigator.getUserMedia ||
                                 navigator.webkitGetUserMedia ||
                                 navigator.mozGetUserMedia ||
                                 navigator.msGetUserMedia);
// window.URL = window.URL || window.webkitURL;

audio_context = new AudioContext;
__log('Audio context set up.');
__log('navigator.getUserMedia ' + (navigator.getUserMedia ? 'available.' : 'not present!'));
} catch (e) {
alert('No web audio support in this browser!');
}

navigator.getUserMedia({audio: true}, startUserMedia, function(e) {
__log('No live audio input: ' + e);
});
};
</script>
    <!-- </body>
</html> -->