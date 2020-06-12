<!-- //this is vraj at 10:41 -->
<?php
session();
echo "test";
?>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/mp3recorder.js"></script>
<div class="container-fluid">
  <h1 class="mt-4">Choose Response Type</h1><hr>
  <div class="row">
        <script type="text/javascript">
            var audio_context;

            function __log(e, data) {
              log.innerHTML += "\n" + e + " " + (data || '');
            }

            $(function() {

              try {
                // webkit shim
                window.AudioContext = window.AudioContext || window.webkitAudioContext;
                navigator.getUserMedia = ( navigator.getUserMedia ||
                                 navigator.webkitGetUserMedia ||
                                 navigator.mozGetUserMedia ||
                                 navigator.msGetUserMedia);
                window.URL = window.URL || window.webkitURL;

                var audio_context = new AudioContext;
                __log('Audio context set up.');
                __log('navigator.getUserMedia ' + (navigator.getUserMedia ? 'available.' : 'not  present!'));
              } catch (e) {
                alert('No web audio support in this browser!');
              }


              
              $('.recorder .start').on('click', function() {
                $this = $(this);
                $recorder = $this.parent(); 

                navigator.getUserMedia({audio: true}, function(stream) {
                  var recorderObject = new MP3Recorder(audio_context, stream, { statusContainer:  $recorder.find('.status'), statusMethod: 'replace' });
                  $recorder.data('recorderObject', recorderObject);

                  recorderObject.start();
                }, function(e) { });
              });

              $('.recorder .stop').on('click', function() {
                $this = $(this);
                $recorder = $this.parent();

                recorderObject = $recorder.data('recorderObject');
                recorderObject.stop();

                recorderObject.exportWAV(function(base64_wav_data) {
                  var url = 'data:audio/wav;base64,' + base64_wav_data;
                  var au  = document.createElement('audio');

                  document.getElementById("playerContainer").innerHTML = "";
                  //console.log(url)

                  var duc = document.getElementById("dataUrlcontainer");
                  duc.innerHTML = url;

                  au.controls = true;
                  au.src = url;
                  //$recorder.append(au);
                  $('#playerContainer').append(au);

                  recorderObject.logStatus('');
                });

              });

            });
          </script>

           <script>
              function upload(){

              var dataURL = document.getElementById("dataUrlcontainer").innerHTML;

                $.ajax({
                  type: "POST",
                  url: "uploadWav.php",
                  data: { 
                    wavBase64: dataURL
                  },
                  success: function(data){
                    console.log('success');
                  }
                });
                // .done(function(o) {
                //   console.log('saved'); 

                // });

              }    
            </script>


           <div class="recorder">
            Recorder 1
            <input type="button" class="start"  value="Record" />
            <input type="button" class="stop" value="Stop" />
            <pre class="status"></pre>
           </div>

           <div><button onclick="upload()">Upload</button></div>

           <div id="playerContainer"></div>

           <div id="dataUrlcontainer"></div>

           <pre id="log"></pre>

  </div>
</div>
