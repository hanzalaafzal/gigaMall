@extends('backEnd.layout')

@section('content')
<div class="padding">
   <div class="box">
      <div class="box-header dker">
         <h3><i class="material-icons"></i> Edit Package</h3>
         <small>
         <a href="{{url('/admin')}}">Home</a> /
         <a href="">Package Edit</a>
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
         <form method="POST" action="{{route('shopPackagesUpdate')}}" accept-charset="UTF-8" enctype="multipart/form-data">
            <input type="hidden" name="id" value="{{$package->id}}">
            {{ csrf_field() }}
            <div class="form-group row">
               <label for="title_ar" class="col-sm-2 form-control-label">Package Name</label>
               <div class="col-sm-10">
                  <input placeholder="" value="{{$package->name}}" class="form-control has-value" id="name" required=""name="name" type="text">
               </div>
            </div>
            <div class="form-group row">
               <label for="title_ar" class="col-sm-2 form-control-label">Price</label>
               <div class="col-sm-10">
                  <input placeholder="Enter Price of Package" value="{{$package->price}}" class="form-control has-value" id="price" required="" name="price" type="number">
               </div>
            </div>
            <div class="form-group row">
               <label for="title_ar" class="col-sm-2 form-control-label">Number of Products</label>
               <div class="col-sm-10">
                  <input placeholder="Enter number of products allow in this package" value="{{$package->products}}" class="form-control has-value" id="products" required="" name="products" type="number">
               </div>
            </div>
            <div class="form-group row m-t-md">
               <div class="col-sm-offset-2 col-sm-10">
                  <button type="submit" class="btn btn-primary m-t"><i class="material-icons">
                  </i> Update</button>
                  <a href="{{route('shopPackages')}}" class="btn btn-default m-t"><i class="material-icons">
                  </i> Cancel</a>
               </div>
            </div>
         </form>
      </div>
   </div>
</div>
@endsection