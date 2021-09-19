@extends('frontEnd.vendor.layout')
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
        <a href="{{route('vendorOrdersRejected')}}" class="button primary <?php if(Route::currentRouteName() == 'vendorOrdersRejected'){echo "dark-light";} ?>">Rejected<small> ({{$count['rejected']}})</small></a>
        <a href="{{route('vendorOrdersCompleted')}}" class="button primary <?php if(Route::currentRouteName() == 'vendorOrdersCompleted'){echo "dark-light";} ?>">Completed<small> ({{$count['completed']}})</small></a>
        <a href="{{route('vendorOrdersDelivered')}}" class="button primary <?php if(Route::currentRouteName() == 'vendorOrdersDelivered'){echo "dark-light";} ?>">Delivered<small> ({{$count['delivered']}})</small></a>
        <a href="{{route('vendorOrdersPending')}}" class="button primary <?php if(Route::currentRouteName() == 'vendorOrdersPending'){echo "dark-light";} ?>">Pending<small> ({{$count['pending']}})</small></a>
        <a href="{{route('vendorOrdersAll')}}" class="button primary <?php if(Route::currentRouteName() == 'vendorOrdersAll'){echo "dark-light";} ?>" >All <small></small></a>
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
            <div class="purchases-list-header-details" style="width: 28.6%">
                <p class="text-header small">Product Details</p>
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
            <div class="purchases-list-header-price">
                <p class="text-header small">Shipping Days</p>
            </div>
            <div class="purchases-list-header-price">
                <p class="text-header small">Action</p>
            </div>
        </div>
        <!-- /PURCHASES LIST HEADER -->

        <!-- PURCHASE ITEM -->
        @foreach($orders as $order)
          <div class="purchase-item">
            <div class="purchase-item-date">
                <p>{{$order->created_at->format('d-m-Y')}}</p>
            </div>
            <div class="purchase-item-details" style="width: 28.6%">
                <!-- ITEM PREVIEW -->
                <div class="item-preview">
                    <figure class="product-preview-image small liquid">
                        <img src="{{url('frontEnd/images/products/'.$order->products->photo)}}" alt="product-image">
                    </figure>
                    <p class="text-header">{{substr($order->products->title,0,25).'...'}}</p>
                    <p class="description">{{substr($order->products->description,0,50).'...'}}</p>
                </div>
                <!-- /ITEM PREVIEW -->
            </div>
            <div class="purchase-item-price">
              <p class="price">{{$order->quantity}}</p>
            </div>
            <div class="purchase-item-price">
              <p class="price">{{$order->product_price * $order->quantity}}<span> PKR</span></p>
            </div>
            <div class="purchase-item-date">
                <p>{{$order->status}}</p>
            </div>
            <div class="purchase-item-price">
              <p class="price">
                @if(!empty($order->shipping_days))
                  {{$order->shipping_days}}
                @else
                  <span>NA</span>
                @endif
              </p>
            </div>
            <div class="purchase-item-price">
              <a href="{{route('vendorOrderView',$order->id)}}" class="button primary">View</a>
            </div>
        </div>
        @endforeach
        <!-- /PURCHASE ITEM -->

        <!-- PAGER -->
<div class="pager-wrap">
  <div class="pager-lara">
    {{$orders->links()}}
   </div></div>
<!-- /PAGER -->
    </div>
    <!-- /PURCHASES LIST -->

   <!-- PAGER -->
   
   <!-- /PAGER -->
   @else
    <div style="text-align: center;color: lightgray;">
      <h4>No Order Found.</h4>
    </div>
   @endif
</div>
<!-- DASHBOARD CONTENT -->


@endsection