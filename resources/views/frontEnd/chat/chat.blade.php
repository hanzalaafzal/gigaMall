<!DOCTYPE html>
<html class=''>
<head>
  <meta charset='UTF-8'>
  <meta name="robots" content="noindex">
<link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,600,700,300' rel='stylesheet' type='text/css'>

<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css'>
<link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.2/css/font-awesome.min.css'>
<link rel="stylesheet" type="text/css" href="{{url('/css/chat.css')}}">
</head>
<body>
<div id="frame">
	<div id="sidepanel">
		<div id="profile">
			<div class="wrap">
				@if(!empty(Auth::user()->photo))
					<img id="profile-img" src="{{url('frontEnd/images/avatars/'.Auth::user()->photo)}}" class="online" alt="" />
				@else
					<img id="profile-img" src="{{url('frontEnd/images/avatars/unknown.jpg')}}" class="online" alt="" />
				@endif
				<p>{{Auth::user()->user_name}}</p>
			</div>
		</div>
		<!-- <div id="search">
			<label for=""><i class="fa fa-search" aria-hidden="true"></i></label>
			<input type="text" placeholder="Search contacts..." />
		</div> -->
		<hr>
		<div id="contacts">
			<ul>
				@foreach($users as $user)
		          <a href="{{route('chat',$user->user_name)}}">
		          	<li class="contact
		          	<?php 
		          		if($user->user_name == $receiver->user_name){
		          			echo 'active';
		          		}
		          	?>
		          	">
			            <div class="wrap">
			              @if(!empty($user->photo))
			              	<img src="{{url('/frontEnd/images/avatars/'.$user->photo)}}" alt="" />
			              @else
			              	<img src="{{url('/frontEnd/images/avatars/unknown.jpg')}}" alt="" />
			              @endif
			              <div class="meta">
			                <p class="name">{{$user->user_name}}</p>
			              </div>
			            </div>
			          </li>
		          </a>
		        @endforeach
			</ul>
		</div>
	</div>

		<div class="pre-loader">
			<img src="{{url('/frontEnd/images/pre-loader.gif')}}">
		</div>
	<div class="content">
		<div class="contact-profile">
			@if(!empty($receiver->photo))
          		<img src="{{url('/frontEnd/images/avatars/'.$receiver->photo)}}" alt="" />
          	@else
          		<img src="{{url('/frontEnd/images/avatars/unknown.jpg')}}" alt="" />
          	@endif
			<p>{{$receiver->user_name}}</p>
			<div class="social-media">
				<a href="{{url('/')}}">
					<h4>Return To Website</h4>
				</a>
			</div>
		</div>
		<div class="messages">
			<ul>
			</ul>
      <div id="scrolldiv" style="float: left;"></div>
		</div>
		<div class="message-input">
			<div class="wrap">
				<form id="message-form">
					<input type="text" id="write-message" placeholder="Write your message..." />
					<button form="message-form" class="submit" id="submit-message"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
				</form>
			</div>
		</div>
	</div>
</div>


<script src="https://www.gstatic.com/firebasejs/4.9.1/firebase.js"></script>
<script>
// Initialize Firebase
var config = {
    apiKey: "{{ config('services.firebase.api_key') }}",
    authDomain: "{{ config('services.firebase.auth_domain') }}",
    databaseURL: "{{ config('services.firebase.database_url') }}",
    storageBucket: "{{ config('services.firebase.storage_bucket') }}",
};
firebase.initializeApp(config);

var database = firebase.database();

// Get Data
firebase.database().ref('{{$chat_code->chat_id}}').on('value', function(snapshot) {
    var value = snapshot.val();
    var htmls = [];
	//Pre Loader
    if (value == null) {
    	$('.pre-loader').css('display','none');
    }

    $.each(value, function(index, value){
      if(value) {
        if(value['sender'] == '{{Auth::user()->user_name}}'){
          htmls.push('<li class="replies">          <img src="{{url("frontEnd/images/avatars/unknown.jpg")}}" alt="" />          <p>'+value['message']+'</p>        </li>');
        }
        else
          htmls.push('<li class="sent">          <img src="{{url("frontEnd/images/avatars/unknown.jpg")}}"" alt="" />          <p>'+value['message']+'</p>        </li>')
      }
    });
    $('.messages ul').html(htmls);


    //scroll to bottom
    $('.messages').scrollTop($('.messages')[0].scrollHeight);

    //Pre Loader
    $('.pre-loader').css('display','none');
});


$("form").on('submit',function(){
    if($('#write-message').val() != ''){
    	firebase.database().ref('{{$chat_code->chat_id}}').push({
	        message: $('#write-message').val(),
	        sender: "{{Auth::user()->user_name}}",
	        receiver: "{{$receiver->user_name}}",
	    });
    }
  $('#write-message').val("");
    return false;
});

</script>

</body>
</html>
