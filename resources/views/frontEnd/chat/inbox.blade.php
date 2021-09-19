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
				@if(count($users)>0)
					@foreach($users as $user)
			          <a href="{{route('chat',$user->user_name)}}">
			          	<li class="contact">
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
				@endif
			</ul>
		</div>
	</div>
	<div class="content">
		<div class="contact-profile">
			<div class="social-media">
				<a href="{{url('/')}}">
					<h4>Return To Website</h4>
				</a>
			</div>
		</div>
	</div>
</div>

</body>
</html>
