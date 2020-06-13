<?php
    session_start(); 
    if(!isset($_SESSION['user_id'])){
        echo "<script>window.location.href='login.php';</script>";
        header("Location: logout.php");
    }
    //header('Access-Control-Allow-Origin: *'); ?>
<head>
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
            <!-- <form action="#" method="POST"> -->
                <ol class="col-md-12 response">
                    <li class="">
                            <label class="label"><b>input Query</b> </label>
                            <input type="text" id="u_input" name="user_input" class="linput" required>
                            <!-- <input type="text" id="pro" name="project_name" class="linput" required> -->
                    </li>
                </ol>
                <br>
                <button id="confirm" type="submit" name="submit" class="bton mr-top">CONFIRM</button>
            <!-- </form> -->
            <?php /*
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
            }*/
            ?> 
        </div>
        <div class="col-md-6 ">
            <?php
            if(isset($_GET['val3']))
            {   ?>
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
<script>
    var audio_context;
    var recorder;
    
    $('#confirm').click(function(){
        var res;
        var inputQuery = $('#u_input').val();
        console.log(inputQuery);
        // $.post(
        //     "http://localhost:8000/phpmessage", //?type=text&message="+inputQuery+"&qacsv=easeassist/files/testdata.csv",
        //     {type:'text', message: inputQuery, qacsv: 'testdata.csv'},
        //     // "jsonp",
        //     function(response){
        //         // alert(response.results)
		// 		// console.log(response);				
		// 		var instance = JSON.parse(response);
        //         console.log(instance);
        //         alert(instance);
		// 	}
        // )
        fetch("http://localhost:8000/phpmessage", {
            method: 'post',
            mode: 'no-cors',
            headers: {"Content-type": "application/x-www-form-urlencoded; charset=UTF-8","Accept": 'application/json'},
            body: 'type=text&message='+inputQuery+'&qacsv=testdata.csv',
            credentials: 'include'
        })
        .then(function (data) {
            console.log('Request succeeded with JSON response', data);
            res = data;
        })
        .catch(function (error) {
            console.log('Request failed', error);
        });

        alert(JSON.stringify(res));

    });
    

    function __log(e, data) {
        log.innerHTML += "\n" + e + " " + (data || '');
    }   
    function startUserMedia(stream) {
        var input = audio_context.createMediaStreamSource(stream);
        console.log('Media stream created.');
        recorder = new Recorder(input);
        console.log('Recorder initialised.');       
    }
    function startRecording(button) {
        if(navigator.getUserMedia ? false : true){
            init();
        }else{
            recorder && recorder.record();
            __log('Recording...');
            button.disabled = true;
            button.nextElementSibling.disabled = false;
        }        
    }
    function stopRecording(button) {
        recorder && recorder.stop();
        button.disabled = true;
        button.previousElementSibling.disabled = false;
        __log('Stopped recording.');
        // create WAV download link using audio data blob
        recorder.stop();
        createDownloadLink();
        recorder.clear();        
    }
    function createDownloadLink() {
        recorder && recorder.exportWAV(function(blob) {
            var url = window.URL.createObjectURL(blob);
            var li = document.createElement('li');
            var au = document.createElement('audio');
            var hf = document.createElement('a');

            au.controls = true;
            au.src = url;
            hf.href = url;
            hf.download = new Date().toISOString() + '.wav';
            hf.innerHTML = hf.download;
            li.appendChild(au);
            // li.appendChild(hf);
            recordingslist.appendChild(li);
            var filename = new Date().toISOString();
            //filename to send to server without extension 
            //upload link 
            var upload = document.createElement('a');
            upload.href = "#";
            upload.innerHTML = "test";
            upload.addEventListener("click", function(event) {
                var xhr = new XMLHttpRequest();
                xhr.onload = function(e) {
                    if (this.readyState === 4) {
                        console.log("Server returned: ", e.target.responseText);
                    }
                };
                var fd = new FormData();
                fd.append("audio_data", blob, filename);
                xhr.open("POST", "action/uploadWav.php", true);
                xhr.send(fd);
            })
            li.appendChild(document.createTextNode(" ")) //add a space in between 
            li.appendChild(upload) //add the upload link to li
        });
    }
    function init() {
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
