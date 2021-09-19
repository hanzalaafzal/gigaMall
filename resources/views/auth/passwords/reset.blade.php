@extends('frontEnd.layout')
@section('content')
<!-- SECTION -->
<div class="section-wrap">
    <div class="section demo">
        <!-- FORM POPUP -->
        <div class="form-popup" style="float: unset;">

            <!-- FORM POPUP CONTENT -->
            <div class="form-popup-content">
                <h4 class="popup-title">Password Reset</h4>
                <!-- LINE SEPARATOR -->
                <hr class="line-separator">
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
                <!-- /LINE SEPARATOR -->
                <form id="login-form" method="POST" action="{{ route('resetPassword') }}">
                    {{ csrf_field() }}
                    <input type="hidden" name="token" value="{{$token}}">

                     <label for="username" class="rl-label">Email</label>
                    <input type="text" id="username" required="" name="email" value="{{ old('email') }}" placeholder="Enter your email here...">
                    
                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif 

                    <label for="password" class="rl-label required">Password</label>
                    <input name="password" required type="password" id="password" placeholder="Enter your password here...">
                    
                
                    @if ($errors->has('password'))
                        <div class="alert alert-warning">
                            <p>{{ $errors->first('password') }}</p>
                        </div>
                    @endif

                    <label for="password_confirmation" class="rl-label required">Confirm Password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" placeholder="confirm your password here...">
                    <button class="button mid dark">Reset <span class="primary">Password!</span></button>
                </form>
                <!-- LINE SEPARATOR -->
                <hr class="line-separator double">
                <!-- /LINE SEPARATOR -->
                <!-- <a href="#" class="button mid fb half">Login with Facebook</a>
                <a href="#" class="button mid twt half">Login with Twitter</a> -->
            </div>
            <!-- /FORM POPUP CONTENT -->
        </div>
        <!-- /FORM POPUP -->
    </div>
</div>
@endsection