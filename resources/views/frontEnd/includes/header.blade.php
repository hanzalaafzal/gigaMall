<?php
	if (Auth::check()) {
		$carts = App\Helpers\Helper_user::carts();
		$categories = App\Helpers\Helper_user::getCategories();
	}
?>
<style type="text/css">
	#search-header-button{
	position: absolute;
    top: 0;
    right: -2px;
    background: unset;
	}
</style>
<!-- HEADER -->
<div class="header-wrap">
	<header>
		<!-- LOGO -->
		<a href="{{url('/')}}">
			<figure class="logo">
				<img src="{{url('/frontEnd/images/logo-old.png')}}" alt="logo">
			</figure>
		</a>
		<!-- /LOGO -->

		<!-- MOBILE MENU HANDLER -->
		<div class="mobile-menu-handler left primary">
			<img src="{{url('/frontEnd/images/pull-icon.png')}}" alt="pull-icon">
		</div>
		<!-- /MOBILE MENU HANDLER -->

		<!-- LOGO MOBILE -->
		<a href="index.html">
			<figure class="logo-mobile">
				<img src="{{url('/frontEnd/images/logo_mobile.png')}}" alt="logo-mobile">
			</figure>
		</a>
		<!-- /LOGO MOBILE -->

		<!-- MOBILE ACCOUNT OPTIONS HANDLER -->
		<div class="mobile-account-options-handler right secondary">
			<span class="icon-user"></span>
		</div>
		<!-- /MOBILE ACCOUNT OPTIONS HANDLER -->

		<!-- USER BOARD -->
		<div class="user-board">
			@if(Auth::check())
				<!-- USER QUICKVIEW -->
			<div class="user-quickview">
				<!-- USER AVATAR -->
				<a href="{{route('dashboard')}}">
				<div class="outer-ring">
					<div class="inner-ring"></div>
					<figure class="user-avatar">
						@if(!empty(Auth::user()->photo))
							<img src="{{url('/frontEnd/images/avatars/'.Auth::user()->photo)}}" alt="avatar">
						@else
							<img src="{{url('/frontEnd/images/avatars/unknown.jpg')}}" alt="avatar">
						@endif
					</figure>
				</div>
				</a>
				<!-- /USER AVATAR -->

				<!-- USER INFORMATION -->
				<p class="user-name">{{Auth::user()->user_name}}</p>
				<p class="user-money">
					<span>Wallet</span>
					{{Auth::user()->wallets->amount}} PKR
				</p>
				{{--  <p class="user-money">
					<span>Ref.Bonused</span>
					{{number_format(Auth::user()->wallets->referral_bonus,2)}} PKR
				</p>  --}}
				<!-- /USER INFORMATION -->

				<!-- DROPDOWN -->
				<ul class="dropdown small hover-effect closed">
					<li class="dropdown-item">
						<a href="{{route('dashboard')}}">Dashboard</a>
					</li>
					<li class="dropdown-item">
						<a href="{{route('helpSupport')}}">FAQs</a>
					</li>
					<li class="dropdown-item">
						<a href="{{route('helpSupport')}}">Help & Support</a>
					</li>
				</ul>
				<!-- /DROPDOWN -->
			</div>
			<!-- /USER QUICKVIEW -->

			<!-- ACCOUNT INFORMATION -->
			<div class="account-information">
				<a href="{{route('inbox')}}">
					<div class="account-wishlist-quickview">	
						<span class="icon-envelope"></span>
					</div>
				</a>
				@if(Auth::user()->permissions_id == 4)
					<a href="{{route('myFavourites')}}">
						<div class="account-wishlist-quickview">	
							<span class="icon-heart"></span>
							<span class="pin soft-edged secondary">{{count(Auth::user()->favourites)}}</span>
						</div>
					</a>
					<div class="account-cart-quickview">
						<span class="icon-present">
							<!-- SVG ARROW -->
							<svg class="svg-arrow">
								<use xlink:href="#svg-arrow"></use>
							</svg>
							<!-- /SVG ARROW -->
						</span>

						<!-- PIN -->
						<span class="pin soft-edged secondary">{{count($carts)}}</span>
						<!-- /PIN -->

						<!-- DROPDOWN CART -->
						@if(count($carts)>0)
							<ul class="dropdown cart closed" id="cart-dropdown">
								<!-- DROPDOWN ITEM -->
								<div class="dropdown-triangle"></div>
									@foreach($carts as $cart)
										<li class="dropdown-item">
											<!-- SVG PLUS -->
											<figure class="product-preview-image tiny">
												<img src="{{url('/frontEnd/images/products/'.$cart->products->photo)}}" alt="">
											</figure>
											<p class="text-header tiny" style="height: 15px;overflow: hidden;">{{$cart->products->title}}</p>
											<p class="category tiny primary">{{$cart->products->productTypes->name}}</p>
											<p class="price tiny">{{$cart->products->price}} <span>PKR</span></p>
										</li>
									@endforeach
								<!-- /DROPDOWN ITEM -->
							</ul>
							<ul class="dropdown cart closed" style="    top: 326px !important;">
								<!-- DROPDOWN ITEM -->
								<li class="dropdown-item" style="height: 43px; ">
									<a href="{{route('myCart')}}" class="button primary half">Go to Cart</a>
									<a href="{{route('checkout')}}" class="button secondary half">Go to Checkout</a>
								</li>
								<!-- /DROPDOWN ITEM -->
							</ul>
						@endif
						<!-- /DROPDOWN CART -->
					</div>
				@endif
			</div>
			<!-- /ACCOUNT INFORMATION -->
			@endif
			<!-- ACCOUNT ACTIONS -->
			<div class="account-actions">
				<a href="{{route('register')}}" class="button primary">Become a Shop Partner</a>
				@if(Auth::check())
					<a href="#" class="button secondary" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</a>
                    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
				@else
					<a href="{{route('login')}}" class="button secondary">Login</a>
					<a href="{{route('register')}}" class="button secondary">Register</a>
				@endif
			</div>
			<!-- /ACCOUNT ACTIONS -->
		</div>
		<!-- /USER BOARD -->
	</header>
