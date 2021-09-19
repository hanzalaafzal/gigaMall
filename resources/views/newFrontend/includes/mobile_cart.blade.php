<div class="ps-panel--sidebar" id="cart-mobile">
    <div class="ps-panel__header">
        <h3>Shopping Cart</h3>
    </div>
    <?php
      if (Auth::check()) {
        $carts = App\Helpers\Helper_user::carts();
        $categories = App\Helpers\Helper_user::getCategories();
      }
    ?>  
    <div class="navigation__content">
        <div class="ps-cart--mobile">
          @if(Auth::check())
            @if(Auth::user()->permissions_id == 4)
                <div class="ps-cart__content">
                  @foreach($carts as $cart)
                    <div class="ps-product--cart-mobile">
                        <div class="ps-product__thumbnail"><a href="#"><img src="{{url('/frontEnd/images/products/'.$cart->products->photo)}}" alt=""></a></div>
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
              @endif
            @endif
        </div>
    </div>
</div>
