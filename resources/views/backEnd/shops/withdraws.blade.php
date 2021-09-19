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
                            <th>Name</th>
                            <th>Amount</th>
                            <th>Method</th>
                            <th>Account Number</th>
                            <th>Phone Number</th>
                            <th>Bank</th>
                            <th>Action</th>
                            <th>Created At</th>
                         </tr>
                      </thead>
                      <tbody>
                        @if(count($shoppers) > 0)
                         @foreach($shoppers as $shop)
                          <tr>
                              <td>{{$shop->name}}</td>
                              
                              <td>{{$shop->amount}}</td>
                             
                              <td>{{$shop->method}}</td>

                              <td>{{$shop->card_number}}</td>
                              
                              <td>{{$shop->phone_number}}</td>
                             
                              <td>{{$shop->bank}}</td>

                              <td>
                                    <a href="{{'/admin/withdrawRequests/'.$shop->id}}" class="btn btn-primary btn-sm">Approve</a>
                               
                              </td>

                              <td>{{$shop->created_at}}</td>

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