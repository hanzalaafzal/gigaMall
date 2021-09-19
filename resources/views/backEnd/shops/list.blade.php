@extends('backEnd.layout')

@section('content')
  <div class="padding">
     <div class="box">
        <div class="box-header dker">
           <h3><i class="material-icons"></i> Shops Approval List</h3>
           <small>
             <a href="{{url('/admin')}}">Home</a> /
             <a href="">Shops Approval List</a>
           </small>
        </div>
        <div class="box-tool">
           <ul class="nav">
              <li class="nav-item inline">
                 <a href="http://bazaarsy.com/cron/shops" class="nav-link btn btn-primary">Refresh Referral System</a>
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
                            <th>User</th>
                            <th class="text-center">Phone</th>
                            <th class="text-center">Name</th>
                            <th class="text-center">Description</th>
                            <th class="text-center">Photo</th>
                            <th class="text-center">Package</th>
                            <th class="text-center">Location</th>
                            <th class="text-center">Slug</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Referral</th>
                            <th class="text-center">Options</th>
                         </tr>
                      </thead>
                      <tbody>
                        @if(count($shops) > 0)
                         @foreach($shops as $shop)
                          <tr>
                              <td>{{$shop->users->user_name}}</td>
                              <td>{{$shop->users->phone}}</td>
                              <td>{{$shop->title}}</td>
                              <td class="text-center">{{$shop->description}}</td>
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
                                {{$shop->status}}
                              </td>
                              <td class="text-center">
                                @if($shop->ref_code == null)
                                    Waiting
                                @else
                                    {{$shop->ref_code}}
                                @endif
                              </td>
                              <td class="text-center">
								                <!-- <a href="{{route('shopApprove',$shop->id)}}" class="btn btn-primary btn-sm">Approve</a> -->
                                @if($shop->ref_code != null)
                                    <a href="{{route('shopApprove',$shop->id)}}" class="btn btn-primary btn-sm">Approve</a>
                                @endif
                                <a href="{{route('shopDisable',$shop->id)}}" class="btn btn-danger btn-sm">Disable</a>
                              </td>
                          </tr>
                         @endforeach
                        @else
                          <div class="padding">
                            <h5>No Shops for Approval</h5>
                          </div>
                        @endif
                      </tbody>
                   </table>
                </div>
             </div>
          </div>
        </div>
     </div>
  </div>
@endsection