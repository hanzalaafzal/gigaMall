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
        <h4>Withdrawal Detail</h4>
    </div>
    <!-- /HEADLINE -->

    <!-- PACK BOXES -->
    <form method="post" action="{{route('vendorWithdrawalPost')}}" id="upload_form" enctype="multipart/form-data">
    {{csrf_field()}}

	<!-- FORM BOX ITEMS -->
	<div class="form-box-items wrap-3-1 left">
		<!-- FORM BOX ITEM -->
		<div class="form-box-item full">
				<!-- INPUT CONTAINER -->
				<div class="input-container">
					<label for="full_name" class="rl-label required">Full Name</label>
					<input type="text" id="full_name" name="full_name" required placeholder="Enter Full Name...">
				</div>
				<!-- /INPUT CONTAINER -->

				<!-- INPUT CONTAINER -->
				<div class="input-container">
					<label for="email" class="rl-label required">Email</label>
					<input type="email" id="email" name="email" required placeholder="Enter Email...">
				</div>
				<!-- /INPUT CONTAINER -->

				<!-- INPUT CONTAINER -->
				<div class="input-container">
					<label for="address" class="rl-label required">Address</label>
					<input type="text" id="address" name="address" required placeholder="Enter Address...">
				</div>
				<!-- /INPUT CONTAINER -->

				<!-- INPUT CONTAINER -->
				<div class="input-container">
					<label for="bank_name" class="rl-label required">Bank Name</label>
					<input type="text" id="bank_name" name="bank_name" required placeholder="Enter Bank Name...">
				</div>
				<!-- /INPUT CONTAINER -->

				<!-- INPUT CONTAINER -->
				<div class="input-container">
					<label for="account_number" class="rl-label required">Account Number</label>
					<input type="text" id="account_number" name="account_number" required placeholder="Enter Account Number...">
				</div>
				<!-- /INPUT CONTAINER -->


				<button id="submit" class="button big dark">Submit <span class="primary">Request</span></button>
		</div>
		<!-- /FORM BOX ITEM -->
	</div>
	<div class="form-box-items wrap-1-3 right">
	</div>
	</form>
	<!-- /FORM BOX ITEMS -->

	<div class="clearfix"></div>
</div>
<!-- DASHBOARD CONTENT -->

@endsection