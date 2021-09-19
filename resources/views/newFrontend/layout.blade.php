
<html lang="en">
  @include('newFrontend.includes.head')

  <body>
    @include('newFrontend.includes.header_web')
    @include('newFrontend.includes.header_mobile')

    @yield('main_content')

    @include('newFrontend.includes.footer')
    <div id="back2top"><i class="icon icon-arrow-up"></i></div>
    <div class="ps-site-overlay"></div>
    @include('newFrontend.includes.mobile_cart')
    @include('newFrontend.includes.mobile_navigation')
    <div class="navigation--list">
        <div class="navigation__content"><a class="navigation__item ps-toggle--sidebar" href="#menu-mobile"><i class="icon-menu"></i><span> Menu</span></a><a class="navigation__item ps-toggle--sidebar" href="#navigation-mobile"><i class="icon-list4"></i><span> Categories</span></a><a class="navigation__item ps-toggle--sidebar" href="#search-sidebar">
          <i class="icon-magnifier"></i><span> Search</span></a><a class="navigation__item ps-toggle--sidebar" href="#cart-mobile"><i class="icon-bag2"></i><span> Cart</span></a></div>
    </div>
    <div class="ps-panel--sidebar" id="search-sidebar">
    <div class="ps-panel__header">
        <form class="ps-form--search-mobile" action="index.html" method="get">
            <div class="form-group--nest">
                <input class="form-control" type="text" placeholder="Search something...">
                <button><i class="icon-magnifier"></i></button>
            </div>
        </form>
    </div>
      <div class="navigation__content"></div>
    </div>
    @include('newFrontend.includes.mobile_menu2')
    <div id="loader-wrapper">
      <div class="loader-section section-left"></div>
      <div class="loader-section section-right"></div>
    </div>
    <div class="ps-search" id="site-search"><a class="ps-btn--close" href="#"></a>
    <div class="ps-search__content">
        <form class="ps-form--primary-search" action="do_action" method="post">
            <input class="form-control" type="text" placeholder="Search for...">
            <button><i class="aroma-magnifying-glass"></i></button>
        </form>
      </div>
  </div>
  @include('newFrontend.includes.js')
  </body>
</html>
