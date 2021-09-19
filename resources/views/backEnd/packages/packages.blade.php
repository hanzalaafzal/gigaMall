@extends('backEnd.layout')

@section('content')
<div class="padding">
   <div class="box">
      <div class="box-header dker">
         <h3><i class="material-icons"></i> Create Package</h3>
         <small>
         <a href="{{url('/admin')}}">Home</a> /
         <a href="">Package Create</a>
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
         <form method="POST" action="{{route('shopPackagesStore')}}" accept-charset="UTF-8" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="form-group row">
               <label for="title_ar" class="col-sm-2 form-control-label">Package Name</label>
               <div class="col-sm-10">
                  <input placeholder="" class="form-control has-value" id="name" required=""name="name" type="text">
               </div>
            </div>
            <div class="form-group row">
               <label for="title_ar" class="col-sm-2 form-control-label">Price</label>
               <div class="col-sm-10">
                  <input placeholder="Enter Price of Package" class="form-control has-value" id="price" required="" name="price" type="number">
               </div>
            </div>
            <div class="form-group row">
               <label for="title_ar" class="col-sm-2 form-control-label">Number of Products</label>
               <div class="col-sm-10">
                  <input placeholder="Enter number of products allow in this package" class="form-control has-value" id="products" required="" name="products" type="number">
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
@if(count($packages) > 0)
  <div class="padding">
     <div class="box">
        <div class="box-header dker">
           <h3><i class="material-icons"></i> List Packages</h3>
           <small>
           <a href="{{url('/admin')}}">Home</a> /
           <a href="">Packages List</a>
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
                            <th class="text-center">Price</th>
                            <th class="text-center">Number of Products</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Options</th>
                         </tr>
                      </thead>
                      <tbody>
                         @foreach($packages as $package)
                          <tr>
                              <td>{{$package->name}}</td>
                              <td class="text-center">{{$package->price}} PKR</td>
                              <td class="text-center">{{$package->products}}</td>
                              <td class="text-center">{{$package->status}}</td>
                              <td class="text-center">
                                @if($package->status == 'Active')
                                  <a href="{{route('shopPackagesDisable',$package->id)}}" class="btn btn-danger btn-sm">Disable</a>
                                @else
                                  <a href="{{route('shopPackagesActive',$package->id)}}" class="btn btn-success btn-sm">Active</a>
                                @endif
                                <a href="{{route('shopPackagesEdit',$package->id)}}" class="btn btn-primary btn-sm">Edit</a>
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