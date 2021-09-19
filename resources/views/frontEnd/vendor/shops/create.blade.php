@extends('frontEnd.vendor.layout')

@section('dashboard')
<style type="text/css">
	.pack-boxes .radio{
		position: relative !important;
	    top: 30px !important;
	    z-index: 1;
	    left: 7px;
	}
	@media screen and (min-width: 1440px){
        .pack-boxes .radio {
            left: -44px !important;
            top: 6px !important;
        }
	}

	@media screen and (max-width: 667px){
        .packageATag{
        	float: left;
        }
        .packageLable{
        	width: 100%;
        }
	}
</style>
<!-- DASHBOARD CONTENT -->
<div class="dashboard-content">
    <!-- HEADLINE -->
    <div class="headline simple primary">
        <h4>Create Shop</h4>
    </div>
    <!-- /HEADLINE -->

    <!-- PACK BOXES -->
    <form method="post" action="{{route('shopStore')}}" id="upload_form" enctype="multipart/form-data">
    {{csrf_field()}}

	<div id="packageError">
		
	</div>
	<div class="pack-boxes">
		<h4>Choose Free Package or Buy Package.</h4>
		<input required="" type="radio" id="payment_id" name="payment_id" value="0">
		<label for="payment_id" style="width: 25%; float: left;">
			<span class="radio primary"><span></span></span>
			<div class="pack-box">
				<p class="text-header small">{{$package->name}}</p>
				<p class="price larger">{{$package->price}}<span>&nbsp;&nbsp; PKR</span></p>
				<p class="credit">Allowed Products: {{$package->products}}</p>
				<span class="button dark-light">Select Pack</span>
			</div>
		</label>
		<a href="{{route('buyPackage')}}" class="packageATag">
			<label style="width: 25%; float: left;">
				<span class="radio primary"><span></span></span>
				<div class="pack-box">
					<p class="price larger" style="    right: -10px;"><span>Buy Package</span></p>
					<br><br>
					<span class="button dark-light">Buy Now</span>
				</div>
			</label>
		</a>
	</div>
	@if(count($payments)>0)
		<div class="or">
			<h3>OR</h3>
		</div>
		<br>
		<div class="pack-boxes">
			<h4>Choose package from your purchases.</h4>
				<?php $i =1; ?>
				@foreach($payments as $payment)
					<!-- PACK BOX -->				
					<input required="" type="radio" id="payment_id{{$i}}" name="payment_id" value="{{$payment->id}}">
					<label for="payment_id{{$i}}" style="width: 25%; float: left;">
						<span class="radio primary"><span></span></span>
						<div class="pack-box">
							<p class="text-header small">{{$payment->packages->name}}</p>
							<p class="price larger"><span>$</span>{{$payment->packages->price}}</p>
							<p class="credit">Allow Products {{$payment->packages->products}}</p>
							<span class="button dark-light">Select Pack</span>
						</div>
					</label>
					<!-- /PACK BOX -->
					<?php $i++; ?>
				@endforeach
		</div>
	@endif
	<!-- /PACK BOXES -->

	<!-- FORM BOX ITEMS -->
	<div class="form-box-items wrap-3-1 left">
		<!-- FORM BOX ITEM -->
		<div class="form-box-item full">
			<h4>Add Shop Details</h4>
			<hr class="line-separator">
				<!-- INPUT CONTAINER -->
				<div class="input-container">
					<label for="title" class="rl-label required">Shop Name</label>
					<input type="text" id="title" name="title" required placeholder="Enter Shop Name...">
				</div>
				<!-- /INPUT CONTAINER -->

				<!-- INPUT CONTAINER -->
				<div class="input-container">
					<label for="description" class="rl-label required">Shop Description</label>
					<textarea id="description" name="description" required placeholder="Enter Shop Description..."></textarea>
				</div>
				<!-- /INPUT CONTAINER -->

				<!-- INPUT CONTAINER -->
				<div class="input-container">
					<label for="currency" class="rl-label required">Select Currency</label>
					<label for="currency" class="select-block">
						<select name="currency" id="currency" required="">
							<option value="" disabled="" selected="">Choose Currency</option>
							<option value="USD">USD</option>
							<option value="PKR">PKR</option>
						</select>
					</label>
				</div>
				<!-- /INPUT CONTAINER -->

				<!-- INPUT CONTAINER -->
				<div class="input-container">
					<label for="photo" class="rl-label">Photo</label>
					<p><small> Ideal resolution: 1346 x 300 px</small></p>
					<input required="" type="file" id="photo" name="photo">
					<p class="alert-danger" id="photoError"></p>
				</div>
				<!-- /INPUT CONTAINER -->

				<!-- INPUT CONTAINER -->
				<div class="input-container">
					<label for="country_id" class="rl-label required">Select Country</label>
					<label for="country_id" class="select-block">
						<select name="country_id" id="country_id" required="">
							<option value="" disabled="" selected="">Choose Country</option>
							@foreach($countries as $country)
								<option value="{{$country->id}}">{{$country->title_en}}</option>
							@endforeach
						</select>
					</label>
				</div>
				<!-- /INPUT CONTAINER -->

				<!-- INPUT CONTAINER -->
				<div class="input-container" id="state" style="display: none;">
					<label for="state_id" class="rl-label required">Select State</label>
					<label for="state_id" class="select-block">
						<select name="state_id" id="state_id" required="">
						</select>
					</label>
				<br>
				</div>
				<!-- /INPUT CONTAINER -->

				<div class="input-container" id="city" style="display: none;">
					<label for="city_id" class="rl-label required">Select City</label>
					<label for="city_id" class="select-block">
						<select name="city_id" id="city_id" >
						</select>
					</label>
				<br>
				</div>
				<!-- /INPUT CONTAINER -->

				<!-- INPUT CONTAINER -->
				<div class="input-container">
					<label for="address" class="rl-label required">Shop Address</label>
					<input type="text" id="address" name="address" required placeholder="Enter Shop Adddress...">
				</div>
				<!-- /INPUT CONTAINER -->

				<!-- INPUT CONTAINER -->
				<div class="input-container">
					<label for="title" class="rl-label">Referral Code</label>
					<input type="text" id="referral_code" name="referral_code" placeholder="Enter Refferal Code...">
				</div>
				<!-- /INPUT CONTAINER -->

				<!-- INPUT CONTAINER -->
				<div class="input-container">
					<label for="title" class="rl-label">Account Password</label>
					<input type="password" id="password" name="password" placeholder="Enter Your Password..">
				</div>
				<!-- /INPUT CONTAINER -->

				<button id="submit" class="button big dark">Submit Shop <span class="primary">for Review</span></button>
		</div>
		<!-- /FORM BOX ITEM -->
	</div>
	<div class="form-box-items wrap-1-3 right">
	   <!-- FORM BOX ITEM -->
	   <div class="form-box-item full">
	      <h4>Upload Guidelines</h4>
	      <hr class="line-separator">
	      <!-- PLAIN TEXT BOX -->
	      <div class="plain-text-box">
	         <!-- PLAIN TEXT BOX ITEM -->
	         <div class="plain-text-box-item">
	            <p class="text-header">Shop Name:</p>
	            <p>Enter the name of your shop. For example, John’s Crockery Store…</p>
	         </div>
	         <!-- /PLAIN TEXT BOX ITEM -->
	         <!-- PLAIN TEXT BOX ITEM -->
	         <div class="plain-text-box-item">
	            <p class="text-header">Shop Description:</p>
	            <p>Describe your shop in detail. What is it about, what kind of products does are up for sale etc.</p>
	         </div>
	         <!-- /PLAIN TEXT BOX ITEM -->
	         <!-- PLAIN TEXT BOX ITEM -->
	         <div class="plain-text-box-item">
	            <p class="text-header">Photo:</p>
	            <p>Enter a cover photo of your shop. In order to make it look elegant, upload the photo in ideal resolution (1346 x 300 pixels).</p>
	         </div>
	         <!-- /PLAIN TEXT BOX ITEM -->
	         <!-- PLAIN TEXT BOX ITEM -->
	         <div class="plain-text-box-item">
	            <p class="text-header">Select Country:</p>
	            <p>Enter the country, state, and city where the shop is located.</p>
	         </div>
	         <!-- /PLAIN TEXT BOX ITEM -->
	         <!-- PLAIN TEXT BOX ITEM -->
	         <div class="plain-text-box-item">
	            <p class="text-header">Referral code:</p>
	            <p>Enter the referral code (if you have any), if someone has referred Bazaarsy to you.</p>
	         </div>
	         <!-- /PLAIN TEXT BOX ITEM -->
	         <!-- PLAIN TEXT BOX ITEM -->
	         <div class="plain-text-box-item">
	            <div class="plain-text-box-item">
		            <p class="text-header">Account password:</p>
		            <p>Enter the password of your Bazaarsy account.</p>
		         </div>
	         </div>
	         <!-- /PLAIN TEXT BOX ITEM -->
	      </div>
	      <!-- /PLAIN TEXT BOX -->
	   </div>
	   <!-- /FORM BOX ITEM -->
	</div>
	</form>
	<!-- /FORM BOX ITEMS -->

	<div class="clearfix"></div>
