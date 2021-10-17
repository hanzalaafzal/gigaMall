@extends('newFrontend.layout')


@section('main_content')
<div class="ps-page--simple">
    <div class="ps-breadcrumb">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="index.html">Home</a></li>
                <li><a href="shop-default.html">Shop</a></li>
                <li>Checkout</li>
            </ul>
        </div>
    </div>
    <div class="ps-checkout ps-section--shopping">
        <div class="container">
            <div class="ps-section__header">
                <h1>Checkout</h1>
            </div>
            <div class="ps-section__content">
              @if(session('doneMessage'))
              <div class="alert alert-success" role="alert">
                  {{session('doneMessage')}}
                </div>
              @endif
              @if(session('errorMessage'))
              <div class="alert alert-danger" role="alert">
                  {{session('errorMessage')}}
                </div>
              @endif

                    <div class="row">
                        <div class="col-xl-7 col-lg-8 col-md-12 col-sm-12  ">
                            <div class="ps-form__billing-info">
                              @if(!(isset($CouponAvailed)))
                              <h3 class="ps-form__heading">Redeem Code</h3>
                              <div class="form-group">
                                <form id="coupon-code-form" method="POST" action="{{route('couponsRedeem')}}" accept-charset="UTF-8" enctype="multipart/form-data">
                                  @csrf
                                  <input type="text" class="form-control" style="width:60%" name="coupon_code" placeholder="Enter your coupon code..." reqired>
                                  <br>
                                  <button type="submit" class="ps-btn btn-sm">Apply Coupon Code</button>
                                </form>

                              </div>
                              @else
                                <h3 class="ps-form__heading">Redeemed Code</h3>
                                  <table>
                                    <tbody>
                                      <tr>
                                        <td>Coupon Code: </td>
                                        <td width="30%"></td>
                                        <td>{{ $CouponAvailed->coupon_code }}</td>
                                      </tr>
                                      <tr>
                                        <td>Promotion Name: </td>
                                        <td width="30%"></td>
                                        <td>{{ $CouponAvailed->promo_name }}</td>
                                      </tr>
                                    </tbody>
                                  </table>
                              @endif
                            </div>
                            <br>
                            <form  method="post" action="{{route('storeOrder')}}" id="checkForm" enctype="multipart/form-data">
                              @csrf
                            <div class="ps-form__billing-info">
                                <h3 class="ps-form__heading">Billing Details</h3>
                                <div class="form-group">
                                    <label>Your Addresses
                                    </label>
                                    <div class="form-group__content">
                                        <select class="form-control" name="billing_address" id="billing_address" required style="width:60%">
                                          <option value="{{Auth::user()->addressBooksDefault->id}}" selected>{{Auth::user()->addressBooksDefault->address}}</option>
                                          @foreach(Auth::user()->addressBooks as $address)
                                              <option value="{{$address->id}}">{{$address->address}}</option>
                                          @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group" id="billing-address-container">
                                  <h5>{{Auth::user()->addressBooksDefault->full_name}}</h5>
                                  <h5>{{Auth::user()->addressBooksDefault->phone}}</h5>
                                  <h5>Country: {{Auth::user()->addressBooksDefault->countries->title_en}}</h5>
                                  <h5>Zip:   {{Auth::user()->addressBooksDefault->zip_code}}</h5>
                                  <h5>{{Auth::user()->addressBooksDefault->address}}</h5>
                                </div>


                                <h3 class="ps-form__heading">Shipping Details</h3>
                                <div class="form-group">
                                  <div class="ps-checkbox">
                                      <input class="form-control" type="checkbox" id="same_add" name="same_add">
                                      <label for="same_add">Use Billing Address for Shipping?</label>
                                  </div>
                                </div>
                                <div class="form-group" id="ship-address">
                                      <select class="form-control" name="shipping_address" id="shipping_address" required style="width:60%">
                                        <option value="{{Auth::user()->addressBooksDefault->id}}" selected>{{Auth::user()->addressBooksDefault->address}}</option>
                                        @foreach(Auth::user()->addressBooks as $address)
                                            <option value="{{$address->id}}">{{$address->address}}</option>
                                        @endforeach
                                      </select>
                                </div>

                                <div class="form-group" id="shipping-address-container">
                                  <h5>{{Auth::user()->addressBooksDefault->full_name}}</h5>
                                  <h5>{{Auth::user()->addressBooksDefault->phone}}</h5>
                                  <h5>Country: {{Auth::user()->addressBooksDefault->countries->title_en}}</h5>
                                  <h5>Zip:   {{Auth::user()->addressBooksDefault->zip_code}}</h5>
                                  <h5>{{Auth::user()->addressBooksDefault->address}}</h5>
                                </div>


                            </div>
                        </div>
                        <div class="col-xl-5 col-lg-4 col-md-12 col-sm-12  ">
                            <div class="ps-form__total">
                                <h3 class="ps-form__heading">Your Order</h3>
                                <div class="content">
                                    <div class="ps-block--checkout-total">

                                        <div class="ps-block__content">
                                          <?php $subtotal = 0; $ship_price = 0; ?>
                                            <table class="table ps-block__products">
                                                <tbody>
                                                  @foreach(Auth::user()->carts as $cart)
                                                    <tr>
                                                        <td><a href="#"> {{substr($cart->products->title,0,30).'...'}} × {{$cart->quantity}}</a>
                                                          <?php $price = $cart->products->price * $cart->quantity?>
                                                          <?php
                                                              $subtotal = $subtotal + $price;
                                                              $ship_price = $ship_price + $cart->products->shipping_price;
                                                          ?>
                                                        </td>
                                                        <td>{{$price}} PKR</td>
                                                        <?php $price_original = $cart->products->original_price * $cart->quantity?>
                                                        @if($cart->products->original_price > $cart->products->price)
                                                        <td style="text-decoration:line-through">{{$price_original}} PKR</td>
                                                        @endif
                                                    </tr>
                                                  @endforeach
                                                </tbody>
                                            </table>
                                            <table>
                                              <tbody>
                                                <tr>
                                                  <td> <h4>Subtotal: </h4></td>
                                                  <td width="40%"></td>
                                                  <td> <h4>{{$subtotal}} PKR</h4></td>
                                                </tr>
                                                <tr>
                                                  <td> <h4>Shipping: </h4> </td>
                                                  <td width="40%"></td>
                                                  <td> <h4>{{$ship_price}} PKR</h4></td>
                                                </tr>
                                                <tr>
                                                  <td> <h4>Total: </h4> </td>
                                                  <td width="40%"></td>
                                                  <td> <h4>{{$subtotal + $ship_price}} PKR</h4></td>
                                                </tr>
                                                @if((isset($CouponAvailed->discount_amount))||(isset($CouponAvailed->discount_percentage)))
                                                <tr>
                                                  <td> <h4>Discount: </h4> </td>
                                                  <td width="40%"></td>
                                                  <td> <h4>
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
                                                  PKR </h4></td>

                                                </tr>
                                                <tr>
                                                  <td> <h4>Discounted Total: </h4> </td>
                                                  <td width="40%"></td>
                                                  <td> <h4>@if(isset($dicount))
                                                   {{$subtotal + $ship_price-$dicount}}
                                                  @endif PKR</h4></td>
                                                </tr>

                                                @endif
                                              </tbody>
                                            </table>

                                        </div>
                                    </div>
                                    <button name="button" type="button" onclick="checkout('wallet')" class="ps-btn ps-btn--fullwidth">Pay with E-bazarr Wallet</button>
                                    <br>
                                    <br>
                                    <a onclick="checkout('card')">
                                      <button  type="button" class="ps-btn ps-btn--fullwidth" name="button">Pay with Master / Visa / Debit Card</button>
                                    </a>
                                    <br>
                                    <br>
                                    <a onclick="checkout('easy')">
                                      <button type="button" class="ps-btn ps-btn--fullwidth" name="button">Pay with Easy Paisa</button>
                                    </a>
                                    <br>
                                    <br>
                                    <a onclick="checkout('cod')">
                                      <button type="button" class="ps-btn ps-btn--fullwidth" name="button">Pay Cash on Delivery</button>
                                    </a>
                                </div>
                            </div>
                        </div>
                      </form>
                    </div>

            </div>
        </div>
    </div>
