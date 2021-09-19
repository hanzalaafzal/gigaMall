@extends('backEnd.layout')
@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<div class="padding">
   <div class="box">
      <div class="box-header dker">
         <h3><i class="material-icons"></i> Edit Deal</h3>
         <small>
         <a href="{{url('/admin')}}">Home</a> /
         <a href="">Deal Edit</a>
         </small>
      </div>
      <div class="box-tool">
         <ul class="nav">
            <li class="nav-item inline">
               <a class="nav-link" href="{{url('/admin')}}">
               <i class="material-icons md-18">×</i>
               </a>
            </li>
         </ul>
      </div>
      <div class="box-body">
         <form method="POST" action="{{route('dealsUpdate')}}" accept-charset="UTF-8" enctype="multipart/form-data">
            <input type="hidden" name="id" value="{{$deal->id}}">
            {{ csrf_field() }}
            <div class="form-group row">
               <label for="title_ar" class="col-sm-2 form-control-label">Deal Name</label>
               <div class="col-sm-10">
                  <input placeholder="" value="{{$deal->deal_name}}" class="form-control has-value" id="name" required=""name="deal_name" type="text">
               </div>
            </div>
            <div class="form-group row">
               <label for="title_ar" class="col-sm-2 form-control-label">Expiry Date</label>
               <div class="col-sm-10">
                  <input placeholder="" value="{{$deal->expiry_date}}" class="form-control has-value" id="name" required=""name="expiry_date" type="date">
               </div>
            </div>
            <div class="form-group row">
               <label for="title_ar" class="col-sm-2 form-control-label">Status</label>
               <div class="col-sm-10">
                  <select name="deal_status" required="" class="form-control has-value">
                     <option value="" selected="" disabled="" >Select Status</option>
                     
                       <option value="Active">Active</option>
                       <option value="Deactive">Deactive</option>
                     
                   </select>
               </div>
            </div>
            <div class="form-group row">
                  <label for="title_ar" class="col-sm-2 form-control-label">Select Coupon Type</label>
                  <div class="col-sm-10">
                     <select name="selectAmountPercent" required="" class="form-control has-value" id="couponselector">
                       <option value="" selected="" disabled="" >Amount or Percentage</option>
                       
                         <option value="Amount">Amount</option>
                         <option value="Percent">Percent</option>
                       
                     </select>
                  </div>
               </div>
            <div class="form-group row colors" id="Amount" style="display:none;">
               <label for="title_ar" class="col-sm-2 form-control-label">Discount Amount</label>
               <div class="col-sm-10">
                  <input id="Amount1" placeholder="Enter Price of Package" value="{{$deal->discount_amount}}" class="form-control has-value amor" id="price" required="" name="discount_amount" type="number">
               </div>
            </div>
            <div class="form-group row colors" id="Percent" style="display:none;">
               <label for="title_ar" class="col-sm-2 form-control-label">Discount percentage</label>
               <div class="col-sm-10">
                  <input id="Percent1" placeholder="Enter number of products allow in this package" value="{{$deal->discount_percentage}}" class="form-control has-value amor" id="products" required="" name="discount_percentage" type="number">
               </div>
            </div>
            <div class="form-group row m-t-md">
               <div class="col-sm-offset-2 col-sm-10">
                  <button type="submit" class="btn btn-primary m-t"><i class="material-icons">
                  </i> Update</button>
                  <a href="{{route('deals')}}" class="btn btn-default m-t"><i class="material-icons">
                  </i> Cancel</a>
               </div>
            </div>
         </form>
      </div>
   </div>
</div>
<script>
     
      $('#couponselector').change(function(){
          $('.colors').hide();
          $('.amor').val('');
          $('#Amount1').prop('required',false);
             $('#Percent1').prop('required',false);
          $('#' + $(this).val()).show();
          $('#' + $(this).val()+1).prop('required',true);
      });
  
</script>
@endsection