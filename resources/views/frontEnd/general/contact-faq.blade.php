@extends('frontEnd.layout')

@section('content')
<!-- SECTION HEADLINE -->
<div class="section-headline-wrap v3">
  <div class="section-headline">
    <h2>Help and Support Center</h2>
  </div>
</div>
<!-- /SECTION HEADLINE -->

<!-- SECTION -->
<div class="section-wrap">
  <div class="section">
    <!-- SIDEBAR -->
    <div class="sidebar right">
        
        <div class="sidebar-item">
          <h4>Contact Us</h4>
          <hr class="line-separator">
          <form class="search-form" action="{{route('contactUs')}}" method="post">
            {{csrf_field()}}
            <input type="text" class="rounded" name="full_name" id="search_topics" placeholder="Full Name...">
            <br>
            <input type="text" class="rounded" name="email" id="search_topics" placeholder="Email...">
            <br>
            <textarea name="message" placeholder="Write Message..." ></textarea>
            <br><br>
            <button class="button secondary">Submit</button>
          </form>
        </div>

    </div>
    <!-- /SIDEBAR -->

    <!-- CONTENT -->
    <div class="content left">

      <!-- POST TAB -->
      <div class="post-tab">
        <!-- TAB HEADER -->
        <div class="tab-header secondary">

          <!-- TAB ITEM -->
          <div class="tab-item">
            <p class="text-header">FAQs</p>
          </div>
          <!-- /TAB ITEM -->
        </div>
        <!-- /TAB HEADER -->

        <!-- TAB CONTENT -->
        <div class="tab-content open">
          <!-- ITEM-FAQ -->
          <div class="accordion item-faq secondary">
            <!-- ACCORDION ITEM -->
            <div class="accordion-item">
              <h6 class="accordion-item-header">Read Before Buying</h6>
              <!-- SVG ARROW -->
              <svg class="svg-arrow">
                <use xlink:href="#svg-arrow"></use>
              </svg>
              <!-- /SVG ARROW -->
              <div class="accordion-item-content">
                <h4>Bidding for the First Time</h4>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in henderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. </p>
                <h4>Winning the Auction</h4>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in henderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. </p>
              </div>
            </div>
            <!-- /ACCORDION ITEM -->

            <!-- ACCORDION ITEM -->
            <div class="accordion-item">
              <h6 class="accordion-item-header">How Does Bidding Work?</h6>
              <!-- SVG ARROW -->
              <svg class="svg-arrow">
                <use xlink:href="#svg-arrow"></use>
              </svg>
              <!-- /SVG ARROW -->
              <div class="accordion-item-content">
                <h4>Bidding for the First Time</h4>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in henderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. </p>
                <h4>Winning the Auction</h4>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in henderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. </p>
              </div>
            </div>
            <!-- /ACCORDION ITEM -->

            <!-- ACCORDION ITEM -->
            <div class="accordion-item">
              <h6 class="accordion-item-header">Our Return Policy</h6>
              <!-- SVG ARROW -->
              <svg class="svg-arrow">
                <use xlink:href="#svg-arrow"></use>
              </svg>
              <!-- /SVG ARROW -->
              <div class="accordion-item-content">
                <h4>Bidding for the First Time</h4>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in henderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. </p>
                <h4>Winning the Auction</h4>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in henderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. </p>
              </div>
            </div>
            <!-- /ACCORDION ITEM -->

            <!-- ACCORDION ITEM -->
            <div class="accordion-item">
              <h6 class="accordion-item-header">Shipping and Delivery</h6>
              <!-- SVG ARROW -->
              <svg class="svg-arrow">
                <use xlink:href="#svg-arrow"></use>
              </svg>
              <!-- /SVG ARROW -->
              <div class="accordion-item-content">
                <h4>Bidding for the First Time</h4>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in henderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. </p>
                <h4>Winning the Auction</h4>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in henderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. </p>
              </div>
            </div>
            <!-- /ACCORDION ITEM -->

            <!-- ACCORDION ITEM -->
            <div class="accordion-item">
              <h6 class="accordion-item-header">Quality Guarantee</h6>
              <!-- SVG ARROW -->
              <svg class="svg-arrow">
                <use xlink:href="#svg-arrow"></use>
              </svg>
              <!-- /SVG ARROW -->
              <div class="accordion-item-content">
                <h4>Bidding for the First Time</h4>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in henderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. </p>
                <h4>Winning the Auction</h4>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in henderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. </p>
              </div>
            </div>
            <!-- /ACCORDION ITEM -->
          </div>
          <!-- /ITEM-FAQ -->
        </div>
        <!-- /TAB CONTENT -->
        
      </div>
      <!-- /POST TAB -->
    </div>
    <!-- CONTENT -->
  </div>
</div>
<!-- /SECTION -->

@endsection