</div>
@endsection

@push('jss')
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
        $('#shipping-address-container').empty();
        $('#shipping-address-container').append('<h5>'+result['full_name']+'</h5>'+'<h5>'+result['phone']+'</h5>'+'<h5>Country: '+result['country']+', Zipe Code: '+result['zip_code']+'</h5>'+'<h5>'+result['address']+'</h5>');
      });
    });

    $('#billing_address').on('change',function(){
      var id = $('#billing_address').val();
      var route = 'get-address';
      var url =  {!! json_encode(url('/')) !!}+'/'+route+'/'+id;
      $.get(url, function(result){
        $('#billing-address-container').empty();
        $('#billing-address-container').append('<h5>'+result['full_name']+'</h5>'+'<h5>'+result['phone']+'</h5>'+'<h5>Country: '+result['country']+', Zipe Code: '+result['zip_code']+'</h5>'+'<h5>'+result['address']+'</h5>');
      });
    });
</script>

<script type="text/javascript">
  function checkout(type){
      var subtotal={!! $subtotal !!}
      var shipping={!! $ship_price !!}

    if(type=='easy'){
      $('#checkForm').attr('action','{!! route("bank_payment",[$subtotal,$ship_price]) !!}')
      $('#checkForm').submit();
    }else if(type=='cod'){
      $('#checkForm').attr('action','{!! route("cash_on_delivery",[$subtotal,$ship_price]) !!}')
      $('#checkForm').submit();
    }else if(type=='card'){
      $('#checkForm').attr('action','{!! route("bank_payment",[$subtotal,$ship_price]) !!}')
      $('#checkForm').submit();
    }else if(type=='wallet'){
      $('#checkForm').attr('action','{!! route("storeOrder") !!}')
      $('#checkForm').submit();
    }
  }
</script>
@endpush
