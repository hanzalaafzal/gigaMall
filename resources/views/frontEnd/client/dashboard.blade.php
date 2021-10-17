@extends('frontEnd.client.layout')

@section('dashboard')
<style type="text/css">
	.profile-notification-body{
		padding-left: 0px !important;
	}
	.profile-notification{
		padding: 2px 10px 2px 10px !important;
		height: 38px !important;
	}
	.profile-notification .profile-notification-body p {
	    line-height: 22px !important;
	}
	.profile-notification .profile-notification-type .type-icon {
	    font-size: 14px !important;
	    top: 6px !important;
	}
	.profile-notification-body h6{
		color: gray !important;
	}
	.center {
	    margin: auto;
	    width: 60%;
	    padding: 20px;
	    margin-bottom: 30px;
	    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
	}
	.hideform {
	    display: none;
	}
</style>
<div class="dashboard-content">
	<!-- HEADLINE -->
	<div class="headline buttons primary">
	    <h4>Account & Addresses</h4>
			<div class="row" style="margin-bottom:10px">
				<a href="{{route('checkout')}}"  class="button mid-short primary">Go To Checkout</a>
				<a href="{{route('myCart')}}"  class="button mid-short secondary c-button">Go To Cart</a>
				<a href="{{route('hellll')}}"  class="button mid-short primary c-button">Recharge E-Wallet</a>
				@php
					$wallet = DB::table('wallets')->where('user_id',auth()->user()->id)->pluck('amount')->first();
				@endphp
				@if($wallet > 0)
					<a href="/withdraw_amount" class="button mid-short secondary c-button">Withdraw Wallet</a>
				@else
						<a href="#" class="button mid-short secondary c-button">Empty Wallet</a>
				@endif
			</div>
	</div>
	<!-- /HEADLINE -->

	@if (Session::has('message'))
        <div class="alert alert-success text-center">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
            <p>{{ Session::get('message') }}</p>
        </div>
    @endif


	<div class="form-box-item">
		<h4>Profile Information</h4>
		<div class="pass-reset-buttons">
		    @if(auth()->user()->permissions_id == 5)
		    <a href="{{route('ResetPassword')}}" class="button primary">Reset Password</a>
		    @else
		    <a href="{{route('clientResetPassword')}}" class="button primary">Reset Password</a>
		    @endif

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
					<input type="file" id="photo" name="photo" placeholder="Enter Photo...">
					<p class="alert-danger" id="photoError"></p>
				</div>
				<!-- /INPUT CONTAINER -->
				<button class="button mid-short primary">Update</button>
			</form>

	</div>

	<!-- FORM BOX ITEMS -->
	<div class="form-box-items">
		<!-- FORM BOX ITEM -->
		<div class="form-box-item">
			<h4>Address Book</h4>
			<!-- Shipping Address-->
			@if(Auth::user()->addressBooksDefault)
				<div class="profile-notifications">
					<!-- Default Billing Address -->
						<div class="profile-notification" style="height: 90px !important;">
					      <div class="profile-notification-body">
							<h6 style="color: red !important;">Default Billing Address</h6>
							<br>
					      	<h6>{{Auth()->user()->addressBooksDefault->full_name}}</h6>
					         <p>{{substr(Auth()->user()->addressBooksDefault->address,0,50).'...'}}</p>
					      </div>
					      <div class="profile-notification-type">
				         	<span onclick="show('a')" class="type-icon icon-pencil primary"></span>
					      </div>
						</div>

						<!-- Edit Form Model -->
						<div class="center hideform" id="editForma">
						    <button onclick="hide('a')" style="float: right;">X</button>
						    <br>
						    <form action="{{route('updateAddress')}}" enctype="multipart/form-data" method="post">
							    {{csrf_field()}}
							    <input type="hidden" name="id" value="{{Auth()->user()->addressBooksDefault->id}}">
								<!-- INPUT CONTAINER -->
								<div class="input-container half">
									<label for="full_name" class="rl-label required">Full Name</label>
									<input type="text" id="full_name" required name="full_name" placeholder="Enter your full name here..." value="{{Auth()->user()->addressBooksDefault->full_name}}">
								</div>
								<!-- /INPUT CONTAINER -->

								<!-- INPUT CONTAINER -->
								<div class="input-container half">
									<label for="phone" class="rl-label required">Phone Number</label>
									<input type="number" id="phone" required name="phone" placeholder="Enter your phone address here..." value="{{Auth()->user()->addressBooksDefault->phone}}">
								</div>
								<!-- /INPUT CONTAINER -->

								<!-- INPUT CONTAINER -->
								<div class="input-container half" style="float: left;">
									<label for="country_id" class="rl-label required">Country</label>
									<label for="country_id" class="select-block">
										<select name="country_id" id="country_id" required>
											<option value="" selected="" disabled="">Select your Country...</option>
											@foreach($countries as $country)
												<option value="{{$country->id}}"
													<?php if($country->id == Auth()->user()->addressBooksDefault->country_id){echo "selected";}?>
												>{{$country->title_en}}</option>
											@endforeach
										</select>
										<!-- SVG ARROW -->
										<svg class="svg-arrow">
											<use xlink:href="#svg-arrow"></use>
										</svg>
										<!-- /SVG ARROW -->
									</label>
								</div>
								<!-- /INPUT CONTAINER -->

								<!-- INPUT CONTAINER -->
								<div class="input-container half">
									<label for="zip_code" class="rl-label required">Zip Code</label>
									<input value="{{Auth()->user()->addressBooksDefault->zip_code}}" type="text" id="zip_code" required name="zip_code" placeholder="Enter Zip Code.">
								</div>
								<!-- /INPUT CONTAINER -->

								<!-- INPUT CONTAINER -->
								<div class="input-container">
									<label for="about" class="rl-label required">Full Address</label>
									<textarea id="address" name="address" required placeholder="Enter shipping full address">{{Auth()->user()->addressBooksDefault->address}}</textarea>
								</div>
								<!-- /INPUT CONTAINER -->

								<button class="button mid-short primary">Submit</button>
							</form>
							<br><br>
						</div>
					<!-- /Default Billing Address-->
					<?php $i =1; ?>
				   @foreach(Auth::user()->addressBooks as $address)
				   		<div class="profile-notification">
					      <div class="profile-notification-body">
					      	<h6>{{$address->full_name}}</h6>
					         <p>{{substr($address->address,0,50).'...'}}</p>
					      </div>
					      <div class="profile-notification-type">
				         	<span onclick="show('{{$i}}')" class="type-icon icon-pencil primary"></span>
				         	<a href="{{route('deleteAddress',$address->id)}}" class="type-icon icon-trash primary"></a>
					      </div>
						</div>

						<!-- Edit Form Model -->
						<div class="center hideform" id="editForm{{$i}}">
						    <button onclick="hide('{{$i}}')" style="float: right;">X</button>
						    <br>
						    <form action="{{route('updateAddress')}}" enctype="multipart/form-data" method="post">
							    {{csrf_field()}}
							    <input type="hidden" name="id" value="{{$address->id}}">
								<!-- INPUT CONTAINER -->
								<div class="input-container half">
									<label for="full_name" class="rl-label required">Full Name</label>
									<input type="text" id="full_name" required name="full_name" placeholder="Enter your full name here..." value="{{$address->full_name}}">
								</div>
								<!-- /INPUT CONTAINER -->

								<!-- INPUT CONTAINER -->
								<div class="input-container half">
									<label for="phone" class="rl-label required">Phone Number</label>
									<input type="number" id="phone" required name="phone" placeholder="Enter your phone address here..." value="{{$address->phone}}">
								</div>
								<!-- /INPUT CONTAINER -->

								<!-- INPUT CONTAINER -->
								<div class="input-container half" style="float: left;">
									<label for="country_id" class="rl-label required">Country</label>
									<label for="country_id" class="select-block">
										<select name="country_id" id="country_id" required>
											<option value="" selected="" disabled="">Select your Country...</option>
											@foreach($countries as $country)
												<option value="{{$country->id}}"
													<?php if($country->id == $address->country_id){echo "selected";}?>
												>{{$country->title_en}}</option>
											@endforeach
										</select>
										<!-- SVG ARROW -->
										<svg class="svg-arrow">
											<use xlink:href="#svg-arrow"></use>
										</svg>
										<!-- /SVG ARROW -->
									</label>
								</div>
								<!-- /INPUT CONTAINER -->

								<!-- INPUT CONTAINER -->
								<div class="input-container half">
									<label for="zip_code" class="rl-label required">Zip Code</label>
									<input value="{{$address->zip_code}}" type="text" id="zip_code" required name="zip_code" placeholder="Enter Zip Code.">
								</div>
								<!-- /INPUT CONTAINER -->

								<!-- INPUT CONTAINER -->
								<div class="input-container">
									<label for="about" class="rl-label required">Full Address</label>
									<textarea id="address" name="address" required placeholder="Enter shipping full address">{{$address->address}}</textarea>
								</div>
								<!-- /INPUT CONTAINER -->

								<button class="button mid-short primary">Submit</button>
							</form>
							<br><br>
						</div>
						<?php $i++; ?>
				   @endforeach
				</div>
			@else
				<h6>You haven’t added any address yet</h6>
			@endif

			<script type="text/javascript">
				function show(i){
					$('.hideform').hide();
					$('#editForm'+i).show();
				}
				function hide(i){
					$('#editForm'+i).hide();
				}
			</script>
			<!-- /Shipping Address-->
		</div>
		<!-- /FORM BOX ITEM -->



		<!-- FORM BOX ITEM -->
			<div class="form-box-item">

			<h4>Add New Address</h4>
			<hr class="line-separator">

			<form method="post" action="{{route('storeAddress')}}" enctype="multipart/form-data" >
			    {{csrf_field()}}
				<!-- INPUT CONTAINER -->
				<div class="input-container half">
					<label for="full_name" class="rl-label required">Full Name</label>
					<input type="text" id="full_name" required name="full_name" placeholder="Enter your full name here...">
				</div>
				<!-- /INPUT CONTAINER -->

				<!-- INPUT CONTAINER -->
				<div class="input-container half">
					<label for="phone" class="rl-label required">Phone Number</label>
					<input type="number" id="phone" required name="phone" placeholder="Enter your phone address here...">
				</div>
				<!-- /INPUT CONTAINER -->

				<!-- INPUT CONTAINER -->
				<div class="input-container half" style="float: left;">
					<label for="country_id" class="rl-label required">Country</label>
					<label for="country_id" class="select-block">
						<select name="country_id" id="country_id" required>
							<option value="" selected="" disabled="">Select your Country...</option>
							@foreach($countries as $country)
								<option value="{{$country->id}}">{{$country->title_en}}</option>
							@endforeach
						</select>
						<!-- SVG ARROW -->
						<svg class="svg-arrow">
							<use xlink:href="#svg-arrow"></use>
						</svg>
						<!-- /SVG ARROW -->
					</label>
				</div>
				<!-- /INPUT CONTAINER -->

				<!-- INPUT CONTAINER -->
				<div class="input-container half">
					<label for="zip_code" class="rl-label required">Zip Code</label>
					<input type="text" id="zip_code" required name="zip_code" placeholder="Enter Zipe Code">
				</div>
				<!-- /INPUT CONTAINER -->

				<!-- INPUT CONTAINER -->
				<div class="input-container">
					<label for="about" class="rl-label required">Full Address</label>
					<textarea id="address" name="address" required placeholder="Enter shipping full address"></textarea>
				</div>
				<!-- /INPUT CONTAINER -->

				<button class="button mid-short primary">Submit</button>
			</form>
		</div>
		<!-- /FORM BOX ITEM -->



	</div>
	<!-- /FORM BOX -->
</div>

@endsection
