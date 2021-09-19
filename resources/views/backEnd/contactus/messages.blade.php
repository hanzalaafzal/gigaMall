@extends('backEnd.layout')

@section('content')

@if(count($messages) > 0)
  <div class="padding">
     <div class="box">
        <div class="box-header dker">
           <h3><i class="material-icons"></i> All Messages</h3>
           <small>
           <a href="{{url('/admin')}}">Home</a> /
           <a href="">Messages</a>
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
                          <th>Full Name</th>
                            <th class="text-center">Email</th>
                            <th class="text-center">Message</th>
                            <th class="text-center">Options</th>
                         </tr>
                      </thead>
                      <tbody>
                         @foreach($messages as $msg)
                          <tr>
                              <td>{{$msg->full_name}}</td>
                              <td class="text-center">{{$msg->email}}</td>
                              <td class="text-center">{{$msg->message}}</td>
                              <td class="text-center">
                                <a class="btn btn-info btn-sm" href="mailto:{{$msg->email}}">Reply</a>
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
@else
  <div class="row">
    <div class="col-md-12">
      <br>
      <h4>No Message Found</h4>
    </div>
  </div>
@endif

@endsection