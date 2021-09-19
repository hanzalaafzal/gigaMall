@extends('frontEnd.vendor.layout')
@section('dashboard')


<style type="text/css">
	.profile-notifications {
	    margin: 0 auto 15px;
	}
</style>
<!-- DASHBOARD CONTENT -->
<div class="dashboard-content">
   <!-- HEADLINE -->
   <div class="headline buttons primary">
      <h4>My Products <small style="color: gray">({{ Request::segment(2) }})</small></h4>
      <div class="shops-buttons">
        <a href="{{route('myProductsDisable')}}" class="button primary <?php if(Route::currentRouteName() == 'myProductsDisable'){echo "dark-light";} ?>">Disable<small> ({{$count['disable']}})</small></a>
        <a href="{{route('myProductsPending')}}" class="button primary <?php if(Route::currentRouteName() == 'myProductsPending'){echo "dark-light";} ?>">Pending<small> ({{$count['pending']}})</small></a>
        <a href="{{route('myProductsActive')}}" class="button primary <?php if(Route::currentRouteName() == 'myProductsActive'){echo "dark-light";} ?>">Active<small> ({{$count['active']}})</small></a>
        <a href="{{route('myProducts')}}" class="button primary <?php if(Route::currentRouteName() == 'myProducts'){echo "dark-light";} ?>" >All <small>({{$count['all']}})</small></a>
      </div>
   </div>
   <!-- /HEADLINE -->
    <!-- PRODUCT LIST -->
      <div class="product-list grid column4-wrap">
        <!-- PRODUCT ITEM -->
        <a href="{{route('productCreate')}}">
          <div class="product-item upload-new column">
          <!-- PRODUCT PREVIEW ACTIONS -->
          <div class="product-preview-actions">
            <!-- PRODUCT PREVIEW IMAGE -->
            <figure class="product-preview-image">
              <img src="{{url('/frontEnd/images/dashboard/uploadnew-bg.jpg')}}" alt="product-image">
            </figure>
            <!-- /PRODUCT PREVIEW IMAGE -->
          </div>
          <!-- /PRODUCT PREVIEW ACTIONS -->

          <!-- PRODUCT INFO -->
          <div class="product-info">
            <p class="text-header">Upload New Product</p>
            <!-- <p class="description">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore.</p> -->
          </div>
          <!-- /PRODUCT INFO -->
        </div>
        </a>
        <!-- /PRODUCT ITEM -->

        @if(count($products)>0)
        <!-- PROFILE NOTIFICATIONS -->
       @foreach($products as $product)
                        <div class="product-item column">
                          <!-- @if($product->is_featured == 1)
                            <span class="pin featured">Featured</span>
                          @endif -->
                           <!-- PRODUCT PREVIEW ACTIONS -->
                           <div class="product-preview-actions">
                              <!-- PRODUCT PREVIEW IMAGE -->
                              <figure class="product-preview-image">
                                 <img src="{{url('/frontEnd/images/products/'.$product->photo)}}" alt="product-image">
                              </figure>
                              <!-- /PRODUCT PREVIEW IMAGE -->
                              <!-- PREVIEW ACTIONS -->
                              <div class="preview-actions">
                                 <!-- PREVIEW ACTION -->
                                 @if($product->status != 'Active')
                                  <div class="preview-action">
                                      <a href="{{route('productEdit',$product->slug)}}">
                                         <div class="circle tiny primary">
                                            <i class="far fa-eye"></i>
                                         </div>
                                      </a>
                                      <a href="{{route('productEdit',$product->slug)}}">
                                         <p>View</p>
                                      </a>
                                   </div>
                                @else
                                  <div class="preview-action">
                                      <a href="{{route('productView',$product->slug)}}">
                                         <div class="circle tiny primary">
                                            <i class="far fa-eye"></i>
                                         </div>
                                      </a>
                                      <a href="{{route('productView',$product->slug)}}">
                                         <p>View</p>
                                      </a>
                                   </div>
                                 @endif
                                 <!-- /PREVIEW ACTION -->
                                  <!-- PREVIEW ACTION -->
                                 <div class="preview-action">
                                    <a href="{{route('productEdit',$product->slug)}}">
                                       <div class="circle tiny secondary">
                                          <i class="fas fa-edit"></i>
                                          <!-- <span class="icon-heart"></span> -->
                                       </div>
                                    </a>
                                    <a href="{{route('productEdit',$product->slug)}}">
                                       <p>Edit Product</p>
                                    </a>
                                 </div>
                                 <!-- /PREVIEW ACTION -->

                              </div>
                              <!-- /PREVIEW ACTIONS -->
                           </div>
                           <!-- /PRODUCT PREVIEW ACTIONS -->
                           <!-- PRODUCT INFO -->
                           <div class="product-info">
                                @if($product->status != 'Active')
                                    <a href="{{route('productEdit',$product->slug)}}">
                                      <p class="text-header">{{$product->title}}</p>
                                    </a>
                                @else
                                    <a href="{{route('productView',$product->slug)}}">
                                      <p class="text-header">{{$product->title}}</p>
                                    </a>
                                 @endif
                            <p class="category primary">{{$product->productTypes->name}}</p>
                            <p class="price">{{$product->price}} <span>{{$product->shops->currency}}</span></p>
                          </div>
                           <!-- /PRODUCT INFO -->
                           <hr class="line-separator">
                           <!-- USER RATING -->
                           <div class="user-rating">
                              <a href="{{route('shopView',$product->shops->slug)}}">
                                 <p class="text-header tiny">{{substr($product->shops->title,0,20)}}</p>
                              </a>
                              <?php $rating = App\Helpers\Helper_user::rating($product->id); ?>
                              <ul class="rating tooltip tooltipstered">

                                 <li class="rating-item" style="    margin-right: 1px;">
                                    <!-- SVG STAR -->
                                    <p>{{$rating}}</p>
                                    <!-- /SVG STAR -->
                                 </li>
                                 <li class="rating-item">
                                    <!-- SVG STAR -->
                                    <svg class="svg-star">
                                       <use xlink:href="#svg-star"></use>
                                    </svg>
                                    <!-- /SVG STAR -->
                                 </li>
                              </ul>
                           </div>
                           <!-- /USER RATING -->
                        </div>
                    @endforeach
       <!-- /PROFILE NOTIFICATIONS -->

       @else
        <div style="text-align: center;color: lightgray;">
          <h4>No Shop Listed</h4>
        </div>
       @endif

      </div>
      <!-- /PRODUCT LIST -->
      <br>
       <!-- PAGER -->
       <div class="pager-lara" style="width: 100%;">
        {{$products->links()}}
       </div>
       <!-- /PAGER -->
   
</div>
<!-- DASHBOARD CONTENT -->



@endsection