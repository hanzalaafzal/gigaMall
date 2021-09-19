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
  <div class="headline statement primary">
      <h4>Order Detail Page</h4>
    @if($order->status == 'Pending')
      <a href="{{route('vendorOrderReject',$order->id)}}" class="button tertiary" onclick="return confirm('Are you sure? You want to reject this order?')">Reject Order</a>
      <button form="statement_filter_form" class="button primary">Accept</button>
      <form id="statement_filter_form" name="statement_filter_form" class="statement-form" style="margin-top: 12px;" method="post" action="{{route('vendorOrderAccept')}}">
        {{csrf_field()}}
        <input type="hidden" name="id" value="{{$order->id}}">
        <!-- DATEPICKER -->

          <label for="days">Enter number of days to deliver this product</label>
        <div class="datepicker-wrap" style="margin-right: 15px;">
          <input type="number" id="days" name="days" class="days" required="" placeholder="Enter number of days...">
        </div>
        <!-- /DATEPICKER -->
      </form>
    @else
      <div class="headline-status">
        <h6>{{$order->status}}</h6>
      </div>
    @endif
  </div>

  @if($order->status == 'Pending')
    <div class="alert alert-danger m-b-0">
        <p><b>Order is Pending! </b> Please accept this order to start.</p>
    </div>
  @endif

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
      <div class="purchase-item">
        <div class="purchase-item-date">
            <p>{{$order->created_at->format('d-m-Y')}}</p>
        </div>
        <div class="purchase-item-details" style="width: 28.6%">
            <!-- ITEM PREVIEW -->
            <a href="{{route('productView',$order->products->slug)}}">
              <div class="item-preview">
                <figure class="product-preview-image small liquid">
                    <img src="{{url('frontEnd/images/products/'.$order->products->photo)}}" alt="product-image">
                </figure>
                <p class="text-header">{{substr($order->products->title,0,25).'...'}}</p>
                <p class="description">{{substr($order->products->description,0,50).'...'}}</p>
              </div>
            </a>
            <!-- /ITEM PREVIEW -->
        </div>
        <div class="purchase-item-price">
          <p class="price">{{$order->quantity}}</p>
        </div>
        <div class="purchase-item-price">
          <p class="price">{{$order->product_price * $order->quantity}} <span>PKR</span></p>
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
          @if($order->status == 'Active')
            {{--  <a href="{{route('vendorOrderDeliver',$order->id)}}" onclick="return confirm('Are you sure that the shipment has been initiated.')" class="button primary">Shipment Initiated</a>  --}}
            <a href="{{route('vendorOrderShipped',$order->id)}}" onclick="return confirm('Are you sure that the shipment has been initiated.')" class="button primary">Mark Shipment Initiated</a>  
          @else
            <p class="price">
              <span>NA</span>
            </p>
          @endif
        </div>
    </div>
    <!-- /PURCHASE ITEM -->
    <br><br>
    <!-- Delivery Details -->
    <div class="form-box-item full" style="border: unset;">
      <h4>Delivery Details</h4>
      <hr class="line-separator">
      <!-- PLAIN TEXT BOX -->
      <div class="plain-text-box" style=" width: 50%;float: left;">
        <!-- PLAIN TEXT BOX ITEM -->
        <div class="plain-text-box-item">
          <p class="text-header">Full Name:</p>
          <p>{{$order->orders->orderAddressesShipping->full_name}}</p>
        </div>
        <!-- /PLAIN TEXT BOX ITEM -->
        <!-- PLAIN TEXT BOX ITEM -->
        <div class="plain-text-box-item">
          <p class="text-header">Phone:</p>
          <p>{{$order->orders->orderAddressesShipping->phone}}</p>
        </div>
        <!-- /PLAIN TEXT BOX ITEM -->
        <!-- PLAIN TEXT BOX ITEM -->
        <div class="plain-text-box-item">
          <p class="text-header">Country:</p>
          <p>{{$order->orders->orderAddressesShipping->country}}</p>
        </div>
        <!-- /PLAIN TEXT BOX ITEM -->
      </div>
      <!-- /PLAIN TEXT BOX -->


      <!-- PLAIN TEXT BOX -->
      <div class="plain-text-box" style=" width: 50%;float: left;">
        <!-- PLAIN TEXT BOX ITEM -->
        <div class="plain-text-box-item">
          <p class="text-header">Zip Code:</p>
          <p>{{$order->orders->orderAddressesShipping->zip_code}}</p>
        </div>
        <!-- /PLAIN TEXT BOX ITEM -->
        <!-- PLAIN TEXT BOX ITEM -->
        <div class="plain-text-box-item">
          <p class="text-header">Address:</p>
          <p>{{$order->orders->orderAddressesShipping->address}}</p>
        </div>
        <!-- /PLAIN TEXT BOX ITEM -->
      </div>
      <!-- /PLAIN TEXT BOX -->
    </div>
    <!-- /Delivery Details -->
  </div>
  <!-- /PURCHASES LIST -->

</div>
<!-- DASHBOARD CONTENT -->


@endsection