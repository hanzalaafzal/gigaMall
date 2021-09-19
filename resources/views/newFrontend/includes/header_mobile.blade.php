<header class="header header--mobile" data-sticky="true">
    <div class="header__top">
        <div class="header__left">
            <p>Welcome to E-Bazarr
            </p>
        </div>
        <div class="header__right">
        </div>
    </div>
    <?php
      if (Auth::check()) {
        $carts = App\Helpers\Helper_user::carts();
        $categories = App\Helpers\Helper_user::getCategories();
      }
    ?>
    <div class="navigation--mobile">
        <div class="navigation__left"><a class="ps-logo" href="index.html"><img src="img/logo_light.png" alt="" /></a></div>
        <div class="navigation__right">
            <div class="header__actions">
              @if(Auth::check())
                @if(Auth::user()->permissions_id == 4)
                <div class="ps-cart--mini"><a class="header__extra" href="#"><i class="icon-bag2"></i><span><i>{{count($carts)}}</i></span></a>
                      @if(count($carts)>0)
                        <div class="ps-cart__content">
                            <div class="ps-cart__items">
                              @foreach($carts as $cart)
                                <div class="ps-product--cart-mobile">
                                    <div class="ps-product__thumbnail"><a href="#"><img src="{{url('/frontEnd/images/products/'.$cart->products->photo)}}" alt="" /></a></div>
                                    <div class="ps-product__content"><a class="ps-product__remove" href="#"><i class="icon-cross"></i></a><a href="#">{{$cart->products->title}}</a>
                                        <p><strong>Type:</strong> {{$cart->products->productTypes->name}}</p><small>{{$cart->products->price}} PKR</small>
                                    </div>
                                </div>
                                @endforeach

                            </div>
                            <div class="ps-cart__footer">
                                <h3>Sub Total:<strong>$59.99</strong></h3>
                                <figure><a class="ps-btn" href="{{route('myCart')}}">View Cart</a><a class="ps-btn" href="{{route('checkout')}}">Checkout</a></figure>
                            </div>
                        </div>
                      @endif
                  </div>
                @endif
            @endif

                <div class="ps-block--user-header">
                  @if(Auth::check())
                    <div class="ps-block__left" style=""><a href="{{route('dashboard')}}"><i class="icon-user"></i></a></div>
                    <div class="ps-block__right"><a href="{{route('dashboard')}}">Dashboard</a>
                      <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                          {{ csrf_field() }}
                      </form>
                      <a href="#" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</a>
                    </div>
                  @else
                  <div class="ps-block__left"><a href="{{route('dashboard')}}"><i class="icon-user"></i></a></div>
                  <div class="ps-block__right"><a href="{{route('login')}}">Login</a><a href="{{route('register')}}">Register</a></div>
                  @endif
                </div>
            </div>
        </div>
    </div>
    <div class="ps-search--mobile">
        <form class="ps-form--search-mobile" action="index.html" method="get">
            <div class="form-group--nest">
                <input class="form-control" type="text" placeholder="Search something..." />
                <button><i class="icon-magnifier"></i></button>
            </div>
        </form>
    </div>
</header>
@stack('mobile_header')
