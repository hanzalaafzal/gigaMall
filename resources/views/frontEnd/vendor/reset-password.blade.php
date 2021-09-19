@extends('frontEnd.vendor.layout')

@section('dashboard')
<div class="dashboard-content">
	<!-- HEADLINE -->
	<div class="headline buttons primary">
	    <h4>Password Reset</h4>
	</div>
	<!-- /HEADLINE -->

	<div class="form-box-item">
		<h4>Reset Password</h4>
		<hr class="line-separator">
		<form action="{{route('ResetPasswordUpdate')}}" enctype="multipart/form-data" method="post">
		    {{csrf_field()}}
			<!-- INPUT CONTAINER -->
			<div class="input-container">
				<label for="old_password" class="rl-label required">Old Password</label>
				<input type="password" id="old_password" required name="old_password" placeholder="Enter your old password here...">
			</div>
			<!-- /INPUT CONTAINER -->

			<!-- INPUT CONTAINER -->
			<div class="input-container half">
				<label for="new_password" class="rl-label required">New Password</label>
				<input type="password" id="new_password" required name="new_password" placeholder="Enter your new password here...">
			</div>
			<!-- /INPUT CONTAINER -->

			<!-- INPUT CONTAINER -->
			<div class="input-container half">
				<label for="confirm_password" class="rl-label required">Comfirm Password</label>
				<input type="password" id="confirm_password" required name="confirm_password" placeholder="Enter your comfirm password here...">
			</div>
			<!-- /INPUT CONTAINER -->

			<button class="button mid-short primary">Reset Password</button>
		</form>

	</div>

</div>

@endsection