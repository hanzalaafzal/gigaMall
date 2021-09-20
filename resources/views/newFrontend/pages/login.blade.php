@extends('newFrontend.layout')



@section('main_content')

<div class="ps-page--my-account">

     <div class="ps-my-account">
         <div class="container">
             <form class="ps-form--account ps-tab-root" action="{{ url('/login') }}" method="POST" id="login-form">
                 <ul class="ps-tab-list">
                     <li class="active"><a href="#sign-in">Login</a></li>
                     <li><a href="#register">Register</a></li>
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
                             <h5>Log In Your Account</h5>
                             
                               @csrf
                               <div class="form-group">
                                   <input class="form-control" type="email" id="username" name="email" value="{{ old('email') }}" placeholder="Email">
                               </div>
                               <div class="form-group">
                                   <input class="form-control" type="password" id="password" name="password" placeholder="password">
                               </div>
                               <div class="form-group">
                                   <div class="ps-checkbox">
                                       <input class="form-control" type="checkbox" id="remember" name="remember" checked/>
                                       <label for="remember">Rememeber me</label>
                                   </div>
                               </div>
                               <div class="form-group submtit">
                                   <button class="ps-btn ps-btn--fullwidth" style="margin-bottom:100px">Login</button>
                               </div>

                         </div>
                     </div>
                     <div class="ps-tab" id="register">
                         <div class="ps-form__content">
                             <h5>Register An Account</h5>
                             <div class="form-group">
                                 <input class="form-control" type="text" placeholder="Username or email address">
                             </div>
                             <div class="form-group">
                                 <input class="form-control" type="text" placeholder="Password">
                             </div>
                             <div class="form-group submtit">
                                 <button class="ps-btn ps-btn--fullwidth">Login</button>
                             </div>
                         </div>
                         <div class="ps-form__footer">
                             <p>Connect with:</p>
                             <ul class="ps-list--social">
                                 <li><a class="facebook" href="#"><i class="fa fa-facebook"></i></a></li>
                                 <li><a class="google" href="#"><i class="fa fa-google-plus"></i></a></li>
                                 <li><a class="twitter" href="#"><i class="fa fa-twitter"></i></a></li>
                                 <li><a class="instagram" href="#"><i class="fa fa-instagram"></i></a></li>
                             </ul>
                         </div>
                     </div>
                 </div>
             </form>
         </div>
     </div>
 </div>
@endsection