</div>
<!-- /HEADER -->

<!-- SIDE MENU -->
<div id="mobile-menu" class="side-menu left closed">
	<!-- SVG PLUS -->
	<svg class="svg-plus">
		<use xlink:href="#svg-plus"></use>
	</svg>
	<!-- /SVG PLUS -->

	<!-- SIDE MENU HEADER -->
	<div class="side-menu-header">
		<figure class="logo small">
			<img src="{{url('/frontEnd/images/logo.png')}}" alt="logo">
		</figure>
	</div>
	<!-- /SIDE MENU HEADER -->

	<!-- DROPDOWN -->
	<ul class="dropdown dark hover-effect interactive">
		<!-- DROPDOWN ITEM -->
		<li class="dropdown-item">
			<a href="{{url('/')}}">Home</a>
		</li>
		<!-- /DROPDOWN ITEM -->

		<!-- DROPDOWN ITEM -->
		<li class="dropdown-item">
			<form method="get" id="search_form" action="{{route('searchProduct')}}"></form>
			<a onclick="$('#search_form').submit();">Products</a>
		</li>	
		<!-- /DROPDOWN ITEM -->

		<!-- DROPDOWN ITEM -->
		<li class="dropdown-item">
			<form method="get" id="search_form2" action="{{route('searchShop')}}"></form>
			<a href="javascript:{}" onclick="$('#search_form2').submit();">Shops</a>
		</li>
		<!-- /DROPDOWN ITEM -->

		<!-- DROPDOWN ITEM -->
		<li class="dropdown-item">
			<a href="{{route('howToShop')}}">How to Shop</a>
		</li>
		<!-- /DROPDOWN ITEM -->

	</ul>
	<!-- /DROPDOWN -->
</div>
<!-- /SIDE MENU -->

