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
         <form method="POST" action="{{route('updateProductAdmin')}}" accept-charset="UTF-8" enctype="multipart/form-data">
            {{ csrf_field() }}
            <input type="hidden" name="id" value="{{$product->id}}">
            <div class="form-group row">
               <label for="title_ar" class="col-sm-2 form-control-label">Product Name</label>
               <div class="col-sm-10">
                  <input placeholder="" class="form-control has-value" value="{{$product->title}}" id="name" required=""name="name" type="text">
               </div>
            </div>
            <div class="form-group row">
               <label for="title_ar" class="col-sm-2 form-control-label">Description</label>
               <div class="col-sm-10">
                  <textarea name="description" required="" class="form-control has-value">{{$product->description}}</textarea>
               </div>
            </div>
            <div class="form-group row">
               <label class="col-sm-2 form-control-label">Price:</label>
               <div class="col-sm-10">
                  <input placeholder="" class="form-control has-value" value="{{$product->price}}" id="price" required="" name="price" type="text">
               </div>
            </div>
            <div class="form-group row">
               <label class="col-sm-2 form-control-label">Original Price:</label>
               <div class="col-sm-10">
                  <input placeholder="" class="form-control has-value" value="{{$product->original_price}}" id="original_price" required="" name="original_price" type="text">
               </div>
            </div>

            <div class="form-group row">
               <label class="col-sm-2 form-control-label">Shipping Price:</label>
               <div class="col-sm-10">
                  <input placeholder="" class="form-control has-value" value="{{$product->shipping_price}}" id="shipping_price" required="" name="shipping_price" type="text">
               </div>
            </div>
            <div class="form-group row">
               <label class="col-sm-2 form-control-label">Quantity:</label>
               <div class="col-sm-10">
                  <input placeholder="" class="form-control has-value" value="{{$product->quantity}}" id="quantity" required="" name="quantity" type="text">
               </div>
            </div>
            <div class="form-group row">
               <label class="col-sm-2 form-control-label">Status:</label>
               <div class="col-sm-10">
                 <select class="form-control" name="status" required>
                   <option value="Pending" @if($product->status=='Pending') selected @endif>Pending</option>
                   <option value="Active"  @if($product->status=='Active') selected @endif>Active</option>
                   <option value="Disable" @if($product->status=='Disable') selected @endif>Disable</option>
                   <option value="Renewal" @if($product->status=='Renewal') selected @endif>Renewal</option>
                   <option value="Deleted" @if($product->status=='Deleted') selected @endif>Deleted</option>
                 </select>

               </div>
            </div>
            <div class="form-group row">
               <label class="col-sm-2 form-control-label">Show in Slider:</label>
               <div class="col-sm-2">
                  <input placeholder="" class="" id="is_slider" name="is_slider" type="checkbox" @if($product->is_slider=="1") checked @endif >
               </div>
            </div>
            <div class="form-group row m-t-md">
               <div class="col-sm-offset-2 col-sm-10">
                  <button type="submit" class="btn btn-primary m-t"><i class="material-icons">
                  </i> Update</button>
               </div>
            </div>

         </form>
      </div>
   </div>
</div>
@endsection
