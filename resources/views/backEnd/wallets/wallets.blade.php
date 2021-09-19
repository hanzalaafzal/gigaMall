@extends('backEnd.layout')
@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
   {{--  @if(count($categories) > 0)  --}}
  <div class="padding">
     <div class="box">
        <div class="box-header dker">
           <h3><i class="material-icons"></i>Wallets</h3>
           <small>
           <a href="{{url('/admin')}}">Home</a> /
           <a href="">Wallet List</a>
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
                            <th class="text-center">User Name</th>
                            <th class="text-center">Present Amount</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Actions</th>
                            {{-- <th class="text-center">Referral Bonus</th> --}}
                         </tr>
                      </thead>
                      <tbody>
                         @foreach($wallets as $wallet)
                          <tr>
                                
                              <td class="text-center">{{$wallet['users']['user_name']}}</td>
                              <td class="text-center">{{$wallet->amount}}</td>
                              <td class="text-center">{{$wallet->status}}</td>
                              {{-- <td class="text-center">{{$wallet->referral_bonus}}</td> --}}
                              <td class="text-center">
                                {{-- @if($wallet->status	 == 'Active')
                                  <a href="{{route('couponDisable',$wallet->id)}}" class="btn btn-danger btn-sm">Debit</a>
                                @else
                                  <a href="{{route('couponActive',$wallet->id)}}" class="btn btn-success btn-sm">Activate</a>
                                @endif --}}
                                <a href="{{route('walletDebitShow',$wallet->id)}}" class="btn btn-danger btn-sm">Deduct amount</a>
                                <a href="{{route('walletCreditShow',$wallet->id)}}" class="btn btn-success btn-sm">Add amount</a>
                                <a href="{{route('walletHistoryShow',$wallet->user_id)}}" class="btn btn-primary btn-sm">History</a>
                                {{-- <a href="{{route('walletEdit',$wallet->id)}}" class="btn btn-primary btn-sm">Edit</a> --}}
                                {{-- <a href="{{route('couponDelete',$wallet->id)}}" class="btn btn-danger btn-sm">Delete</a> --}}
                              </td>

                          </tr>
                         @endforeach
                      </tbody>
                   </table>
                   {{ $wallets->links() }}
                </div>
             </div>
          </div>
        </div>
     </div>
  </div>
 
{{--  @endif  --}}
@endsection