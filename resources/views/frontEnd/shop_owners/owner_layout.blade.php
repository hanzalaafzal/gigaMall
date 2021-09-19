@extends('frontEnd.layout')

@section('content')
<style type="text/css">
    .author-profile-info h3{
        text-align: left;
        color: #00d7b3;
    }
    @media screen and (max-width: 935px) {
        .author-profile-banner{
            display: none;
        }
    }

</style>

    <!-- AUTHOR PROFILE BANNER -->
    <div class="author-profile-banner"></div>
    <!-- /AUTHOR PROFILE BANNER -->

    <!-- AUTHOR PROFILE META -->
    <div class="author-profile-meta-wrap">
        <div class="author-profile-meta">
            <div class="author-profile-info">
                <h3>{{$user->user_name}}</h3>
                <br>
                <hr class="line-separator">
                <br>
            </div>
            <!-- AUTHOR PROFILE INFO -->
            <div class="author-profile-info">
                <!-- AUTHOR PROFILE INFO ITEM -->
                <div class="author-profile-info-item">
                    <p class="text-header">Joined:</p>
                    <p>{{date('d-M-Y',strtotime($user->created_at))}}</p>
                </div>
                <!-- /AUTHOR PROFILE INFO ITEM -->

                <!-- AUTHOR PROFILE INFO ITEM -->
                <div class="author-profile-info-item">
                    <p class="text-header">Total Products:</p>
                    <p>{{$count['products']}}</p>
                </div>
                <!-- /AUTHOR PROFILE INFO ITEM -->

                <!-- AUTHOR PROFILE INFO ITEM -->
                <div class="author-profile-info-item">
                    <p class="text-header">Total Shops</p>
                    <p>{{$count['shops']}}</p>
                </div>
                <!-- /AUTHOR PROFILE INFO ITEM -->

                <!-- AUTHOR PROFILE INFO ITEM -->
                <?php $shop_rating = App\Helpers\Helper_user::vendor_rating($user->id); ?>
                <div class="author-profile-info-item">
                    <p class="text-header">Rating</p>
                    <ul class="rating" style="    width: 35px;">
                     <li class="rating-item" style="    margin-right: 1px;">
                        <!-- SVG STAR -->
                        <p>{{$shop_rating}}</p>
                        <!-- /SVG STAR -->
                     </li>
                     <li class="rating-item">
                        <!-- SVG STAR -->
                        <svg class="svg-star">
                           <use xlink:href="#svg-star"></use>
                        </svg>
                        <!-- /SVG STAR -->
                     </li>
                  </ul>
                </div>
                <!-- /AUTHOR PROFILE INFO ITEM -->
            </div>
            <!-- /AUTHOR PROFILE INFO -->
        </div>
    </div>
    <!-- /AUTHOR PROFILE META -->

    <!-- SECTION -->
    <div class="section-wrap">
        <div class="section overflowable" style="padding-top: 40px;">
            <!-- SIDEBAR -->
            <div class="sidebar left author-profile">
                <!-- SIDEBAR ITEM -->
                <div class="sidebar-item author-bio">
                  <a href="{{route('shopOwner',$user->user_name)}}">
                    <h5>Shop Partner</h5>
                  </a>
                    
                    <!-- USER AVATAR -->
                    <a href="{{route('shopOwner',$user->user_name)}}" class="user-avatar-wrap medium">
                        <figure class="user-avatar medium">
                            @if(!empty($user->photo))
                                <img src="{{url('/frontEnd/images/avatars/'.$user->photo)}}" alt="">
                            @else
                                <img src="{{url('/frontEnd/images/avatars/unknown.jpg')}}" alt="">
                            @endif
                        </figure>
                    </a>
                    <!-- /USER AVATAR -->
                    <a href="{{route('shopOwner',$user->user_name)}}">
                      <p class="text-header">{{$user->user_name}}</p>
                    </a>
                    <br><br>
                    @if(Auth::check() && Auth::user()->permissions_id == 3)
                        <a href="{{route('dashboard')}}" class="button mid dark spaced">Go To <span class="primary">Dashboard</span></a>
                    @else
                        <a href="{{route('chat',$user->user_name)}}" class="button mid dark spaced">Chat <span class="primary">Now</span></a>
                    @endif
                </div>
                <!-- /SIDEBAR ITEM -->

                <!-- DROPDOWN -->
                <ul class="dropdown hover-effect">
                    <li class="dropdown-item <?php if(Route::currentRouteName() == 'shopOwner'){echo "active";} ?>">
                        <a href="{{route('shopOwner',$user->user_name)}}">Owner</a>
                    </li>
                    <li class="dropdown-item <?php if(Route::currentRouteName() == 'shopOwnerAllShops'){echo "active";} ?>">
                        <a href="{{route('shopOwnerAllShops',$user->user_name)}}">All Shops ({{$count['shops']}})</a>
                    </li>
                    <li class="dropdown-item <?php if(Route::currentRouteName() == 'shopOwnerAllProducts'){echo "active";} ?>">
                        <a href="{{route('shopOwnerAllProducts',$user->user_name)}}">All Products ({{$count['products']}})</a>
                    </li>
                </ul>
                <!-- /DROPDOWN -->
            </div>
            <!-- /SIDEBAR -->
            <div class="content right">
              @yield('shop_owner_content')
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <!-- /SECTION -->
@endsection