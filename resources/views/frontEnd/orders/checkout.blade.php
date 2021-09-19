@extends('frontEnd.layout')
@section('content')
<style type="text/css">
    .cart-actions h3{
            width: 70%;
    float: left;
    margin-top: 9px;
    }
</style>
<script src="https://use.fontawesome.com/6dbae2107a.js"></script>
<!-- SECTION -->
<div class="section-wrap">
    <div class="section">
        <!-- SIDEBAR -->
        <div class="sidebar left">
            <!-- SIDEBAR ITEM -->
            @if(!(isset($CouponAvailed)))
            <div class="sidebar-item">
                <h4>Redeem Code</h4>
                <hr class="line-separator">
                <form id="coupon-code-form" method="POST" action="{{route('couponsRedeem')}}" accept-charset="UTF-8" enctype="multipart/form-data">
                    <input type="text" name="coupon_code" placeholder="Enter your coupon code...">
                    {{ csrf_field() }}
                    <button class="button mid dark-light">Apply Coupon Code</button>
                </form>
            </div>
            @else
            <div class="sidebar-item">
                <h4>Coupon Redeemed</h4>
                <hr class="line-separator">
               <h6 style="text-transform: none;">Coupon:&nbsp;&nbsp;{{ $CouponAvailed->coupon_code }}</h6>
               <br>
               <hr class="line-separator">
               <h6 style="text-transform: none;">Promotion Name:&nbsp;&nbsp;{{ $CouponAvailed->promo_name }}</h6>
               <br>
               <hr class="line-separator">
               {{-- <h6>Coupon: {{ $CouponAvailed->expiry_date }}</h6>
               <h6>Coupon: {{ $CouponAvailed->coupon_code }}</h6> --}}
                <br>
                {{-- {{ $CouponAvailed->coupon_code }} --}}
                {{-- <form id="coupon-code-form" method="POST" action="{{route('couponsRedeem')}}" accept-charset="UTF-8" enctype="multipart/form-data">
                    <input type="text" name="coupon_code" placeholder="Enter your coupon code...">
                    {{ csrf_field() }}
                    <button class="button mid dark-light">Apply Coupon Code</button>
                </form> --}}
            </div>
            @endif
            <!-- /SIDEBAR ITEM -->

            <!-- SIDEBAR ITEM -->
            {{--  <div class="sidebar-item">
                <h4>Calculate Shipping</h4>
                <hr class="line-separator">
                <form id="shipping-form">
                    <label for="country" class="select-block">
                        <select name="country" id="country">
                            <option value="0">Select your Country...</option>
                            <option value="1">United States</option>
                            <option value="2">Argentina</option>
                            <option value="3">Brasil</option>
                            <option value="4">Japan</option>
                        </select>
                        <!-- SVG ARROW -->
                        <svg class="svg-arrow">
                            <use xlink:href="#svg-arrow"></use>
                        </svg>
                        <!-- /SVG ARROW -->
                    </label>
                    <label for="state_city" class="select-block">
                        <select name="state_city" id="state_city">
                            <option value="0">Select your State/City...</option>
                            <option value="1">New York</option>
                            <option value="2">Buenos Aires</option>
                            <option value="3">Brasilia</option>
                            <option value="4">Tokyo</option>
                        </select>
                        <!-- SVG ARROW -->
                        <svg class="svg-arrow">
                            <use xlink:href="#svg-arrow"></use>
                        </svg>
                        <!-- /SVG ARROW -->
                    </label>
                    <input type="text" name="zip_code" placeholder="Enter your Zip Code...">
                    <button class="button mid dark-light">Update Shipping Total</button>
                </form>
            </div>  --}}
            <!-- /SIDEBAR ITEM -->
        </div>
        <!-- /SIDEBAR -->

        <!-- CONTENT -->
        <form  method="post" action="{{route('storeOrder')}}" enctype="multipart/form-data">
            {{csrf_field()}}
        <div class="content right">
            <!-- FORM BOX ITEM -->
                <div class="form-box-item not-padded">
                    <h4>Cart Overview</h4>
                    <hr class="line-separator">
                    <!-- CART OVERVIEW ITEM -->
                    <?php $subtotal = 0; $ship_price = 0; ?>
                    @foreach(Auth::user()->carts as $cart)

                        <div class="cart-overview-item">
                            <p class="text-header small">{{substr($cart->products->title,0,30).'...'}} <span class="primary"> x{{$cart->quantity}}</span></p>

                            <?php $price = $cart->products->price * $cart->quantity?>
                            <?php
                                $subtotal = $subtotal + $price;
                                $ship_price = $ship_price + $cart->products->shipping_price;
                            ?>
                            <p class="price">{{$price}} <span>PKR</span></p>
                             <?php $price_original = $cart->products->original_price * $cart->quantity?>
                             @if($cart->products->original_price > $cart->products->price)
                            <p class="price" style=" text-decoration: line-through; margin-right: 4%">{{$price_original}}<span style=" text-decoration: line-through;"> PKR</span></p>
                             @endif
                            <p class="category primary"></p>
                        </div>


                    @endforeach
                    <!-- /CART OVERVIEW ITEM -->



                    <!-- CART TOTAL -->
                    <div class="cart-total small">
                        <p class="price">{{$subtotal}}<span> PKR</span></p>
                        <p class="text-header subtotal">Subtotal</p>
                    </div>
                    <!-- /CART TOTAL -->
                    <br>

                    <div class="cart-addresses" style="width: 100%;float: left;">
                        <!-- INPUT CONTAINER -->
                            <div class="input-container half">
                                    <a href="{{route('dashboard')}}" class="button primary secondary">Add New Address</a>
                                     <br><br>
                                    <h6>Billing Address</h6>
                                {{-- <a href="{{route('dashboard')}}" class="bill-add-btn button primary secondary">Add New Address</a> --}}

                                <br>
                                <!-- INPUT CONTAINER -->
                                <div class="input-container">
                                    <label for="billing_address" class="rl-label required">Your Addresses</label>
                                    <label for="billing_address" class="select-block">
                                        <select name="billing_address" id="billing_address" required="">
                                            <option value="{{Auth::user()->addressBooksDefault->id}}">{{Auth::user()->addressBooksDefault->address}}</option>
                                            @foreach(Auth::user()->addressBooks as $address)
                                                <option value="{{$address->id}}">{{$address->address}}</option>
                                            @endforeach
                                        </select>
                                    </label>
                                </div>
                                <!-- /INPUT CONTAINER -->
                                <div class="billing-address-container">
                                    <p>
                                        {{Auth::user()->addressBooksDefault->full_name}}
                                    </p>
                                    <p>
                                        {{Auth::user()->addressBooksDefault->phone}}
                                    </p>
                                    <p>
                                        Country:
                                        {{Auth::user()->addressBooksDefault->countries->title_en}},
                                        Zipe Code:
                                        {{Auth::user()->addressBooksDefault->zip_code}}
                                    </p>
                                    <p>
                                        {{Auth::user()->addressBooksDefault->address}}
                                    </p>
                                </div>
                            </div>
                        <!-- /INPUT CONTAINER -->
                        <!-- INPUT CONTAINER -->
                            <div class="input-container half">
                                <h6>Shipping Address</h6>
                                {{-- <a href="{{route('dashboard')}}" class=" ship-add-btn button primary secondary">Add New Address</a> --}}
                                <div class="input-container">
                                    <!-- CHECKBOX -->
                                    <input type="checkbox" id="same_add" name="same_add">
                                    <label for="same_add" class="label-check b-label">
                                        <span class="checkbox primary"><span></span></span>
                                        Use Billing Address for Shipping.
                                    </label>
                                    <!-- /CHECKBOX -->
                                </div>
                                <div id="ship-address">
                                    <!-- INPUT CONTAINER -->
                                    <div class="input-container">
                                        <label for="shipping_address" class="rl-label required">Your Addresses</label>
                                        <label for="shipping_address" class="select-block">
                                            <select name="shipping_address" id="shipping_address" required="">
                                                <option value="{{Auth::user()->addressBooksDefault->id}}">{{Auth::user()->addressBooksDefault->address}}</option>
                                                @foreach(Auth::user()->addressBooks as $address)
                                                    <option value="{{$address->id}}">{{$address->address}}</option>
                                                @endforeach
                                            </select>
                                        </label>
                                    </div>
                                    <!-- /INPUT CONTAINER -->
                                    <div class="shipping-address-container">
                                        <p>
                                            {{Auth::user()->addressBooksDefault->full_name}}
                                        </p>
                                        <p>
                                            {{Auth::user()->addressBooksDefault->phone}}
                                        </p>
                                        <p>
                                            Country:
                                            {{Auth::user()->addressBooksDefault->countries->title_en}},
                                            Zipe Code:
                                            {{Auth::user()->addressBooksDefault->zip_code}}
                                        </p>
                                        <p>
                                            {{Auth::user()->addressBooksDefault->address}}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        <!-- /INPUT CONTAINER -->

                    </div>

                    <!-- CART TOTAL -->
                    <div class="cart-total small">
                        <p class="price">{{$ship_price}} <span> PKR</span></p>
                        <input type="hidden" name="shipping_cost" value="5">
                        <p class="text-header subtotal">Shipping</p>
                    </div>
                    <!-- /CART TOTAL -->

                    <!-- CART TOTAL -->
                    <div class="cart-total small">
                        <p class="price">{{$subtotal + $ship_price}}<span> PKR</span></p>
                        <p class="text-header subtotal">Cart Total</p>
                    </div>
                    <!-- /CART TOTAL -->
                    <!-- CART TOTAL -->
                    @if((isset($CouponAvailed->discount_amount))||(isset($CouponAvailed->discount_percentage)))
                    <div class="cart-total small">
                        <p class="price">
                            @if(isset($CouponAvailed->discount_amount))
                              @php
                              $dicount= $CouponAvailed->discount_amount;
                              echo $dicount;
                              @endphp
                            @endif
                            @if(isset($CouponAvailed->discount_percentage))
                              @php
                              $dicount=($subtotal)*($CouponAvailed->discount_percentage/100);
                              echo $dicount;

                              @endphp
                            @endif


                            {{-- {{$subtotal + $ship_price}} --}}

                            <span> PKR</span></p>
                        <p class="text-header subtotal">Discount</p>
                    </div>

                    <!-- /CART TOTAL -->
                    <!-- CART TOTAL -->
                    <div class="cart-total small">
                        <p class="price">
                            @if(isset($dicount))
                             {{$subtotal + $ship_price-$dicount}}
                            @endif
                            <span> PKR</span></p>
                        <p class="text-header subtotal">Total After Discount</p>
                    </div>
                    @endif
                    <!-- /CART TOTAL -->

                    <br>
                    <button class="button big dark">Pay With <span class="primary">E-Bazarr Wallet!</span><i class="fas fa-wallet"  style="margin-left: 2%"></i></button>
                    <br>

                    <a href="{{'/bank_payment/'.$subtotal.'/'.$ship_price}}">
                      <button type="button" class="button big dark">Pay With <span class="primary">Master / Debit Visa Card!</span><i class="fas fa-university" style="margin-left: 2%"></i></button>
                    </a>
                    <br>

                    <a href="{{'/bank_payment/'.$subtotal.'/'.$ship_price}}"><button type="button" class="button big dark">Pay With <span class="primary">Easy Paisa!</span><i class="fas fa-euro-sign"  style="margin-left: 2%"></i></button></a>
                    <br>

                     <a href="{{'/cash_on_delivery/'.$subtotal.'/'.$ship_price}}"><button type="button" class="button big dark">Pay Cash on <span class="primary">Delivery!</span><i class="fas fa-box"  style="margin-left: 2%"></i></button></a>
                    <br>
                </div>
                <!-- /FORM BOX ITEM -->
        </div>
        </form>
        <!-- CONTENT -->
    </div>
