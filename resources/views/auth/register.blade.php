@extends('frontEnd.layout')
@section('content')
<div class="section-wrap">
    <div class="section demo">
        <!-- FORM POPUP -->
        <div class="form-popup" style="float: unset;">

            <!-- FORM POPUP CONTENT -->
            <div class="form-popup-content">
                <h4 class="popup-title">Register Account</h4>
                <!-- LINE SEPARATOR -->
                <hr class="line-separator">
                <!-- /LINE SEPARATOR -->
                <form id="register-form"  method="post" action="{{ url('/register') }}">
                    {{ csrf_field() }}
                    <label for="email_address" class="rl-label required">Email Address</label>
                    <input type="email" id="email_address"  name="email" value="{{ old('email') }}" required  placeholder="Enter your email address here...">

                    <label for="user_name" class="rl-label">Username</label>
                    <input type="text" id="user_name" name="user_name" value="{{ old('user_name') }}" required placeholder="Enter your username here...">

                    <label for="password_confirmation" class="rl-label required">User Type</label>
                    <select name="user_type" required="" style="margin-bottom: 20px;">
                        <option value="" disabled="" selected="">Select User Type</option>
                        <option value="1">Shop Partner</option>
                        <option value="2">Customer</option>
                        <option value="3">Affiliator</option>
                    </select>

                    <label for="password" class="rl-label required">Password</label>
                    <input name="password" required type="password" id="password" placeholder="Enter your password here...">

                    <label for="password_confirmation" class="rl-label required">Confirm Password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" placeholder="confirm your password here...">

                    <button class="button mid dark">Register <span class="primary">Now!</span></button>
                </form>
            </div>
            <!-- /FORM POPUP CONTENT -->
        </div>
        <!-- /FORM POPUP -->
    </div>
</div>
@endsection