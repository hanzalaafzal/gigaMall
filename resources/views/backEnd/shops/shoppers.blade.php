@extends('backEnd.layout')

@section('content')
  <div class="padding">
     <div class="box">
        <div class="box-header dker">
           <h3><i class="material-icons"></i> Shop Partner Approval List</h3>
           <small>
             <a href="{{url('/admin')}}">Home</a> /
             <a href="">Shop Partner Approval List</a>
           </small>
        </div>
        
        <div class="box-body">
           <div class="row">
             <div class="box m-b-0">
                <div class="table-responsive">
                   <table class="table table-striped">
                      <thead>
                         <tr>                          
                            <th>User</th>
                            <th>Email</th>
                            <th>Created At</th>
                            <th>Action</th>
                         </tr>
                      </thead>
                      <tbody>
                        @if(count($shoppers) > 0)
                         @foreach($shoppers as $shop)
                          <tr>
                              <td>{{$shop->user_name}}</td>
                              
                              <td>{{$shop->email}}</td>
                             
                              <td>{{$shop->created_at}}</td>
                              <td>
                                    <a href="{{'/admin/shopperApproval/'.$shop->id}}" class="btn btn-primary btn-sm">Approve</a>
                               
                              </td>
                          </tr>
                         @endforeach
                        @else
                          <div class="padding">
                            <h5>No Shoppers for Approval</h5>
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