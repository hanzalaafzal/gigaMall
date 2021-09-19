@extends('frontEnd.layout')
@section('content')
<!-- SECTION -->
    <div class="section-wrap">
        <div class="section">
            <!-- CONTENT -->
            <div class="content">
                <!-- HEADLINE -->
                <div class="headline primary">
                    <h4>Products</h4>
                    <!-- VIEW SELECTORS -->
                    <!-- <div class="view-selectors">
                        <a href="shop-gridview-v1.html" class="view-selector grid active"></a>
                        <a href="shop-listview-v1.html" class="view-selector list"></a>
                    </div>
 -->                    <!-- /VIEW SELECTORS -->
                    <div class="clearfix"></div>
                </div>
                <!-- /HEADLINE -->

                @if(count($products) > 0)
                    <!-- PRODUCT SHOWCASE -->
                <div class="product-showcase">
                    <!-- PRODUCT LIST -->
                    <div class="product-list grid column3-4-wrap">
                        <!-- PRODUCT ITEM -->
                        @foreach($products as $product)
                          @if($product->is_featured == 1)
                            @include('frontEnd.includes.products_list')
                          @endif
                        @endforeach
                        @foreach($products as $product)
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

            <!-- SIDEBAR -->
            <div class="sidebar">
                <form method="get" action="{{route('searchProduct')}}" enctype="multipart/form-data">
                  <!-- SIDEBAR ITEM -->
                    <div class="sidebar-item">
                        <h4>Keyword</h4>
                        <hr class="line-separator">
                        <input type="text" placeholder="Type keyword here..." name="keyword"
                          <?php
                            if (!empty($q['keyword'])) {
                              echo "value='".$q['keyword']."'";
                            }
                          ?>
                        >
                    </div>
                    <!-- /SIDEBAR ITEM -->
                    <br>
                  <!-- SIDEBAR ITEM -->
                    <div class="sidebar-item">
                        <h4>Categories</h4>
                        <hr class="line-separator">
                        <label for="category">Choose Category</label>
                          <select name="category" id="category" style="margin-bottom: 15px;">
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
                              >{{$category->name}}</option>
                            @endforeach
                          </select>
                          <div id="sub_category_div"
                            <?php
                              if(empty($q['category']) || $q['category'] == 'All'){
                                echo "style='display:none;'";
                              }
                            ?>
                          >
                            <label for="sub_category">Choose Sub Category</label>
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
                          </div>
                    </div>
                    <!-- /SIDEBAR ITEM -->
                    <br>
                  <!-- SIDEBAR ITEM -->
                    <div class="sidebar-item">
                        <h4>Product Type</h4>
                        <hr class="line-separator">
                          <!-- CHECKBOX -->
                          <?php $i=1; ?>
                          @foreach($product_types as $productType)
                            <input type="checkbox" id="product_type{{$i}}" name="product_type[]" value="{{$productType->id}}"
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
                            <label for="product_type{{$i}}">
                                <span class="checkbox primary primary"><span></span></span>
                                {{$productType->name}}
                                <!-- <span class="quantity">350</span> -->
                            </label>
                            <?php $i++; ?>
                          @endforeach
                          <!-- /CHECKBOX -->
                    </div>
                    <!-- /SIDEBAR ITEM -->
                    <br>
                    <!-- SIDEBAR ITEM -->
                    <div class="sidebar-item">
                        <h4>Stock</h4>
                        <hr class="line-separator">
                          <!-- CHECKBOX -->
                            <input type="checkbox" id="stock" name="stock" value="1"
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
                          <!-- /CHECKBOX -->
                    </div>
                    <!-- /SIDEBAR ITEM -->
                    <br>
                    <!-- SIDEBAR ITEM -->
                    <div class="sidebar-item range-feature">
                      <h4>Price Range</h4>
                      <hr class="line-separator spaced">
                      <label>Min</label>
                      <input type="number" name="min" class="price-range-slider"
                        <?php
                          if(!empty($q['min'])){
                            echo "value='".$q['min']."'";
                          }
                        ?>
                      >
                      <label>Max</label>
                      <input type="number" name="max" class="price-range-slider"
                      <?php
                        if(!empty($q['max'])){
                          echo "value='".$q['max']."'";
                        }
                      ?>
                      >
                    </div>
                    <!-- /SIDEBAR ITEM -->
                    <br>
                      <div style="text-align: center;">
                        <button style="margin: 0 auto;" class="button mid primary">Update Search</button>
                      </div>
                      @if(isset($q['ebazarr']))
                           <input type="hidden" name="ebazarr" value="yes">
                      @endif
                </form>
            </div>
            <!-- /SIDEBAR -->
        </div>
    </div>
    <!-- /SECTION -->


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
@endsection