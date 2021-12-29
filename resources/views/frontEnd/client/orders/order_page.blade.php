@extends('frontEnd.client.layout')
@section('dashboard')
<style type="text/css">
  .profile-notifications {
      margin: 0 auto 15px;
  }
  #end_date{
        font-weight: 600;
    margin-right: 30px;
  }
  .purchase-item{
    height: 150px;
  }
  .client-order-review-1{
    width: 100%;
    padding: 0px 25px;
  }
  .client-order-review-1 i{
        font-size: 9px;
    position: relative;
    top: -7px;
    left: -2px;
    color: #ffc000;
  }
</style>
<!-- DASHBOARD CONTENT -->
<div class="dashboard-content">
   <!-- HEADLINE -->
   <div class="headline buttons primary">
      <h4>Orders <small style="color: gray">(#{{ $order->order_number }})</small></h4>
      <div class="headline-status">
        <h6>{{$order->status}}</h6>

      </div>
   </div>
   <!-- /HEADLINE -->

   <!-- PURCHASES LIST -->
    <div class="purchases-list">
      <?php
          $total_product_price = 0;
          $total_shipping_price = 0;
          $total_quantity = 0;
          foreach($order->orderProducts as $order_product){
            $total_product_price = $total_product_price + $order_product->product_price*$order_product->quantity;
            $total_shipping_price = $total_shipping_price + $order_product->shipping_price;
            $total_quantity = $total_quantity + $order_product->quantity;
          }
          $grand_total = $total_product_price + $total_shipping_price;
        ?>

        <div style="width:1024px">
          <div class="purchases-list-header">
              <div class="purchases-list-header-price">
                  <p class="text-header small">Receipt</p>
              </div>
              <div class="purchases-list-header-price">
                  <p class="text-header small">Total Price</p>
              </div>
              <div class="purchases-list-header-price">
                  <p class="text-header small">Total Shipping</p>
              </div>
              <div class="purchases-list-header-price">
                  <p class="text-header small">Total Discount</p>
              </div>
              <div class="purchases-list-header-price">
                  <p class="text-header small">Total Quantity</p>
              </div>
              <div class="purchases-list-header-download">
                  <p class="text-header small">Grand Total</p>
              </div>
              <div class="purchases-list-header-download">
                  <p class="text-header small">Payment Method</p>
              </div>

          </div>
          <div class="purchase-item">
              <div class="purchase-item-price">
                <p class="price">#{{ $order->order_number }}</p>
              </div>
              <div class="purchase-item-price">
                <p class="price">{{$total_product_price}}<span> PKR</span></p>
              </div>
              <div class="purchase-item-price">
                <p class="price">{{$total_shipping_price}}<span> PKR</span></p>
              </div>
              <div class="purchase-item-price">
                  <p class="price">{{ $order->discount }}<span> PKR</span></p>
                </div>
              <div class="purchase-item-price">
                <p class="price">{{$total_quantity}}</p>
              </div>
              <div class="purchase-item-price">
                <p class="price">{{$grand_total}}<span> PKR</span></p>
              </div>
              <div class="purchase-item-price">
                <p class="price">{{$order->payment_method}}</p>
              </div>
              <div class="purchase-item-price">
                <a href="{{'/downloadInvoice/'.$order->id}}"><button class="btn " style="background-color: #00d7b3; color: white">Download Invoice</button></a>
              </div>
          </div>
        </div>
        <!-- PURCHASES LIST HEADER -->

        <!-- /PURCHASES LIST HEADER -->

        <!-- /PURCHASE ITEM -->
    </div>
   <!--/PURCHASES LIST -->

   <br><br>

   <!-- PURCHASES LIST -->
    <div class="purchases-list">
        <!-- PURCHASES LIST HEADER -->
        <div style="width:1024px;">
          <div class="purchases-list-header">
              <div class="purchases-list-header-date">
                  <p class="text-header small">Date</p>
              </div>
              <div class="purchases-list-header-details" style="width: 28.6%">
                  <p class="text-header small">Product Details</p>
              </div>
              <div class="purchases-list-header-price">
                  <p class="text-header small">Price</p>
              </div>
              <div class="purchases-list-header-price">
                  <p class="text-header small">Quantity</p>
              </div>
              <div class="purchases-list-header-price">
                  <p class="text-header small">Total Price</p>
              </div>
              <div class="purchases-list-header-date">
                  <p class="text-header small">Status</p>
              </div>
              <div class="purchases-list-header-download">
                  <p class="text-header small">Shipping Days</p>
              </div>
          </div>
          @foreach($order->orderProducts as $order_product)
            <div class="purchase-item">
              <div class="purchase-item-date">
                  <p>{{$order_product->created_at->format('d-m-Y')}}</p>
              </div>
              <div class="purchase-item-details" style="width: 28.6%">
                <!-- ITEM PREVIEW -->
                <div class="item-preview">
                    <figure class="product-preview-image small liquid">
                        <img src="{{url('/frontEnd/images/products/'.$order_product->products->photo)}}" alt="product-image">
                    </figure>
                    <p class="text-header">{{substr($order_product->products->title,0,20).'...'}}</p>
                    <p class="description">{{substr($order_product->products->description,0,50).'...'}}</p>
                </div>
                <!-- /ITEM PREVIEW -->
              </div>
              <div class="purchase-item-price">
                <p class="price">{{$order_product->product_price}}<span> PKR</span></p>
              </div>
              <div class="purchase-item-price">
                <p class="price">{{$order_product->quantity}}</p>
              </div>
              <div class="purchase-item-price">
                <p class="price">{{$order_product->product_price * $order_product->quantity}}<span> PKR</span></p>
              </div>
              <div class="purchase-item-date" style="padding-top:44px;">
                                {{$order_product->status}}
                    @if($order_product->status == 'Shipped')
                    {{--  <a href="{{route('vendorOrderDeliver',$order->id)}}" onclick="return confirm('Are you sure that the shipment has been initiated.')" class="button primary">Shipment Initiated</a>  --}}
                    <a href="{{route('clientMarkDelivered',$order_product->id)}}" onclick="return confirm('Are you sure you want to change status to Delivered.')" class="button primary">Mark Delivered</a>

                    </p>
                  @endif




              </div>
              <div class="purchase-item-price">
                <p class="price">
                  @if(!empty($order_product->shipping_days))
                    {{$order_product->shipping_days}}
                  @else
                    <span>NA</span>
                  @endif
                </p>
              </div>

            @if(count($order_product->reviews)>0)
              <div class="client-order-review-1">
                <p>
                  <span><b>Rating:</b> {{$order_product->reviews->rating}} <i class="fas fa-star"></i></span> -
                  <b>Review: </b> {{$order_product->reviews->review}}
                </p>
              </div>
            @endif
          </div>
          @endforeach
        </div>

        <!-- /PURCHASES LIST HEADER -->

        <!-- PURCHASE ITEM -->


    <!-- /PURCHASES LIST -->
    </div>
<!-- DASHBOARD CONTENT -->

</div>
@endsection
