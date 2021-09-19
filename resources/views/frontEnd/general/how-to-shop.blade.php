@extends('frontEnd.layout')

@section('content')
<!-- HT BANNER WRAP -->
  <div class="ht-banner-wrap">
    <!-- HT BANNER -->
    <div class="ht-banner void violet">
      <figure class="ht-banner-img1">
        <img src="{{url('/frontEnd/images/how_to_shop_01.png')}}" alt="">
      </figure>
    </div>
    <!-- /HT BANNER -->

    <!-- HT BANNER -->
    <div class="ht-banner">
      <!-- HT BANNER CONTENT -->
      <div class="ht-banner-content">
        <p class="text-header">Create Your Account</p>
        <p>Creating your account is fast and easy. Simply enter some information about your business and your store is ready for the next step. Next, get your eCom Store set up by following simple video tutorials. If you've got several different products or services, then you can create as many eCom Stores as you need.</p>
        <a href="{{url('/register')}}" class="button mid dark">Create your <span class="primary">New Account</span></a>
      </div>
      <!-- /HT BANNER CONTENT -->
    </div>
    <!-- /HT BANNER -->

    <!-- HT BANNER -->
    <div class="ht-banner void pink">
      <figure class="ht-banner-img2">
        <img src="{{url('/frontEnd/images/how_to_shop_02.png')}}" alt="">
      </figure>
    </div>
    <!-- /HT BANNER -->

    <!-- HT BANNER -->
    <div class="ht-banner">
      <!-- HT BANNER CONTENT -->
      <div class="ht-banner-content">
        <p class="text-header">Browse Our Shop Items</p>
        <p>Find almost any item for sale in our worldwide marketplace. Whether you're looking for products, services, giftcards, or any digital item, you'll most likely find it in our marketplace. If you can't find an item, simply send an email to suggestions ebazzarpk.com and let us know of the item you're looking for.</p>
        <form method="get" id="search_form" action="{{route('searchProduct')}}"></form>
        <a onclick="$('#search_form').submit();" class="button mid dark"><span class="primary">Most Popular</span> Items</a>
      </div>
      <!-- /HT BANNER CONTENT -->
    </div>
    <!-- /HT BANNER -->

    <!-- HT BANNER -->
    <div class="ht-banner void blue">
      <figure class="ht-banner-img3">
        <img src="{{url('/frontEnd/images/how_to_shop_03.png')}}" alt="">
      </figure>
    </div>
    <!-- /HT BANNER -->

    <!-- HT BANNER -->
    <div class="ht-banner">
      <!-- HT BANNER CONTENT -->
      <div class="ht-banner-content">
        <p class="text-header">Shopping Cart and Checkout</p>
        <p>We make it easy for you to complete your purchase. Just add your item to your shopping cart and pay using the payment options your seller is offering. If you have any questions, communicate with the seller using email or our chat option.</p>
        <a href="{{route('myCart')}}" class="button mid dark">Our <span class="primary">Payment Methods</span></a>
      </div>
      <!-- /HT BANNER CONTENT -->
    </div>
    <!-- /HT BANNER -->
  </div>
  <!-- /HT BANNER WRAP -->
@endsection