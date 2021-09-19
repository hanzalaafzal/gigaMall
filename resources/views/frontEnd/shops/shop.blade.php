@extends('frontEnd.shops.shop_layout')

@section('shop_content')
<!-- CONTENT -->
            <div class="content right">
                <div class="comment-list">
                   <!-- COMMENT -->
                   <div class="comment-wrap" id="description">
                      <div class="comment">
                         <h5 class="text-header">Shop Details</h5>
                         <p>{{$shop->description}}</p>
                      </div>
                   </div>
                   <!-- /COMMENT -->
                </div>
                <br><br>
                <!-- HEADLINE -->
                <div class="headline buttons primary">
                    <h4>Latest Products</h4>
                    @if(Auth::check() && Auth::user()->id == $shop->users->id)
                      <a href="{{route('productCreate')}}" class="button mid-short primary">Add New Product</a>
                    @endif
                    <a href="{{route('shopAllProducts',$shop->slug)}}" class="button mid-short dark-light">See all the products</a>
                </div>
                <!-- /HEADLINE -->

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