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
          <source src="{{url('')}}" type="video/mp4">
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
          <source src="{{url('')}}" type="video/mp4">
          Your browser does not support the video tag.
        </video>
      </figure>
    </div>
    <!-- /HT BANNER -->

    <!-- HT BANNER -->
    <div class="ht-banner">
      <!-- HT BANNER CONTENT -->
      <div class="ht-banner-content">
        <p class="text-header">How to create shop</p>
        <p>Login to your eBazaar account and under shops submenu, click on “Add new shop”. You can either select the free package, the package you’ve purchased, or buy a new one. Shops created under each package allow limited number of products to be added. Add all the necessary shop details like shop name, description, picture, country, state, city, referral code, and your account password. Then, hit the submit button. Once the shop is approved by the admin, it will be activated. Then, you will be able to add products in it.</p>
      </div>
      <!-- /HT BANNER CONTENT -->
    </div>
    <!-- /HT BANNER -->

    <!-- HT BANNER -->
    <div class="ht-banner void blue">
      <figure class="ht-banner-img1">
        <video width="100%" height="100%" controls>
          <source src="{{url('')}}" type="video/mp4">
          Your browser does not support the video tag.
        </video>
      </figure>
    </div>
    <!-- /HT BANNER -->

    <!-- HT BANNER -->
    <div class="ht-banner">
      <!-- HT BANNER CONTENT -->
      <div class="ht-banner-content">
        <p class="text-header">How to add product</p>
        <p>Login to your eBazaar account and under products submenu, click on “Add new product”. Add all the necessary product details, like product name, description, price, shipping price, quantity, picture, shop, product type, category and sub category, and gallery photos if you want. Then, hit the submit button. Once the product is approved by the admin, it will be visible to users. Then, customers could order your product.</p>
      </div>
      <!-- /HT BANNER CONTENT -->
    </div>
    <!-- /HT BANNER -->

  </div>
  <!-- /HT BANNER WRAP -->
@endsection