@extends('frontEnd.layout')

@section('content')
<style type="text/css">
  .ht-banner .ht-banner-img1{
    width: 100% !important;
    height: 100% !important;
        top: 0px !important;
    right: 0px !important;
  }
  .ht-banner .ht-banner-img2 {
    width: 100% !important;
    height: 100% !important;
        top: 0px !important;
    left: 0px !important;
  }
</style>
<!-- HT BANNER WRAP -->
  <div class="ht-banner-wrap">
    <!-- HT BANNER -->
    <div class="ht-banner void violet">
      <figure class="ht-banner-img1">
        <video width="100%" height="100%" controls>
          <source src="{{url('frontEnd/videos/how-to/How-to-signup-client.mp4')}}" type="video/mp4">
          Your browser does not support the video tag.
        </video>
      </figure>
    </div>
    <!-- /HT BANNER -->

    <!-- HT BANNER -->
    <div class="ht-banner">
      <!-- HT BANNER CONTENT -->
      <div class="ht-banner-content">
        <p class="text-header">How to signup</p>
        <p>Hit the register button at the top of the website. Enter your email, username, user type, and password. Click on register button. Your account will be easily created, and you’ll be good to go.</p>
        <a href="{{url('/register')}}" class="button mid dark">Create your <span class="primary">New Account</span></a>
      </div>
      <!-- /HT BANNER CONTENT -->
    </div>
    <!-- /HT BANNER -->

    <!-- HT BANNER -->
    <div class="ht-banner void pink">
      <figure class="ht-banner-img2">
        <video width="100%" height="100%" controls>
          <source src="{{url('frontEnd/videos/how-to/How-to-signup-client.mp4')}}" type="video/mp4">
          Your browser does not support the video tag.
        </video>
      </figure>
    </div>
    <!-- /HT BANNER -->

    <!-- HT BANNER -->
    <div class="ht-banner">
      <!-- HT BANNER CONTENT -->
      <div class="ht-banner-content">
        <p class="text-header">Completing profile & addresses:</p>
        <p>To complete your eBazaar profile, enter all the required information on the dashboard and hit the update button. Your profile will be easily updated. To add a shipping or billing address, enter the name, phone number, country, zip code, and complete address. Then hit the submit button. Your address will be saved. You can also add more than one shipping or billing addresses.</p>
      </div>
      <!-- /HT BANNER CONTENT -->
    </div>
    <!-- /HT BANNER -->

    <!-- HT BANNER -->
    <div class="ht-banner void blue">
      <figure class="ht-banner-img1">
        <video width="100%" height="100%" controls>
          <source src="{{url('frontEnd/videos/how-to/how-to-send.mp4')}}" type="video/mp4">
          Your browser does not support the video tag.
        </video>
      </figure>
    </div>
    <!-- /HT BANNER -->

    <!-- HT BANNER -->
    <div class="ht-banner">
      <!-- HT BANNER CONTENT -->
      <div class="ht-banner-content">
        <p class="text-header">How to place orders:</p>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris pretium porta eros imperdiet posuere. Nulla sagittis blandit sodales.</p>
      </div>
      <!-- /HT BANNER CONTENT -->
    </div>
    <!-- /HT BANNER -->
  </div>
  <!-- /HT BANNER WRAP -->
@endsection