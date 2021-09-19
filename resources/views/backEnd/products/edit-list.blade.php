@extends('backEnd.layout')

@section('content')
@if(count($products) > 0)
  <div class="padding">
     <div class="box">
        <div class="box-header dker">
           <h3><i class="material-icons"></i> Products Edit Approval List</h3>
           <small>
           <a href="{{url('/admin')}}">Home</a> /
           <a href="">Products Edit Approval List</a>
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
                            <th>User</th>
                            <th class="text-center">Shop</th>
                            <th class="text-center">Name</th>
                            <th class="text-center">Description</th>
                            <th class="text-center">Photo</th>
                            <th class="text-center">Price</th>
                            <th class="text-center">Category</th>
                            <th class="text-center">Sub Category</th>
                            <th class="text-center">Product Type</th>
                            <th class="text-center">Quantity</th>
                            <th class="text-center">Slug</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Options</th>
                         </tr>
                      </thead>
                      <tbody>
                         @foreach($products as $product)
                          <tr>
                              <td>{{$product->users->user_name}}</td>
                              <td>{{$product->shops->title}}</td>
                              <td>{{$product->title}}</td>
                              <td class="text-center">{{substr($product->description,0,100).'...'}}</td>
                              <td class="text-center">
                                @if(!empty($product->photo))
									<a href="{{url('frontEnd/images/products/'.$product->photo)}}" target="_blank">
									  <img style="width: 100%;" src="{{url('frontEnd/images/products/'.$product->photo)}}">
									</a>
								@else
								  N/A
								@endif
                                @if(count($product->galleries) >0)
                                  @foreach($product->galleries as $gallery)
                                    <a href="{{url('frontEnd/images/products/gallery/'.$gallery->photo)}}" target="_blank">
                                      <img style="width: 100%;" src="{{url('frontEnd/images/products/gallery/'.$gallery->photo)}}">
                                    </a>
                                  @endforeach
                                @endif
                              </td>
                              <td class="text-center">{{$product->price}}</td>
                              <td class="text-center">{{$product->categories->name}}</td>
                              <td class="text-center">{{$product->subCategories->name}}</td>
                              <td class="text-center">{{$product->productTypes->name}}</td>
                              <td class="text-center">{{$product->quantity}}</td>
                              <td class="text-center">{{$product->slug}}</td>
                              <td class="text-center">
                                {{$product->status}}
                              </td>
                              <td class="text-center">
                                <a href="{{route('EditprodcutApprove',$product->id)}}" class="btn btn-primary btn-sm">Approve</a>
                                <a href="{{route('EditprodcutDisapprove',$product->id)}}" class="btn btn-danger btn-sm">Unapprove</a>
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
  <div class="padding">
    <h5>No products for Approval</h5>
  </div>
@endif
@endsection