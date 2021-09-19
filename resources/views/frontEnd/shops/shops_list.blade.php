@extends('frontEnd.layout')
@section('content')
<!-- SIDEBAR NAV -->
<div class="sidebar-nav-wrap">
  <div class="sidebar-nav">

    <!-- SIDEBAR FILTERS -->
    <div class="sidebar-filters">
      <form id="shop_filter_form" name="shop_filter_form" action="{{route('searchShop')}}" method="get">
        <label for="country_id" class="select-block">
          <select name="country_id" id="country_id">
            <option value="All">All (Countries)</option>
            @foreach($countries as $country)
              <option value="{{$country->id}}"
                <?php
                  if (!empty($q['country_id']) && $q['country_id'] != 'All') {
                    if ($q['country_id'] == $country->id) {
                      echo "selected";
                    }
                  }
                ?>
              >{{$country->title_en}}</option>
            @endforeach
          </select>
          <!-- SVG ARROW -->
          <svg class="svg-arrow">
            <use xlink:href="#svg-arrow"></use>
          </svg>
          <!-- /SVG ARROW -->
        </label>
        <label id="state" for="state_id" class="select-block"
          <?php
            if(empty($q['country_id']) || $q['country_id'] == 'All'){
              echo "style='display:none;'";
            }
          ?>
        >
          <select name="state_id" id="state_id">
            <?php
              if(!empty($q['country_id']) && $q['country_id'] != 'All'){
                echo '<option selected="" value="All">All</option>';
                foreach($states as $state){
                  if(!empty($q['state_id']) && $q['state_id'] != 'All' ){
                    if ($q['state_id'] == $state->id) {
                      echo "<option selected value='".$state->id."'>".$state->name."</option>";
                    }
                    else{
                      echo "<option value='".$state->id."'>".$state->name."</option>";
                    }
                  }
                  else{
                    echo "<option value='".$state->id."'>".$state->name."</option>";
                  }
                }
              }
            ?>
          </select>
          <!-- SVG ARROW -->
          <svg class="svg-arrow">
            <use xlink:href="#svg-arrow"></use>
          </svg>
          <!-- /SVG ARROW -->
        </label>
        <label id="keyword" for="keyword" class="select-block">
          <input placeholder="Search shop name here..." style="height: 32px;" type="text" name="keyword"
          <?php
            if (!empty($q['keyword'])) {
              echo "value='".$q['keyword']."'";
            }
          ?>
          >
        </label>
        <button style="margin-top: 0px;" class="button dark-light">Update Search</button>
      </form>
    </div>
    <!-- /SIDEBAR FILTERS -->
  </div>
</div>
<!-- /SIDEBAR NAV -->

<!-- SECTION -->
  <div class="section-wrap">
    <div class="section">
      <!-- PRODUCT SHOWCASE -->
      <div class="product-showcase">
        <!-- PRODUCT LIST -->
        <div class="product-list list full">
          <!-- PRODUCT ITEM -->
          @if(count($shops)>0)
            @foreach($shops as $shop)
              <div class="product-item shop">
                <a href="{{route('shopView',$shop->slug)}}">
                  <!-- PRODUCT PREVIEW IMAGE -->
                  <figure class="product-preview-image small">
                    <img src="{{url('/frontEnd/images/shops/'.$shop->photo)}}" alt="product-image">
                  </figure>
                  <!-- /PRODUCT PREVIEW IMAGE -->
                </a>

                <!-- PRODUCT INFO -->
                <div class="product-info">
                  <a href="{{route('shopView',$shop->slug)}}">
                    <p class="text-header">{{$shop->title}}</p>
                  </a>
                  <p class="product-description">{{$shop->description}}</p>
                  <a href="{{route('shopView',$shop->slug)}}">
                    <p class="category primary">View Shop</p>
                  </a>
                </div>
                <!-- /PRODUCT INFO -->

                <!-- AUTHOR DATA -->
                <div class="author-data">
                  <!-- USER RATING -->
                  <div class="user-rating" style="margin-bottom: 5px;">
                    <a href="author-profile.html">
                      <figure class="user-avatar small">
                        @if($shop->users->photo)
                          <img src="{{url('/frontEnd/images/avatars/'.$shop->users->photo)}}" alt="user-avatar">
                        @else
                          <img src="{{url('/frontEnd/images/avatars/unknown.jpg')}}" alt="user-avatar">
                        @endif
                      </figure>
                    </a>
                    <a href="{{route('shopOwner',$shop->users->user_name)}}">
                      <p class="text-header tiny">{{$shop->users->user_name}}</p>
                    </a>
                  </div>
                  <!-- /USER RATING -->

                  <!-- METADATA -->
                  <div class="metadata">
                    <!-- META ITEM -->
                    <div class="meta-item">
                      <p>Total Products</p>
                      <p>{{count($shop->users->products_active)}}</p>
                    </div>
                    <!-- /META ITEM -->

                    <!-- META ITEM -->
                    <div class="meta-item">
                      <p>Total Shops</p>
                      <p>{{count($shop->users->shops_active)}}</p>
                    </div>
                    <!-- /META ITEM -->
                  </div>
                  <!-- /METADATA -->
                </div>
                <!-- /AUTHOR DATA -->

                <!-- ITEM METADATA -->
                <div class="item-metadata">
                  <?php $i= 1; ?>
                  @foreach($shop->productsActive as $product)
                    <a href="{{route('productView',$product->slug)}}">
                      <p class="text-header tiny">{{substr($product->title,0,20)}}</p>
                    </a><br>
                    <?php if($i>=2){break;} $i++; ?>
                  @endforeach
                  <a href="{{route('shopView',$shop->slug)}}">
                    <p class="text-header primary" style="font-size: 12px;">
                      View All
                    </p>
                  </a>
                </div>
                <!-- ITEM METADATA -->

                <!-- AUTHOR DATA REPUTATION -->
                <div class="author-data-reputation">
                  <p class="text-header tiny">Reputation</p>
                  <ul class="rating" style="    width: 35px;">
                    <?php $shop_rating = App\Helpers\Helper_user::shop_rating($shop->id); ?>
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
                <!-- /AUTHOR DATA REPUTATION -->

                <!-- ITEM ACTIONS -->
                <div class="item-actions" style="padding: 22px 4px 0 4px;">
                  <p><small>Total Products</small></p>
                </div>
                <!-- /ITEM ACTIONS -->

                <!-- PRICE INFO -->
                <div class="price-info">
                  <p class="price medium">{{count($shop->productsActive)}}</p>
                </div>
                <!-- /PRICE INFO -->
              </div>
            @endforeach
          @else
            <h4>No shop found against this search.</h4>
          @endif
          <!-- /PRODUCT ITEM -->
			{{$shops->links()}}
        </div>
        <!-- /PRODUCT LIST -->
      </div>
      <!-- /PRODUCT SHOWCASE -->

      <div class="clearfix"></div>
    </div>
  </div>
  <!-- /SECTION -->

<script type="text/javascript">
  $('#country_id').on('change',function(){
    var country_id= $('#country_id').val();
    if (country_id == 'All') {
      $('#state_id').empty();
      $('#state').css('display','none');
    }
    var route = '/get-states';
    var url =  {!! json_encode(url('/')) !!}+'/'+route+'/'+country_id;
    $('#state_id').empty();
    $.get(url, function(result){
      $('#state').css('display','unset');
        $('#state_id').append('<option value="All" selected="">All (States)</option>');
        $.each(result, function(key, value) {
              $('#state_id').append('<option value=' + value['id'] + '>' + value['name'] + '</option>');
          });
    });
  });
</script>
@endsection