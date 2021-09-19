@extends('frontEnd.layout')
@section('content')
<!-- SECTION -->
<div class="section-wrap">
    <div class="section demo">
        <!-- FORM POPUP -->
        <div class="form-popup" style="float: unset;">

            <!-- FORM POPUP CONTENT -->
            <div class="form-popup-content">
                <h4 class="popup-title">Login to your Account</h4>
                <!-- LINE SEPARATOR -->
                <hr class="line-separator">
                @if ($errors->has('password'))
                    <div class="alert alert-warning">
                        <p><strong>{{ $errors->first('password') }}</strong></p>
                    </div>
                @endif
                @if ($errors->has('email'))
                    <div class="alert alert-warning">
                        <p><strong>{{ $errors->first('email') }}</strong></p>
                    </div>
                @endif
                <!-- /LINE SEPARATOR -->
                <form id="login-form" method="POST" action="{{ url('/login') }}">
                    {{ csrf_field() }}
                    <label for="username" class="rl-label">Email</label>
                    <input type="email" id="username" required="" name="email" value="{{ old('email') }}" placeholder="Enter your email here...">
                    
                    <label for="password" class="rl-label">Password</label>
                    <input type="password" required="" id="password" name="password" placeholder="Enter your password here...">
                    
                    <!-- CHECKBOX -->
                    <input type="checkbox" id="remember" name="remember" checked>
                    <label for="remember" class="label-check">
                        <span class="checkbox primary primary"><span></span></span>
                        Remember username and password
                    </label>
                    <!-- /CHECKBOX -->
                    <p>Forgot your password? <a href="{{url('/password/reset')}}" class="primary">Click here!</a></p>
                    <button class="button mid dark">Login <span class="primary">Now!</span></button>
                </form>
                <!-- LINE SEPARATOR -->
                <hr class="line-separator double">
                <!-- /LINE SEPARATOR -->

                    <p style="text-align: center;">Don't have account? <a href="{{url('/register')}}" class="primary">Sign Up!</a></p>
                <!-- <a href="#" class="button mid fb half">Login with Facebook</a>
                <a href="#" class="button mid twt half">Login with Twitter</a> -->
            </div>
            <!-- /FORM POPUP CONTENT -->
        </div>
        <!-- /FORM POPUP -->
    </div>
</div>
@endsection