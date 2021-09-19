@extends('frontEnd.client.layout')
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
      <h4>My Favourites Products</h4>
   </div>
   <!-- /HEADLINE -->
    <!-- PRODUCT LIST -->
      <div class="product-list grid column4-wrap">

      @if(count($favourites)>0)
        <!-- PROFILE NOTIFICATIONS -->
       @foreach($favourites as $favourite)
            <div class="product-item column">
               <!-- PRODUCT PREVIEW ACTIONS -->
               <div class="product-preview-actions">
                  <!-- PRODUCT PREVIEW IMAGE -->
                  <figure class="product-preview-image">
                     <img src="{{url('/frontEnd/images/products/'.$favourite->products->photo)}}" alt="product-image">
                  </figure>
                  <!-- /PRODUCT PREVIEW IMAGE -->
                  <!-- PREVIEW ACTIONS -->
                  <div class="preview-actions">
                     <!-- PREVIEW ACTION -->
                     <div class="preview-action">
                        <a href="{{route('productView',$favourite->products->slug)}}">
                           <div class="circle tiny primary">
                              <i class="far fa-eye"></i>
                           </div>
                        </a>
                        <a href="{{route('productView',$favourite->products->slug)}}">
                           <p>View</p>
                        </a>
                     </div>
                     <!-- /PREVIEW ACTION -->
                     <?php $cart = App\Helpers\Helper_user::check_cart($favourite->products->id); ?>
                     @if($cart == 1)
                      <!-- PREVIEW ACTION -->
                       <div class="preview-action">
                          <a href="{{route('myCart')}}">
                             <div class="circle tiny secondary">
                                <span class="icon-present check"></span>
                             </div>
                          </a>
                          <a href="{{route('myCart')}}">
                             <p>Added  <i class="fas fa-check"> </i></p>
                          </a>
                       </div>
                       <!-- /PREVIEW ACTION -->
                     @elseif($cart == 0)
                      <!-- PREVIEW ACTION -->
                       <div class="preview-action">
                          <a href="{{route('addCart',$favourite->products->slug)}}">
                             <div class="circle tiny secondary">
                                <span class="icon-present"></span>
                             </div>
                          </a>
                          <a href="{{route('addCart',$favourite->products->slug)}}">
                             <p>Add To Cart</p>
                          </a>
                       </div>
                       <!-- /PREVIEW ACTION -->
                     @endif
                     <?php $fav = App\Helpers\Helper_user::check_fav($favourite->products->id); ?>
                     @if($fav['status'] == 0)
                      <!-- PREVIEW ACTION -->
                       <div class="preview-action">
                          <a href="{{route('favouriteProduct',$favourite->products->slug)}}">
                             <div class="circle tiny secondary">
                                <span class="icon-heart"></span>
                             </div>
                          </a>
                          <a href="{{route('favouriteProduct',$favourite->products->slug)}}">
                             <p>Favourite</p>
                          </a>
                       </div>
                       <!-- /PREVIEW ACTION -->
                      @elseif($fav['status'] == 1)
                      <!-- PREVIEW ACTION -->
                     <div class="preview-action">
                        <a href="{{route('unFavouriteProduct',$fav['fav'][0]->id)}}">
                           <div class="circle tiny secondary">
                              <i class="fas fa-heart"></i>
                              <!-- <span class="icon-heart"></span> -->
                           </div>
                        </a>
                        <a href="{{route('unFavouriteProduct',$fav['fav'][0]->id)}}">
                           <p>Favourite <i class="fas fa-check"></i></p>
                        </a>
                     </div>
                     <!-- /PREVIEW ACTION -->
                     @endif

                  </div>
                  <!-- /PREVIEW ACTIONS -->
               </div>
               <!-- /PRODUCT PREVIEW ACTIONS -->
               <!-- PRODUCT INFO -->
               <div class="product-info">
                <a href="{{route('productView',$favourite->products->slug)}}">
                  <p class="text-header">{{substr($favourite->products->title,0,60).'...'}}</p>
                </a>
                <p class="product-description">{{substr($favourite->products->description,0,75).'...'}}</p>
                <p class="category primary">{{$favourite->products->productTypes->name}}</p>
                <p class="price"><span>$</span>{{$favourite->products->price}}</p>
              </div>
               <!-- /PRODUCT INFO -->
               <hr class="line-separator">
               <!-- USER RATING -->
               <div class="user-rating">
                  <a href="{{route('shopView',$favourite->products->shops->slug)}}">
                     <p class="text-header tiny">{{substr($favourite->products->shops->title,0,20)}}</p>
                  </a>
                  <?php $rating = App\Helpers\Helper_user::rating($favourite->products->id); ?>
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
          <h4>No Favourite Product Found!</h4>
        </div>
       @endif

      </div>
      <!-- /PRODUCT LIST -->
      <br>
       <!-- PAGER -->
       <div class="pager-lara" style="width: 100%;">
        {{$favourites->links()}}
       </div>
       <!-- /PAGER -->
   
</div>
<!-- DASHBOARD CONTENT -->



@endsection