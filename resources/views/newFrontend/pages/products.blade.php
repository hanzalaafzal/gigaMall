@extends('newFrontend.layout')


@section('main_content')
<div class="ps-breadcrumb">
    <div class="ps-container">
        <ul class="breadcrumb">
            <li><a href="#">Home</a></li>
            <li>Products</li>
        </ul>
    </div>
</div>
<div class="ps-page--shop" id="shop-sidebar">
    <div class="container">
        <div class="ps-layout--shop">
            <div class="ps-layout__left">
                <aside class="widget widget_shop">
                  <form class="ps-form--widget-search" action="{{route('searchProduct')}}" enctype="multipart/form-data" method="get">
                    <h4 class="widget-title">Keywords</h4>

                        <input class="form-control" type="text" placeholder="Type keyword here" name="keyword">

                    <figure class="ps-custom-scrollbar" data-height="250">
                      <h4 class="widget-title">Categories</h4>
                        <div>
                          <select class="form-control" id="category" name="category">
                            <option selected="" value="All">All</option>
                            @foreach($categories as $category)
                              <option value="{{$category->slug}}"
                                <?php
                                  if(!empty($q['category'])){
                                    if($q['category'] == $category->slug){
                                      echo "selected";
                                    }
                                  }
                                ?>
                              > {{$category->name}}</option>
                            @endforeach
                          </select>
                        </div>
                        <div id="sub_category_div"
                          <?php
                            if(empty($q['category']) || $q['category'] == 'All'){
                              echo "style='display:none;'";
                            }
                          ?>
                        >
                          <label for="sub_category">Choose Sub Category</label>
                          <select name="sub_category" id="sub_category" class="form-control">
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
                        </div>

                    </figure>
                    <figure>
                        <h4 class="widget-title">Product Type</h4>

                          <?php $i=1; ?>
                          @foreach($product_types as $productType)
                          <div class="ps-checkbox">
                          <input class="form-control" type="checkbox" id="product_type{{$i}}" name="product_type[]" value="{{$productType->id}}"
                              <?php
                                if(!empty($q['product_type'])){
                                  foreach ($q['product_type'] as $p_type) {
                                    if ($p_type == $productType->id) {
                                      echo "checked";
                                    }
                                  }
                                }
                              ?>
                            >
                            <label for="product_type{{$i}}"><span>{{$productType->name}}</span></label>

                            <?php $i++; ?>
                            </div>
                          @endforeach
                    </figure>
                    <figure>
                        <h4 class="widget-title">Stock</h4>
                        <div class="ps-checkbox">
                          <input class="form-control" type="checkbox" id="stock" name="stock" value="1"
                            <?php
                              if(!empty($q['stock'])){
                                echo "checked";
                              }
                            ?>
                          >
                          <label for="stock">
                              <span class="checkbox primary primary"><span></span></span>
                              In Stock
                              <!-- <span class="quantity">350</span> -->
                          </label>
                        </div>

                    </figure>
                    <figure>
                        <h4 class="widget-title">Price Range</h4>
                        <div>
                            <label for="">Min</label>
                            <input type="text" class="form-control" name="min"
                            <?php
                              if(!empty($q['min'])){
                                echo "value='".$q['min']."'";
                              }
                            ?>
                          >
                            <br>
                            <label for="">Max</label>
                            <input type="text" class="form-control" name="max"
                            <?php
                              if(!empty($q['max'])){
                                echo "value='".$q['max']."'";
                              }
                            ?>
                            >
                        </div>
                        <br>
                        <div style="padding-bottom:10px">
                          <button type="submit" name="button" class="btn btn-lg btn-primary float-right" style="top:100%;border: none;font-weight: 700;padding: 0 24px;border-radius:4px;background-color:#20c997;color:#000;height:40px;">Search</button>
                        </div>
                        @if(isset($q['ebazarr']))
                             <input type="hidden" name="ebazarr" value="yes">
                        @endif

                    </figure>
                    </form>
                </aside>
            </div>
            <div class="ps-layout__right">
                <div class="ps-shopping ps-tab-root">
                    <div class="ps-shopping__header">
                        <p><strong> {{$count}}</strong> Products found</p>

                    </div>
                    <div class="ps-tabs">
                        <div class="ps-tab active" id="tab-1">
                            <div class="ps-shopping-product">
                                <div class="row">

                                      @if(count($products) > 0)

                                            @foreach($products as $product)
                                            <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6 col-6 ">

                                                @include('newFrontend.includes.product_list')

                                              </div>
                                            @endforeach
                                        @endif

                                </div>
                            </div>
                            @if($products->hasMorePages())
                            <div class="ps-pagination">
                                <ul class="pagination">

                                    @if($products->onFirstPage())

                                    @else
                                      <li><a href="{{$products->previousPageUrl()}}"><i class="icon-chevron-left"></i> Previous Page</a></li>
                                      <li><a href="{{$products->url( $products->currentPage() - 1)}}">{{$products->currentPage() - 1 }}</a></li>
                                    @endif

                                    <li class="active">
                                      <a href="{{$products->url($products->currentPage())}}">{{$products->currentPage()}}</a></li>
                                    <li><a href="{{$products->url( $products->currentPage()+ 1)}}">{{$products->currentPage() + 1 }}</a></li>
                                    <li><a href="{{$products->url( $products->currentPage()+ 2)}}">{{$products->currentPage() + 2}}</a></li>
                                    <li><a href="{{$products->nextPageUrl()}}">Next Page<i class="icon-chevron-right"></i></a></li>
                                </ul>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('jss')
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
</script>
@endpush
