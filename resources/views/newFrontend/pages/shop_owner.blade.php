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
                  <h3>{{$user->user_name}}</h3><a class="ps-block__inquiry" href="#"><i class="fa fa-question"></i> Inquiry</a>
              </div>
              <div class="ps-block__user">
                  <div class="ps-block__user-avatar">
                  <a href="{{route('shopOwner',$user->user_name)}}">
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
                      <p>Name: {{$user->user_name}}</p>
                      <p>Joined: {{date('d-M-Y',strtotime($user->created_at))}} </p>
                      <p>Total Products: {{$count['products']}}</p>
                      <p>Total Shops: {{$count['shops']}}</p>

                  </div>
              </div>
          </aside>
          <?php $shop_rating = App\Helpers\Helper_user::shop_rating($shop->id); ?>
          <div class="ps-section__wrapper">

              <div class="ps-section__right">
                  <nav class="ps-store-link">
                      <ul>
                          <li class="<?php if(Route::currentRouteName() == 'shopView'){echo "active";} ?>"><a href="{{route('shopView',$shops[0]->slug)}}">Products</a></li>
                          <li class="<?php if(Route::currentRouteName() == 'shopOwner'){echo "active";} ?>"><a href="{{route('shopOwner',$user->user_name)}}">Shop Owner</a></li>

                      </ul>
                  </nav>
                  <div class="ps-shopping ps-tab-root">
                      <div class="ps-shopping__header">
                          <p><strong> {{count($products)}}</strong> Products found</p>

                      </div>
                      <div class="ps-tabs">
                          <div class="ps-tab active" id="tab-2">
                              <div class="ps-shopping-product">
                                <div class="ps-document">
                                    <p>We connect millions of buyers and sellers around the world, empowering people & creating economic opportunity for all. Within our markets, millions of people around the world connect, both online and offline, to make, sell and buy unique goods. We also offer a wide range of Seller Services and tools that help creative entrepreneurs start, manage and scale their businesses. Our mission is to reimagine commerce in ways that build a more fulfilling and lasting world, and we’re committed to using the power of business to strengthen communities and empower people.</p>
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
