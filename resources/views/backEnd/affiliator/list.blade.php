@extends('backEnd.layout')

@section('content')
  <div class="padding">
     <div class="box">
        <div class="box-header dker">
           <h3><i class="material-icons"></i> Affiliators Approval List</h3>
           <small>
             <a href="{{url('/admin')}}">Home</a> /
             <a href="">Affiliators Approval List</a>
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
                            <th>Full Name</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Approval Status</th>
                            <th>Options</th>
                         </tr>
                      </thead>
                      <tbody>
                        @if(count($users) > 0)
                         @foreach($users as $user)
                          <tr>
                              <td>{{$user->user_name}}</td>
                              <td>{{$user->first_name}} {{$user->last_name}}</td>
                              <td>{{$user->phone}}</td>
                              <td>{{$user->email}}</td>
                              <td>@if($user->status==0) Not Approved @else Approved @endif</td>
                              {{-- <td>
                                @if($user->status==0)
                                  <a href="{{route('approveAffiliator',[$user->id,1])}}" onclick="return confirm('Do y`ou wish to Approve this affiliator ? ')" class="btn btn-primary">Approve</a>
                                @else
                                <a href="{{route('approveAffiliator',[$user->id,0])}}" onclick="return confirm('Do y`ou wish to Deactivate/Disapprove this affiliator ? ')" style="background-color:red" class="btn btn-primary">Disapprove</a>
                                @endif

                              </td>
                              --}}
                          </tr>
                         @endforeach

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