</div>
<!-- /SECTION -->

<script type="text/javascript">
    $('#same_add').on('click',function(){
        var ckbox = $('#same_add');
        if (ckbox.is(':checked')) {
            $('#ship-address').css('display','none');
        } else {
            $('#ship-address').css('display','unset');
        }
    });

    $('#shipping_address').on('change',function(){
      var id = $('#shipping_address').val();
      var route = 'get-address';
      var url =  {!! json_encode(url('/')) !!}+'/'+route+'/'+id;
      $.get(url, function(result){
        $('.shipping-address-container').empty();
        $('.shipping-address-container').append('<p>'+result['full_name']+'</p>'+'<p>'+result['phone']+'</p>'+'<p>Country: '+result['country']+', Zipe Code: '+result['zip_code']+'</p>'+'<p>'+result['address']+'</p>');
      });
    });

    $('#billing_address').on('change',function(){
      var id = $('#billing_address').val();
      var route = 'get-address';
      var url =  {!! json_encode(url('/')) !!}+'/'+route+'/'+id;
      $.get(url, function(result){
        $('.billing-address-container').empty();
        $('.billing-address-container').append('<p>'+result['full_name']+'</p>'+'<p>'+result['phone']+'</p>'+'<p>Country: '+result['country']+', Zipe Code: '+result['zip_code']+'</p>'+'<p>'+result['address']+'</p>');
      });
    });
</script>
@endsection
