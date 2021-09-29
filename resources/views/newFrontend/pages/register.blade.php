@extends('newFrontend.layout')



@section('main_content')

<div class="ps-page--my-account">

     <div class="ps-my-account">
         <div class="container">
             <form class="ps-form--account ps-tab-root" action="{{ url('/register') }}" method="POST" id="login-form">
                 <ul class="ps-tab-list">
                     <li><a href="{{url('/login')}}" onclick="redirect()">Login</a></li>
                     <li class="active"><a href="#sign-in">Register</a></li>
                 </ul>
                 <div class="ps-tabs">
                     <div class="ps-tab active" id="sign-in">
                         <div class="ps-form__content">
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
                             <h5>Register your account</h5>

                               @csrf
                               <div class="form-group">
                                   <input class="form-control" type="email" id="username" name="email" value="{{ old('email') }}" placeholder="Email" required>
                               </div>
                               <div class="form-group">
                                   <input class="form-control" type="user_name" id="username" name="user_name" value="{{ old('user_name') }}" placeholder="Username" required>
                               </div>
                               <div class="form-group">
                                    <select class="form-control" name="user_type" required>
                                      <option value="" disabled>Select User Type</option>
                                      <option value="1">Shop Keeper</option>
                                      <option value="2">Customer</option>
                                      <option value="3">Affiliator</option>
                                    </select>
                               </div>
                               <div class="form-group">
                                   <input class="form-control" type="password" id="password" name="password" placeholder="password">
                               </div>
                               <div class="form-group">
                                   <input class="form-control" type="password" id="password_confirmation" name="password_confirmation" placeholder="confirm password">
                               </div>

                               <div class="form-group submtit">
                                   <button class="ps-btn ps-btn--fullwidth" style="margin-bottom:100px">Register Now !</button>
                               </div>

                         </div>
                     </div>

                 </div>
             </form>
         </div>
     </div>
 </div>
@endsection
@push('jss')
<script>
    function redirect() {
      window.location.href= "{!! url('/login') !!}";
    }
</script>
@endpush
