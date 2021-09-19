@extends('frontEnd.shops.shop_layout')

@section('shop_content')
<!-- CONTENT -->
<div class="headline buttons primary">
    <h4>All Products</h4>
</div>
<!-- /HEADLINE -->

<!-- PRODUCT LIST -->
<div class="product-list grid column3-4-wrap">
    @if(count($products)>0)
        @foreach($products as $product)
        @include('frontEnd.includes.products_list')
    @endforeach
      <div style="width: 100%;float: right">
        {{$products->links()}}
      </div>
    @else
        <h5>No Product Listed</h5>
        <br>
    @endif                     
</div>
<!-- /PRODUCT LIST -->
<!-- /CONTENT -->
@endsection