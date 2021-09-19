@extends('frontEnd.layout')
@section('content')
<style type="text/css">
    .cart-actions h3{
            width: 70%;
    float: left;
    margin-top: 9px;
    }
    @media screen and (max-width: 935px) {
        .cart .cart-header-category, .cart .cart-header-price,
    .cart .cart-item-category, .cart .cart-item-price {
      display: unset !important; }
    }
</style>
<!-- SECTION -->
<div class="section-wrap">
        <div class="section">
            <!-- CART -->
            <div class="cart">
                <!-- CART HEADER -->
                <div class="cart-header">
                    <div class="cart-header-product">
                        <p class="text-header small">Product Details</p>
                    </div>
                    <div class="cart-header-category">
                        <p class="text-header small">Price <small><small> (Per Product)</small></small></p>
                    </div>
                    <div class="cart-header-price">
                        <p class="text-header small">Quantity</p>
                    </div>
                    <div class="cart-header-actions">
                        <p class="text-header small">Remove</p>
                    </div>
                </div>
                <!-- /CART HEADER -->
                <!-- CART ITEM -->

            @if(count($carts) >0)
                <?php $i=0;$subTotal=0;?>
                @foreach($carts as $cart)
                    <div class="cart-item">
                        <!-- CART ITEM PRODUCT -->
                        <div class="cart-item-product">
                            <!-- ITEM PREVIEW -->
                            <div class="item-preview">
                                <a href="">
                                    <figure class="product-preview-image small liquid">
                                        <img src="{{url('/frontEnd/images/products/'.$cart->products->photo)}}" alt="">
                                    </figure>
                                </a>
                                <a href=""><p class="text-header small">{{substr($cart->products->title,0,25).'...'}}</p></a>
                                <p class="description">{{substr($cart->products->description,0,45).'...'}}</p>
                            </div>
                            <!-- /ITEM PREVIEW -->
                        </div>
                        <!-- /CART ITEM PRODUCT -->

                        <!-- CART ITEM PRICE -->
                        <div class="cart-item-price">
                            <p class="price">{{$cart->products->price}}&nbsp;<span>PKR</span></p>
                            <div style="display: none;" id="{{ $cart->id."item" }}">{{$cart->products->price}}</div>
                        </div>
                        <!-- /CART ITEM PRICE -->

                        <!-- CART ITEM CATEGORY -->
                        <div class="cart-item-category" style="padding-top: 0px;">
                            <input type="number" id="{{$cart->id}}" name="quantity" onchange="updatePreviousprice('{{$cart->id}}'); updateQ('{{$cart->id}}'); setTotal('{{$cart->id}}')"  value="{{ $cart->quantity }}">
                            <input type="hidden" id="{{ $cart->id."prevOrignal" }}" name="quantityOrignal14" value="{{ $cart->quantity }}">
                            <input type="hidden" id="{{ $cart->id."netNewPrice" }}" name="quantityOrignal14">
                            <div style="display: none;" id="{{ $cart->id."Previousquant" }}"></div>
                            <p><small class="alert-info" id="quantitymessage{{$cart->id}}"></small></p>
                        </div>
                        <!-- /CART ITEM CATEGORY -->
                        
                        <!-- CART ITEM ACTIONS -->
                        <div class="cart-item-actions">
                            <!-- CHECKBOX -->
                            <a href="{{route('removeCart',$cart->id)}}" class="button dark-light rmv">
                                <!-- SVG PLUS -->
                                <svg class="svg-plus">
                                    <use xlink:href="#svg-plus"></use>  
                                </svg>
                                <!-- /SVG PLUS -->
                            </a>
                            <!-- /CHECKBOX -->
                        </div>
                        <!-- /CART ITEM ACTIONS -->
                    </div>
                    <?php $i++; ?>
                    <?php $subTotal = $subTotal+($cart->products->price*$cart->quantity); ?>
                   
                @endforeach
                <div style="padding-left:55%">

                    <p class="price" id="subTotStr" }}>{{ $subTotal  }}<span>PKR</span></p>
                    <div style="display:none;" id="subTot">{{ $subTotal  }}</div>
                </div>
                               
                <!-- /CART ITEM -->

                <!-- CART ACTIONS -->
                <div class="cart-actions">
                    <a href="{{route('checkout')}}" class="button mid primary">Proceed to Checkout</a>
                    <a href="{{url('/')}}" class="button mid dark-light spaced">Continue Browsing</a>
                </div>
                <!-- /CART ACTIONS -->

            @else
                <div class="cart-actions">
                    <h3>No products found in cart.</h3>
                    <a href="{{url('/')}}" class="button mid dark-light spaced">Browsing Products</a>
                </div>
            @endif
            </div>
            <!-- /CART -->
        </div>
</div>
<!-- /SECTION -->  
<script type="text/javascript">
    function updateQ(id){
        var quantity = $('#'+id).val();
        var itemPrice=$('#'+id+'item').text();
       //alert(itemPrice);
        //var subT = $('#subTot').val();
       // alert($("#subTot").text());
        //$('#subTot').text('hello');
      // var subT ="shere";
        //alert(subT);
        
        //alert(NewPrice);
        if(quantity < 1){
            $('#'+id).val('');
        }
          var route = 'cart-update/'+id+'/'+quantity;
          var url =  {!! json_encode(url('/')) !!}+'/'+route;
          $.get(url, function(result){
              if(result['status'] == 0){
                $('#quantitymessage'+id).text('');
                $('#quantitymessage'+id).text('Available in Stock = '+result['product']['quantity']);
                $('#'+id).val(result['product']['quantity']);

              
                updateQ(id);
                window.location.href = '{{route("myCart")}}';
                            }
              

          });
         // window.location.href = '{{route("myCart")}}'; 
          var NewPrice=itemPrice*quantity;
          var itemQuant=$('#'+id+'Previousquant').text();
          
          //alert('bfr');
            //alert(itemQuant);
            var oldPrice=itemQuant*itemPrice;
           // alert("oldprice");
            //alert(oldPrice);
            //alert("newprice");
            //alert(NewPrice);
            $('#'+id+'prevOrignal').val(quantity);
            getPreviousFromDiv=$('#subTot').text();
           // alert('total price new');
            //alert(getPreviousFromDiv);
            var newprice=getPreviousFromDiv-oldPrice+NewPrice;
            //alert("net new is=");
           // alert(newprice);
           // newprice=newprice+NewPrice;
           $('#'+id+'netNewPrice').val(newprice);
           // $('#subTotStr').text(newprice+' PKR');
            //alert(newprice);
           // window.location.href = '{{route("myCart")}}';
    }
    function setTotal(id){
        
       // alert('i ss');
        var netFromField= $('#'+id+'netNewPrice').val();
        $('#subTot').text(netFromField);
        $('#subTotStr').text(netFromField+' PKR');

        //alert('final');
    }
    function updatePreviousprice(id){
//alert('iam on previous function');
var quantit = $('#'+id+'prevOrignal').val();
//alert(quantit);
$('#'+id+'Previousquant').text(quantit);
//var itemPrice=$('#'+id+'Previousquant').text();
//alert(itemPrice);
    }
    setTimeout(function() {
        $('.alert-info').text('');
    }, 5000);
</script>
@endsection