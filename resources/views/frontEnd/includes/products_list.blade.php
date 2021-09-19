<div class="product-item column">
  @if($product->is_featured == 1)
    <span class="pin featured">Featured</span>
  @endif
   <!-- PRODUCT PREVIEW ACTIONS -->
   <div class="product-preview-actions">
      <!-- PRODUCT PREVIEW IMAGE -->
      <figure class="product-preview-image">
         <img src="{{url('/frontEnd/images/products/'.$product->photo)}}" alt="product-image">
      </figure>
      <!-- /PRODUCT PREVIEW IMAGE -->
      <!-- PREVIEW ACTIONS -->
      @if(Auth::check() && Auth::user()->permissions_id == 3)

      @else
        <div class="preview-actions">
         <!-- PREVIEW ACTION -->
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
         <!-- /PREVIEW ACTION -->
         <?php $cart = App\Helpers\Helper_user::check_cart($product->id); ?>
         @if($cart == 1)
          <!-- PREVIEW ACTION -->
           <div class="preview-action">
              <a onclick="return false;">
                 <div class="circle tiny secondary">
                    <span class="icon-present check"></span>
                 </div>
              </a>
              <a href="{{route('myCart')}}">
                 <p>In Cart  <i class="fas fa-check"> </i></p>
              </a>
           </div>
           <!-- /PREVIEW ACTION -->
         @elseif($cart == 0)
          <!-- PREVIEW ACTION -->
           <div class="preview-action">
              <a href="{{route('addCart',$product->slug)}}">
                 <div class="circle tiny secondary">
                    <span class="icon-present"></span>
                 </div>
              </a>
              <a href="{{route('addCart',$product->slug)}}">
                 <p>Add To Cart</p>
              </a>
           </div>
           <!-- /PREVIEW ACTION -->
         @endif
         <?php $fav = App\Helpers\Helper_user::check_fav($product->id); ?>
         @if($fav['status'] == 0)
          <!-- PREVIEW ACTION -->
           <div class="preview-action">
              <a href="{{route('favouriteProduct',$product->slug)}}">
                 <div class="circle tiny secondary">
                    <span class="icon-heart"></span>
                 </div>
              </a>
              <a href="{{route('favouriteProduct',$product->slug)}}">
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
      @endif
      <!-- /PREVIEW ACTIONS -->
   </div>
   <!-- /PRODUCT PREVIEW ACTIONS -->
   <!-- PRODUCT INFO -->
   <div class="product-info">
    <a href="{{route('productView',$product->slug)}}">
      <p class="text-header">{{$product->title}}</p>
    </a>
    <p class="category primary">{{$product->productTypes->name}}</p>
    <p class="price">{{$product->price}}<span>PKR</span></p>
  </div>
   <!-- /PRODUCT INFO -->
   <hr class="line-separator">
   <!-- USER RATING -->
   <div class="user-rating">
       @if(isset($product->shops))
      <a href="{{route('shopView',$product->shops->slug)}}">
         <p class="text-header tiny">{{substr($product->shops->title,0,20)}}</p>
      </a>
      @endif
     
      <?php $rating = App\Helpers\Helper_user::rating($product->id); ?>
      <ul class="rating tooltip tooltipstered">

         <li class="rating-item" style="margin-right: 1px;">
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