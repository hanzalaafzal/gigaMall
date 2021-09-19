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
        <h4>Choose Package</h4>
    </div>
    <!-- /HEADLINE -->
		<!-- PACK BOXES -->
			<div class="pack-boxes">
				@if(count($payments) > 0)
					<?php $i =1; ?>
					@foreach($payments as $payment)
						<!-- PACK BOX -->
						<div class="pack-box">
							<p class="text-header small">{{$payment->packages->name}}</p>
							<p class="price larger"><span>$</span>{{$payment->packages->price}}</p>
							<p class="credit">Allowed Products: {{$payment->packages->products}}</p>
							<span class="button dark-light">Select Pack</span>
						</div>
						<!-- /PACK BOX -->
						<?php $i++; ?>
					@endforeach
				@else
					<div style="width: 100%; text-align: center;">
						<h4>You haven’t purchased any package yet.</h4>
					</div>
				@endif
				<a href="{{route('buyPackage')}}" style="width: 100%;">
					<div class="pack-box">
						<p class="price larger" style="    right: -10px;"><span>Buy Packages</span></p>
						<br><br>
						<span class="button dark-light">Buy Now</span>
					</div>
				</a>
			</div>
		<!-- /PACK BOXES -->
		<div class="clearfix"></div>			
		<!-- FORM BOX ITEMS -->
	<!-- /FORM BOX ITEMS -->
</div>
<!-- DASHBOARD CONTENT -->
@endsection