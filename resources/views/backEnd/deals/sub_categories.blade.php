@extends('backEnd.layout')

@section('content')
<div class="padding">
   <div class="box">
      <div class="box-header dker">
         <h3><i class="material-icons"></i> Create SubCategory</h3>
         <small>
         <a href="{{url('/admin')}}">Home</a> /
         <a href="">Sub Category Create</a>
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
         <form method="POST" action="{{route('SubCategoriesStore')}}" accept-charset="UTF-8" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="form-group row">
               <label for="title_ar" class="col-sm-2 form-control-label">SubCategory Name</label>
               <div class="col-sm-10">
                  <input placeholder="" class="form-control has-value" id="name" required=""name="name" type="text">
               </div>
            </div>
            <div class="form-group row">
               <label for="title_ar" class="col-sm-2 form-control-label">Slug</label>
               <div class="col-sm-10">
                  <input placeholder="" class="form-control has-value" id="slug" required=""name="slug" type="text" step="text-transform: lowercase;">
                  <small>Use Only Alphabets and dash (-).</small>
               </div>
            </div>
            <div class="form-group row">
               <label for="title_ar" class="col-sm-2 form-control-label">Parent Category</label>
               <div class="col-sm-10">
                  <select name="parent_category" required="" class="form-control has-value">
                    <option value="" selected="" disabled="" >Select Parent Category</option>
                    @foreach($categories as $category)
                      <option value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                  </select>
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
@if(count($subCategories) > 0)
  <div class="padding">
     <div class="box">
        <div class="box-header dker">
           <h3><i class="material-icons"></i> Create Category</h3>
           <small>
           <a href="{{url('/admin')}}">Home</a> /
           <a href="">Sub Category List</a>
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
                            <th class="text-center">Status</th>
                            <th class="text-center">Parent Category</th>
                            <th class="text-center">Options</th>
                         </tr>
                      </thead>
                      <tbody>
                         @foreach($subCategories as $category)
                          <tr>
                              <td>{{$category->name}}</td>
                              <td class="text-center">{{$category->slug}}</td>
                              <td class="text-center">{{$category->status}}</td>
                              <td class="text-center">{{$category->categories->name}}</td>
                              <td class="text-center">
                                @if($category->status == 'Active')
                                  <a href="{{route('SubCategoriesDisable',$category->slug)}}" class="btn btn-danger btn-sm">Disable</a>
                                @else
                                  <a href="{{route('SubCategoriesActive',$category->slug)}}" class="btn btn-success btn-sm">Active</a>
                                @endif
                                <a href="{{route('SubCategoriesEdit',$category->slug)}}" class="btn btn-primary btn-sm">Edit</a>
                                <a href="{{route('SubCategoriesDelete',$category->slug)}}" class="btn btn-danger btn-sm">Delete</a>
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