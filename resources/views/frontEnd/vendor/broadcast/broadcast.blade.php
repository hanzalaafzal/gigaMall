@extends('frontEnd.vendor.layout')
@section('dashboard')

<style type="text/css">
  .profile-notifications {
      margin: 0 auto 15px;
  }
  #end_date{
        font-weight: 600;
    margin-right: 30px;
  }
  label {
    display: inline;
  }
</style>
<!-- DASHBOARD CONTENT -->
<div class="dashboard-content">
   <!-- HEADLINE -->
   <div class="headline buttons primary">
      {{--  <h4 style="padding-top:10px;"><input type="text" id="room-id" value="abcdef" autocorrect=off autocapitalize=off size=20 ></h4>  --}}
      {{--  <h4 style="padding-top:10px;"><input type="text" id="room-id" value="abcdef" autocorrect=off autocapitalize=off size=20></h4>  --}}
      <div class="shops-buttons">
          {{--  <input type="text" id="room-id" value="abcdef" autocorrect=off autocapitalize=off size=20>  --}}
          <label><h3 style="padding-top:25px;">Video Conferencing Section</h3></label>
          <label style="display:none;"><input type="checkbox" id="record-entire-conference"> Record Entire Conference In The Browser?</label>
      <span id="recording-status" style="display: none;"></span>
      <button id="btn-stop-recording" style="display: none;">Stop Recording</button>
      <br><br>

      {{--  <button id="open-room" class="btn btn-success">Open Room</button>
      <button id="join-room" class="btn btn-success">Join Room</button>
      <button id="open-or-join-room" class="btn btn-success">Auto Open Or Join Room</button>
          --}}
      </div>
   </div>
   <!-- /HEADLINE -->

   
   <!-- PURCHASES LIST -->
    <div class="purchases-list">
        <!-- PURCHASES LIST HEADER -->
        <div class="purchases-list-header">
            <div class="purchases-list-header-date">
              <script>
                $(document).ready(function(){
                  if (window.location.href.indexOf('?roomid=') > 0) {
                  //alert("invited"); 
                  $("#room-id").hide();
                  $("#myInput").hide();
                  $("#open-or-join-room").hide();
                  }



                 //alert('doc loaded');
                 var x = Math.floor((Math.random() * 1000000) + 1);
                 document.getElementById("room-id").value=x;
                });
              </script>
                <p class="text-header small"> <h4 style="padding-top:5px;">
                <input type="text" id="room-id" value="abcdef" autocorrect=off autocapitalize=off size=20 readonly></h4></p>
                <input type="text" name="named" value="Hello World" id="myInput">
            </div>
            <div class="purchases-list-header-details" style="width: 28.6%">
                <p class="text-header small" style="display:none;"><label><input type="checkbox" id="record-entire-conference"> Record Entire Conference In The Browser?</label>
                </p>
            </div>
            <div class="purchases-list-header-price" style="display: none;">
                <p class="text-header small"><button id="open-room" class="btn btn-success">Open Room</button></p>
            </div>
            <div class="purchases-list-header-price" style="display: none;">
                <p class="text-header small"> <button id="join-room" class="btn btn-success">Join Room</button></p>
            </div>
            <div class="purchases-list-header-date">
                <p class="text-header small"><button id="open-or-join-room" class="btn btn-success">Open Or Join Room</button></p>
            </div>
            {{--  <div class="purchases-list-header-price">
                <p class="text-header small">Shipping Days</p>
            </div>  --}}
            {{--  <div class="purchases-list-header-price">
                <p class="text-header small">Action</p>
            </div>  --}}
        </div>
        <!-- /PURCHASES LIST HEADER -->
        <div id="videos-container" style="margin: 20px 0;"></div>

        <div id="room-urls" style="text-align: center;display: none;background: #F1EDED;margin: 15px -10px;border: 1px solid rgb(189, 189, 189);border-left: 0;border-right: 0;"></div>
        <!-- PURCHASE ITEM -->
        {{--  @foreach($orders as $order)
          <div class="purchase-item">
            <div class="purchase-item-date">
                <p>{{$order->created_at->format('d-m-Y')}}</p>
            </div>
            <div class="purchase-item-details" style="width: 28.6%">
                <!-- ITEM PREVIEW -->
                <div class="item-preview">
                    <figure class="product-preview-image small liquid">
                        <img src="{{url('frontEnd/images/products/'.$order->products->photo)}}" alt="product-image">
                    </figure>
                    <p class="text-header">{{substr($order->products->title,0,25).'...'}}</p>
                    <p class="description">{{substr($order->products->description,0,50).'...'}}</p>
                </div>
                <!-- /ITEM PREVIEW -->
            </div>
            <div class="purchase-item-price">
              <p class="price">{{$order->quantity}}</p>
            </div>
            <div class="purchase-item-price">
              <p class="price">{{$order->product_price * $order->quantity}}<span> PKR</span></p>
            </div>
            <div class="purchase-item-date">
                <p>{{$order->status}}</p>
            </div>
            <div class="purchase-item-price">
              <p class="price">
                @if(!empty($order->shipping_days))
                  {{$order->shipping_days}}
                @else
                  <span>NA</span>
                @endif
              </p>
            </div>
            <div class="purchase-item-price">
              <a href="{{route('vendorOrderView',$order->id)}}" class="button primary">View</a>
            </div>
        </div>
        @endforeach  --}}
        {{--  starting script video  --}}
        <script src="{{url('video/dist/RTCMultiConnection.min.js')}}"></script>
        <script src="{{url('video/node_modules/webrtc-adapter/out/adapter.js')}}"></script>
        <script src="{{url('video/socket.io/socket.io.js')}}"></script>
        
        <!-- custom layout for HTML5 audio/video elements -->
        <link rel="stylesheet" href="{{url('video/dev/getHTMLMediaElement.css')}}">
        <script src="{{url('video/dev/getHTMLMediaElement.js')}}"></script>
        
        <script src="{{url('video/node_modules/recordrtc/RecordRTC.js')}}"></script>
        <script>
        // ......................................................
        // .......................UI Code........................
        // ......................................................
        document.getElementById('open-room').onclick = function() {
            disableInputButtons();
            connection.open(document.getElementById('room-id').value, function(isRoomOpened, roomid, error) {
                if(isRoomOpened === true) {
                  showRoomURL(connection.sessionid);
                }
                else {
                  disableInputButtons(true);
                  if(error === 'Room not available') {
                    alert('Someone already created this room. Please either join or create a separate room.');
                    return;
                  }
                  alert(error);
                }
            });
        };
        
        document.getElementById('join-room').onclick = function() {
            disableInputButtons();
            connection.join(document.getElementById('room-id').value, function(isJoinedRoom, roomid, error) {
              if (error) {
                    disableInputButtons(true);
                    if(error === 'Room not available') {
                      alert('This room does not exist. Please either create it or wait for moderator to enter in the room.');
                      return;
                    }
                    alert(error);
                }
            });
        };
        
        document.getElementById('open-or-join-room').onclick = function() {
            disableInputButtons();
            connection.openOrJoin(document.getElementById('room-id').value, function(isRoomExist, roomid, error) {
                if(error) {
                  disableInputButtons(true);
                  alert(error);
                }
                else if (connection.isInitiator === true) {
                    // if room doesn't exist, it means that current user will create the room
                    showRoomURL(roomid);
                }
            });
        };
        
        // ......................................................
        // ..................RTCMultiConnection Code.............
        // ......................................................
        
        var connection = new RTCMultiConnection();
        
        // by default, socket.io server is assumed to be deployed on your own URL
        connection.socketURL = '/';
        
        // comment-out below line if you do not have your own socket.io server
        connection.socketURL = 'https://rtcmulticonnection.herokuapp.com:443/';
        
        connection.socketMessageEvent = 'video-conference-demo';
        
        connection.session = {
            audio: true,
            video: true,
             oneway: true
        };
        
        connection.sdpConstraints.mandatory = {
            OfferToReceiveAudio: true,
            OfferToReceiveVideo: true
        };
        
        // https://www.rtcmulticonnection.org/docs/iceServers/
        // use your own TURN-server here!
        connection.iceServers = [{
            'urls': [
                'stun:stun.l.google.com:19302',
                'stun:stun1.l.google.com:19302',
                'stun:stun2.l.google.com:19302',
                'stun:stun.l.google.com:19302?transport=udp',
            ]
        }];
        
        connection.videosContainer = document.getElementById('videos-container');
        connection.onstream = function(event) {
            var existing = document.getElementById(event.streamid);
            if(existing && existing.parentNode) {
              existing.parentNode.removeChild(existing);
            }
        
            event.mediaElement.removeAttribute('src');
            event.mediaElement.removeAttribute('srcObject');
            event.mediaElement.muted = true;
            event.mediaElement.volume = 0;
        
            var video = document.createElement('video');
        
            try {
                video.setAttributeNode(document.createAttribute('autoplay'));
                video.setAttributeNode(document.createAttribute('playsinline'));
            } catch (e) {
                video.setAttribute('autoplay', true);
                video.setAttribute('playsinline', true);
            }
        
            if(event.type === 'local') {
              video.volume = 0;
              try {
                  video.setAttributeNode(document.createAttribute('muted'));
              } catch (e) {
                  video.setAttribute('muted', true);
              }
            }
            video.srcObject = event.stream;
        
            var width = parseInt(connection.videosContainer.clientWidth / 3) - 20;
            var mediaElement = getHTMLMediaElement(video, {
                title: event.userid,
                buttons: ['full-screen'],
                width: width,
                showOnMouseEnter: false
            });
        
            connection.videosContainer.appendChild(mediaElement);
        
            setTimeout(function() {
                mediaElement.media.play();
            }, 5000);
        
            mediaElement.id = event.streamid;
        
            // to keep room-id in cache
            localStorage.setItem(connection.socketMessageEvent, connection.sessionid);
        
            chkRecordConference.parentNode.style.display = 'none';
        
            if(chkRecordConference.checked === true) {
              btnStopRecording.style.display = 'inline-block';
              recordingStatus.style.display = 'inline-block';
        
              var recorder = connection.recorder;
              if(!recorder) {
                recorder = RecordRTC([event.stream], {
                  type: 'video'
                });
                recorder.startRecording();
                connection.recorder = recorder;
              }
              else {
                recorder.getInternalRecorder().addStreams([event.stream]);
              }
        
              if(!connection.recorder.streams) {
                connection.recorder.streams = [];
              }
        
              connection.recorder.streams.push(event.stream);
              recordingStatus.innerHTML = 'Recording ' + connection.recorder.streams.length + ' streams';
            }
        
            if(event.type === 'local') {
              connection.socket.on('disconnect', function() {
                if(!connection.getAllParticipants().length) {
                  location.reload();
                }
              });
            }
        };
        
        var recordingStatus = document.getElementById('recording-status');
        var chkRecordConference = document.getElementById('record-entire-conference');
        var btnStopRecording = document.getElementById('btn-stop-recording');
        btnStopRecording.onclick = function() {
          var recorder = connection.recorder;
          if(!recorder) return alert('No recorder found.');
          recorder.stopRecording(function() {
            var blob = recorder.getBlob();
            invokeSaveAsDialog(blob);
        
            connection.recorder = null;
            btnStopRecording.style.display = 'none';
            recordingStatus.style.display = 'none';
            chkRecordConference.parentNode.style.display = 'inline-block';
          });
        };
        
        connection.onstreamended = function(event) {
            var mediaElement = document.getElementById(event.streamid);
            if (mediaElement) {
                mediaElement.parentNode.removeChild(mediaElement);
            }
        };
        
        connection.onMediaError = function(e) {
            if (e.message === 'Concurrent mic process limit.') {
                if (DetectRTC.audioInputDevices.length <= 1) {
                    alert('Please select external microphone. Check github issue number 483.');
                    return;
                }
        
                var secondaryMic = DetectRTC.audioInputDevices[1].deviceId;
                connection.mediaConstraints.audio = {
                    deviceId: secondaryMic
                };
        
                connection.join(connection.sessionid);
            }
        };
        
        // ..................................
        // ALL below scripts are redundant!!!
        // ..................................
        
        function disableInputButtons(enable) {
            document.getElementById('room-id').onkeyup();
        
            document.getElementById('open-or-join-room').disabled = !enable;
            document.getElementById('open-room').disabled = !enable;
            document.getElementById('join-room').disabled = !enable;
            document.getElementById('room-id').disabled = !enable;
        }
        
        // ......................................................
        // ......................Handling Room-ID................
        // ......................................................
        
        function showRoomURL(roomid) {
            var roomHashURL = '#' + roomid;
            
            var roomQueryStringURL = '?roomid=' + roomid;
         //alert(window.location.href);
          var share=window.location.href+roomQueryStringURL;
          document.getElementById("myInput").value =share;
          
  
  
       // alert(document.getElementById("myInput").value);
            var html = '<h2>Unique URL for your room:</h2><br>';
                   
            html += 'Hash URL: <a href="' + roomHashURL + '" target="_blank">' + roomHashURL + '</a>';
            html += '<br>';
            html += 'QueryString URL: <a href="' + roomQueryStringURL + '" target="_blank">' + roomQueryStringURL + '</a>';
        //alert(html);
            html += '<br><br>';
            html+='<button type="button" onclick="myFunction()" class="btn btn-success">Click to copy invitation address for video conferencing </button>';
            html += '<br><br>';
            var roomURLsDiv = document.getElementById('room-urls');
            roomURLsDiv.innerHTML = html;
        
            roomURLsDiv.style.display = 'block';
        }
        
        (function() {
            var params = {},
                r = /([^&=]+)=?([^&]*)/g;
        
            function d(s) {
                return decodeURIComponent(s.replace(/\+/g, ' '));
            }
            var match, search = window.location.search;
            while (match = r.exec(search.substring(1)))
                params[d(match[1])] = d(match[2]);
            window.params = params;
        })();
        
        var roomid = '';
        if (localStorage.getItem(connection.socketMessageEvent)) {
            roomid = localStorage.getItem(connection.socketMessageEvent);
        } else {
            roomid = connection.token();
        }
        
        var txtRoomId = document.getElementById('room-id');
        txtRoomId.value = roomid;
        txtRoomId.onkeyup = txtRoomId.oninput = txtRoomId.onpaste = function() {
            localStorage.setItem(connection.socketMessageEvent, document.getElementById('room-id').value);
        };
        
        var hashString = location.hash.replace('#', '');
        if (hashString.length && hashString.indexOf('comment-') == 0) {
            hashString = '';
        }
        
        var roomid = params.roomid;
        if (!roomid && hashString.length) {
            roomid = hashString;
        }
        
        if (roomid && roomid.length) {
            document.getElementById('room-id').value = roomid;
            localStorage.setItem(connection.socketMessageEvent, roomid);
        
            // auto-join-room
            (function reCheckRoomPresence() {
                connection.checkPresence(roomid, function(isRoomExist) {
                    if (isRoomExist) {
                        connection.join(roomid);
                        return;
                    }
        
                    setTimeout(reCheckRoomPresence, 5000);
                });
            })();
        
            disableInputButtons();
        }
        
        // detect 2G
        if(navigator.connection &&
           navigator.connection.type === 'cellular' &&
           navigator.connection.downlinkMax <= 0.115) {
          alert('2G is not supported. Please use a better internet service.');
        }
        </script>
        <script>
          function myFunction() {
            var copyText = document.getElementById("myInput");
            copyText.select();
            document.execCommand("copy");
            alert("Copied the URL Address for video conferencing invitation: " + copyText.value);
          }
        </script>
        <script src="https://www.webrtc-experiment.com/common.js"></script>
        
        {{--  ending script video  --}}
        <!-- /PURCHASE ITEM -->

        <!-- PAGER -->
<div class="pager-wrap">
  <div class="pager-lara">
    {{$orders->links()}}
   </div></div>
<!-- /PAGER -->
    </div>
    <!-- /PURCHASES LIST -->

   <!-- PAGER -->
   
   <!-- /PAGER -->
   
   
</div>
<!-- DASHBOARD CONTENT -->


@endsection