@extends('frontEnd.layout')

@section('content')

<style>
        .carousel-inner{
            height: 500px !important;
        }
        .search-widget-form .select-block {
            float: left;
            width: 177px;
            margin-right: 16px;
        }
        .item.item4 .carousel-desc {
    text-align: center !important;
}

 html, body{
    width:100%;
    height:90%;
    background-color:#fff;
    font-family: 'Sansita', sans-serif;
    }
.carousel-inner,.carousel,.item,.container,.fill {
  height:100%;
  width:100%;
  background-position:center center;
  background-size:cover;
}
.slide-wrapper{display:inline;}
.slide-wrapper .container{padding:0px;}

/*------------------------------ vertical bootstrap slider----------------------------*/

.carousel-inner> .item.next ,  .carousel-inner > .item.active.right{ transform: translateY(100%); -webkit-transform: translateY(100%); -ms-transform: translateY(100%);
-moz-transform: translateY(100%); -o-transform: translateY(100%);  top: 0;left:0;}
.carousel-inner > .item.prev ,.carousel-inner > .item.active.left{ transform: translateY(-100%); -webkit-transform: translateY(-100%);  -moz-transform: translateY(-100%);
-ms-transform: translateY(-100%); -o-transform: translateY(-100%); top: 0; left:0;}
.carousel-inner > .item.next.left , .carousel-inner > .item.prev.right , .carousel-inner > .item.active{transform:translateY(0); -webkit-transform:translateY(0);
-ms-transform:translateY(0);-moz-transform:translateY(0); -o-transform:translateY(0); top:0; left:0;}

/*------------------------------- vertical carousel indicators ------------------------------*/
.carousel-indicators{
position:absolute;
top:0;
bottom:0px;
margin:auto;

right:10px; left:auto;
width:auto;

}

/*-------- Animation slider ------*/

.animated{
    animation-duration:3s;
    -webkit-animation-duration:3s;
    -moz-animation-duration:3s;
    -ms-animation-duration:3s;
    -o-animation-duration:3s;
    visibility:visible;
    opacity:1;
    transition:all 0.3s ease;
}
.carousel-img{
     display: inline-block;
    margin: 0 auto;
    width: 100%;
    text-align: center;
    }
