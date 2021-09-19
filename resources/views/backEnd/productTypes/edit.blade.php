@extends('backEnd.layout')

@section('content')
<div class="padding">
   <div class="box">
      <div class="box-header dker">
         <h3><i class="material-icons"></i> Edit Product Type</h3>
         <small>
         <a href="{{url('/admin')}}">Home</a> /
         <a href="">Product Type Edit</a>
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
         <form method="POST" action="{{route('productTypeUpdate')}}" accept-charset="UTF-8" enctype="multipart/form-data">
            {{ csrf_field() }}
            <input type="hidden" name="id" value="{{$ProductType->id}}">
            <div class="form-group row">
               <label for="title_ar" class="col-sm-2 form-control-label">Name</label>
               <div class="col-sm-10">
                  <input placeholder="Enter Product Type Name" value="{{$ProductType->name}}" class="form-control has-value" id="name" required=""name="name" type="text">
               </div>
            </div>
            <div class="form-group row">
               <label for="title_ar" class="col-sm-2 form-control-label">Slug</label>
               <div class="col-sm-10">
                  <input placeholder="" value="{{$ProductType->slug}}" class="form-control has-value" id="slug" required=""name="slug" type="text" step="text-transform: lowercase;">
                  <small>Use Only Alphabets and dash (-).</small>
               </div>
            </div>
            <div class="form-group row m-t-md">
               <div class="col-sm-offset-2 col-sm-10">
                  <button type="submit" class="btn btn-primary m-t"><i class="material-icons">
                  </i> Update</button>
                  <a href="{{url('/admin')}}" class="btn btn-default m-t"><i class="material-icons">
                  </i> Cancel</a>
               </div>
            </div>
         </form>
      </div>
   </div>
</div>
@endsection