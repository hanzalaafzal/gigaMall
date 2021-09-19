@extends('backEnd.layout')
@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<div class="padding">
   <div class="box">
      <div class="box-header dker">
         <h3><i class="material-icons"></i> Create Coupons</h3>
         <small>
         <a href="{{url('/admin')}}">Home</a> /
         <a href="">Parent Coupons Create</a>
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
         <form method="POST" action="{{route('couponsStore')}}" accept-charset="UTF-8" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="form-group row">
               <label for="title_ar" class="col-sm-2 form-control-label">Promo Name</label>
               <div class="col-sm-10">
                  <input placeholder="" class="form-control has-value" id="name" required=""name="promo_name" type="text">
               </div>
            </div>
            <div class="form-group row">
               <label for="title_ar" class="col-sm-2 form-control-label">Coupon Code</label>
               <div class="col-sm-10">
                  <input placeholder="" class="form-control has-value" id="name" required=""name="coupon_code" type="text">
               </div>
            </div>
            <div class="form-group row">
               <label for="title_ar" class="col-sm-2 form-control-label">Expiry Date</label>
               <div class="col-sm-10">
                  <input placeholder="" class="form-control has-value" id="name" required=""name="expiry_date" type="date">

                  

               </div>
            </div>
            <div class="form-group row">
               <label for="title_ar" class="col-sm-2 form-control-label">Status</label>
               <div class="col-sm-10">
                  <select name="coupon_status" required="" class="form-control has-value">
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
            <div class="form-group row colors" id="Amount" style="display: none;">
               <label for="title_ar" class="col-sm-2 form-control-label">Discount Amount</label>
               <div class="col-sm-10">
                  <input placeholder="" class="form-control has-value amor" id="Amount1" name="discount_amount" type="text">
               </div>
            </div>
            <div class="form-group row colors" id="Percent" style="display: none;">
               <label for="title_ar" class="col-sm-2 form-control-label">Discount Percentage</label>
               <div class="col-sm-10">
                  <input placeholder="" class="form-control has-value amor" id="Percent1" name="discount_percentage" type="number" min="0" max="100">
                  
               </div>
            </div>
            {{--  <div class="form-group row">
               <label for="title_ar" class="col-sm-2 form-control-label">Slug</label>
               <div class="col-sm-10">
                  <input placeholder="" class="form-control has-value" id="slug" required=""name="slug" type="text" step="text-transform: lowercase;">
                  <small>Use Only Alphabets and dash (-).</small>
               </div>
            </div>  --}}
            {{--  <div class="form-group row">
               <label for="title_ar" class="col-sm-2 form-control-label">Choose Type</label>
               <div class="col-sm-10">
                  <select name="type_id" required="" class="form-control has-value">
                    <option value="" selected="" disabled="" >Select Type</option>
                    @foreach($types as $category)
                      <option value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                  </select>
               </div>
            </div>  --}}
            <div class="form-group row m-t-md">
               <div class="col-sm-offset-2 col-sm-10">
                  <button type="submit" class="btn btn-primary m-t"><i class="material-icons">
                  </i> Create</button>
                  <a href="{{url('/admin')}}" class="btn btn-default m-t"><i class="material-icons">
                  </i> Cancel</a>
               </div>
            </div>
         </form>
      </div>
   </div>
</div>
{{--  @if(count($categories) > 0)  --}}
  <div class="padding">
     <div class="box">
        <div class="box-header dker">
           <h3><i class="material-icons"></i>Coupons</h3>
           <small>
           <a href="{{url('/admin')}}">Home</a> /
           <a href="">Parent Category List</a>
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
           <div class="row">
             <div class="box m-b-0">
                <div class="table-responsive">
                   <table class="table table-striped">
                      <thead>
                         <tr>
                            <th>Name</th>
                            <th class="text-center">Coupon Code</th>
                            <th class="text-center">Creation date</th>
                            <th class="text-center">Expiry Date</th>
                            <th class="text-center">Options</th>
                         </tr>
                      </thead>
                      <tbody>
                         @foreach($coupons as $coupon)
                          <tr>
                                <td>{{ $coupon->promo_name}}</td> 
                              <td class="text-center">{{$coupon->coupon_code}}</td>
                              <td class="text-center">{{$coupon->creation_date}}</td>
                              <td class="text-center">{{$coupon->expiry_date}}</td>
                              <td class="text-center">
                                @if($coupon->coupon_status == 'Active')
                                  <a href="{{route('couponDisable',$coupon->id)}}" class="btn btn-danger btn-sm">Disable</a>
                                @else
                                  <a href="{{route('couponActive',$coupon->id)}}" class="btn btn-success btn-sm">Activate</a>
                                @endif
                                <a href="{{route('couponEdit',$coupon->id)}}" class="btn btn-primary btn-sm">Edit</a>
                                <a href="{{route('couponDelete',$coupon->id)}}" class="btn btn-danger btn-sm">Delete</a>
                              </td>

                          </tr>
                         @endforeach
                      </tbody>
                   </table>
                </div>
             </div>
          </div>
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
{{--  @endif  --}}
@endsection