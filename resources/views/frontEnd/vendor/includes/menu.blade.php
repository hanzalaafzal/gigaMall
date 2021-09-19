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
			<a href="{{route('dashboard')}}">
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
			<p class="user-money">
				<span>Wallet</span>
				{{Auth::user()->wallets->amount}} PKR
			</p>
			{{--  <p class="user-money">
				<span>Ref.Bonus</span>
				${{number_format(Auth::user()->wallets->referral_bonus,2)}}
			</p>  --}}
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
				if(Request::segment('1')=='dashboard'){
					echo "active";
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
		<li class="dropdown-item
			<?php
				if(Request::segment('2')=='order'){
					echo "active";
				}
			?>
		">
			<a href="{{route('vendorOrdersAll')}}">
                <span class="sl-icon icon-settings"></span>
                Orders
            </a>
		</li>
		<!-- /DROPDOWN ITEM -->
		
		<!-- DROPDOWN ITEM -->
		<li class="dropdown-item">
			<a href="{{route('inbox')}}">
                <span class="sl-icon icon-envelope"></span>
                Inbox
            </a>
		</li>
		<!-- /DROPDOWN ITEM -->

		<!-- Shops -->
		<li class="dropdown-item interactive
			<?php
				if(Route::currentRouteName()=='shopCreate' || Route::currentRouteName()=='myShops'){
					echo "active";
				}
			?>
		">
			<a href="#">
                <span class="sl-icon icon-envelope"></span>
                Shops
                <!-- SVG ARROW -->
				<svg class="svg-arrow">
					<use xlink:href="#svg-arrow"></use>
				</svg>
				<!-- /SVG ARROW -->
			</a>

			<!-- Shops Items -->
			<ul class="inner-dropdown
				<?php
					if(Route::currentRouteName()=='shopCreate' || Route::currentRouteName()=='myShops'){
						echo "open";
					}
				?>
			">
				<li class="inner-dropdown-item">
					<a href="{{route('shopCreate')}}">
		                Add New Shop
		            </a>
				</li>
				<li class="inner-dropdown-item active">
					<a href="{{route('myShops')}}">
		                My Shops
		            </a>
				</li>
			</ul>
			<!--  Shops Items -->
		</li>
		<!-- /Shops -->

		<!-- Products -->
		<li class="dropdown-item interactive
			<?php
				if(Request::segment(1)=='product' || Request::segment(1)=='my-products'){
					echo "active";
				}
			?>
		">
			<a href="#">
                <span class="sl-icon icon-envelope"></span>
                Products
                <!-- SVG ARROW -->
				<svg class="svg-arrow">
					<use xlink:href="#svg-arrow"></use>
				</svg>
				<!-- /SVG ARROW -->
			</a>

			<!-- Products Items -->
			<ul class="inner-dropdown
				<?php
					if(Request::segment(1)=='product' || Request::segment(1)=='my-products'){
						echo "open";
					}
				?>
			">
				<li class="inner-dropdown-item">
					<a href="{{route('productCreate')}}">
		                <span class="sl-icon icon-credit-card"></span>
		                Add New Product
		            </a>
				</li>
				<li class="inner-dropdown-item">
					<a href="{{route('myProducts')}}">
		                <span class="sl-icon icon-credit-card"></span>
		                My Products
		            </a>
				</li>
			</ul>
			<!--  Products Items -->
		</li>
		<!-- /Products -->

		<!-- Packages -->
		<li class="dropdown-item interactive
			<?php
				if(Request::segment(1)=='my-packages'){
					echo "active";
				}
			?>
		">
			<a href="#">
                <span class="sl-icon icon-envelope"></span>
                Shop Packages
                <!-- SVG ARROW -->
				<svg class="svg-arrow">
					<use xlink:href="#svg-arrow"></use>
				</svg>
				<!-- /SVG ARROW -->
			</a>

			<!-- Packages Items -->
			<ul class="inner-dropdown
				<?php
					if(Request::segment(1)=='my-packages'){
						echo "open";
					}
				?>
			">
				<li class="inner-dropdown-item">
					<a href="{{route('buyPackage')}}">
		                <span class="sl-icon icon-credit-card"></span>
		                Buy Package
		            </a>
				</li>
				<li class="inner-dropdown-item">
					<a href="{{route('myPackages')}}">
		                <span class="sl-icon icon-credit-card"></span>
		                My Packages
		            </a>
				</li>
			</ul>
			<!--  Packages Items -->
		</li>
		<!-- /Packages -->
		<!-- DROPDOWN ITEM -->
		<li class="dropdown-item 
		<?php
				if(Request::segment('1')=='video'){
					echo "active";
				}
			?>
		">
			<a href="{{route('videoConference')}}">
                <span class="sl-icon icon-settings"></span>
             Video Conferencing
            </a>
		</li>
		<!-- /DROPDOWN ITEM -->
		<!-- DROPDOWN ITEM -->
		<li class="dropdown-item 
		<?php
				if(Request::segment('1')=='broadcast'){
					echo "active";
				}
			?>
		">
			<a href="{{route('videoBroadcast')}}">
                <span class="sl-icon icon-settings"></span>
             Video Broadcasting
            </a>
		</li>
		<!-- /DROPDOWN ITEM -->
		<!-- DROPDOWN ITEM -->
		<li class="dropdown-item 
		<?php
				if(Request::segment('1')=='audio'){
					echo "active";
				}
			?>
		">
			<a href="{{route('audioConference')}}">
                <span class="sl-icon icon-settings"></span>
             Audio Conferencing
            </a>
		</li>
		<!-- /DROPDOWN ITEM -->



	</ul>
	<!-- /DROPDOWN -->

    <!-- SIDE MENU TITLE -->
	<p class="side-menu-title">Info &amp; Statistics</p>
	<!-- /SIDE MENU TITLE -->

	<!-- DROPDOWN -->
	<ul class="dropdown dark hover-effect">
		<!-- DROPDOWN ITEM -->
		<li class="dropdown-item">
			<a href="{{route('vendorSalesStatements')}}">
                <span class="sl-icon icon-layers"></span>
                Sales Statement
            </a>
		</li>
		<!-- /DROPDOWN ITEM -->
	</ul>
	<!-- /DROPDOWN -->

     <!-- SIDE MENU TITLE -->
	<p class="side-menu-title">Author Tools</p>
	<!-- /SIDE MENU TITLE -->

	<!-- DROPDOWN -->
	<ul class="dropdown dark hover-effect">
        <!-- DROPDOWN ITEM -->
		<li class="dropdown-item">
			<a href="{{route('vendorWithdrawal')}}">
                <span class="sl-icon icon-wallet"></span>
                Withdrawals
            </a>
		</li>
		<!-- /DROPDOWN ITEM -->
	</ul>
	<!-- /DROPDOWN -->

    <a href="#" class="button medium secondary" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</a>
    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
        {{ csrf_field() }}
    </form>
</div>
<!-- /SIDE MENU -->