@extends('frontEnd.layout')
@section('content')
<style type="text/css">
    .post-image figure{
        background-size: contain !important;
    }
    .comment-list{
        border-top: 5px solid #00d7b3;
    }
    .button.big.purchase{
        padding-left: 45px;
    }
    .text-header{
        height: unset !important;
    }

</style>
@push('meta')
<meta property="og:image" content="{{url('frontEnd/images/products/'.$product->photo)}}"/>
<meta property="og:title" content="{{$product->title}}"/>
<meta property="og:description" content="{{$product->description}}"/>
@endpush
<!-- SECTION -->
<div class="section-wrap">
    <div class="section">
        <!-- SIDEBAR -->
        <div class="sidebar right">
            <!-- SIDEBAR ITEM -->
            <div class="sidebar-item void buttons">
                @if($product->original_price > $product->price )
                <span class="button big dark purchase">
                    <span  style=" text-decoration: line-through;" class="currency">{{$product->original_price}}</span>
                    <span  style=" text-decoration: line-through;" class="primary">PKR</span>
                </span>
                @endif
                <span class="button big dark purchase">
                    <span class="currency">{{$product->price}}</span>
                    <span class="primary">PKR</span>
                </span>
                @if(Auth::check() && Auth::user()->permissions_id == 3)
                    @if(Auth::user()->id == $product->user_id)
                        <a href="{{route('productEdit',$product->slug)}}" class="button big primary wcart">
                            <span class="icon-pencil"></span>
                            Edit Product
                        </a>
                    @endif
                @elseif($product->status != 'Renewal')
                    @if($product->quantity == 0)
                        <a onclick="return false;" class="button big primary wcart">
                            <span class="icon-ban"></span>
                            Out of Stock
                        </a>
                    @elseif($product->quantity != 0)
                        <?php $cart = App\Helpers\Helper_user::check_cart($product->id); ?>
                        @if($cart == 1)
                            <a  onclick="return false;" class="button big primary wcart">
                                <i class="fas fa-check"></i>
                                Added in Cart
                            </a>
                        @else
                          @if(isset($affiliator))
                            <a href="{{route('addCart',$product->slug.'?id='.$affiliator->id)}}" class="button big primary wcart">
                                <span class="icon-present"></span>
                                Add to the Cart
                            </a>
                            @else
                            <a href="{{route('addCart',$product->slug)}}" class="button big primary wcart">
                                <span class="icon-present"></span>
                                Add to the Cart
                            </a>
                            @endif
                        @endif
                    @endif
                    <?php $fav = App\Helpers\Helper_user::check_fav($product->id); ?>
                    @if($fav['status'] == 0)
                        <a href="{{route('favouriteProduct',$product->slug)}}" class="button big secondary wfav">
                            <span class="icon-heart"></span>
                            Add to Favourites
                        </a>
                    @else
                        <a href="{{route('unFavouriteProduct',$fav['fav'][0]->id)}}" class="button big secondary wfav">
                            <i class="fas fa-heart"></i>
                            Added in Favourites
                        </a>
                    @endif
                @endif
                <a onclick="phone('{{$product->shops->users->phone}}');" class="button big secondary wfav">
                    <i style="color: white;" class="fas fa-phone"></i>
                    <div id="phone">
                        Show Number
                    </div>
                </a>
                <script type="text/javascript">
                    function  phone(phone_no) {
                        $('#phone').text(phone_no);
                    }
                </script>
            </div>
            <!-- /SIDEBAR ITEM -->
            <div class="sidebar-item product-info">
                <h4>Product Information</h4>
               <hr class="line-separator">
               <!-- INFORMATION LAYOUT -->
               <div class="information-layout v2">
                    <!-- INFORMATION LAYOUT ITEM -->
                  <div class="information-layout-item">
                     <p class="text-header">Stock:</p>
                     <p>
                        @if($product->quantity == 0)
                            Out of Stock
                        @elseif($product->quantity != 0)
                           Available
                        @endif
                     </p>
                  </div>
                  <!-- /INFORMATION LAYOUT ITEM -->
                  <!-- INFORMATION LAYOUT ITEM -->
                  <div class="information-layout-item">
                     <p class="text-header">Product Type:</p>
                     <p>{{$product->productTypes->name}}</p>
                  </div>
                  <!-- /INFORMATION LAYOUT ITEM -->
                  <!-- INFORMATION LAYOUT ITEM -->
                  <div class="information-layout-item">
                     <p class="text-header">Category:</p>
                     <p>{{$product->categories->name}}->{{$product->subCategories->name}}</p>
                  </div>
                  <!-- /INFORMATION LAYOUT ITEM -->
                  <!-- INFORMATION LAYOUT ITEM -->
                  @if(isset($product->shop))
                  <div class="information-layout-item">
                     <p class="text-header">Shop:</p>
                     <a href="{{route('shopView',$product->shops->slug)}}">
                         <p>{{$product->shops->title}}</p>
                     </a>
                  </div>
                  @else
                  <div class="information-layout-item">
                     <p class="text-header">Shop:</p>
                     <a href="#">
                         <p>E-Bazarr Mall</p>
                     </a>
                  </div>
                  @endif

                  <!-- /INFORMATION LAYOUT ITEM -->

               </div>
               <!-- INFORMATION LAYOUT -->
            </div>

            <!-- SIDEBAR ITEM -->
            @if(isset($product->shop))
            <div class="sidebar-item author-bio short">
                <h4>Product Owner</h4>
                <hr class="line-separator">
                <!-- USER AVATAR -->
                <a href="{{route('shopOwner',$product->shops->users->user_name)}}" class="user-avatar-wrap medium">
                    <figure class="user-avatar medium">
                        @if(!empty($product->users->photo))
                            <img src="{{url('frontEnd/images/avatars/'.$product->users->photo)}}" alt="">
                        @else
                            <img src="{{url('frontEnd/images/avatars/unknown.jpg')}}" alt="">
                        @endif
                    </figure>
                </a>
                <!-- /USER AVATAR -->
                <a href="{{route('shopOwner',$product->shops->users->user_name)}}">
                    <p class="text-header">{{$product->users->user_name}}</p>
                </a>
                <p class="text-oneline">{{substr($product->shops->description,0,50).' . . .'}}</p>
                <div class="clearfix"></div>
                <br>
                @if(Auth::check() && Auth::user()->permissions_id == 3)
                    <a href="{{route('dashboard')}}" class="button mid dark spaced">Go To <span class="primary">Dashboard</span></a>
                @else
                    <a href="{{route('chat',$product->users->user_name)}}" class="button mid dark spaced">Chat <span class="primary">Now</span></a>
                @endif
            </div>
            @endif
            <!-- /SIDEBAR ITEM -->

            <!-- SIDEBAR ITEM -->
            @if(count($moreProducts)>0)
                <div class="sidebar-item author-items-v2">
                    <h4>This Shop's Hot Products</h4>
                    <hr class="line-separator">
                    <!-- ITEM PREVIEW -->
                    @foreach($moreProducts as $m_pro)
                        <div class="item-preview">
                            <a href="{{route('productView',$m_pro->slug)}}">
                                <figure class="product-preview-image small liquid">
                                    <img src="{{url('/frontEnd/images/products/'.$m_pro->photo)}}" alt="">
                                </figure>
                            </a>
                            <a href="{{route('productView',$m_pro->slug)}}"><p class="text-header small">{{substr($m_pro->title,0,40).'...'}}</p></a>
                            <p class="category tiny primary">
                                <a href="{{route('productView',$m_pro->slug)}}">{{$m_pro->productTypes->name}}</a>
                            </p>
                            <p class="price">{{$m_pro->price}} <span>{{$m_pro->shops->currency}}</span></p>
                        </div>
                    @endforeach
                    <!-- /ITEM PREVIEW -->
                </div>
            @endif
            <!-- /SIDEBAR ITEM -->
        </div>
        <!-- /SIDEBAR -->

      @if(auth()->check() && !isset($affiliator) && auth()->user()->permissions_id == 5)

        <div style="text-align: center; margin: 1%">
            <a onclick="copyToClipboard('#copy')" id="copy" href="{{url('product/'.$product->slug.'?id='. auth()->user()->id)}}" style="color: #37c9ff">Click here to get affliate link</a>
        </div>

        @elseif(isset($affiliator))
         <div style="text-align: center; margin: 1%">
             <p style="color: #37c9ff">You are referred by: {{$affiliator->user_name}}</p>
         </div>
        @endif

        <!-- CONTENT -->
        <div class="content left">
            <!-- POST -->
            <article class="post">
                <div class="post-title-head">
                    <h3>{{$product->title}}</h3>
                </div>
                <!-- POST IMAGE -->
                <div class="post-image">
                    <figure class="product-preview-image large liquid">
                        <img style="width: 100%;" src="{{url('frontEnd/images/products/'.$product->photo)}}" alt="">
                    </figure>
                </div>
                <!-- /POST IMAGE -->

                <!-- POST IMAGE SLIDES -->
                @if(count($product->galleries)>0)
                <div class="post-image-slides">
                    <!-- SLIDE CONTROLS -->
                    <div class="slide-control-wrap">
                        <div class="slide-control left">
                            <!-- SVG ARROW -->
                            <svg class="svg-arrow">
                                <use xlink:href="#svg-arrow"></use>
                            </svg>
                            <!-- /SVG ARROW -->
                        </div>

                        <div class="slide-control right">
                            <!-- SVG ARROW -->
                            <svg class="svg-arrow">
                                <use xlink:href="#svg-arrow"></use>
                            </svg>
                            <!-- /SVG ARROW -->
                        </div>
                    </div>
                    <!-- /SLIDE CONTROLS -->

                    <!-- IMAGE SLIDES WRAP -->
                    <div class="image-slides-wrap">
                        <!-- IMAGE SLIDES -->
                        <div class="image-slides" data-slide-visible-full="6"
                                                  data-slide-visible-small="2"
                                                  data-slide-count="{{count($product->galleries)+1}}">
                            <!-- IMAGE SLIDE -->
                            <div class="image-slide selected">
                                <div class="overlay"></div>
                                <figure class="product-preview-image thumbnail liquid">
                                    <img src="{{url('frontEnd/images/products/'.$product->photo)}}" alt="">
                                </figure>
                            </div>
                                @foreach($product->galleries as $gallery)
                                    <div class="image-slide ">
                                        <div class="overlay"></div>
                                        <figure class="product-preview-image thumbnail liquid">
                                            <img src="{{url('frontEnd/images/products/gallery/'.$gallery->photo)}}" alt="">
                                        </figure>
                                    </div>
                                @endforeach
                            <!-- /IMAGE SLIDE -->
                        </div>
                        <!-- IMAGE SLIDES -->
                    </div>
                    <!-- IMAGE SLIDES WRAP -->
                </div>
                @endif
                <!-- /POST IMAGE SLIDES -->

                <hr class="line-separator">

                <!-- POST CONTENT -->
                <div class="post-content">
                    <!-- POST PARAGRAPH -->
                    <div class="post-paragraph">
                        <h3 class="post-title">Description</h3>
                        <p><?php echo $product->description; ?></p>
                    </div>
                    <!-- /POST PARAGRAPH -->

                    <!-- <iframe src="http://player.vimeo.com/video/109558222" class="video"></iframe> -->

                    <div class="clearfix"></div>
                </div>
                <!-- /POST CONTENT -->
            </article>
            <!-- /POST -->
            <!-- COMMENTS -->

            <?php $rating = App\Helpers\Helper_user::rating($product->id); ?>
                <div class="comment-list">
                    <div class="comment-wrap" style="padding: 23px 16px 0 10px;">
                        <div class="comment">
                            <h4 style="font-size: 25px;" class="text-header">Customer Reviews</h4>
                            <span class="report" id="rating-box"><p>
                                <h4 style="font-size: 25px;">
                                    {{$rating}}
                                </h4>
                                <i class="fas fa-star"></i>
                            </p></span>
                        </div>
                    </div>
            @if(count($product->reviews)>0)
                @foreach($product->reviews as $review)
                        <!-- COMMENT -->
                        <div class="comment-wrap">
                            <!-- USER AVATAR -->
                            <a href="user-profile.html">
                                <figure class="user-avatar medium">
                                    @if(!empty(Auth::user()->photo))
                                        <img src="{{url('/frontEnd/images/avatars/',Auth::user()->photo)}}" alt="">
                                    @else
                                        <img src="{{url('/frontEnd/images/avatars/unknown.jpg')}}" alt="">
                                    @endif
                                </figure>
                            </a>
                            <!-- /USER AVATAR -->
                            <div class="comment">
                                <p class="text-header">{{$review->users->user_name}}</p>
                                <!-- PIN -->
                                <span style="background-color: #00d7b3;font-size: 14px;" class="pin greyed">{{number_format($review->rating,1)}}
                                    <i style="margin-bottom: 2px; font-size: 11px;" class="fas fa-star"></i>
                                </span>
                                <!-- /PIN -->
                                <!-- <p class="timestamp">5 Hours Ago</p> -->
                                <!-- <a href="#" class="report">Report</a> -->
                                <p>{{$review->review}}</p>
                            </div>
                        </div>
                        <!-- /COMMENT -->

                        <!-- LINE SEPARATOR -->
                        <hr class="line-separator">
                        <!-- /LINE SEPARATOR -->

                @endforeach

            @else
            <br><br>
                <h6>Not Rated Yet!</h6>
            @endif

                        <div class="clearfix"></div>

                    </div>
            <!-- /COMMENTS -->
        </div>
        <!-- CONTENT -->
    </div>
</div>
<script>
    function copyToClipboard(element) {
     event.preventDefault()
      var $temp = $("<input>");
      $("body").append($temp);
      $temp.val($(element).attr('href')).select();
      document.execCommand("copy");
      alert('Affiliate Link Copied');
      $temp.remove();
    }
</script>
<!-- /SECTION -->
@endsection
