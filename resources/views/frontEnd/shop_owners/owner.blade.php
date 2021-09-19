@extends('frontEnd.shop_owners.owner_layout')
@section('shop_owner_content')

<style type="text/css">
  .profile-notifications {
    margin: 0 auto 10px;
}
</style>
<div class="headline buttons primary">
    <h4>Latest Shops</h4>
    <a href="{{route('shopOwnerAllShops',$user->user_name)}}" class="button mid-short dark-light">See all the Shops</a>
</div>
<!-- CONTENT -->
<div class="content right">    

    @if(count($shops)>0)
        <!-- PROFILE NOTIFICATIONS -->
       @foreach($shops as $shop)
        <div class="profile-notifications">
          <!-- PROFILE NOTIFICATION -->
          <div class="profile-notification">
             <div class="profile-notification-date">
                <p>Shop</p>
             </div>
             <div class="profile-notification-body" style="padding-left: 0px;">
                <!-- <figure class="user-avatar">
                   <img src="images/avatars/avatar_02.jpg" alt="user-avatar">
                </figure> -->
                <p>
                  <span>
                    <a href="{{route('shopView',$shop->slug)}}" style="color: black">
                      {{$shop->title}}
                    </a>
                  </span>
                </p>

             </div>
             <div class="profile-notification-type">
              <div class="recommendation-wrap" style="margin-top: 17px;">
                    <a title="View" href="{{route('shopView',$shop->slug)}}" class="recommendation good hoverable open-recommendation-form">
                      <i class="far fa-eye"></i>
                    </a>
                </div> 
                <span class="type-icon icon-heart primary"><!-- 
                  <a href="" class="button button secondary">Edit</a>
                  <a href="" class="button dark-light">View</a>   -->

                </span>
             </div>
          </div>
          <!-- PROFILE NOTIFICATION -->
       </div>
       @endforeach
       <!-- /PROFILE NOTIFICATIONS -->
       @else
        <div style="text-align: center;color: lightgray;">
          <h4>No Shop Listed</h4>
        </div>
       @endif
    <!-- /HEADLINE -->

    <br>
    <hr class="line-separator">
    <br>
    <!-- HEADLINE -->
    <div class="headline buttons primary">
        <h4>Latest Products</h4>
        <a href="{{route('shopOwnerAllProducts',$user->user_name)}}" class="button mid-short dark-light">See all the Products</a>
    </div>
    <!-- PRODUCT LIST -->
    <div class="product-list grid column3-4-wrap">
        @if(count($products)>0)
            @foreach($products as $product)
              @include('frontEnd.includes.products_list')
            @endforeach
        @else
            <h5>No Product Listed</h5>
            <br>
        @endif                     
    </div>
    <!-- /PRODUCT LIST -->

    <div class="clearfix"></div>
</div>
<!-- CONTENT -->
@endsection