<?php
    session_start(); 
    if(!isset($_SESSION['user_id'])){
        echo "<script>window.location.href='login.php';</script>";
        header("Location: logout.php");
    }
?>
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
        #recordingslist {
            list-style-type: none;
        }
        #textResponse {
            list-style-type: decimal;
        }
    </style>

</head>
    
<div class="container-fluid">
    <h2 class="mt-4">Input Query</h2><hr>
    <div class="row">
        <div class="col-md-6">
            <button id="testrecord" onclick="startRecording(this);"><i class="fa fa-microphone"></i></button>
            <button onclick="stopRecording(this);" disabled><i class="fa fa-microphone-slash"></i></button>
            <div id="testRecording"></div>
        </div>
        <div class="col-md-6 sideimg">
                <ol class="col-md-12 response">
                    <li class="">
                            <label class="label"><b>input Query</b> </label>
                            <input type="text" id="u_input" name="user_input" class="linput" required>
                    </li>
                </ol>
                <br>
                <button id="confirm" type="submit" name="submit" class="bton mr-top">CONFIRM</button>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <h2>Response</h2>
            <ul id="textResponse"></ul>
        </div>
        <div class="col-md-6">                
            <h2>Recordings</h2>
            <ul id="recordingslist"></ul>
            <h2>Log</h2>
            <pre id="log"></pre>                
        </div>
    </div>
</div>
<script>
    var audio_context;
    var recorder;
    $(document).ready(function(){
        $('#confirm').click(function(){
            var res;
            var inputQuery = $('#u_input').val();
            console.log(inputQuery);
            $.post(
                "http://localhost:8000/phpmessage", //?type=text&message="+inputQuery+"&qacsv=easeassist/files/testdata.csv",
                {type:'text', message: inputQuery, qacsv: 'testdata.csv'},
                function(response){
                    console.log(response);
                    var res = ['id','request','response'];
                    for( var i=0; i<response.results.length; i++){
                        var li = document.createElement('li');
                        li.innerHTML = res[i]+" : "+response.results[i];
                        textResponse.appendChild(li);
                    }
                }
            );
        });
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
            recordingslist.appendChild(li);
            var filename = new Date().toISOString();
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

                $.post(
                    "http://localhost:8000/phpmessage",
                    {type:'voice', qacsv: 'testdata.csv'},
                    function(response){
                        console.log(response);
                        var li = document.createElement('li');
                        li.innerHTML = "text : "+response;
                        textResponse.appendChild(li);                        
                    }
                );

            })
            testRecording.appendChild(upload) //add the upload link to li
        });
    }
    function init() {
        try {
            window.AudioContext = window.AudioContext || window.webkitAudioContext;
            navigator.getUserMedia = ( navigator.getUserMedia ||
                                        navigator.webkitGetUserMedia ||
                                        navigator.mozGetUserMedia ||
                                        navigator.msGetUserMedia);

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
