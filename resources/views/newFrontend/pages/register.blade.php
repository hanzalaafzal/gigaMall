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

                           @if($errors->any())
                           <div class="alert alert-warning">
                             @foreach($errors->all() as $error)
                              <p><strong>{{ $error }}</strong></p>
                             @endforeach

                           </div>
                           @endif
                             <h5>Register your account</h5>

                               @csrf
                               <div class="form-group">
                                   <input class="form-control" type="email" id="username" name="email" value="{{ old('email') }}" placeholder="Email" required autocomplete="off">
                               </div>
                               <div class="form-group">
                                   <input class="form-control" type="user_name" id="username" name="user_name" value="{{ old('user_name') }}" placeholder="Username" required autocomplete="off"> 
                               </div>
                               <div class="form-group">
                                    <select class="form-control" name="user_type" id="user_type" required>
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
                               <div id="shopkeeperFrom" style="display:block">
                                 <div class="form-group">
                                     <input class="form-control @if($errors->has('shop_name')) is-invalid @endif" type="text" id="shop_name" name="shop_name" value="{{ old('shop_name') }}" placeholder="Shop Name * ">
                                 </div>
                                 <div class="form-group">
                                     <input class="form-control @if($errors->has('business_name')) is-invalid @endif" type="text" id="business_name" name="business_name" value="{{ old('business_name') }}" placeholder="Business Name *">
                                 </div>
                                 <div class="form-group">
                                     <input class="form-control @if($errors->has('cnic')) is-invalid @endif" type="text" id="cnic" name="cnic" value="{{ old('cnic') }}" placeholder="CNIC (without dashes)">
                                 </div>
                                 <div class="form-group">
                                     <input class="form-control @if($errors->has('city')) is-invalid @endif" type="text" id="city" name="city" value="{{ old('city') }}" placeholder="City *">
                                 </div>
                                 <div class="form-group">
                                     <input class="form-control @if($errors->has('province')) is-invalid @endif" type="text" id="province" name="province" value="{{ old('province') }}" placeholder="Province *">
                                 </div>
                                 <div class="form-group">
                                     <input class="form-control @if($errors->has('ntn')) is-invalid @endif" type="text" id="NTN" name="ntn" placeholder="NTN" value ="{{ old('ntn') }}">
                                 </div>
                                 <div class="form-group">
                                     <input class="form-control @if($errors->has('stn')) is-invalid @endif" type="text" id="STN" name="stn" placeholder="STN" value="{{ old('stn') }}">
                                 </div>
                                 <div class="form-group">
                                     <input class="form-control @if($errors->has('mobile')) is-invalid @endif" type="text" id="mobile" name="mobile" placeholder="Mobile No *" value="{{ old('mobile') }}">
                                 </div>
                                 <div class="form-group">
                                     <textarea class="form-control @if($errors->has('shop_address')) is-invalid @endif" type="text" id="shop_address" name="shop_address" placeholder="Shop address">{{ old('shop_address') }}</textarea>
                                 </div>

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

    $('#user_type').change(function(){
      const type=$('#user_type').val();
      if(type == 1){
        $('#shopkeeperFrom').css('display','block');
      }else{
        $('#shopkeeperFrom').css('display','none');
      }
    })
</script>
@endpush
