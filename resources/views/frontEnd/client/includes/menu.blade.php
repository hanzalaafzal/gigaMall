<!-- SIDE MENU -->
<div id="dashboard-options-menu" class="side-menu dashboard left closed">
    <!-- SVG PLUS -->
	<svg class="svg-plus">
		<use xlink:href="#svg-plus"></use>
	</svg>
	<!-- /SVG PLUS -->
    
	<!-- SIDE MENU HEADER -->
	<div class="side-menu-header">
		<!-- USER QUICKVIEW -->
		<div class="user-quickview">
			<!-- USER AVATAR -->
			<a href="{{url('/dashboard')}}">
			<div class="outer-ring">
				<div class="inner-ring"></div>
				<figure class="user-avatar">
					@if(!empty(Auth::user()->photo))
						<img src="{{url('/frontEnd/images/avatars/'.Auth::user()->photo)}}" alt="profile-default-image">
					@else
						<img src="{{url('/frontEnd/images/avatars/unknown.jpg')}}" alt="profile-default-image">
					@endif
				</figure>
			</div>
			</a>
			<!-- /USER AVATAR -->

			<!-- USER INFORMATION -->
			<p class="user-name">{{Auth::user()->user_name}}</p>
			<p class="user-money">{{Auth::user()->wallets->amount}} PKR</p>
			<!-- /USER INFORMATION -->
		</div>
		<!-- /USER QUICKVIEW -->
	</div>
	<!-- /SIDE MENU HEADER -->

	<!-- SIDE MENU TITLE -->
	<p class="side-menu-title">Your Account</p>
	<!-- /SIDE MENU TITLE -->

	<!-- DROPDOWN -->
	<ul class="dropdown dark hover-effect interactive">
		<!-- DROPDOWN ITEM -->
		<li class="dropdown-item
			<?php
				if(Request::segment(1)=='dashboard'){
					echo 'active';
				}
			?>
		">
			<a href="{{route('dashboard')}}">
                <span class="sl-icon icon-settings"></span>
                Account Settings
            </a>
		</li>
		<!-- /DROPDOWN ITEM -->

		<!-- DROPDOWN ITEM -->
		@if(auth()->user()->permissions_id == 4)
		<li class="dropdown-item
			<?php
				if(Request::segment(2)=='order'){
					echo 'active';
				}
			?>
		">
			<a href="{{route('clientOrdersActive')}}">
                <span class="sl-icon icon-settings"></span>
                Orders
            </a>
		</li>
		<!-- /DROPDOWN ITEM -->

		<!-- DROPDOWN ITEM -->
		<li class="dropdown-item
			<?php
				if(Request::segment(2)=='reviews'){
					echo 'active';
				}
			?>
		">
			<a href="{{route('clientReviewsPending')}}">
                <span class="sl-icon icon-settings"></span>
                Reviews
            </a>
		</li>
		@endif
		<!-- /DROPDOWN ITEM -->

		@if(auth()->user()->permissions_id == 5)
		<!-- DROPDOWN ITEM -->
		<li class="dropdown-item
			<?php
				if(Request::segment(1)== 'client_affiliate'){
					echo 'active';
				}
			?>
		">
			<a href="{{route('client_affiliate')}}">
                <span class="sl-icon icon-settings"></span>
                Affiliate Data
            </a>
		</li>
		
		<!-- DROPDOWN ITEM -->
		<li class="dropdown-item
			<?php
				if(Request::segment(1)== 'client_withdraw_request'){
					echo 'active';
				}
			?>
		">
			<a href="{{route('client_withdraw_request')}}">
                <span class="sl-icon icon-settings"></span>
                Withdraw Request
            </a>
		</li>
		@endif
		<!-- /DROPDOWN ITEM -->

		<!-- DROPDOWN ITEM -->
		@if(auth()->user()->permissions_id == 4)
		<li class="dropdown-item
			<?php
				if(Request::segment(2)=='my-favourites'){
					echo 'active';
				}
			?>
		">
			<a href="{{route('myFavourites')}}">
                <span class="sl-icon icon-settings"></span>
                Favourites Products
            </a>
		</li>
		<!-- /DROPDOWN ITEM -->

    <!-- SIDE MENU TITLE -->
	<p class="side-menu-title">Info &amp; Statistics</p>
	<!-- /SIDE MENU TITLE -->

	<!-- DROPDOWN -->
	<ul class="dropdown dark hover-effect">
		<!-- DROPDOWN ITEM -->
		<li class="dropdown-item">
			<a href="{{route('clientPurchaseStatements')}}">
                <span class="sl-icon icon-layers"></span>
                Purchase Statement
            </a>
		</li>
		<!-- /DROPDOWN ITEM -->
	</ul>
	<!-- /DROPDOWN -->
	@endif

    <a href="#" class="button medium secondary" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</a>
    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
        {{ csrf_field() }}
    </form>
</div>
<!-- /SIDE MENU -->