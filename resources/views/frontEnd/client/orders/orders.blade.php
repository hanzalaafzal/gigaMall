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
</style>
<!-- DASHBOARD CONTENT -->
<div class="dashboard-content">
   <!-- HEADLINE -->
   <div class="headline buttons primary">
      <h4>Orders <small style="color: gray">({{ Request::segment(3) }})</small></h4>
      <div class="shops-buttons">
        <a href="{{route('clientOrdersCompleted')}}" class="button primary <?php if(Route::currentRouteName() == 'clientOrdersCompleted'){echo "dark-light";} ?>">Completed<small> ({{$count['completed']}})</small></a>
        <a href="{{route('clientOrdersAll')}}" class="button primary <?php if(Route::currentRouteName() == 'clientOrdersAll'){echo "dark-light";} ?>">All<small> ({{$count['all']}})</small></a>
        <a href="{{route('clientOrdersActive')}}" class="button primary <?php if(Route::currentRouteName() == 'clientOrdersActive'){echo "dark-light";} ?>">Active<small> ({{$count['active']}})</small></a>
          <a href="{{route('clientOrdersCanceled')}}" class="button primary <?php if(Route::currentRouteName() == 'clientOrdersCanceled'){echo "dark-light";} ?>">Canceled<small> ({{$count['canceled']}})</small></a>
      </div>
   </div>
   <!-- /HEADLINE -->

   @if(count($orders)>0)
   <!-- PURCHASES LIST -->
    <div class="purchases-list">
        <!-- PURCHASES LIST HEADER -->
        <div class="purchases-list-header">
            <div class="purchases-list-header-date">
                <p class="text-header small">Date</p>
            </div>
            <div class="purchases-list-header-price">
                <p class="text-header small">Products</p>
            </div>
            <div class="purchases-list-header-price">
                <p class="text-header small">Products Price</p>
            </div>
            <div class="purchases-list-header-price">
                <p class="text-header small">Shipping Price</p>
            </div>
            <div class="purchases-list-header-price">
                <p class="text-header small">Discount</p>
            </div>
            <div class="purchases-list-header-price">
                <p class="text-header small">Grand Total</p>
            </div>
            <div class="purchases-list-header-date">
                <p class="text-header small">Status</p>
            </div>

            <div class="purchases-list-header-download">
                <p class="text-header small">Action</p>
            </div>


        </div>
        <!-- /PURCHASES LIST HEADER -->

        <!-- PURCHASE ITEM -->
        @foreach($orders as $order)
          <?php
            $product_price = 0;
            $shipping_price = 0;
            foreach($order->orderProducts as $order_product){
              $product_price = $product_price + $order_product->product_price*$order_product->quantity;
              $shipping_price = $shipping_price + $order_product->shipping_price;
            }
              $grand_total = $product_price + $shipping_price - $order->discount;
          ?>
          <div class="purchase-item">
            <div class="purchase-item-date">
                <p>{{$order->created_at->format('d-m-Y')}}</p>
            </div>
            <div class="purchase-item-price">
              <p class="price">{{count($order->orderProducts)}}</p>
            </div>
            <div class="purchase-item-price">
              <p class="price">{{$product_price}}<span> PKR</span></p>
            </div>
            <div class="purchase-item-price">
              <p class="price">{{$shipping_price}}<span> PKR</span></p>
            </div>
            <div class="purchase-item-price">
                <p class="price">{{ $order->discount }}<span> PKR</span></p>
              </div>
             <div class="purchase-item-price">
              <p class="price">{{$grand_total - $discount}}<span> PKR</span></p>
            </div>
            <div class="purchase-item-date">
                <p>{{$order->status}}</p>
            </div>

            @php
                $now=Carbon\Carbon::now();
                $diff=$now->diffInSeconds($order->created_at);
            @endphp

            @if(Route::currentRouteName()=='clientOrdersActive')

              @if($diff < 30)
              <div class="purchase-item-download">
                  <a href="{{route('clientOrderView',$order->id)}}" style="margin-top:-10px" class="button primary">View</a>
                  <a href="{{route('cancelOrder',$order->order_number)}}" onclick="return confirm('Do you wish to cancel this order?')" style="margin-top:8px;color:white;background-color:red" class="button danger">Cancel</a>
              </div>

              @else
              <div class="purchase-item-download">
                  <a href="{{route('clientOrderView',$order->id)}}" class="button primary">View</a>
              </div>
              @endif

            @else
            <div class="purchase-item-download">
                <a href="{{route('clientOrderView',$order->id)}}" class="button primary">View</a>
            </div>
            @endif



        </div>
        @endforeach
        <!-- /PURCHASE ITEM -->
    <!-- /PURCHASES LIST -->

   <!-- PAGER -->

   <!-- /PAGER -->
   @else
    <div style="text-align: center;color: lightgray;">
      <h4>No Order Found</h4>
    </div>
   @endif
</div>
<!-- DASHBOARD CONTENT -->


@endsection
