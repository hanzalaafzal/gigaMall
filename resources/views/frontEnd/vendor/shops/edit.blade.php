@extends('frontEnd.vendor.layout')

@section('dashboard')
<style type="text/css">
	.pack-boxes .radio{
		position: relative !important;
	    top: 30px !important;
	    z-index: 1;
	    left: 7px;
	}
</style>
<!-- DASHBOARD CONTENT -->
<div class="dashboard-content">
    <!-- HEADLINE -->
    <div class="headline simple primary">
        <h4>Edit Shop</h4>
        <div class="headline-status">
        	<h6>{{$shop->status}}</h6>
        </div>
    </div>
    <!-- /HEADLINE -->

    <!-- PACK BOXES -->
    <form method="post" action="{{route('shopUpdate')}}" id="upload_form" enctype="multipart/form-data">
    {{csrf_field()}}
    <input type="hidden" value="{{$shop->slug}}" name="slug">
	<!-- FORM BOX ITEMS -->
	<div class="form-box-items wrap-3-1 left">
		<!-- FORM BOX ITEM -->
		<div class="form-box-item full">
			<h4>Edit Shop Details</h4>
			<hr class="line-separator">
				<!-- INPUT CONTAINER -->
				<div class="input-container">
					<label for="title" class="rl-label required">Shop Name</label>
					<input type="text" id="title" name="title" required value="{{$shop->title}}">
				</div>
				<!-- /INPUT CONTAINER -->

				<!-- INPUT CONTAINER -->
				<div class="input-container">
					<label for="description" class="rl-label required">Shop Description</label>
					<textarea id="description" name="description" required placeholder="Enter Shop Description...">{{$shop->description}}</textarea>
				</div>
				<!-- /INPUT CONTAINER -->

				<!-- INPUT CONTAINER -->
				<div class="input-container">
					<label for="currency" class="rl-label required">Select Currency</label>
					<label for="currency" class="select-block">
						<select name="currency" id="currency" required="">
							<option value="" disabled="" selected="">Choose Currency</option>
							<option value="USD" 
							<?php
								if ($shop->currency == 'USD') {
									echo "selected";
								}
							?>
							>USD</option>
							<option value="PKR"
							<?php
								if ($shop->currency == 'PKR') {
									echo "selected";
								}
							?>
							>PKR</option>
						</select>
					</label>
				</div>
				<!-- /INPUT CONTAINER -->

				<!-- INPUT CONTAINER -->
				<div class="input-container">
					<label for="photo" class="rl-label">Photo</label>
					<input type="file" id="photo" name="photo">
					<p><small class="alert-danger" id="photoError"></small></p>
					<br>
					<img width="300px;" src="{{url('/frontEnd/images/shops/'.$shop->photo)}}">
				</div>
				<!-- /INPUT CONTAINER -->

				<!-- INPUT CONTAINER -->
				<div class="input-container">
					<label for="country_id" class="rl-label required">Select Country</label>
					<label for="country_id" class="select-block">
						<select name="country_id" id="country_id" required="">
							@foreach($countries as $country)
								<option <?php if($country->id == $shop->country_id){echo "selected";} ?> value="{{$country->id}}">{{$country->title_en}}</option>
							@endforeach
						</select>
					</label>
				</div>
				<!-- /INPUT CONTAINER -->

				<!-- INPUT CONTAINER -->
				<div class="input-container" id="state">
					<label for="state_id" class="rl-label required">Select State</label>
					<label for="state_id" class="select-block">
						<select name="state_id" id="state_id" required="">
							@foreach($states as $state)
								<option <?php if($state->id == $shop->state_id){echo "selected";} ?> value="{{$state->id}}">{{$state->name}}</option>
							@endforeach
						</select>
					</label>
				<br>
				</div>
				<!-- /INPUT CONTAINER -->

				<div class="input-container" id="city" >
					<label for="city_id" class="rl-label required">Select City</label>
					<label for="city_id" class="select-block">
						<select name="city_id" id="city_id" >
							@foreach($cities as $city)
								<option <?php if($city->id == $shop->city_id){echo "selected";} ?> value="{{$city->id}}">{{$city->name}}</option>
							@endforeach
						</select>
					</label>
				<br>
				<br>
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
      	$('#city_id').empty();
          $('#state_id').append('<option value="" disabled="" selected="">Choose State</option>');
          $.each(result, function(key, value) {
                $('#state_id').append('<option value=' + value['id'] + '>' + value['name'] + '</option>');
            });
      });
    });
</script>


@endsection