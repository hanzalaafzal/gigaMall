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
      <h4>Orders Reviews <small style="color: gray"> ({{ Request::segment(3) }})</small></h4>
   </div>
   <!-- /HEADLINE -->

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
                <p class="text-header small">Review</p>
            </div>
        </div>
        <!-- /PURCHASES LIST HEADER -->

        <!-- PURCHASE ITEM -->
        <?php $i= 1; ?>
        @foreach($orderProducts as $order_product)
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
              <p class="price">{{$order_product->product_price}} <span>PKR</span></p>
            </div>
            <div class="purchase-item-price">
              <p class="price">{{$order_product->quantity}}</p>
            </div>
            <div class="purchase-item-price">
              <p class="price">{{$order_product->product_price * $order_product->quantity}} <span>PKR</span></p>
            </div>
            <div class="purchase-item-date">
                <p>{{$order_product->status}}</p>
            </div>
            <div class="purchase-item-price">
              <button onclick="show('{{$i}}')" class="button dark-light">Review Now</button>
            </div>
        </div>
        <!--- Review Form --->

                  <br><br>
            <div class="center hideform" id="editForm{{$i}}">
                <button class="button dark-light rmv" onclick="hide('{{$i}}')" style="float: right;">X</button>
                <br>
                <div class="comment-list">
                  <!-- COMMENT REPLY -->
                  <div class="comment-wrap comment-reply">
                    <!-- COMMENT REPLY FORM -->
                    <form class="comment-reply-form" method="post" action="{{route('clientReviewsPost')}}">
                      {{csrf_field()}}
                      <div class='rating-stars text-center'>
                        <br>
                        <h4>Review You Experience!</h4>
                      <ul id='stars'>
                        <li class='star' title='Poor' data-value='1'>
                          <i class='fa fa-star fa-fw'></i>
                        </li>
                        <li class='star' title='Fair' data-value='2'>
                          <i class='fa fa-star fa-fw'></i>
                        </li>
                        <li class='star' title='Good' data-value='3'>
                          <i class='fa fa-star fa-fw'></i>
                        </li>
                        <li class='star' title='Excellent' data-value='4'>
                          <i class='fa fa-star fa-fw'></i>
                        </li>
                        <li class='star' title='WOW!!!' data-value='5'>
                          <i class='fa fa-star fa-fw'></i>
                        </li>
                      </ul>
                    </div>
                      <input type="hidden" id="rathidden" name="rating" required="">
                      <input type="hidden" id="id" name="id" value="{{$order_product->id}}">
                      <textarea name="review" required="" placeholder="Write your Review here..."></textarea>
                      <button class="button primary">Post Review</button>
                    </form>
                    <!-- /COMMENT REPLY FORM -->
                  </div>
                  <!-- /COMMENT REPLY -->
                </div>
              
            </div>
              <!--- /Review Form --->
        <?php $i++; ?>
        @endforeach

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