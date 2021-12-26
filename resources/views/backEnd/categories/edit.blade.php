@extends('backEnd.layout')

@section('content')
<div class="padding">
   <div class="box">
      <div class="box-header dker">
         <h3><i class="material-icons"></i> Edit Category</h3>
         <small>
         <a href="{{url('/admin')}}">Home</a> /
         <a href="">Parent Category Edit</a>
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
         <form method="POST" action="{{route('categoriesUpdate')}}" accept-charset="UTF-8" enctype="multipart/form-data">
            {{ csrf_field() }}
            <input type="hidden" name="id" value="{{$category->id}}">
            <div class="form-group row">
               <label for="title_ar" class="col-sm-2 form-control-label">Category Name</label>
               <div class="col-sm-10">
                  <input placeholder="" class="form-control has-value" value="{{$category->name}}" id="name" required=""name="name" type="text">
               </div>
            </div>
            <div class="form-group row">
               <label for="title_ar" class="col-sm-2 form-control-label">Slug</label>
               <div class="col-sm-10">
                  <input placeholder="" class="form-control has-value" value="{{$category->slug}}" id="slug" required=""name="slug" type="text" step="text-transform: lowercase;">
                  <small>Use Only Alphabets and dash (-).</small>
               </div>
            </div>
            <div class="form-group row">
               <label for="title_ar" class="col-sm-2 form-control-label">Choose Type</label>
               <div class="col-sm-10">
                  <select name="type_id" required="" class="form-control has-value">
                    <option value="" selected="" disabled="" >Select Type</option>
                    @foreach($types as $row)
                      <option @if($row->id == $category->type_id) selected @endif value="{{$row->id}}">{{$row->name}}</option>
                    @endforeach
                  </select>
               </div>
            </div>

            <div class="form-group row">
               <label for="title_ar" class="col-sm-2 form-control-label">Choose Affilate Profit Percentage</label>
               <div class="col-sm-10">
                   <input placeholder="" class="form-control has-value" step="any" type="number" id="slug" required="" value ="{{$category->profit_percentage}}" name="profit_percentage" >
                  <small>Number from 0-100</small>
               </div>
            </div>

            <div class="form-group row m-t-md">
               <div class="col-sm-offset-2 col-sm-10">
                  <button type="submit" class="btn btn-primary m-t"><i class="material-icons">
                  </i> Update</button>
                  <a href="{{route('categories')}}" class="btn btn-default m-t"><i class="material-icons">
                  </i> Cancel</a>
               </div>
            </div>
         </form>
      </div>
   </div>
</div>
@endsection
