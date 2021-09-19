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
  .center {
      margin: auto;
      width: 100%;
      padding: 20px;
      margin-bottom: 30px;
  }
  .hideform {
      display: none;
  }
  .rmv{
        width: 30px;
    height: 30px;
    margin: 0 auto;
    position: relative;
  }
</style>
<!-- DASHBOARD CONTENT -->
<div class="dashboard-content">
   <!-- HEADLINE -->
   <div class="headline buttons primary">
      <h4>Affiliate Data </h4>
      <small style="float: right; margin: 3%">Affiliate Profit will automatically be added in your wallet after 7 days</small>
   </div>
   <!-- /HEADLINE -->

   <!-- PURCHASES LIST -->
    <div class="purchases-list">
        <!-- PURCHASES LIST HEADER -->
        <div class="purchases-list-header">
            <div class="purchases-list-header-date">
                <p class="text-header small">Product</p>
            </div>
            <div class="purchases-list-header-details" style="width: 38.6%">
                <p class="text-header small">Link</p>
            </div>
            <div class="purchases-list-header-price">
                <p class="text-header small">Purchases</p>
            </div>
            <div class="purchases-list-header-price">
                <p class="text-header small">Profit</p>
            </div>
            <div class="purchases-list-header-price">
                <p class="text-header small">Visits</p>
            </div>
            <div class="purchases-list-header-price">
                <p class="text-header small">Created At</p>
            </div>
            
        </div>
        <!-- /PURCHASES LIST HEADER -->

        <!-- PURCHASE ITEM -->
        <?php $i= 1; ?>
        @if(isset($affiliates))
        @foreach($affiliates as $row)
          @php
            $product = DB::table('products')->where('id',$row->product_id)->first();
          @endphp
          <div class="purchase-item">
            <div class="purchase-item-date">
                <p>@if(isset($product)){{$product->title}}@endif</p>
            </div>
            
            <div class="purchase-item-price" style="width: 38.6%; font-size: 10px;">
              <p class="price">{{url('product/'.$product->slug.'?id='. auth()->user()->id)}}</p>
            </div>
            <div class="purchase-item-price">
              <p class="price">{{$row->purchases}}</p>
            </div>
            <div class="purchase-item-price">
              <p class="price">{{$row->profit}}</p>
            </div>
               <div class="purchase-item-price">
              <p class="price">{{$row->visits}}</p>
            </div>
               <div class="purchase-item-price" style="font-size: 10px">
              <p class="price">{{$row->created_at}}</p>
            </div>
          
        </div>
       
        <?php $i++; ?>
        @endforeach
        @endif

    <!-- /PURCHASES LIST -->
    </div>
<!-- DASHBOARD CONTENT -->

</div>


<script type="text/javascript">
    $(document).ready(function(){
  
  /* 1. Visualizing things on Hover - See next part for action on click */
  $('#stars li').on('mouseover', function(){
    var onStar = parseInt($(this).data('value'), 10); // The star currently mouse on
   
    // Now highlight all the stars that's not after the current hovered star
    $(this).parent().children('li.star').each(function(e){
      if (e < onStar) {
        $(this).addClass('hover');
      }
      else {
        $(this).removeClass('hover');
      }
    });
    
  }).on('mouseout', function(){
    $(this).parent().children('li.star').each(function(e){
      $(this).removeClass('hover');
    });
  });
  
  
  /* 2. Action to perform on click */
  $('#stars li').on('click', function(){
    var onStar = parseInt($(this).data('value'), 10); // The star currently selected
    var stars = $(this).parent().children('li.star');
    
    for (i = 0; i < stars.length; i++) {
      $(stars[i]).removeClass('selected');
    }
    
    for (i = 0; i < onStar; i++) {
      $(stars[i]).addClass('selected');
    }

    var value = $(this).data();
    $('input[name="rating"]').val(value['value']);
  });
  
  
});
</script>

<script type="text/javascript">
  function show(i){
    $('.hideform').hide();
    $('#editForm'+i).show();
  }
  function hide(i){
    $('#editForm'+i).hide();
  }
</script>
@endsection