@extends('backEnd.layout')

@section('content')
<div class="padding">
   <div class="box">
      <div class="box-header dker">
         <h3><i class="material-icons"></i> Create Product Type</h3>
         <small>
         <a href="{{url('/admin')}}">Home</a> /
         <a href="">Product Type Create</a>
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
         <form method="POST" action="{{route('productTypeStore')}}" accept-charset="UTF-8" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="form-group row">
               <label for="title_ar" class="col-sm-2 form-control-label">Name</label>
               <div class="col-sm-10">
                  <input placeholder="Enter Product Type Name" class="form-control has-value" id="name" required=""name="name" type="text">
               </div>
            </div>
            <div class="form-group row">
               <label for="title_ar" class="col-sm-2 form-control-label">Slug</label>
               <div class="col-sm-10">
                  <input placeholder="" class="form-control has-value" id="slug" required=""name="slug" type="text" step="text-transform: lowercase;">
                  <small>Use Only Alphabets and dash (-).</small>
               </div>
            </div>
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
@if(count($ProductTypes) > 0)
  <div class="padding">
     <div class="box">
        <div class="box-header dker">
           <h3><i class="material-icons"></i> List Product Types</h3>
           <small>
           <a href="{{url('/admin')}}">Home</a> /
           <a href="">Product Types List</a>
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
                            <th class="text-center">Slug</th>
                            <th class="text-center">Options</th>
                         </tr>
                      </thead>
                      <tbody>
                         @foreach($ProductTypes as $ProductType)
                          <tr>
                              <td>{{$ProductType->name}}</td>
                              <td class="text-center">{{$ProductType->slug}}</td>
                              <td class="text-center">
                                <a href="{{route('productTypeEdit',$ProductType->slug)}}" class="btn btn-primary btn-sm">Edit</a>
                                <a href="{{route('productTypeDelete',$ProductType->id)}}" class="btn btn-danger btn-sm">Delete</a>
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
@endif
@endsection