@extends('frontEnd.shop_owners.owner_layout')
@section('shop_owner_content')

<style type="text/css">
  .profile-notifications {
    margin: 0 auto 10px;
}
</style>
<!-- CONTENT -->
<div class="content right">
    <!-- HEADLINE -->
    <div class="headline buttons primary">
        <h4>All Products</h4>
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