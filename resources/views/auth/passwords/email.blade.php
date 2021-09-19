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
                <form id="login-form" method="POST" action="{{ route('sendResetPasswordLink') }}">
                    {{ csrf_field() }}
                    <label for="username" class="rl-label">Email</label>
                    <input type="text" id="username" required="" name="email" value="{{ old('email') }}" placeholder="Enter your email here...">
                    
                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif 
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