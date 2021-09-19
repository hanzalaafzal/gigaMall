@extends('frontEnd.vendor.layout')

@section('dashboard')
<style type="text/css">
	.pack-boxes .radio{
		position: relative !important;
	    top: 30px !important;
	    z-index: 1;
	    left: 7px;
	}
	.remove-me{
	position: relative;
    bottom: 39px;
    float: right;}
</style>
<!-- DASHBOARD CONTENT -->
<div class="dashboard-content">
    <!-- HEADLINE -->
    <div class="headline buttons primary">
        <h4>Edit Product</h4>
        <a href="{{route('productGalleryEdit',$product->slug)}}" class="button mid-short primary">Edit Gallery Images</a>
    </div>
    <!-- /HEADLINE -->

    <!-- PACK BOXES -->
    <form method="post" action="{{route('productUpdate')}}" id="upload_form" enctype="multipart/form-data">
    {{csrf_field()}}
    <input type="hidden" value="{{$product->slug}}" name="slug">

	<!-- FORM BOX ITEMS -->
	<div class="form-box-items wrap-3-1 left">
		<!-- FORM BOX ITEM -->
		<div class="form-box-item full">
			<h4>Edit Product Details</h4>
			<hr class="line-separator">
				<!-- INPUT CONTAINER -->
				<div class="input-container">
					<label for="title" class="rl-label required">Title</label>
					<input type="text" value="{{$product->title}}" id="title" name="title" required maxlength="200" placeholder="Enter Product Name...">
				</div>
				<!-- /INPUT CONTAINER -->

				<!-- INPUT CONTAINER -->
				<div class="input-container">
					<label for="description" class="rl-label required">Description</label>
					<textarea id="description" name="description" required placeholder="Enter Product Description...">{{$product->description}}</textarea>
				</div>
				<!-- /INPUT CONTAINER -->

				<!-- INPUT CONTAINER -->
				<div class="input-container">
					<label for="price" class="rl-label required">Original Price</label>
					<input type="number" id="price" value="{{$product->original_price}}" name="original_price" required placeholder="Enter Product Price...">
				</div>
				<!-- /INPUT CONTAINER -->

				<!-- INPUT CONTAINER -->
				<div class="input-container">
					<label for="price" class="rl-label required">Discount Price</label>
					<input type="number" id="price" value="{{$product->price}}" name="price" required placeholder="Enter Product Price...">
				</div>
				<!-- /INPUT CONTAINER -->
				<!-- INPUT CONTAINER -->
				<div class="input-container">
					<label for="shipping_price" class="rl-label required">Shipping Price</label>
					<input type="number" id="shipping_price" value="{{$product->shipping_price}}" name="shipping_price" required placeholder="Enter Product Shipping Price...">
				</div>
				<!-- /INPUT CONTAINER -->
				<!-- INPUT CONTAINER -->
				<div class="input-container">
					<label for="quantity" class="rl-label required">Quantity</label>
					<input type="number" id="quantity" value="{{$product->quantity}}" name="quantity" required placeholder="Enter Product Quantity...">
				</div>
				<!-- /INPUT CONTAINER -->

				<!-- INPUT CONTAINER -->
				<div class="input-container" id="field">
					<label for="photo" class="rl-label">Photo</label>
					<input type="file" id="photo" name="photo">
					<p><small class="alert-danger" id="photoError"></small></p>
					<img width="300px;" src="{{url('/frontEnd/images/products/'.$product->photo)}}">

				</div>
				<!-- /INPUT CONTAINER -->

				<!-- INPUT CONTAINER -->
				<div class="input-container">
					<label for="shop_id" class="rl-label required">Select Shop</label>
					<small><p>Select From Active Shops</p></small>
					<label for="shop_id" class="select-block">
						<select name="shop_id" id="shop_id" required="">
							@foreach($shops as $shop)
								<option <?php if($shop->id == $product->shop_id){echo "selected";} ?> value="{{$shop->slug}}">{{$shop->title}}</option>
							@endforeach
						</select>
					</label>
				</div>
				<!-- /INPUT CONTAINER -->

				<!-- INPUT CONTAINER -->
				<div class="input-container">
					<label for="product_type" class="rl-label required">Select Product Type</label>
					<label for="product_type" class="select-block">
						<select name="product_type" id="product_type" required="">
							<option value="" disabled="" selected="">Choose Product Type</option>
							@foreach($product_types as $product_type)
								<option <?php if($product_type->id == $product->product_type){echo "selected";} ?> value="{{$product_type->id}}">{{$product_type->name}}</option>
							@endforeach
						</select>
					</label>
				</div>
				<!-- /INPUT CONTAINER -->

				<div class="input-container" id="category">
					<label for="category_id" class="rl-label required">Select Categories</label>
					<label for="category_id" class="select-block">
						<select name="category_id" id="category_id" required=""  >
							<option value="" disabled="" selected="">Choose Category</option>
							@foreach($categories as $category)
		                        <option <?php if($category->id == $product->category_id){echo "selected";} ?> value="{{$category->id}}">{{$category->name}}</option>
		                    @endforeach
						</select>
					</label>
				</div>
				<div class="input-container" id="sub_category" >
					<label for="sub_category_id" class="rl-label required">Select Sub Category</label>
					<label for="sub_category_id" class="select-block">
						<select name="sub_category_id" id="sub_category_id" required="">
							@foreach($subCategories as $subCat)
		                        <option <?php if($subCat->id == $product->sub_category_id){echo "selected";} ?> value="{{$subCat->id}}">{{$subCat->name}}</option>
		                    @endforeach
						</select>
					</label>
					<br>
				</div>

				<!-- INPUT CONTAINER -->
				<!-- <div class="input-container">
					<div id="field">
						<label for="gallery_photos" class="rl-label">Gallery Photos</label>
						<input onchange="gal_img(id)" type="file" id="field1" class="gal_img" name="gallery_photos[]" multiple="" required="">
					</div>
					<br>
						<p style="width: 100%; text-align: center;"><small class="alert-danger" id="galleryPhotosError"></small></p>
						<br>
						<button id="b1" class="btn btn-block btn-primary add-more" type="button">+</button>
				</div> -->
				<!-- /INPUT CONTAINER -->

				<button id="submit" class="button big dark">Update <span class="primary">Product</span></button>
		</div>
		<!-- /FORM BOX ITEM -->
	</div>

	<div class="form-box-items wrap-1-3 right">
	   <!-- FORM BOX ITEM -->
	   <div class="form-box-item full">
	      <h4>Upload Guidelines</h4>
	      <hr class="line-separator">
	      <!-- PLAIN TEXT BOX -->
	      <div class="plain-text-box">
	         <!-- PLAIN TEXT BOX ITEM -->
	         <div class="plain-text-box-item">
	            <p class="text-header">Title:</p>
	            <p>Enter the name of your product. For example, sofa cum bed…</p>
	         </div>
	         <!-- /PLAIN TEXT BOX ITEM -->
	         <!-- PLAIN TEXT BOX ITEM -->
	         <div class="plain-text-box-item">
	            <p class="text-header">Description</p>
	            <p>Describe your product in detail. This may include color, size, brand, type etc…</p>
	         </div>
	         <!-- /PLAIN TEXT BOX ITEM -->
	         <!-- PLAIN TEXT BOX ITEM -->
	         <div class="plain-text-box-item">
	            <p class="text-header">Price:</p>
	            <p>Enter the price of your product.</p>
	          
	         </div>
	         <!-- /PLAIN TEXT BOX ITEM -->
	         <!-- PLAIN TEXT BOX ITEM -->
	         <div class="plain-text-box-item">
	            <p class="text-header">Shipping price:</p>
	            <p>Enter the shipping price of your product.</p>
	         </div>
	         <!-- /PLAIN TEXT BOX ITEM -->
	         <!-- PLAIN TEXT BOX ITEM -->
	         <div class="plain-text-box-item">
	            <p class="text-header">Quantity</p>
	            <p>Enter the total quantity stock of your product (available in stock).</p>
	         </div>
	         <!-- /PLAIN TEXT BOX ITEM -->
	         <!-- PLAIN TEXT BOX ITEM -->
	         <div class="plain-text-box-item">
	            <p class="text-header">Photo:</p>
	            <p>Enter a cover photo of your shop. In order to make it look elegant, upload the photo in ideal resolution (838 x 436 pixels).</p>
	         </div>
	         <!-- /PLAIN TEXT BOX ITEM -->
	         <!-- PLAIN TEXT BOX ITEM -->
	         <div class="plain-text-box-item">
	            <p class="text-header">Select shop:</p>
	            <p>Select the shop in which you want to add this product.</p>
	         </div>
	         <!-- /PLAIN TEXT BOX ITEM -->
	         <!-- PLAIN TEXT BOX ITEM -->
	         <div class="plain-text-box-item">
	            <p class="text-header">Select product type:</p>
	            <p>Select the type of product, i.e. physical product, digital product, or service.</p>
	         </div>
	         <!-- /PLAIN TEXT BOX ITEM -->
	         <!-- PLAIN TEXT BOX ITEM -->
	         <div class="plain-text-box-item">
	            <p class="text-header">Select category:</p>
	            <p>Select the category and sub-category of the product.</p>
	         </div>
	         <!-- /PLAIN TEXT BOX ITEM -->
	         <!-- PLAIN TEXT BOX ITEM -->
	         <div class="plain-text-box-item">
	            <p class="text-header">Gallery photos:</p>
	            <p>Enter more photos of your product. This will more likely boost product’s sale. In order to make them look elegant, upload the photos in ideal resolution (838 x 436 pixels).</p>
	         </div>
	         <!-- /PLAIN TEXT BOX ITEM -->
	      </div>
	      <!-- /PLAIN TEXT BOX -->
	   </div>
	   <!-- /FORM BOX ITEM -->
	</div>
	</form>
	<!-- /FORM BOX ITEMS -->

	<div class="clearfix"></div>
