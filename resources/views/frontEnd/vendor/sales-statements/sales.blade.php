@extends('frontEnd.vendor.layout')
@section('dashboard')
<style type="text/css">
  .purchase-item-date p {
    font-size: 1.75em;
    line-height: 120px;
    text-align: center;
  }
  .purchases-list-header .text-header{
    text-align: center;
  }
  .purchases-list-header-date, .purchase-item-date{
    width: 15%;
  }
</style>
<!-- DASHBOARD CONTENT -->
<div class="dashboard-content">
   <!-- HEADLINE -->
   <div class="headline buttons primary">
      <h4>Sales Statements</h4>
   </div>
   <!-- /HEADLINE -->

   <!-- PURCHASES LIST -->
    <div class="purchases-list">
        <!-- PURCHASES LIST HEADER -->
        <div class="purchases-list-header">
            <div class="purchases-list-header-date">
                <p class="text-header small">Total Orders</p>
            </div>
            <div class="purchases-list-header-date">
                <p class="text-header small">Total Income</p>
            </div>
            <div class="purchases-list-header-date">
                <p class="text-header small">Average Order Price</p>
            </div>
        </div>
        <!-- /PURCHASES LIST HEADER -->

        <!-- PURCHASE ITEM -->
          <div class="purchase-item">
            <div class="purchase-item-date">
                <p>{{$order['total-orders']}}</p>
            </div>
            <div class="purchase-item-date">
                <p>${{$order['total-price']}}</p>
            </div>
            <div class="purchase-item-date">
                <p>${{$order['ave-price']}}</p>
            </div>
        </div>
        <!--- Review Form --->


    <!-- /PURCHASES LIST -->
    </div>
<!-- DASHBOARD CONTENT -->

</div>

@endsection