@extends('newFrontend.layout')

@section('main_content')
<div class="ps-page--simple">

    <div class="ps-section--shopping ps-shopping-cart">
        <div class="container">
            <div class="ps-section__header">
                <h1>Shopping Cart</h1>
            </div>
            <div class="ps-section__content">
                <div class="table-responsive">
                    <table class="table ps-table--shopping-cart ps-table--responsive">
                        <thead>
                            <tr>
                                <th>Product name</th>
                                <th>PRICE</th>
                                <th>QUANTITY</th>
                                <th>TOTAL</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                          @if(count($carts) >0)
                            <?php $i=0;$subTotal=0;?>
                            @foreach($carts as $cart)

                            <tr>
                                <td data-label="Product">
                                    <div class="ps-product--cart">
                                        <div class="ps-product__thumbnail"><a href="#"><img src="{{url('/frontEnd/images/products/'.$cart->products->photo)}}" alt="" /></a></div>
                                        <div class="ps-product__content"><a href="#">{{$cart->products->title}}</a>
                                            <p>Description:<strong> {{substr($cart->products->description,0,45).'...'}}</strong></p>
                                        </div>
                                    </div>
                                </td>
                                <td class="price" data-label="Price">{{$cart->products->price}} PKR</td>
                                <div style="display: none;" id="{{ $cart->id."item" }}">{{$cart->products->price}}</div>
                                <td data-label="Quantity">
                                    <div class="form-group--number">
                                      <input class="form-control" type="number" min="1" id="{{$cart->id}}" name="quantity" onchange="updatePreviousprice('{{$cart->id}}'); updateQ('{{$cart->id}}'); setTotal('{{$cart->id}}')"  value="{{ $cart->quantity }}">
                                      <input type="hidden" id="{{ $cart->id."prevOrignal" }}" name="quantityOrignal14" value="{{ $cart->quantity }}">
                                      <input type="hidden" id="{{ $cart->id."netNewPrice" }}" name="quantityOrignal14">
                                      <div style="display: none;" id="{{ $cart->id."Previousquant" }}"></div>
                                      <p><small class="alert-info" id="quantitymessage{{$cart->id}}"></small></p>
                                    </div>
                                </td>
                                <td data-label="Total" id="{{$cart->id."newSub"}}">{{ $cart->quantity*$cart->products->price }} PKR</td>
                                <td data-label="Actions"><a href="{{route('removeCart',$cart->id)}}"><i class="icon-cross"></i></a></td>
                            </tr>
                            <?php $i++; ?>
                            <?php $subTotal = $subTotal+($cart->products->price*$cart->quantity); ?>
                            @endforeach
                          @endif
                          <tr>
                            <td></td>
                            <td></td>
                            <td>Subtotal</td>
                            <td id="subTotStr">{{ $subTotal  }} PKR</td>
                            <td></td>
                          </tr>
                        </tbody>
                    </table>
                </div>
                <div style="display:none;" id="subTot">{{ $subTotal  }}</div>
                <div class="ps-section__cart-actions">
                  <a class="ps-btn" href="{{url('/')}}"><i class="icon-arrow-left"></i> Back to Shop</a>
                  <a class="ps-btn" href="{{route('checkout')}}">Proceed to Checkout<i class="icon-arrow-right"></i></a>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection

@push('jss')
<script type="text/javascript">
    function updateQ(id){
        var quantity = $('#'+id).val();
        if(quantity >= 1){
          var itemPrice=$('#'+id+'item').text();
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
          var NewPrice=itemPrice*quantity;

          $('#'+id+'newSub').html(NewPrice + 'PKR');
          var itemQuant=$('#'+id+'Previousquant').text();
          var oldPrice=itemQuant*itemPrice;
          $('#'+id+'prevOrignal').val(quantity);
          getPreviousFromDiv=$('#subTot').text();
          var newprice=getPreviousFromDiv-oldPrice+NewPrice;
           $('#'+id+'netNewPrice').val(newprice);
        }else{
          window.location.href = '{{route("myCart")}}';
        }

        // if(quantity < 1){
        //     $('#'+id).val('');
        // }

    }
    function setTotal(id){

       // alert('i ss');
        var netFromField= $('#'+id+'netNewPrice').val();
        $('#subTot').html(netFromField);
        $('#subTotStr').html(netFromField+' PKR');

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
@endpush