<!-- SIDE MENU -->
<div id="account-options-menu" class="side-menu right closed">
	<!-- SVG PLUS -->
	<svg class="svg-plus">
		<use xlink:href="#svg-plus"></use>
	</svg>
	<!-- /SVG PLUS -->

	<!-- SIDE MENU HEADER -->
	@if(Auth::check())
		<div class="side-menu-header">
			<!-- USER QUICKVIEW -->
			<div class="user-quickview">
				<!-- USER AVATAR -->
				<a href="author-profile.html">
				<div class="outer-ring">
					<div class="inner-ring"></div>
					<figure class="user-avatar">
						@if(empty(Auth::user()->photo))
							<img src="{{url('/frontEnd/images/avatars/unknown.jpg')}}" alt="avatar">
						@else
							<img src="{{url('/frontEnd/images/avatars/'.Auth::user()->photo)}}" alt="avatar">
						@endif
					</figure>
				</div>
				</a>
				<!-- /USER AVATAR -->

				<!-- USER INFORMATION -->
				<p class="user-name">{{Auth::user()->user_name}}</p>
				<p class="user-money">
					<span>Wallet</span>
					${{Auth::user()->wallets->amount}}
				</p>
				<p class="user-money">
					<span>Ref.Bonused</span>
					${{Auth::user()->wallets->referral_bonus}}
				</p>
				<!-- /USER INFORMATION -->
			</div>
			<!-- /USER QUICKVIEW -->
		</div>

		<!-- DROPDOWN -->
		<ul class="dropdown dark hover-effect">
			<!-- DROPDOWN ITEM -->
			<li class="dropdown-item">
				<a href="{{route('dashboard')}}">Dashboard</a>
			</li>
			<!-- /DROPDOWN ITEM -->

			<!-- DROPDOWN ITEM -->
			<li class="dropdown-item">
				<a href="{{route('inbox')}}">Messages</a>
			</li>
			<!-- /DROPDOWN ITEM -->

			@if(Auth::user()->permissions_id == 4)
				<!-- DROPDOWN ITEM -->
				<li class="dropdown-item">
					<a href="{{route('myFavourites')}}">My Favourites</a>
				</li>
				<!-- /DROPDOWN ITEM -->

				<!-- DROPDOWN ITEM -->
				<li class="dropdown-item">
					<a href="{{route('myCart')}}">My Cart</a>
				</li>
				<!-- /DROPDOWN ITEM -->
			@endif

		</ul>
		<!-- /DROPDOWN -->
		<br>
		<a href="#" class="button secondary" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</a>
        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>
	@else
		<br><br>
		<a href="{{url('/login')}}" class="button medium secondary">Login</a>
		<a href="{{url('/register')}}" class="button medium secondary">Register</a>
		<a href="{{url('/register')}}" class="button medium primary">Become a Shop Partner</a>
	@endif
	<!-- /SIDE MENU HEADER -->


</div>
<!-- /SIDE MENU -->

<!-- MAIN MENU -->
<div class="main-menu-wrap">
	<div class="menu-bar">
		<nav>
			<ul class="main-menu">
				<!-- MENU ITEM -->
				<li class="menu-item">
					<a href="{{url('/')}}">Home</a>
				</li>
				<!-- /MENU ITEM -->

				<!-- MENU ITEM -->
				<li class="menu-item">
					<a href="{{route('howToShop')}}">How to shop</a>
				</li>
				<!-- /MENU ITEM -->

				<!-- MENU ITEM -->
				<li class="menu-item">
					<form method="get" id="search_form" action="{{route('searchProduct')}}"></form>
					<a href="javascript:{}" onclick="$('#search_form').submit();">Products</a>
				</li>
				<!-- /MENU ITEM -->

				<!-- MENU ITEM -->
				<li class="menu-item">
					<form method="get" id="search_form2" action="{{route('searchShop')}}"></form>
					<a href="javascript:{}" onclick="$('#search_form2').submit();">Shops</a>
				</li>
				<!-- /MENU ITEM -->

			</ul>
		</nav>
		<form class="search-form" method="get" action="{{route('searchProduct')}}">
			<input type="text" required="" class="rounded" name="keyword" id="search_products" placeholder="Search products here...">
			<button id="search-header-button">
				<img src="{{url('/frontEnd/images/search-icon.png')}}">
			</button>
		</form>
	</div>
</div>
<!-- /MAIN MENU -->