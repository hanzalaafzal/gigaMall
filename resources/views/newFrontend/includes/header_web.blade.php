
<header class="header header--standard header--market-place-2" data-sticky="true">
    <div class="header__top">
        <div class="container">

            <div class="header__right">
                <ul class="header__top-links">
                    <!-- <li><a href="#">Store Location</a></li>
                    <li><a href="#">Track Your Order</a></li> -->
                    <!-- <li>
                        <div class="ps-dropdown"><a href="#">US Dollar</a>
                            <ul class="ps-dropdown-menu">
                                <li><a href="#">Us Dollar</a></li>
                                <li><a href="#">Euro</a></li>
                            </ul>
                        </div>
                    </li> -->
                    <!-- <li>
                        <div class="ps-dropdown language"><a href="#"><img src="img/flag/en.png" alt="">English</a>
                            <ul class="ps-dropdown-menu">
                                <li><a href="#"><img src="img/flag/germany.png" alt=""> Germany</a></li>
                                <li><a href="#"><img src="img/flag/fr.png" alt=""> France</a></li>
                            </ul>
                        </div>
                    </li> -->
                </ul>
            </div>
        </div>
    </div>
    <?php
    	if (Auth::check()) {
    		$carts = App\Helpers\Helper_user::carts();
    		$categories = App\Helpers\Helper_user::getCategories();
    	}else{
        $carts = App\Helpers\Helper_user::carts();
    		$categories = App\Helpers\Helper_user::getCategories();
      }
    ?>
    <div class="header__content">
        <div class="container">
            <div class="header__content-left">
              <a class="ps-logo" href="{{url('/')}}"><img src="{{url('/frontEnd/images/logo-old.png')}}"  alt=""></a>
            </div>
            <div class="header__content-center">
                <form class="ps-form--quick-search" action="{{route('searchProduct')}}" method="get">
                    <div class="form-group--icon" style="width:50%">
                      <i class="icon-chevron-down"></i>
                        <select class="form-control" name="category" required>
                          @foreach($categories as $category)
                              <option value="{{$category->slug}}">{{$category->name}}</option>
                          @endforeach
                        </select>
                    </div>
                    <input class="form-control" type="text" name="keyword" placeholder="I'm shopping for...">
                    <button>Search</button>
                </form>

            </div>
            <div class="header__content-right">
                <div class="header__actions"><a class="header__extra" href="#"><i style="display:none" class="icon-heart"></i></a>
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
                                <!-- <h3>Sub Total:<strong>$59.99</strong></h3> -->
                                <figure><a class="ps-btn" href="{{route('myCart')}}">View Cart</a><a class="ps-btn" href="{{route('checkout')}}">Checkout</a></figure>
                            </div>
                        </div>
                        @endif
                    </div>
                    @endif
                  @else
                    <div class="ps-cart--mini"><a class="header__extra" href="#"><i class="icon-bag2"></i><span><i>{{count($carts)}}</i></span></a>
                        <div class="ps-cart__content">
                            <div class="ps-cart__items">

                            </div>
                        </div>
                    </div>
                  @endif
                    <div class="ps-block--user-header">
                      @if(Auth::check())
                        <div class="ps-block__left" style=""><i class="icon-user"></i></div>
                        <div class="ps-block__right"><a href="{{route('dashboard')}}">Dashboard</a>
                            <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                          <a href="#" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</a>
                        </div>
                      @else
                      <div class="ps-block__left"><i class="icon-user"></i></div>
                      <div class="ps-block__right"><a href="{{route('login')}}">Login</a><a href="{{route('register')}}">Register</a></div>
                      @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <nav class="navigation">
        <div class="container">
            <ul class="menu menu--market-2">
                <li><a href="{{url('/')}}">Home</a>
                </li>
                <li><a href="{{route('howToShop')}}">How to shop</a>
                </li>
                <li><a href="{{route('searchProduct')}}">Products</a>
                </li>
                <li><a href="{{route('searchShop')}}">Shops</a>
                </li>
                <li><a href="{{route('helpSupport')}}}">Faqs</a>
                </li>
                <li><a href="{{route('helpSupport')}}">Help & Support</a>
                  @if(!Auth::check())
                  <li><a href="{{route('register')}}" style="background:black;padding:10px;color:white">Become a shop partner</a>
                  @endif
                </li>

            </ul>
        </div>
    </nav>
</header>
