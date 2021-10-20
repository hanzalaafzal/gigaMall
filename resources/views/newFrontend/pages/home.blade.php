@extends('newFrontend.layout')

@push('css')
<style media="screen">
.ps-deal-of-day .ps-section__header {
  margin-bottom: 65px;
  padding-bottom: 10px;
  display: flex;
  flex-flow: row nowrap;
  justify-content: space-between;
  align-items: center;
  border-bottom: 1px solid #ccc;
  background-color: #21a767;
  padding-top: 15px;
  padding-right: 15px;
  padding-bottom: 15px;
  padding-left: 15px;
}
</style>
@endpush

@section('main_content')
<div id="homepage-4">
    <div class="ps-home-banner">
        <div class="container">
          @php
            $count=1
          @endphp
            <div class="" style="width:100%">
                <div class="ps-carousel--nav-inside owl-slider" data-owl-auto="true" data-owl-loop="false" data-owl-speed="5000" data-owl-gap="1" data-owl-nav="true" data-owl-dots="true" data-owl-item="1" data-owl-item-xs="1" data-owl-item-sm="1" data-owl-item-md="1" data-owl-item-lg="1" data-owl-duration="1000" data-owl-mousedrag="on">
                  @foreach($slider as $key=>$slid)
                  <a href="{{route('productView',$slid->slug)}}">
                    <img style="width:100%;height:331px" src="{{url('/frontEnd/images/products/'.$slid->photo)}}" alt="">
                  </a>
                  @endforeach
               </div>
            </div>

        </div>
    </div>
    <div class="ps-deal-of-day">
        <div class="container">
            <div class="ps-section__header">
                <div class="ps-block--countdown-deal">
                    <div class="ps-block__left">
                        <h3> <a href="/products/search?ebazarr=yes"> E-bazarr Mall</a></h3>
                    </div>
                </div>
                <!-- <a href="shop-default.html">View all</a> -->
            </div>
            <div class="ps-section__content">
                <div class="ps-carousel--nav owl-slider" data-owl-auto="true" data-owl-loop="true" data-owl-speed="5000" data-owl-gap="30" data-owl-nav="true" data-owl-dots="true" data-owl-item="5" data-owl-item-xs="2" data-owl-item-sm="3" data-owl-item-md="4" data-owl-item-lg="4" data-owl-item-xl="5" data-owl-duration="1000" data-owl-mousedrag="on">
                  @foreach($admin_products as $product)
                      @include('newFrontend.includes.product_list')
                  @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="ps-deal-of-day">
        <div class="container">
            <div class="ps-section__header">
                <div class="ps-block--countdown-deal">
                    <div class="ps-block__left">
                        <h3>Daily Sale</h3>
                    </div>
                    <div class="ps-block__right">
                        <figure>
                            <figcaption>Ends in:</figcaption>
                            <ul class="ps-countdown" data-time="December 30, 2021 15:37:25">
                                <li><span class="days"></span></li>
                                <li><span class="hours"></span></li>
                                <li><span class="minutes"></span></li>
                                <li><span class="seconds"></span></li>
                            </ul>
                        </figure>
                    </div>
                </div>
                <!-- <a href="shop-default.html">View all</a> -->
            </div>
            <div class="ps-section__content">
                <div class="ps-carousel--nav owl-slider" data-owl-auto="true" data-owl-loop="true" data-owl-speed="5000" data-owl-gap="30" data-owl-nav="true" data-owl-dots="true" data-owl-item="5" data-owl-item-xs="2" data-owl-item-sm="3" data-owl-item-md="4" data-owl-item-lg="4" data-owl-item-xl="5" data-owl-duration="1000" data-owl-mousedrag="on">
                  @foreach($daily_sales as $product)
                      @include('newFrontend.includes.product_list')
                  @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="ps-deal-of-day">
        <div class="container">
            <div class="ps-section__header">
                <div class="ps-block--countdown-deal">
                    <div class="ps-block__left">
                        <h3>All Products</h3>
                    </div>
                </div>
                <!-- <a href="shop-default.html">View all</a> -->
            </div>
            <div class="ps-section__content">
                <div class="ps-carousel--nav owl-slider" data-owl-auto="true" data-owl-loop="true" data-owl-speed="5000" data-owl-gap="30" data-owl-nav="true" data-owl-dots="true" data-owl-item="5" data-owl-item-xs="2" data-owl-item-sm="3" data-owl-item-md="4" data-owl-item-lg="4" data-owl-item-xl="5" data-owl-duration="1000" data-owl-mousedrag="on">
                  @foreach($all_products as $product)
                    @if($product->is_featured == 1)
                      @include('newFrontend.includes.product_list')
                    @endif
                  @endforeach
                  @foreach($all_products as $product)
                    @if($product->is_featured == 0)
                      @include('newFrontend.includes.product_list')
                    @endif
                  @endforeach
                </div>
            </div>
        </div>
    </div>

    <div class="ps-promotions">
{{--  <div class="container">
            <div class="row">
              @if(Auth::check() )
                  @if(Auth::user()->permissions_id == 3)
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12 "><a class="ps-collection" href="{{route('shopCreate')}}"><img src="img/promotions/home-3-1.jpg" alt=""></a></div>
                  @else
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12 "><a class="ps-collection" href="{{route('register')}}"><img src="img/promotions/home-3-2.jpg" alt=""></a></div>
                  @endif
              @else
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12 "><a class="ps-collection" href="{{route('register')}}"><img src="img/promotions/home-3-3.jpg" alt=""></a></div>
              @endif
            </div>
        </div> --}}
    </div>

</div>
@endsection
