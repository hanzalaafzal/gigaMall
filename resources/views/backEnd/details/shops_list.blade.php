@extends('backEnd.layout')

@section('content')
@if(count($shops) > 0)
  <div class="padding">
     <div class="box">
        <div class="box-header dker">
           <h3><i class="material-icons"></i>All Shops
           <small>
             <a href="{{url('/admin')}}">Home</a> /
             <a href="">Shops List</a>
           </small>
            <br>
            <a class="btn btn-primary btn-sm" href="{{route('shopsAll')}}">All ({{$count['All']}})</a>
            <a class="btn btn-primary btn-sm" href="{{route('shopsActive')}}">Active ({{$count['Active']}})</a>
            <a class="btn btn-primary btn-sm" href="{{route('shopsPending')}}">Pending ({{$count['Pending']}})</a>
            <a class="btn btn-primary btn-sm" href="{{route('shopsDisable')}}">Disabled ({{$count['Disable']}})</a>
            <a class="btn btn-primary btn-sm" href="{{route('shopsRenewal')}}">Renewal ({{$count['Renewal']}})</a>
            <a class="btn btn-primary btn-sm" href="{{route('shopsDeleted')}}">Deleted ({{$count['Deleted']}})</a>
          </h3>
        </div>
        <div class="box-tool" style="width: 40%;">
           <form method="POST" action="{{route('searchShops')}}" accept-charset="UTF-8" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="form-group row">
               <div class="col-md-8">
                  <input placeholder="Search Shops By Title" class="form-control has-value" id="name" required="" name="name" type="text">
               </div>
               <div class="col-md-4">
                  <button type="submit" class="btn btn-primary m-t" style="margin-top: 0px !important"> Search</button>
               </div>
            </div>
         </form>
        </div>
        <div class="box-body">
           <div class="row">
             <div class="box m-b-0">
                <div class="table-responsive">
                   <table class="table table-striped">
                      <thead>
                         <tr>                          
                            <th>User</th>
                            <th class="text-center">Phone</th>
                            <th class="text-center">Name</th>
                            <th class="text-center">Description</th>
                            <th class="text-center">Address</th>
                            <th class="text-center">Photo</th>
                            <th class="text-center">Package</th>
                            <th class="text-center">Location</th>
                            <th class="text-center">Slug</th>
                            <th class="text-center">Is Featured</th>
							 <th class="text-cetner">Ref Code</th>
                            <th class="text-center">Since</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Options</th>
                         </tr>
                      </thead>
                      <tbody>
                         @foreach($shops as $shop)
                          <tr>
                              <td>{{$shop->users->user_name}}</td>
                              <td>{{$shop->users->phone}}</td>
                              <td>{{$shop->title}}</td>
                              <td class="text-center">{{$shop->description}}</td>
                              <td class="text-center">{{$shop->address}}</td>
                              <td class="text-center">
                                <a href="{{url('frontEnd/images/shops/'.$shop->photo)}}" target="_blank">
                                  <img style="width: 100%;" src="{{url('frontEnd/images/shops/'.$shop->photo)}}">
                                </a>
                              </td>
                              <td class="text-center">{{$shop->packages->name}}</td>
                              <td class="text-center">
                                {{$shop->countries->title_en}}->{{$shop->states->name}}
                                @if(!empty($shop->cities->name))
                                  ->{{$shop->cities->name}}
                                @endif
                              </td>
                              <td class="text-center">{{$shop->slug}}</td>
                              <td class="text-center">
                                @if($shop->is_featured == 0)
                                  No
                                @else
                                  Yes
                                @endif
                              </td>
							  <td>{{$shop->ref_code}}</td>
							  <td>{{$shop->created_at->format('d-m-Y')}}</td>
                              <td class="text-center">
                                {{$shop->status}}
                              </td>
                              <td class="text-center">
                                @if($shop->is_featured == 0 && $shop->status != 'Deleted')
                                  <a onclick="return confirm('Are you sure? You want to make this shop feature?')" href="{{route('shopsFeaturedCreate',$shop->id)}}" class="btn btn-primary btn-sm">Feature</a>
                                @elseif($shop->is_featured != 0 && $shop->status != 'Deleted')
                                  <a onclick="return confirm('Are you sure? You want to remove this shop from feature?')" href="{{route('shopsUnFeatured',$shop->id)}}" class="btn btn-danger btn-sm">UnFeature</a>
                                @endif

                                @if($shop->status == 'Active')
                                  <a onclick="return confirm('Are you sure? You want to disable this shop?')" href="{{route('shopDisable',$shop->id)}}" class="btn btn-danger btn-sm">Disable</a>
                                @elseif($shop->status == 'Disable')
                                  <a onclick="return confirm('Are you sure? You want to active this shop?')" href="{{route('shopActive',$shop->id)}}" class="btn btn-info btn-sm">Active</a>
                                  <a onclick="return confirm('Are you sure? You want to delete this shop?')" href="{{route('shopDeleted',$shop->id)}}" class="btn btn-danger btn-sm">Delete</a>
                                @endif
                                <a href="{{route('editShopAdmin',$shop->id)}}" class="btn btn-primary btn-sm">Edit</a>
                              </td>
                          </tr>
                         @endforeach
                      </tbody>
                   </table>
                </div>
             </div>
             <br>
             <div style="float: right;">
                {{$shops->links()}}
             </div>
          </div>
        </div>
     </div>
  </div>
@else
  <div class="padding">
    <h5>No Shop Found</h5>
  </div>
@endif
@endsection