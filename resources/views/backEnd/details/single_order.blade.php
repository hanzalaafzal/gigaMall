@extends('backEnd.layout')

@section('content')
<div class="padding">
   <div class="box">
      <div class="box-header dker">
         <h3><i class="material-icons"></i>Address Details</h3>
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
         <form accept-charset="UTF-8" enctype="multipart/form-data">
            {{ csrf_field() }}
            @foreach($order_address as $address)
            <div class="form-group row">
               <label for="title_ar" class="col-sm-2 form-control-label">Address Type:</label>
               <div class="col-sm-10">
                  <h5>{{$address->type}}</h5>
               </div>
            </div>
            <div class="form-group row">
               <label for="title_ar" class="col-sm-2 form-control-label">Name / Contact / Country:</label>
               <div class="col-sm-10">
                  <input placeholder="" class="form-control has-value" value="{{$address->full_name}} / {{$address->phone}} / {{$address->country}}" id="name" type="text" disabled>
               </div>
            </div>
            <div class="form-group row">
               <label for="title_ar" class="col-sm-2 form-control-label">State / City / Zip:</label>
               <div class="col-sm-10">
                  <input placeholder="" class="form-control has-value" value="{{$address->city}} / {{$address->state}} / {{$address->zip_code}}" id="name" type="text" disabled>
               </div>
            </div>
            <div class="form-group row">
               <label for="title_ar" class="col-sm-2 form-control-label">Address</label>
               <div class="col-sm-10">
                  <textarea name="description"disabled class="form-control has-value">{{$address->address}}</textarea>
               </div>
            </div>

            @endforeach
         </form>
      </div>
   </div>
   <div class="box">
      <div class="box-header dker">
         <h3><i class="material-icons"></i>Product Details</h3>
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
         <form accept-charset="UTF-8" enctype="multipart/form-data">
            {{ csrf_field() }}
            @foreach($order_products as $product)
            <div class="form-group row">
               <label for="title_ar" class="col-sm-2 form-control-label">Product:</label>
               <div class="col-sm-10">
                  <p>{{$product->title}}</p>
               </div>
            </div>
            <div class="form-group row">
               <label for="title_ar" class="col-sm-2 form-control-label">Quantity:</label>
               <div class="col-sm-10">
                  <p>{{$product->qty}}</p>
               </div>
            </div>
            <div class="form-group row">
               <label for="title_ar" class="col-sm-2 form-control-label">Product Price:</label>
               <div class="col-sm-10">
                  <p>{{$product->product_price}} PKR</p>
               </div>
            </div>
            <div class="form-group row">
               <label for="title_ar" class="col-sm-2 form-control-label">Vendor/Shop Name:</label>
               <div class="col-sm-10">
                  <p>{{$product->first_name}} {{$product->last_name}} / {{$product->title}}</p>
               </div>
            </div>

            @endforeach
         </form>
      </div>
   </div>
   <div class="box">
      <div class="box-header dker">
         <h3><i class="material-icons"></i>Order Details</h3>
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
         <form accept-charset="UTF-8" enctype="multipart/form-data">
            {{ csrf_field() }}

            <div class="form-group row">
               <label for="title_ar" class="col-sm-2 form-control-label">Order Number:</label>
               <div class="col-sm-10">
                  <p>{{$order[0]->order_number}}</p>
               </div>
            </div>
            <div class="form-group row">
               <label for="title_ar" class="col-sm-2 form-control-label">Product Total Price:</label>
               <div class="col-sm-10">
                  <p>{{$order[0]->products_price}} PKR</p>
               </div>
            </div>
            <div class="form-group row">
               <label for="title_ar" class="col-sm-2 form-control-label">Shipping:</label>
               <div class="col-sm-10">
                  <p>{{$order[0]->shipping_price}} PKR</p>
               </div>
            </div>
            <div class="form-group row">
               <label for="title_ar" class="col-sm-2 form-control-label">Discount:</label>
               <div class="col-sm-10">
                  <p>{{$order[0]->discount}}</p>
               </div>
            </div>
            <div class="form-group row">
               <label for="title_ar" class="col-sm-2 form-control-label">Grand Total:</label>
               <div class="col-sm-10">
                  <p><b> {{$order[0]->grand_price - $order[0]->discount}} PKR </b></p>
               </div>
            </div>
            <div class="form-group row">
               <label for="title_ar" class="col-sm-2 form-control-label">Payment Method:</label>
               <div class="col-sm-10">
                  <p><b> {{$order[0]->payment_method}}</b></p>
               </div>
            </div>

         </form>
      </div>
   </div>
</div>
@endsection
