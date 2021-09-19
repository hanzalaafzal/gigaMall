@extends('backEnd.layout')
@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<div class="padding">
   <div class="box">
      <div class="box-header dker">
         <h3><i class="material-icons"></i> Show Wallet Transaction History</h3>
         <small>
         <a href="{{url('/admin')}}">Home</a> /
         <a href="">Wallet Transactin History</a>
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
         <form method="POST" action="{{route('historyFilters')}}" accept-charset="UTF-8" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="form-group row">
               <label for="title_ar" class="col-sm-2 form-control-label">Start Date</label>
               <div class="col-sm-10">
                  <input placeholder="" class="form-control has-value" id="name" required=""name="start_date" type="date">
               </div>
            </div>
            <div class="form-group row">
               <label for="title_ar" class="col-sm-2 form-control-label">End Date</label>
               <div class="col-sm-10">
                  <input placeholder="" class="form-control has-value" id="name" required=""name="end_date" type="date">
                  <input id="user_id" name="user_id" type="hidden" value="{{ $id }}">
               </div>
            </div>
            <div class="form-group row m-t-md">
               <div class="col-sm-offset-2 col-sm-10">
                  <button type="submit" class="btn btn-primary m-t"><i class="material-icons">
                  </i> View History</button>
                  <a href="{{url('admin/wallets')}}" class="btn btn-default m-t"><i class="material-icons">
                  </i> Cancel</a>
               </div>
            </div>
         </form>
      </div>
   </div>
</div>
{{--  @if(count($categories) > 0)  --}}
  <div class="padding">
     <div class="box">
        <div class="box-header dker">
           <h3><i class="material-icons"></i>  Transactions History</h3>
           <small>
           <a href="{{url('/admin')}}">Home</a> /
           <a href="">Wallet Transactions History</a>
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
                            <th>Transaction type</th>
                            <th class="text-center">Amount</th>
                            <th class="text-center">Transaction Date</th>
                            {{--  <th class="text-center">Expiry Date</th>
                            <th class="text-center">Options</th>  --}}
                         </tr>
                      </thead>
                      <tbody>
                         @foreach($walletHistoy as $wallet)
                          <tr>
                                <td>{{ $wallet->transaction_type}}</td> 
                              <td class="text-center">{{$wallet->transaction_amount	}}</td>
                              <td class="text-center">{{$wallet->transaction_date}}</td>
                              {{--  <td class="text-center">{{$wallet->transaction_date}}</td>  --}}
                              {{-- <td class="text-center">
                                @if($wallet->wallet_status == 'Active')
                                  <a href="{{route('walletDisable',$wallet->id)}}" class="btn btn-danger btn-sm">Disable</a>
                                @else
                                  <a href="{{route('walletActive',$wallet->id)}}" class="btn btn-success btn-sm">Activate</a>
                                @endif
                                <a href="{{route('walletEdit',$wallet->id)}}" class="btn btn-primary btn-sm">Edit</a>
                                <a href="{{route('walletDelete',$wallet->id)}}" class="btn btn-danger btn-sm">Delete</a>
                              </td> --}}

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
  <script>
     
         $('#couponselector').change(function(){
             $('.colors').hide();
             $('.amor').val('');
             $('#Amount1').prop('required',false);
             $('#Percent1').prop('required',false);
             $('#' + $(this).val()).show();
             $('#' + $(this).val()+1).prop('required',true);
             
         });
     
  </script>
{{--  @endif  --}}
@endsection