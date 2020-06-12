<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>MediaCapture and Streams API</title>
    <meta name="viewport" content="width=device-width">
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script src="js/recorder.js" type="text/javascript"></script>
    <!-- <link rel="stylesheet" href="main.css"> -->
</head>
<body>
<div class="container">
  <h1 class="mt-4">Test your Project</h1><hr>
  <div>
    <p></p>
  </div>
  <div class="row">
    <div class="col-md-6">

        <button id="testrecord" ><i class="fa fa-microphone"></i></button>
        <!-- <button onclick="stopRecording(this);" disabled><i class="fa fa-microphone-slash"></i></button> -->

        <h2>Recordings</h2>
        <ul id="recordingslist"></ul>

        <h2>Log</h2>
        <pre id="log"></pre>
    </div>
    <div class="col-md-6">
        <div>
            <input class="" type="text" name="testtxt" placeholder="Enter Text" />
            <input type="button" name="testsubmit" id="testsubmit" value="submit" />
        </div>
    </div>
</div>
</div>

<script>

    $('#testrecord').clickToggle(function() {
        init();
        $('.fa').addClass('fa-microphone-slash');
        startRecording(this);
    },
    function() {
        $('.fa').addClass('fa-microphone');
        stopRecording(this);  
    });

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

// window.onload = 
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


</body>
</html>