</div>
<!-- DASHBOARD CONTENT -->
<script type="text/javascript">
    $('#product_type').on('change',function(){
      var type_id= $('#product_type').val();
      var route = '/get-categories';
      var url =  {!! json_encode(url('/')) !!}+'/'+route+'/'+type_id;
      $('#category_id').empty();
      $.get(url, function(result){
      	$('#category').css('display','unset');
          $('#category_id').append('<option value="" disabled="" selected="">Choose Category</option>');
          $.each(result, function(key, value) {
                $('#category_id').append('<option value=' + value['id'] + '>' + value['name'] + '</option>');
            });
      });
    });
</script>

<script type="text/javascript">
    $('#category_id').on('change',function(){
      var category_id= $('#category_id').val();
      var route = '/get-sub-categories';
      var url =  {!! json_encode(url('/')) !!}+'/'+route+'/'+category_id;
      $('#sub_category_id').empty();
      $.get(url, function(result){
      	$('#sub_category').css('display','unset');
          $('#sub_category_id').append('<option value="" disabled="" selected="">Choose Sub Category</option>');
          $.each(result, function(key, value) {
                $('#sub_category_id').append('<option value=' + value['id'] + '>' + value['name'] + '</option>');
            });
      });
    });
</script>

<script>
   $(document).ready(function(){
    var next = 1;
    $(".add-more").click(function(e){
      var counta = $(".remove-me").length;
      if(counta >= 4){
      $('#galleryPhotosError').append('You can upload only 5 images in gallery.');
      return false;}
        e.preventDefault();
        var addto = "#field" + next;
        var addRemove = "#field" + (next);
        next = next + 1;
        var newIn = '<input onchange="gal_img(id)" class="gal_img" type="file" id="field'+next+'" name="gallery_photos[]" multiple="" required>';
        var newInput = $(newIn);
        var removeBtn = '<button id="remove' + (next - 1) + '" class="btn btn-danger remove-me" >-</button></div><div id="field">';
        var removeButton = $(removeBtn);
        $(addto).after(newInput);
        $(addRemove).after(removeButton);
        $("#field" + next).attr('data-source',$(addto).attr('data-source'));
        $("#count").val(next);  
        
            $('.remove-me').click(function(e){
                e.preventDefault();
                var fieldNum = this.id.charAt(this.id.length-1);
                var fieldID = "#field" + fieldNum;
                $(this).remove();
                $(fieldID).remove();
            });
    });
});
</script>

<script type="text/javascript">
	function gal_img(id) {
		var file = $('#'+id);
	  var extension=file.val().replace(/^.*\./, '');
	  var _size = file[0].files[0].size;
	  var e_size = _size/1024;
	  if (extension=='png' || extension=='jpg' || extension=='jpeg') {
	    $('#galleryPhotosError').empty();
	   if (e_size > 2000) {
	     $('#galleryPhotosError').append('<b>Error:</b> Upload only 2MB Image');
	     file.val('');
	    }
	    else{
	    	$('#galleryPhotosError').empty();
	      file.css('border','none !important');
	    }
	  }
	  else{
	    $('#galleryPhotosError').empty();
	    $('#galleryPhotosError').append('<b>Error:</b> Upload Only jpg/png Image');
	     file.val('');
	  }
	}
</script>

@endsection