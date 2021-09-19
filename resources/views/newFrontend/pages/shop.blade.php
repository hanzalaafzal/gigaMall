@extends('newFrontend.layout')

@push('css')
<link rel="stylesheet" href="{{asset('assets/css/autopart.css')}}">
<link rel="stylesheet" href="{{asset('assets/css/vendor.css')}}">
@endpush

@section('main_content')

<div class="ps-page--single ps-page--vendor">
  <section class="ps-store-list">
      <div class="container">
          <aside class="ps-block--store-banner">
              <div class="ps-block__content bg--cover" data-background="{{asset('assets/img/vendor/store/default_banner.jpg')}}">
                  <h3>{{$shop->title}}</h3><a class="ps-block__inquiry" href="#"><i class="fa fa-question"></i> Inquiry</a>
              </div>
              <div class="ps-block__user">
                  <div class="ps-block__user-avatar">
                  <a href="{{route('shopOwner',$shop->users->user_name)}}">
                    @if(!empty($shop->users->photo))
                        <img src="{{url('/frontEnd/images/avatars/'.$shop->users->photo)}}" alt="">
                    @else
                        <img src="{{url('/frontEnd/images/avatars/unknown.jpg')}}" alt="">
                    @endif

                  </a>
                      <select class="ps-rating" data-read-only="true">
                          <option value="1">1</option>
                          <option value="1">2</option>
                          <option value="1">3</option>
                          <option value="1">4</option>
                          <option value="2">5</option>
                      </select>
                  </div>
                  <div class="ps-block__user-content">
                      <p>Since: {{date('d-M-Y',strtotime($shop->created_at))}} </p>
                      <p>Total Products: {{$count['products']}}</p>
                      <p>Location: <?php if(count($shop->cities)>0){echo $shop->cities->name.', ';} ?> {{$shop->states->name}}, {{$shop->countries->title_en}} </p>
                      <p>{{$shop->address}}</p>
                  </div>
              </div>
          </aside>
          <?php $shop_rating = App\Helpers\Helper_user::shop_rating($shop->id); ?>
          <div class="ps-section__wrapper">

              <div class="ps-section__right">
                  <nav class="ps-store-link">
                      <ul>
                          <li class="<?php if(Route::currentRouteName() == 'shopView'){echo "active";} ?>"><a href="{{route('shopView',$shop->slug)}}">Products</a></li>
                          <li class="<?php if(Route::currentRouteName() == 'shopOwner'){echo "active";} ?>"><a href="{{route('shopOwner',$shop->users->user_name)}}">Shop Owner</a></li>

                      </ul>
                  </nav>
                  <div class="ps-shopping ps-tab-root">
                      <div class="ps-shopping__header">
                          <p><strong> {{count($products)}}</strong> Products found</p>

                      </div>
                      <div class="ps-tabs">
                          <div class="ps-tab active" id="tab-1">
                              <div class="ps-shopping-product">
                                  <div class="row">
                                    @foreach($products as $product)
                                      @include('newFrontend.includes.product_list')
                                    @endforeach





                                  </div>
                              </div>

                          </div>

                      </div>
                  </div>
              </div>
          </div>
      </div>
  </section>
</div>

@endsection
