
@extends('newFrontend.layout')
@push('css')
<link rel="stylesheet" href="{{asset('assets/css/vendor.css')}}">

@endpush

@section('main_content')
<div class="ps-page--single ps-page--vendor">
    <div class="ps-breadcrumb">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="index.html">Home</a></li>
                <li>Shops List</li>
            </ul>
        </div>
    </div>
    <section class="ps-store-list">
        <div class="container">
            <div class="ps-section__header">
                <h3>Shops list</h3>
            </div>
            <div class="ps-section__content">
                <div class="ps-section__search row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <button><i class="icon-magnifier"></i></button>
                            <input class="form-control" type="text" placeholder="Search vendor...">
                        </div>
                    </div>
                </div>
                @if(count($shops)>0)
                <div class="row">
                  @foreach($shops as $shop)
                      <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12 ">
                            <article class="ps-block--store-2">
                                <div class="ps-block__content bg--cover" data-background="{{asset('assets/img/vendor/store/default-store-banner.png')}}">
                                    <figure>
                                       <a href="{{route('shopView',$shop->slug)}}"><h4>{{$shop->title}}</h4></a>
                                        <div class="ps-block__rating">
                                            <select class="ps-rating" data-read-only="true">
                                                <option value="1">1</option>
                                            </select>
                                            N/A
                                        </div>
                                        <p>{{$shop->description}}.<br> Shop Owner: <a href="{{route('shopOwner',$shop->users->user_name)}}"> <u> {{$shop->users->user_name}} </u></a> </p>
                                        <p>Total Products: </p> <h3>{{count($shop->users->products_active)}}</h3>
                                    </figure>
                                </div>
                                <div class="ps-block__author">
                                  <a class="ps-block__user" href="{{route('shopView',$shop->slug)}}"><img style="max-height:68px" src="{{url('/frontEnd/images/shops/'.$shop->photo)}}" alt=""></a>
                                  <a class="ps-btn" href="{{route('shopView',$shop->slug)}}">Visit Shop</a></div>
                            </article>
                        </div>

                        @endforeach
                    </div>

                @endif
            </div>
            @if($shops->hasMorePages())
            <div class="ps-pagination" style="padding-bottom:10px">
                <ul class="pagination">

                    @if($shops->onFirstPage())

                    @else
                      <li><a href="{{$shops->previousPageUrl()}}"><i class="icon-chevron-left"></i> Previous Page</a></li>
                      <li><a href="{{$shops->url( $shops->currentPage() - 1)}}">{{$shops->currentPage() - 1 }}</a></li>
                    @endif

                    <li class="active">
                      <a href="{{$shops->url($shops->currentPage())}}">{{$shops->currentPage()}}</a></li>
                    <li><a href="{{$shops->url( $shops->currentPage()+ 1)}}">{{$shops->currentPage() + 1 }}</a></li>
                    <li><a href="{{$shops->url( $shops->currentPage()+ 2)}}">{{$shops->currentPage() + 2}}</a></li>
                    <li><a href="{{$shops->nextPageUrl()}}">Next Page<i class="icon-chevron-right"></i></a></li>
                </ul>
            </div>
        </div>

    </section>
</div>

@endif
@endsection
