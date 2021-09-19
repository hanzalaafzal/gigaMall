@extends('backEnd.layout')

@section('content')
<div class="padding">
   <div class="box">
      <div class="box-header dker">
         <h3><i class="material-icons"></i> Edit Product</h3>
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
         <form method="POST" action="{{route('editApprovedProductAdmin')}}" accept-charset="UTF-8" enctype="multipart/form-data">
            {{ csrf_field() }}
            <input type="hidden" name="id" value="{{$product->id}}">
            <div class="form-group row">
               <label for="title_ar" class="col-sm-2 form-control-label">Product Name</label>
               <div class="col-sm-10">
                  <input placeholder="" class="form-control has-value" value="{{$product->products->title}}" id="name" name="name" type="text" readonly>
               </div>
            </div>
            <div class="form-group row">
               <label for="title_ar" class="col-sm-2 form-control-label">Vendor Name</label>
               <div class="col-sm-10">
                  <input placeholder="" class="form-control has-value" value="{{$product->vendor->user_name}}" id="name" name="name" type="text" readonly>
               </div>
            </div>
            <div class="form-group row">
               <label for="title_ar" class="col-sm-2 form-control-label">Product Price</label>
               <div class="col-sm-10">
                  <input placeholder="" class="form-control has-value" value="{{$product->product_price}}" id="name" required name="product_price" type="text">
               </div>
            </div>
            <div class="form-group row">
               <label for="title_ar" class="col-sm-2 form-control-label">Shipping Price</label>
               <div class="col-sm-10">
                  <input placeholder="" class="form-control has-value" value="{{$product->shipping_price	}}" id="name" required name="shipping_price" type="text">
               </div>
            </div>
            <div class="form-group row">
               <label for="title_ar" class="col-sm-2 form-control-label">Quantity</label>
               <div class="col-sm-10">
                  <input placeholder="" class="form-control has-value" value="{{$product->quantity}}" id="name" required name="quantity" type="text">
               </div>
            </div>
            
            
            
            <div class="form-group row m-t-md">
               <div class="col-sm-offset-2 col-sm-10">
                  <button type="submit" class="btn btn-primary m-t"> <i class="material-icons">
                  </i> Update</button>
                  <a href="{{route('approveDeliveredProducts')}}" class="btn btn-default m-t"><i class="material-icons">
                     </i> Cancel</a>
               </div>
            </div>
         </form>
      </div>
   </div>
</div>
@endsection