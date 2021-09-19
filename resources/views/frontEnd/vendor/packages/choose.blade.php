@extends('frontEnd.vendor.layout')
@section('dashboard')


<?php
	$price = App\Helpers\Helper_user::usd_to_pkr($packages[1]->price);
?>

<style type="text/css">
	.pack-boxes .radio{
		position: relative !important;
	    top: 30px !important;
	    z-index: 1;
	    left: 7px;
	}
	@media screen and (min-width: 1440px) {
        .pack-boxes .radio{
            left: -44px !important;
            top: 6px !important;
        }
    }
    @media screen and (max-width: 667px){
        .packageATag{
        	float: left;
        }
        .packageLable{
        	width: 100% !important;
        }
	}

</style>
<!-- DASHBOARD CONTENT -->
<div class="dashboard-content">
    <!-- HEADLINE -->
    <div class="headline simple primary">
        <h4>Choose Package</h4>
    </div>
    <!-- /HEADLINE -->
	<form method="post" id="form" action="{{route('masterCardAuthorizeNet')}}">
		{{ csrf_field() }}
		<!-- PACK BOXES -->
		<div class="pack-boxes">
			<?php $i =1; ?>
			@foreach($packages as $package)
				<!-- PACK BOX -->				
				<input type="radio" id="package_id{{$i}}" name="package_id" value="{{$package->id}}">
				<label for="package_id{{$i}}" class="packageLable" style="width: 25%; float: left;">
					<span class="radio primary"><span></span></span>
					<div class="pack-box">
						<p class="text-header small">{{$package->name}}</p>
						<p class="price larger"><span>$</span>{{$package->price}}</p>
						<p class="credit">Allowed Products: {{$package->products}}</p>
						<span class="button dark-light">Select Pack</span>
					</div>
				</label>
				<!-- /PACK BOX -->
				<?php $i++; ?>
			@endforeach
		</div>
		<!-- /PACK BOXES -->

		<div class="clearfix"></div>			

		<!-- FORM BOX ITEMS -->
		<div class="form-box-items">
			<!-- FORM BOX ITEM -->
			<div class="pre-loader" style="position: absolute;">
				<img src="{{url('/frontEnd/images/pre-loader.gif')}}">
			</div>
			<div class="form-box-item" style="width: 100%;">
				<h4>Payment &amp; Detail</h4>
				<hr class="line-separator">
					<label class="rl-label">Choose your Payment Method</label>
					<!-- RADIO -->
					<input type="radio" id="credit_card" name="payment_method" value="cc" checked>
					<label for="credit_card">
						<span class="radio primary"><span></span></span>
						Master Card
					</label>
					<hr class="line-separator top">

					<!-- INPUT CONTAINER -->
					<div class="input-container">
						<label for="credit_card_number" class="rl-label required">Credit Card Number</label>
						<input type="text" id="credit_card_number" name="credit_card_number" placeholder="Enter your credit card number here...">
					</div>
					<!-- /INPUT CONTAINER -->
					
					<!-- INPUT CONTAINER -->
					<div class="input-container half">
						<label for="expiry_month" class="rl-label required">Expiration Month</label>
						<label for="expiry_month" class="select-block">
							<select name="expiry_month" id="expiry_month">
								<option disable>Select the expiration Month...</option>
								<option value="01">Jan (01)</option>
                                <option value="02">Feb (02)</option>
                                <option value="03">Mar (03)</option>
                                <option value="04">Apr (04)</option>
                                <option value="05">May (05)</option>
                                <option value="06">June (06)</option>
                                <option value="07">July (07)</option>
                                <option value="08">Aug (08)</option>
                                <option value="09">Sep (09)</option>
                                <option value="10">Oct (10)</option>1
                                <option value="11">Nov (11)</option>
                                <option value="12">Dec (12)</option>
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
						<label for="expiry_year" class="rl-label required">Expiration Year</label>
						<label for="expiry_year" class="select-block">
							<select name="expiry_year" id="expiry_year">
								<option disable>Select the expiration Month...</option>
								<option value="2019">2019</option>
								<option value="2020">2020</option>
								<option value="2021">2021</option>
								<option value="2022">2022</option>
								<option value="2023">2023</option>
								<option value="2024">2024</option>
								<option value="2025">2025</option>
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
						<label for="secode" class="rl-label required">Card CVV</label>
						<input type="password" id="cvv" name="cvv" placeholder="Enter your Card CVV here...">
					</div>
					<!-- /INPUT CONTAINER -->
					<div class="clearfix"></div>
					<hr class="line-separator">
					<button class="button big dark" id="submit">Buy Package <span class="primary">Now!</span></button>
			</div>
			<!-- /FORM BOX ITEM -->
		</div>
	</form>
	<!-- /FORM BOX ITEMS -->
</div>
<!-- DASHBOARD CONTENT -->
<script type="text/javascript">
	$('#submit').click(function() {
		$('.pre-loader').css('z-index','9');        
	});
</script>
@endsection