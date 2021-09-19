@extends('backEnd.layout')
@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<div class="padding">
   <div class="box">
      <div class="box-header dker">
         <h3><i class="material-icons"></i> Deduct from Wallet</h3>
         <small>
         <a href="{{url('/admin')}}">Home</a> /
         <a href="">wallet Edit</a>
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
         <form method="POST" action="{{route('deductFromWallet')}}" accept-charset="UTF-8" enctype="multipart/form-data">
            <input type="hidden" name="id" value="{{$wallet->id}}">
            {{ csrf_field() }}
            <div class="form-group row">
               <label for="title_ar" class="col-sm-2 form-control-label">User Name</label>
               <div class="col-sm-10">
                  <input placeholder="" value="{{ $wallet['users']['user_name'] }}" class="form-control has-value" id="name" required=""name="promo_name" type="text" disabled>
               </div>
            </div>
            <div class="form-group row">
               <label for="title_ar" class="col-sm-2 form-control-label">Current Wallet Amount</label>
               <div class="col-sm-10">
                  <input placeholder="" value="{{$wallet->amount}}" class="form-control has-value" id="price" required="" name="coupon_code" type="text" disabled>
               </div>
            </div>
            <div class="form-group row">
               <label for="title_ar" class="col-sm-2 form-control-label">Deduction Head</label>
               <div class="col-sm-10">
                  <input placeholder=""  class="form-control has-value" id="price" required="" name="deductionHead" type="text" >
               </div>
            </div>
            <div class="form-group row">
               <label for="title_ar" class="col-sm-2 form-control-label">Deduct From Wallet Amount</label>
               <div class="col-sm-10">
                  <input placeholder=""  class="form-control has-value" id="price" required="" name="deductionAmount" type="number" >
                  <input type="hidden" id="walletId" name="walletId" value="{{ $wallet->id}}">
                  <input type="hidden" id="walletId" name="user_id" value="{{ $wallet['users']['id']}}">

               </div>
            </div>
            

            
            <div class="form-group row m-t-md">
               <div class="col-sm-offset-2 col-sm-10">
                  <button type="submit" class="btn btn-primary m-t"><i class="material-icons">
                  </i> Update</button>
                  <a href="{{route('wallets')}}" class="btn btn-default m-t"><i class="material-icons">
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