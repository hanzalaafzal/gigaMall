<div class="ps-product ps-product--inner">
    <div class="ps-product__thumbnail"><a href="{{route('productView',$product->slug)}}"><img src="{{url('/frontEnd/images/products/'.$product->photo)}}" alt=""></a>
      @if($product->is_featured == 1)
        <div class="ps-product__badge">-16%</div>
      @endif
      <?php $cart = App\Helpers\Helper_user::check_cart($product->id); ?>
      @if(Auth::check() && Auth::user()->permissions_id == 3)

      @else
        <ul class="ps-product__actions">
          <li>
            <a href="{{route('productView',$product->slug)}}" data-toggle="tooltip" data-placement="top" title="Quick View">
              <i class="icon-eye"></i>
            </a>
          </li>
          @if($cart == 1)
            <li>
              <a href="#" data-toggle="tooltip" data-placement="top" title="Already in Cart">
                <i class="icon-bag2" style="color:red">
                </i>
              </a>
            </li>
          @elseif($cart == 0)

          <li>
            <a href="{{route('addCart',$product->slug)}}" data-toggle="tooltip" data-placement="top" title="Add to cart">
              <i class="icon-bag2">
              </i>
            </a>
          </li>

          @endif

          <?php $fav = App\Helpers\Helper_user::check_fav($product->id); ?>

          @if($fav['status'] == 0)
            <li>
              <a href="{{route('favouriteProduct',$product->slug)}}" data-toggle="tooltip" data-placement="top" title="Add to Whishlist">
                <i class="icon-heart"></i>
              </a>
            </li>
          @elseif($fav['status'] == 1))

          <li>
            <a href="#" data-toggle="tooltip" data-placement="top" title="Already in wishlist">
              <i class="icon-heart"></i>
            </a>
          </li>
            @endif
        </ul>
        @endif
    </div>
    <div class="ps-product__container">
      @if($product->original_price > $product->price)
        <p class="ps-product__price sale">{{$product->price}} PKR
      @endif
        <del>{{$product->original_price}} PKR </del>
      @if($product->original_price > $product->price)
        </p>
      @endif

        <div class="ps-product__content"><a class="ps-product__title" href="{{route('productView',$product->slug)}}">{{$product->title}}</a>
          @if(isset($product->shops))
            <p>Sold by:<a href="{{route('shopView',$product->shops->slug)}}"> {{substr($product->shops->title,0,20)}}</a></p>
          @endif
            <?php $rating = App\Helpers\Helper_user::rating($product->id); ?>
            <div class="ps-product__rating">
                <select class="ps-rating" data-read-only="true">
                    <option value="1">1</option>
                    <option value="1">2</option>
                    <option value="1">3</option>
                    <option value="1">4</option>
                    <option value="2">5</option>
                </select><span>{{$rating}}</span>
            </div>
            <div class="ps-product__progress-bar ps-progress" data-value="86">
                <div class="ps-progress__value"><span></span></div>

            </div>
        </div>
    </div>
</div>