.item img{margin:auto;visibility:hidden; opacity:0; transition:all 0.3s ease; -webkit-transition:all 0.3s ease; -moz-transition:all 0.3s ease; -ms-transition:all 0.3s ease; -o-transition:all 0.3s ease;}
.item1 .carousel-img img , .item1.active .carousel-img img{max-height:300px;}
.item1.active .carousel-img img.animated{visibility:visible; opacity:1; transition:all 1s ease; -webkit-transition:all 1s ease; -moz-transition:all 1s ease; -ms-transition:all 1s ease; -o-transition:all 1s ease;
animation-duration:2s; -webkit-animation-duration:2s; -moz-animation-duration:2s; -ms-animation-duration:2s; -o-animation-duration:2s; animation-delay:0.3s ; -webkit-animation-delay:0.3s;
-moz-animation-delay:0.3s;-ms-animation-delay:0.3s; }
.item .carousel-desc{color:#fff; text-align:center;}
.item  h2{font-size:50px; animation-delay:1.5s;animation-duration:1s; }
.item  p{animation-delay:2.5s;animation-duration:1s; width:50%; margin:auto;}

.item2 .carousel-img img , .item2.active .carousel-img img{max-height:300px;}
.item2.active .carousel-img img.animated{visibility:visible; opacity:1; transition:all 0.3s ease; animation-duration:3s; animation-delay:0.3s}
.item2 h2 , item2.active h2{visibility:hidden; opacity:0; transition:all 5s ease;}
.item2.active h2.animated{visibility:visible; opacity:1;  animation-delay:3s;}

.item .fill{padding:0px 30px; display:table; }
.item .inner-content{display: table-cell;vertical-align: middle;}
.item3 .col-md-6{float:none; display:inline-block; vertical-align:middle; width:49%;}

.item3.active .carousel-img img.animated{visibility:visible; opacity:1; transition:all 0.3s ease; animation-duration:2s; animation-delay:0.3s}
.item3 h2 , item3.active h2{visibility:hidden; opacity:0; transition:all 5s ease; }
.item.item3 .carousel-desc{text-align:left;}
.item3.active h2.animated{visibility:visible; opacity:1;  animation-delay:1.5s}
.item3 p , item3.active p{visibility:hidden; opacity:0; transition:all 5s ease; width:100%;  }
.item3.active p.animated{visibility:visible; opacity:1;  animation-delay:2.5s;}

.item4 .col-md-6{float:none; display:inline-block; vertical-align:middle; width:49%;}

.item4.active .carousel-img img.animated{visibility:visible; opacity:1; transition:all 0.3s ease; animation-duration:2s; animation-delay:0.3s}
.item4 h2 , item4.active h2{visibility:hidden; opacity:0; transition:all 5s ease; }
.item.item4 .carousel-desc{text-align:left;}
.item4.active h2.animated{visibility:visible; opacity:1;  animation-delay:1.5s}
.item4 p , item4.active p{visibility:hidden; opacity:0; transition:all 5s ease; width:100%;  }
.item4.active p.animated{visibility:visible; opacity:1;  animation-delay:2.5s;}

.item5 .col-md-6{float:none; display:inline-block; vertical-align:middle; width:49%;}

.item5.active .carousel-img img.animated{visibility:visible; opacity:1; transition:all 0.3s ease; animation-duration:2s; animation-delay:0.3s}
.item5 h2 , item5.active h2{visibility:hidden; opacity:0; transition:all 5s ease; }
.item.item5 .carousel-desc{text-align:left;}
.item5.active h2.animated{visibility:visible; opacity:1;  animation-delay:1.5s}
.item5 p , item5.active p{visibility:hidden; opacity:0; transition:all 5s ease; width:100%;  }
.item5.active p.animated{visibility:visible; opacity:1;  animation-delay:2.5s;}

@media(max-width:991px)
{
    .item .carousel-desc , .item.item3 .carousel-desc{text-align:center;}
    .item .carousel-desc p {width:80%;}
    .item3 .col-md-6{width:100%; text-align:center;}
}
@media(max-width:768px)
{
.item .carousel-img img, .item.active .carousel-img img{max-height:155px;}
.item  h2{font-size:30px; margin-top:0px;}
.item .carousel-desc p{width:100%; font-size:12px;}
}
@media(max-width:480px)
{
.item  h2{font-size:30px;}
.item .carousel-desc p{width:100%;}
}

.search-div{
position: relative !important;
margin-top: 145px !important;
}
#services-wrap {
    background-color: #f5f5f5 !important;
}
html{
    background-color: #f5f5f5 ;

}
@media only screen and (max-width: 600px) {

    .search-widget {
    width: 319px !important;
    height: 170px !important;
    padding: 7px 0 0 2px !important;
    /* margin: 10px auto; */
    border-radius: 4px;
    position: absolute;
    /* left: 50%; */
    /* margin-left: -485px; */
    background: url(../images/searchbar_texture.png) no-repeat center, linear-gradient(to right, #05e6aa, #1cbdf9);
    background-size: cover;
    display: flex;
}
.search-widget-form input {
   width: 99% !important;
}
.search-widget-form .select-block {
    float: left;
    width: 177px !important;
    margin-right: 16px !important;
}
.search-widget-form select {
    font-size: 1.07692em;
    border-left: none;
    border-top-left-radius: 0;
    border-bottom-left-radius: 0;
    width: 313px !important;
}
.search-widget-form .select-block .svg-arrow {
    width: 4px;
    height: 8px;
    top: 22px !important;
    right: -105px !important;
}
.button.medium {
    width: 311px !important;
    height: 50px !important;
    line-height: 50px;
    font-size: 1em !important;
}
.search-div{
    position: relative !important;
    margin-top: 150px !important;
    padding-bottom: 39px !important;
}
}
</style>

<script type="text/javascript">



    $(document).ready(function(){
// invoke the carousel
    $('#myCarousel').carousel({
      interval:6000
    });

// scroll slides on mouse scroll
$('#myCarousel').bind('mousewheel DOMMouseScroll', function(e){

        if(e.originalEvent.wheelDelta > 0 || e.originalEvent.detail < 0) {
            $(this).carousel('prev');


        }
        else{
            $(this).carousel('next');

        }
    });

//scroll slides on swipe for touch enabled devices
    $("#myCarousel").on("touchstart", function(event){

        var yClick = event.originalEvent.touches[0].pageY;
        $(this).one("touchmove", function(event){

        var yMove = event.originalEvent.touches[0].pageY;
        if( Math.floor(yClick - yMove) > 1 ){
            $(".carousel").carousel('next');
        }
        else if( Math.floor(yClick - yMove) < -1 ){
            $(".carousel").carousel('prev');
        }
    });
    $(".carousel").on("touchend", function(){
            $(this).off("touchmove");
    });
});

});
//animated  carousel start
$(document).ready(function(){

//to add  start animation on load for first slide
$(function(){
        $.fn.extend({
            animateCss: function (animationName) {
                var animationEnd = 'webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend';
                this.addClass('animated ' + animationName).one(animationEnd, function() {
                    $(this).removeClass(animationName);
                });
            }
        });
             $('.item1.active img').animateCss('slideInDown');
             $('.item1.active h2').animateCss('zoomIn');
             $('.item1.active p').animateCss('fadeIn');

});

//to start animation on  mousescroll , click and swipe
  $("#myCarousel").on('slide.bs.carousel', function () {
        $.fn.extend({
            animateCss: function (animationName) {
                var animationEnd = 'webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend';
                this.addClass('animated ' + animationName).one(animationEnd, function() {
                    $(this).removeClass(animationName);
                });
            }
        });

// add animation type  from animate.css on the element which you want to animate

        $('.item1 img').animateCss('slideInDown');
        $('.item1 h2').animateCss('zoomIn');
        $('.item1 p').animateCss('fadeIn');

        $('.item2 img').animateCss('zoomIn');
        $('.item2 h2').animateCss('swing');
        $('.item2 p').animateCss('fadeIn');

        $('.item3 img').animateCss('fadeInLeft');
        $('.item3 h2').animateCss('fadeInDown');
        $('.item3 p').animateCss('fadeIn');

        $('.item4 img').animateCss('fadeInLeft');
        $('.item4 h2').animateCss('fadeInDown');
        $('.item4 p').animateCss('fadeIn');

        $('.item5 img').animateCss('fadeInLeft');
        $('.item5 h2').animateCss('fadeInDown');
        $('.item5 p').animateCss('fadeIn');
    });
});

</script>
 <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

   <link href="https://fonts.googleapis.com/css?family=Sansita" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">

<div class="text-center">
    @if(Session::has('message'))
    <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
    @endif
</div>

    <section class="slide-wrapper">

            <div id="myCarousel" class="carousel slide" style="height: 70%">
                <!-- Indicators -->
                <ol class="carousel-indicators" style="height: 0px; margin-bottom: 340px">
                    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                    <li data-target="#myCarousel" data-slide-to="1"></li>
                    <li data-target="#myCarousel" data-slide-to="2"></li>
                     <li data-target="#myCarousel" data-slide-to="3"></li>
                      <li data-target="#myCarousel" data-slide-to="4"></li>
                 </ol>

                <!-- Wrapper for slides -->
                <div class="carousel-inner">

                  @php
                    $count=1
                  @endphp

                  @foreach($slider as $key=>$slid)
                    <div class="item item{{$key+1}} @if($count==1) active @endif">
                      @php
                        $count++
                      @endphp
                        <div class="fill" style=" background-color:#48c3af;">
                            <a href="{{route('productView',$slid->slug)}}">
                            <div class="inner-content">
                                <div class="carousel-img">
                                    <img src="{{url('/frontEnd/images/products/'.$slid->photo)}}" class="img img-responsive" />
                                </div>
                                <div class="carousel-desc">

                                    <h2> <a href="{{route('productView',$slid->slug)}}">{{$slid->title}}</a></h2>
                                    <p>{{$slid->description}}</p>

                                </div>
                            </div>

                        </div>
                    </div>
                    @endforeach

                </div>
            </div>
        </div>
    <!-- BANNER -->
   <!--  <div class="banner-wrap">
        <section class="banner">
            <h5>Welcome to</h5>
            <h1>The Biggest <span>Marketplace</span></h1>
            <p>Set up your own eCom Store in minutes and start selling your products and services worldwide!</p>
            <img src="{{url('/frontEnd/images/top_items.png')}}" alt="banner-img">
 -->
            <!-- SEARCH WIDGET -->

            <!-- /SEARCH WIDGET -->
        </section>
    </div>
    <div class="search-div">
                <div class="search-widget">
                <form class="search-widget-form" method="get" action="{{route('searchProduct')}}">
                    <input type="text" name="keyword" style="width:323px;" required="" placeholder="Search products or services here...">
                    <label for="category" class="select-block">
                        <select name="category" id="category" required="">
                            <option value="All">All</option>
                            @foreach($categories as $category)
                                <option value="{{$category->slug}}">{{$category->name}}</option>
                            @endforeach
                        </select>
                        <!-- SVG ARROW -->
                        <svg class="svg-arrow">
                            <use xlink:href="#svg-arrow"></use>
                        </svg>
                        <!-- /SVG ARROW -->
                    </label>

                        <div id="sub_category_div"
                            <?php
                              if(empty($q['category']) || $q['category'] == 'All'){
                                echo "style='display:none;'";
                              }
                            ?>
                          >
                            {{-- <label for="sub_category">Choose Sub Category</label> --}}
                            <label for="category" class="select-block">
                            <select name="sub_category" id="sub_category">
                              <?php
                                if(!empty($q['category']) && $q['category'] != 'All'){
                                  echo '<option selected="" value="All">All</option>';
                                  foreach($sub_categories as $sub_cat){
                                    if(!empty($q['sub_category']) && $q['sub_category'] != 'All' ){
                                      if ($q['sub_category'] == $sub_cat->slug) {
                                        echo "<option selected value='".$sub_cat->slug."'>".$sub_cat->name."</option>";
                                      }
                                      else{
                                        echo "<option value='".$sub_cat->slug."'>".$sub_cat->name."</option>";
                                      }
                                    }
                                    else{
                                      echo "<option value='".$sub_cat->slug."'>".$sub_cat->name."</option>";
                                    }
                                  }
                                }
                              ?>
                            </select>
                            <svg class="svg-arrow">
                                <use xlink:href="#svg-arrow"></use>
                            </svg>
                            <!-- /SVG ARROW -->
                          </div>
                        <!-- SVG ARROW -->

                    </label>

                    <button class="button medium dark">Search Now!</button>
                </form>
            </div>
           </div>
    <!-- /BANNER -->
    <!-- Products SIDESHOW -->
    <div id="product-sideshow-wrap">
        <div id="product-sideshow">


            <!-- Shop SHOWCASE -->
            <div class="product-showcase">
                <!-- HEADLINE -->
                <div class="headline secondary">
                   <a href="/products/search?ebazarr=yes" style="text-decoration: none!important; color:black"> <h4>Ebazarr mall</h4> </a>
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
                </div>
                <!-- /HEADLINE -->

                     <!-- PRODUCT LIST -->
                <div id="pl-3" class="product-list grid column4-wrap owl-carousel">
                    <!-- PRODUCT ITEM -->

                    <!-- /PRODUCT ITEM -->
                </div>
                <!-- /PRODUCT LIST -->

                <!-- PRODUCT LIST -->
                <div id="pl-4" class="product-list grid column4-wrap owl-carousel">
                    <!-- PRODUCT ITEM -->
                    @foreach($admin_products as $product)
                        @include('frontEnd.includes.products_list')
                    @endforeach
                    <!-- /PRODUCT ITEM -->
                </div>
                <!-- /PRODUCT LIST -->

                <!-- PRODUCT LIST -->

                <!-- /PRODUCT LIST -->
            </div>
            <!-- /PRODUCT SHOWCASE -->

            <!-- PRODUCT SHOWCASE -->
            <div class="product-showcase">
                <!-- HEADLINE -->
                <div class="headline primary">
                    <h4>Daily Sale   <span id='time' style="color:red"></span></h4>
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
                </div>
                <!-- /HEADLINE -->

                <!-- PRODUCT LIST -->
                <div id="pl-1" class="product-list grid column4-wrap owl-carousel">
                    <!-- PRODUCT ITEM -->

                    <!-- /PRODUCT ITEM -->
                </div>
                <!-- /PRODUCT LIST -->

                <!-- PRODUCT LIST -->
                <div id="pl-2" class="product-list grid column4-wrap owl-carousel">
                    <!-- PRODUCT ITEM -->
                    @foreach($daily_sales as $product)
                        @include('frontEnd.includes.products_list')
                    @endforeach
                    <!-- /PRODUCT ITEM -->
                </div>
                <!-- /PRODUCT LIST -->

                <!-- PRODUCT LIST -->

                <!-- /PRODUCT LIST -->
            </div>
            <!-- /PRODUCT SHOWCASE -->

              @if(count($all_products) > 0)
                    <!-- PRODUCT SHOWCASE -->
                <div class="product-showcase" >

                     <div class="headline primary">
                    <h4>All Products  </h4>
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
                </div>
                <!-- /HEADLINE -->
                    <!-- PRODUCT LIST -->
                    <div class="product-list grid column3-4-wrap" style="background-color: #f5f5f5 !important">
                        <!-- PRODUCT ITEM -->
                        @foreach($all_products as $product)
                          @if($product->is_featured == 1)
                            @include('frontEnd.includes.products_list')
                          @endif
                        @endforeach
                        @foreach($all_products as $product)
                          @if($product->is_featured == 0)
                            @include('frontEnd.includes.products_list')
                          @endif
                        @endforeach
                        <!-- /PRODUCT ITEM -->
                    </div>
                    <!-- /PRODUCT LIST -->
                </div>
                <!-- /PRODUCT SHOWCASE -->

                <!-- PAGER -->
                  <div style="width: 100%;float: left;">

                  </div>
                <!-- /PAGER -->
                @else
                    <h3>No product found against this search</h3>
                @endif
            </div>
            <!-- CONTENT -->




        </div>
    </div>
    <!-- PROMO -->
    <div class="promo-banner dark left">
        <span class="icon-wallet"></span>
        <h5 style="color: white;">Make money instantly!</h5>
        <h1 style="color: white;">Start <span>Selling</span></h1>
        @if(Auth::check() )
            @if(Auth::user()->permissions_id == 3)
                <a href="{{route('shopCreate')}}" class="button medium primary">Open Your Shop!</a>
            @else
                <a onclick="registerAsVendor()" class="button medium primary">Open Your Shop!</a>
            @endif
        @else
          <a href="{{route('register')}}" class="button medium primary">Open Your Shop!</a>
        @endif
        <div id="registerAsVendor" style="display: none;">
            <br>
            <h5 >Register as Vendor to Open Shop </h5>
        </div>
        <script type="text/javascript">
            function registerAsVendor(){
                $('#registerAsVendor').css('display','unset');
                return false;
            }
        </script>
    </div>
    <!-- /PROMO -->

    <!-- PROMO -->
    <div class="promo-banner secondary right">
        <span class="icon-tag"></span>
        <h5 style="color: white;">Find anything you want</h5>
        <h1 style="color: white;">Start Buying</h1>
        <a href="{{route('register')}}" class="button medium dark">Register Now!</a>
    </div>
    <!-- /PROMO -->
    <!-- SERVICES -->
    <div id="services-wrap" style="padding-top:300px;">
        <section id="services">
            <!-- SERVICE LIST -->
            <div class="service-list column4-wrap">
                <!-- SERVICE ITEM -->
                <div class="service-item column">
                    <div class="circle medium gradient"></div>
                    <div class="circle white-cover"></div>
                    <div class="circle dark">
                        <span class="icon-present"></span>
                    </div>
                    <h3>Buy &amp; Sell Easily</h3>
                    <p>Easily find  products and services near you or from the other side of the world. eBazarr is a worldwide buying and shopping digital marketplace.</p>
                </div>
                <!-- /SERVICE ITEM -->

                <!-- SERVICE ITEM -->
                <div class="service-item column">
                    <div class="circle medium gradient"></div>
                    <div class="circle white-cover"></div>
                    <div class="circle dark">
                        <span class="icon-lock"></span>
                    </div>
                    <h3>Easy Transaction</h3>
                    <p>ebazzar makes it easy to search and find the products or services you're looking for. Transactions are done between the buyers and the sellers. You deal directly with the other party.</p>
                </div>
                <!-- /SERVICE ITEM -->

                <!-- SERVICE ITEM -->
                <div class="service-item column">
                    <div class="circle medium gradient"></div>
                    <div class="circle white-cover"></div>
                    <div class="circle dark">
                        <span class="icon-like"></span>
                    </div>
                    <h3>Training</h3>
                    <p>Easily learn how to set up your store from training videos and online chat. We're here to help you succeed in your own eCommerce business. The world is your Marketplace, take advantage of eBazarr selling and marketing platform.</p>
                </div>
                <!-- /SERVICE ITEM -->

                <!-- SERVICE ITEM -->
                <div class="service-item column">
                    <div class="circle medium gradient"></div>
                    <div class="circle white-cover"></div>
                    <div class="circle dark">
                        <span class="icon-diamond"></span>
                    </div>
                    <h3>Earn Rewards</h3>
                    <p>Refer others and receive Reward Points. Use your Reward Points to purchase products and services from the eBazarr Marketplace.</p>
                </div>
                <!-- /SERVICE ITEM -->
            </div>
            <!-- /SERVICE LIST -->
            <div class="clearfix"></div>
        </section>
    </div>
    <!-- /SERVICES -->



    <div class="clearfix"></div>

       <!-- /PRODUCTS SIDESHOW -->
     <script type="text/javascript">
        $('#category').on('change',function(){
          var category_slug= $('#category').val();
          if (category_slug == 'All') {
            $('#sub_category').empty();
            $('#sub_category_div').css('display','none');
          }
          var route = '/get-sub-categories/by-slug';
          var url =  {!! json_encode(url('/')) !!}+'/'+route+'/'+category_slug;
          $('#sub_category').empty();
          $.get(url, function(result){
            $('#sub_category_div').css('display','unset');
            $('#sub_category').append('<option selected="" value="All">All</option>');
              $.each(result, function(key, value) {
                    $('#sub_category').append('<option value=' + value['slug'] + '>' + value['name'] + '</option>');
                });
          });
        });



        (function() {
          var start = new Date;
          start.setHours(24, 0, 0); // 11pm

          function pad(num) {
            return ("0" + parseInt(num)).substr(-2);
          }

          function tick() {
            var now = new Date;
            if (now > start) { // too late, go to tomorrow
              start.setDate(start.getDate() + 1);
            }
            var remain = ((start - now) / 1000);
            var hh = pad((remain / 60 / 60) % 60);
            var mm = pad((remain / 60) % 60);
            var ss = pad(remain % 60);
            document.getElementById('time').innerHTML =
              hh + ":" + mm + ":" + ss;
            setTimeout(tick, 1000);
          }

          document.addEventListener('DOMContentLoaded', tick);
        })();
        </script>
@endsection
