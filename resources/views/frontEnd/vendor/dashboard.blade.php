@extends('frontEnd.vendor.layout')

@section('dashboard')
<div class="dashboard-content">
	<!-- HEADLINE -->
	<div class="headline buttons primary">
	    <h4>Dashboard</h4>
	    @php
	    	$wallet = DB::table('wallets')->where('user_id',auth()->user()->id)->pluck('amount')->first();
	    @endphp
	    @if($wallet > 0)
	    	<a href="/withdraw_amount" class="button mid-short secondary">Withdraw Wallet</a>
	    @endif
	</div>
	<!-- /HEADLINE -->

	<div class="form-box-item">
		<h4>Profile Information</h4>
		<div class="pass-reset-buttons">
			<a href="{{route('vendorResetPassword')}}" class="button primary">Reset Password</a>	
		</div>
		<hr class="line-separator">
			<!-- PROFILE IMAGE UPLOAD -->
			<div class="profile-image">
				<div class="profile-image-data">
					<figure class="user-avatar medium">
						@if(!empty(Auth::user()->photo))
							<img src="{{url('/frontEnd/images/avatars/'.Auth::user()->photo)}}" alt="profile-default-image">
						@else
							<img src="{{url('/frontEnd/images/avatars/unknown.jpg')}}" alt="profile-default-image">
						@endif
					</figure>
					<p class="text-header">{{Auth::user()->user_name}}</p>
				</div>
			</div>
			<!-- PROFILE IMAGE UPLOAD -->
		<form action="{{route('storeUserDetails')}}" enctype="multipart/form-data" method="post">
		    {{csrf_field()}}
			<!-- INPUT CONTAINER -->
			
			<div class="input-container half">
				<label for="first_name" class="rl-label required">First Name</label>
				<input type="text" id="first_name" value="{{Auth::user()->first_name}}" required name="first_name" placeholder="Enter your first name here...">
			</div>
			<!-- /INPUT CONTAINER -->

			<!-- INPUT CONTAINER -->
			<div class="input-container half">
				<label for="last_name" class="rl-label required">Last Name</label>
				<input type="text" id="last_name" value="{{Auth::user()->last_name}}" required name="last_name" placeholder="Enter your full name here...">
			</div>
			<!-- /INPUT CONTAINER -->

			<!-- INPUT CONTAINER -->
			<div class="input-container half">
				<label for="phone" class="rl-label required">Phone Number</label>
				<input type="number" id="phone" value="{{Auth::user()->phone}}" required name="phone" placeholder="Enter your phone number here...">
			</div>
			<!-- /INPUT CONTAINER -->

			<!-- INPUT CONTAINER -->
			<div class="input-container half" style="float: left;">
				<label for="email" class="rl-label">Email <small>(Non Editable)</small></label>
				<input type="email" id="email" value="{{Auth::user()->email}}" readonly="">
			</div>
			<!-- /INPUT CONTAINER -->

			<!-- INPUT CONTAINER -->
			<div class="input-container">
				<label for="photo" class="rl-label">Profile Picture</label>
				<p><small> Minimum resolution: 1080 x 1080 px</small></p>
				<input type="file" id="photo" accept="image/png, image/gif, image/jpeg" name="photo" placeholder="Enter Photo...">
				<p class="alert-danger" id="photoError"></p>
			</div>
			<!-- /INPUT CONTAINER -->
			<button class="button mid-short primary">Update</button>
		</form>

	</div>


	@php
		$shopper = DB::table('shopper_details')->where('user_id',auth()->user()->id)->first();
	@endphp

	<div class="form-box-item">
		<h4>Shopper Information</h4>
		
		<hr class="line-separator">
			<!-- PROFILE IMAGE UPLOAD -->
			
			<!-- PROFILE IMAGE UPLOAD -->
		<form action="/storeShopperDetails" enctype="multipart/form-data" method="post">
		    {{csrf_field()}}
			<!-- INPUT CONTAINER -->
				<div class="input-container half">
				<label for="first_name" class="rl-label required">Business Name</label>
				<input type="text" id="first_name" value="{{$shopper->business_name}}" required name="business_name" placeholder="Enter your business name here...">
			</div>
			<!-- /INPUT CONTAINER -->

			<!-- INPUT CONTAINER -->
			<div class="input-container half">
				<label for="last_name" class="rl-label required">CNIC</label>
				<input type="number" id="last_name" value="{{$shopper->cnic}}" required name="cnic" placeholder="Enter your cnic here...">
			</div>
			<!-- /INPUT CONTAINER -->

			<!-- INPUT CONTAINER -->
			<div class="input-container half">
				<label for="phone" class="rl-label required">Province</label>
				<input type="text" id="phone" value="{{$shopper->province}}" required name="province" placeholder="Enter your province here...">
			</div>
			<!-- /INPUT CONTAINER -->

			<!-- INPUT CONTAINER -->
			<div class="input-container half "style="float: left;" >
				<label for="email" class="rl-label required">City </label>
				<input type="text" id="email" value="{{$shopper->city}}" required name="city"placeholder="Enter your city here...">
			</div>
			<!-- /INPUT CONTAINER -->

			<!-- INPUT CONTAINER -->
			<div class="input-container">
				<label for="photo" class="rl-label required">Current Shop Address</label>
				<input type="text" id="photo" value="{{$shopper->shop_address}}" required name="shop_address"placeholder="Enter your Shop Address here...">
				
			</div>

			<!-- INPUT CONTAINER -->
			<div class="input-container">
				<label for="photo" class="rl-label">NTN</label>
				<input type="number" id="photo" value="{{$shopper->ntn}}" required name="ntn" placeholder="Enter your NTN here...">
				
			</div>

			<!-- INPUT CONTAINER -->
			<div class="input-container">
				<label for="photo" class="rl-label">STN</label>
				<input type="number" id="photo" value="{{$shopper->stn}}" required name="stn" placeholder="Enter your STN here...">
				
			</div>

			<!-- INPUT CONTAINER -->
			<div class="input-container">
				<label for="photo" class="rl-label required">Mobile Number</label>
				<input type="number" id="photo" value="{{$shopper->mobile_number}}" required name="mobile_number" placeholder="Enter your Mobile number here...">
				
			</div>
			<!-- /INPUT CONTAINER -->
			<button class="button mid-short primary">Update</button>
		</form>

	</div>

</div>

@endsection