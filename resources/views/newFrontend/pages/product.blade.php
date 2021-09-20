@extends('newFrontend.layout')

@section('main_content')
@push('meta')
<meta property="og:image" content="{{url('frontEnd/images/products/'.$product->photo)}}"/>
<meta property="og:title" content="{{$product->title}}"/>
<meta property="og:description" content="{{$product->description}}"/>
@endpush
<div class="ps-breadcrumb">
    <div class="ps-container">

    </div>
</div>
<div class="ps-page--product">
    <div class="ps-container">
        <div class="ps-page__container">
            <div class="ps-page__left">
                <div class="ps-product--detail ps-product--fullwidth">

                  @if(auth()->check() && !isset($affiliator) && auth()->user()->permissions_id == 5)
                  <div style="text-align:center">
                      <a onclick="copyToClipboard('#copy')" id="copy" style="color:#ffc107" href="{{url('product/'.$product->slug.'?id='. auth()->user()->id)}}">Click here to get affliate link</a>
                  </div>
                  @elseif(isset($affiliator))
                  <div style="text-align:center">
                    <h5 style="color:#ffc107">You are referred by: {{$affiliator->user_name}}</h5>
                  </div>

                  @endif

                  <br>
                  <br>
                    <div class="ps-product__header">

                        <div class="ps-product__thumbnail" data-vertical="true">
                            <figure>
                                <div class="ps-wrapper">
                                    <div class="ps-product__gallery" data-arrow="true">

                                        @foreach($product->galleries as $gallery)
                                          <div class="item"><a href="{{url('frontEnd/images/products/gallery/'.$gallery->photo)}}"><img src="{{url('frontEnd/images/products/gallery/'.$gallery->photo)}}" alt=""></a></div>
                                        @endforeach

                                    </div>
                                </div>
                            </figure>
                            <div class="ps-product__variants" data-item="4" data-md="4" data-sm="4" data-arrow="false">

                                @foreach($product->galleries as $gallery)
                                  <div class="item"><img src="{{url('frontEnd/images/products/gallery/'.$gallery->photo)}}" alt=""></div>
                                @endforeach
                            </div>
                        </div>
                        <div class="ps-product__info">
                            <h1>{{$product->title}}</h1>
                            <div class="ps-product__meta">

                                <div class="ps-product__rating">
                                    <select class="ps-rating" data-read-only="true">
                                        <option value="1">1</option>
                                        <option value="1">2</option>
                                        <option value="1">3</option>
                                        <option value="1">4</option>
                                        <option value="2">5</option>
                                    </select><span>(1 review)</span>
                                </div>
                            </div>
                            <h4 class="ps-product__price">
                              @if($product->original_price > $product->price )
                                {{$product->original_price}} PKR
                              @else
                              {{$product->price}}
                              <del>{{$product->original_price}} PKR</del>

                              @endif
                            </h4>


                            <div class="ps-product__desc">
                                @if(isset($product->shop))
                                <p>Sold By: <a href="#"><strong>{{$product->shops->title}}</strong></a></p>

                                @else
                                <p>Sold By: <a href="#"><strong>E-bazarr Mall</strong></a></p>
                                @endif
                                <ul class="ps-list--dot">
                                    <li> {{substr($product->description,0,25)}}...</li>

                                </ul>
                            </div>

                            <div class="ps-product__shopping">

                                @if(Auth::check() && Auth::user()->permissions_id == 3)
                                <a class="ps-btn ps-btn--black" href="{{route('productEdit',$product->slug)}}">Edit Product</a>
                                @elseif($product->status != 'Renewal')
                                    @if($product->quantity == 0)
                                      <h1>Out of Stock</h1>

                                    @elseif($product->quantity > 0)
                                      <?php $cart = App\Helpers\Helper_user::check_cart($product->id); ?>
                                        @if($cart == 1)
                                          <a class="ps-btn ps-btn--yellow" href="#">Added in cart</a>

                                        @else
                                            @if(isset($affiliator))
                                                <a class="ps-btn ps-btn--black" href="{{route('addCart',$product->slug.'?id='.$affiliator->id)}}">Add to cart</a>
                                            @else
                                                <a class="ps-btn ps-btn--black" href="{{route('addCart',$product->slug)}}">Add to cart</a>
                                            @endif

                                         @endif
                                    @endif



                                @endif

                            </div>
                            <div class="ps-product__specification">
                                <p><strong>Contact:</strong>{{$product->shops->users->phone}}</p>
                                <p class="categories"><strong> Category:</strong><a href="#">{{$product->categories->name}} - {{$product->subCategories->name}}</a></p>
                                <p class="tags"><strong>Product type</strong><a href="#">{{$product->productTypes->name}}</a></p>
                            </div>
                            <div class="ps-product__sharing"><a class="facebook" href="#"><i class="fa fa-facebook"></i></a><a class="twitter" href="#"><i class="fa fa-twitter"></i></a><a class="google" href="#"><i class="fa fa-google-plus"></i></a><a class="linkedin" href="#"><i class="fa fa-linkedin"></i></a><a class="instagram" href="#"><i class="fa fa-instagram"></i></a></div>
                        </div>
                    </div>
                    <div class="ps-product__content ps-tab-root">
                        <ul class="ps-tab-list">
                            <li class="active"><a href="#tab-1">Description</a></li>

                        </ul>
                        <div class="ps-tabs">
                            <div class="ps-tab active" id="tab-1">
                                <div class="ps-document">
                                    <?php echo $product->description; ?>
                                </div>
                            </div>
                            <div class="ps-tab active" id="tab-6">
                                <p>Sorry no more offers available</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="ps-page__right">
                <aside class="widget widget_product widget_features">
                    <p><i class="icon-network"></i> Shipping worldwide</p>
                    <p><i class="icon-3d-rotate"></i> Free 7-day return if eligible, so easy</p>
                    <p><i class="icon-receipt"></i> Supplier give bills for this product.</p>
                    <p><i class="icon-credit-card"></i> Pay online or when receiving goods</p>
                </aside>
                <aside class="widget widget_sell-on-site">
                    <p><i class="icon-store"></i> Sell on E-bazarr?<a href="{{route('register')}}"> Register Now !</a></p>
                </aside>
                <aside class="widget widget_ads"><a href="#"><img src="img/ads/product-ads.png" alt=""></a></aside>

            </div>
        </div>
        @if(count($moreProducts)>0)
        <div class="ps-section--default">
            <div class="ps-section__header">
                <h3>This Shop's Hot Products</h3>
            </div>
            <div class="ps-section__content">
                <div class="ps-carousel--nav owl-slider" data-owl-auto="true" data-owl-loop="false" data-owl-speed="10000" data-owl-gap="30" data-owl-nav="true" data-owl-dots="true" data-owl-item="6" data-owl-item-xs="2" data-owl-item-sm="2" data-owl-item-md="3" data-owl-item-lg="4" data-owl-item-xl="5" data-owl-duration="1000" data-owl-mousedrag="on">
                  @foreach($moreProducts as $m_pro)
                    <div class="ps-product">
                        <div class="ps-product__thumbnail"><a href="{{route('productView',$m_pro->slug)}}"><img src="{{url('/frontEnd/images/products/'.$m_pro->photo)}}" alt="" /></a>

                        </div>
                        <div class="ps-product__container">
                            <div class="ps-product__content"><a class="ps-product__title" href="{{route('productView',$m_pro->slug)}}">{{substr($m_pro->title,0,30).'...'}}</a>
                                <div class="ps-product__rating">
                                    <select class="ps-rating" data-read-only="true">
                                        <option value="1">1</option>
                                        <option value="1">2</option>
                                        <option value="1">3</option>
                                        <option value="1">4</option>
                                        <option value="2">5</option>
                                    </select><span>01</span>
                                </div>
                                <p class="ps-product__price">{{$m_pro->price}} PKR</p>
                            </div>
                            <div class="ps-product__content hover"><a class="ps-product__title" href="{{route('productView',$m_pro->slug)}}">{{substr($m_pro->title,0,30).'...'}}</a>
                                <p class="ps-product__price">{{$m_pro->price}} PKR</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection

@push('jss')
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
@endpush