</div>
<!-- DASHBOARD CONTENT -->


<script type="text/javascript">
	$('#submit').on('click',function(){
		if (!$("input[name='payment_id']:checked").val()) {
			window.scrollTo(0,0);
			$('#packageError').empty();
			$('#packageError').append('<div class="alert alert-warning m-b-0"><p>Please Choose Package</p></div>')
		}
		else
			$('#packageError').empty();

	});
</script>


<script type="text/javascript">
    $('#state_id').on('change',function(){
      var state_id= $('#state_id').val();
      var route = '/get-cities';
      var url =  {!! json_encode(url('/')) !!}+'/'+route+'/'+state_id;
      $('#city_id').empty();
      $.get(url, function(result){
      	$('#city').css('display','unset');
          $('#city_id').append('<option value="" disabled="" selected="">Choose City</option>');
          $.each(result, function(key, value) {
                $('#city_id').append('<option value=' + value['id'] + '>' + value['name'] + '</option>');
            });
      });
    });
</script>

<script type="text/javascript">
    $('#country_id').on('change',function(){
      var country_id= $('#country_id').val();
      var route = '/get-states';
      var url =  {!! json_encode(url('/')) !!}+'/'+route+'/'+country_id;
      $('#state_id').empty();
      $.get(url, function(result){
      	$('#state').css('display','unset');
          $('#state_id').append('<option value="" disabled="" selected="">Choose State</option>');
          $.each(result, function(key, value) {
                $('#state_id').append('<option value=' + value['id'] + '>' + value['name'] + '</option>');
            });
      });
    });
</script>


@endsection