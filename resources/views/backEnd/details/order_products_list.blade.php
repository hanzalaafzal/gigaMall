@extends('backEnd.layout')

@section('content')
@if(count($products) > 0)
  <div class="padding">
     <div class="box">
        <div class="box-header dker">
           <h3>
            <i class="material-icons"></i>All Products
             <small>
               <a href="{{url('/admin')}}">Home</a> /
               <a href="">All Products List</a>
             </small>
            <br>
            <a class="btn btn-primary btn-sm" href="{{route('approveDeliveredProducts')}}">All ({{$count['All']}})</a>
            <a class="btn btn-primary btn-sm" href="{{route('productsActiveDelivered')}}">Delivered ({{$count['Delivered']}})</a>
            <a class="btn btn-primary btn-sm" href="{{route('productsActiveCompleted')}}">Completed ({{$count['Completed']}})</a>
            <a class="btn btn-primary btn-sm" href="{{route('productsDeactiveRejected')}}">Rejected ({{$count['Rejected']}})</a>
            {{-- <a class="btn btn-primary btn-sm" href="{{route('productsRenewal')}}">Renewal ({{$count['Renewal']}})</a>
            <a class="btn btn-primary btn-sm" href="{{route('productsDeleted')}}">Deleted ({{$count['Deleted']}})</a> --}}
           </h3>
        </div>
        <div class="box-tool" style="width: 40%;">
           <form method="POST" action="{{route('searchProducts')}}" accept-charset="UTF-8" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="form-group row">
               <div class="col-md-8">
                  <input placeholder="Search Products By Title" class="form-control has-value" id="name" required="" name="name" type="text">
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
                            
                            <th class="text-center">Client</th>
                            <th class="text-center">Vendor</th>
                            <th class="text-center">Order Number</th>
                            <th class="text-center">Product</th>
                            <th class="text-center">Price</th>
                            <th class="text-center">Quantity</th>
                            <th class="text-center">Shipping Price</th>
                            <th class="text-center">Shipping Days</th>
                            <th class="text-center">Review</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Options</th>
                            
                         </tr>
                      </thead>
                      <tbody>
                         @foreach($products as $product)
                          <tr>
                              <td>{{$product->client->user_name}}</td>
                              <td>{{$product->vendor->user_name}}</td>
                              <td>{{$product->orders->order_number}}</td>
                              <td>{{$product->products->title	}}</td>
                              {{-- <td class="text-center">{{substr($product->product_id,0,100).'...'}}</td> --}}
                              <td class="text-center">
                                  {{$product->product_price}} PKR
                                {{-- <a href="{{url('frontEnd/images/products/'.$product->photo)}}" target="_blank">
                                  <img style="width: 100%;" src="{{url('frontEnd/images/products/'.$product->photo)}}">
                                </a>
                                @if(count($product->galleries) >0)
                                  @foreach($product->galleries as $gallery)
                                    <a href="{{url('frontEnd/images/products/gallery/'.$gallery->photo)}}" target="_blank">
                                      <img style="width: 100%;" src="{{url('frontEnd/images/products/gallery/'.$gallery->photo)}}">
                                    </a> --}}
                                  {{-- @endforeach
                                @endif --}}
                              </td>
                              <td class="text-center">{{$product->quantity}} </td>
                              <td class="text-center">{{$product->shipping_price}} PKR</td>
                              <td class="text-center">{{$product->shipping_days}}</td>
                              <td class="text-center">{{$product->review}}</td>
                              <td class="text-center">{{$product->status}}</td>
                              
                              <td class="text-center">
                                @if($product->status == "Delivered")
                                  <a onclick="return confirm('Are you sure? You want to Remove this product from feature?')" href="{{route('productsReject',$product->id)}}" class="btn btn-danger btn-sm">Reject</a>
                                  <br>
                                  <a onclick="return confirm('Are you sure? You want to Complete status for this product ?')" href="{{route('productsComplete',$product->id)}}" class="btn btn-primary btn-sm">Complete</a>
                                  <br>

                                @endif

                                @if($product->status == "Completed")
                                <a onclick="return confirm('Are you sure? You want to Reject this product?')" href="{{route('productsReject',$product->id)}}" class="btn btn-danger btn-sm">Reject</a>
                                <br>
                                <a onclick="return confirm('Are you sure? You want to change status to Delivered ?')" href="{{route('productsUnFeatured',$product->id)}}" class="btn btn-danger btn-sm">Back to Delivered</a>
                                <br>

                              @endif
                              @if($product->status == "Rejected")
                                <a onclick="return confirm('Are you sure? You want to change status to Complete ?')" href="{{route('productsComplete',$product->id)}}" class="btn btn-primary btn-sm">Complete</a>
                                <br>
                                <a onclick="return confirm('Are you sure? You want to change status to Delivered ?')" href="{{route('backToDelivered',$product->id)}}" class="btn btn-danger btn-sm">Back to Delivered</a>
                                <br>

                              @endif

                                {{-- @if($product->status == 'Active')
                                  <a onclick="return confirm('Are you sure? You want to disable this product?')" href="{{route('productDisable',$product->id)}}" class="btn btn-danger btn-sm">Disable</a>
                                @elseif($product->status == 'Disable')
                                  <a onclick="return confirm('Are you sure? You want to active this product?')" href="{{route('productActive',$product->id)}}" class="btn btn-info btn-sm">Active</a>
                                  <a onclick="return confirm('Are you sure? You want to delete this product?')" href="{{route('productDeleted',$product->id)}}" class="btn btn-danger btn-sm">Delete</a>
                                @endif --}}
                                <a href="{{route('editOrderProductAdmin',$product->id)}}" class="btn btn-primary btn-sm">Edit</a>
                              </td>
                          </tr>
                         @endforeach
                      </tbody>
                   </table>
                </div>
             </div>

            <br>
            <div style="float: right;">
              {{$products->links()}}
            </div>
            
          </div>
        </div>
     </div>

  </div>
@else
  <div class="padding">
    <h5>No products for Approval</h5>
  </div>
@endif
@endsection