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
  .purchase-item {
    height: auto;
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
            <a href="{{route('clientOrdersRefunded')}}" class="button primary <?php if(Route::currentRouteName() == 'clientOrdersRefunded'){echo "dark-light";} ?>">Refund<small> ({{$count['refund']}})</small></a>
      </div>
   </div>
   <!-- /HEADLINE -->

   @if(count($orders)>0)
   <!-- PURCHASES LIST -->
    <div class="purchases-list">
        <!-- PURCHASES LIST HEADER -->
        <div style="width:1024px">
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

              <div class="purchases-list-header-price">
                  <p class="text-header small">Action</p>
              </div>


          </div>
          <!-- /PURCHASES LIST HEADER -->

          <!-- PURCHASE ITEM -->

          @php
            $counter=0;
            $fiber_counter=0;
          @endphp

          @foreach($orders as $key=>$order)
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
                  $diff=$now->diffInMinutes($order->created_at);

                  $diff_days=$now->diffInDays($order->created_at);
              @endphp

              @if(Route::currentRouteName()=='clientOrdersActive')

                @if($diff < 60)
                  @php
                    $time=Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$order->created_at)->addHours(6)->toDateTimeString();

                    $counter++;
                  @endphp

                <div class="purchase-item-price" >
                    <a href="{{route('clientOrderView',$order->id)}}" style="margin-top:-20px" class="button primary">View</a>
                    <a href="{{route('cancelOrder',$order->order_number)}}" onclick="return confirm('Do you wish to cancel this order?')" style="margin-top:8px;color:white;background-color:red" class="button danger">Cancel</a>
                    <a style="margin-top:8px;margin-bottom:10px;color:red;cursor:pointer" id="timer{{$counter}}"  class="button danger">{{$time}}</a>
                </div>

                @else
                <div class="purchase-item-price">
                    <a href="{{route('clientOrderView',$order->id)}}" class="button primary">View</a>
                    @if($diff_days < 7)
                      @php
                        $days=Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$order->created_at)->addDays(6)->addHours(6)->toDateTimeString();
                        $fiber_counter++;
                      @endphp
                      <a href="{{route('refundOrder',$order->order_number)}}" onclick="return confirm('Do you wish to request refund for your order ?')" style="margin-top:8px;color:white;background-color:blue" class="button danger">Request Refund</a>
                      <a style="margin-top:8px;margin-bottom:10px;color:blue;cursor:pointer" id="fiber{{$fiber_counter}}"  class="button danger">{{$days}}</a>
                    @endif
                </div>
                @endif

              @else
              <div class="purchase-item-price">
                <p>hello</p>
                  <!-- <a href="{{route('clientOrderView',$order->id)}}" class="button primary">View</a> -->
              </div>
              @endif

          </div>
          @endforeach
          <!-- /PURCHASE ITEM -->
      <!-- /PURCHASES LIST -->

     <!-- PAGER -->

     <!-- /PAGER -->
        </div>

    </div>
@else
 <div style="text-align: center;color: lightgray;">
   <h4>No Order Found</h4>
 </div>
@endif
<!-- DASHBOARD CONTENT -->



<script type="text/javascript">

  function timer2(count,cdd){
    let counter=setInterval(()=>{
      //count=count-1;
      // Get today's date and time
      var now = new Date().getTime();

      // Find the distance between now and the count down date
      var distance = cdd - now;

      // Time calculations for days, hours, minutes and seconds
      var days = Math.floor(distance / (1000 * 60 * 60 * 24));
      var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
      var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
      var seconds = Math.floor((distance % (1000 * 60)) / 1000);

      // Display the result in the element with id="demo"

      document.getElementById('fiber'+count.toString()).innerHTML =days + "d " + hours + "h " + minutes + "m " + seconds + "s ";

      // If the count down is finished, write some text
      // if (distance < 0) {
      //   clearInterval(x);
      //   document.getElementById(id).innerHTML = "EXPIRED";
      // }
    });
  }

  function timer(count,cdd){

    let counter=setInterval(()=>{
      //count=count-1;
      // Get today's date and time
      var now = new Date().getTime();

      // Find the distance between now and the count down date
      var distance = cdd - now;

      // Time calculations for days, hours, minutes and seconds
      var days = Math.floor(distance / (1000 * 60 * 60 * 24));
      var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
      var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
      var seconds = Math.floor((distance % (1000 * 60)) / 1000);

      // Display the result in the element with id="demo"

      document.getElementById('timer'+count.toString()).innerHTML = hours + "h " + minutes + "m " + seconds + "s ";

      // If the count down is finished, write some text
      // if (distance < 0) {
      //   clearInterval(x);
      //   document.getElementById(id).innerHTML = "EXPIRED";
      // }
    });
  }

var fiber_count=1;
var fiber_total={!! $fiber_counter !!};

var count=1;
var total={!! $counter !!};
for(count;count<=total;count++){

  console.log('From Main: Counter:'+count);
  var countDownDate = new Date(document.getElementById('timer'+count.toString()).innerHTML).getTime();
  timer(count,countDownDate);


}

for(fiber_count;fiber_count<=fiber_total;fiber_count++){

  console.log('From Main fiber: Counter:'+fiber_count);
  var countDownDate2 = new Date(document.getElementById('fiber'+fiber_count.toString()).innerHTML).getTime();
  timer2(fiber_count,countDownDate2);


}

</script>

@endsection
