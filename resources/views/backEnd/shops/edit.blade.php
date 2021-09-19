@extends('backEnd.layout')

@section('content')
<div class="padding">
   <div class="box">
      <div class="box-header dker">
         <h3><i class="material-icons"></i> Edit Shop</h3>
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
         <form method="POST" action="{{route('updateShopAdmin')}}" accept-charset="UTF-8" enctype="multipart/form-data">
            {{ csrf_field() }}
            <input type="hidden" name="id" value="{{$shop->id}}">
            <div class="form-group row">
               <label for="title_ar" class="col-sm-2 form-control-label">Shop Name</label>
               <div class="col-sm-10">
                  <input placeholder="" class="form-control has-value" value="{{$shop->title}}" id="name" required=""name="name" type="text">
               </div>
            </div>
            <div class="form-group row">
               <label for="title_ar" class="col-sm-2 form-control-label">Description</label>
               <div class="col-sm-10">
                  <textarea name="description" required="" class="form-control has-value">{{$shop->description}}</textarea>
               </div>
            </div>
            <div class="form-group row">
               <label for="title_ar" class="col-sm-2 form-control-label">Shop Address</label>
               <div class="col-sm-10">
                  <input placeholder="" class="form-control has-value" value="{{$shop->address}}" id="address" required=""name="address" type="text">
               </div>
            </div>

            <div class="form-group row">
               <label for="title_ar" class="col-sm-2 form-control-label">Shop Owner Phone</label>
               <div class="col-sm-10">
                  <input placeholder="" class="form-control has-value" value="{{$shop->users->phone}}" id="phone" required=""name="phone" type="text">
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