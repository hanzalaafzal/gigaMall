@extends('backEnd.layout')

@section('content')
@if(count($orders) > 0)
  <div class="padding">
     <div class="box">
        <div class="box-header dker">
           <h3>
            <i class="material-icons"></i>All Orders
             <small>
               <a href="{{url('/admin')}}">Home</a> /
               <a href="">All Orders List</a>
             </small>
            <br>
            <a class="btn btn-primary btn-sm" href="#">All ({{$count['All']}})</a>
            <a class="btn btn-primary btn-sm" href="#">Active ({{$count['Active']}})</a>
            <a class="btn btn-primary btn-sm" href="#">Completed ({{$count['Deleted']}})</a>
           </h3>
        </div>

        <div class="box-body">
           <div class="row">
             <div class="box m-b-0">
                <div class="table-responsive">
                   <table class="table table-striped">
                      <thead>
                         <tr>
                            <th>Order no.</th>
                            <th >Client</th>
                            <th>Products</th>
                            <th >Price</th>
                            <th>Shipping</th>
                            <th >Discount</th>
                            <th >Total</th>
                            <th >Status</th>
                            <th>Pay Method</th>
                            <th >Created At</th>
                         </tr>
                      </thead>
                      <tbody>
                        @if(isset($orders))
                         @foreach($orders as $row)
                         @php
                          $user = DB::table('users')->where('id',$row->client_id)->first();
                          $products = DB::table('order_products')->where('order_id',$row->id)->get();
                         @endphp
                          <tr>
                              <td> <a style="color:blue" href="{{route('adminOrderSingle',$row->order_number)}}">{{$row->order_number}}</a> </td>
                              <td>@if(isset($user)){{$user->first_name}}@endif</td>
                              <td>@if(isset($products))
                                <ol>
                                    @foreach($products as $pro)
                                      @php
                                        $product = DB::table('products')->where('id',$pro->product_id)->first();
                                      @endphp
                                      <li>{{$product->title}}</li>
                                    @endforeach
                                  </ol>
                                  @endif
                                </td>

                              <td>{{$row->products_price}}</td>
                              <td>{{$row->shipping_price}}</td>
                              <td>{{$row->discount}}</td>
                              <td>{{$row->grand_price - $row->discount}}</td>
                              <td>{{$row->status}}</td>
                               <td>{{$row->payment_method}}</td>
                              <td>{{$row->created_at}}</td>
                          </tr>
                         @endforeach
                         @endif
                      </tbody>
                   </table>
                </div>
             </div>

            <br>
            <div style="float: right;">
              {{$orders->links()}}
            </div>

          </div>
        </div>
     </div>

  </div>
@else
  <div class="padding">
    <h5>No orders </h5>
  </div>
@endif
@endsection
