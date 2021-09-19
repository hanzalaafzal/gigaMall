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
    .deleteimg label{
    	width: 30% !important;
    	float:left;
    	margin:6px;
    }
    .deleteimg label img{
    	height: 180px;
    	width: 100%;
    }
    input[type="checkbox"] {
	    display: unset;
	}
</style>
<!-- DASHBOARD CONTENT -->
<div class="dashboard-content">
    <!-- HEADLINE -->
    <div class="headline buttons primary">
        <h4>Edit Prodduct</h4>
        <a href="{{route('productEdit',$product->slug)}}" class="button mid-short primary">Edit Product</a>
    </div>
    <!-- /HEADLINE -->

    <!-- PACK BOXES -->

	<!-- FORM BOX ITEMS -->
	<div class="form-box-items wrap-3-1 left">
		<!-- FORM BOX ITEM -->
		<div class="form-box-item full">
			<h4>Delete Gallery Images</h4>
			<hr class="line-separator">
				<!-- INPUT CONTAINER -->
				<form method="post" action="{{route('productGalleryDelete')}}" id="upload_form" enctype="multipart/form-data">
				    {{csrf_field()}}
				    <input type="hidden" value="{{$product->slug}}" name="slug">
					<div class="deleteimg">
						@if(count($product->galleries)>0)
							@foreach($product->galleries as $gallery)
								<label for="{{$gallery->id}}" class="rl-label">
									<img src="{{url('frontEnd/images/products/gallery/'.$gallery->photo)}}">
									<input type="checkbox" id="{{$gallery->id}}" value="{{$gallery->id}}" name="gallery[]">
								</label>
							@endforeach
							
					        <button id="submit" class="button big dark">Delete <span class="primary">Images</span></button>
						@else
						    <div style="text-align:center">
						        <h5 style="color:gray;">No Image Found.</h5>
						    </div>
						@endif
					</div>
				</form>
				<!-- /INPUT CONTAINER -->

				<br><br>
				<h4>Upload Gallery Images</h4>
				<hr class="line-separator">

				<form method="post" action="{{route('productGalleryUpdate')}}" id="upload_form" enctype="multipart/form-data">
				    {{csrf_field()}}
				    <input type="hidden" value="{{$product->slug}}" name="slug">

					<!-- INPUT CONTAINER -->
					<div class="input-container">
						<div id="field">
							<label for="gallery_photos" class="rl-label">Gallery Photos</label>
							<input onchange="gal_img(id)" type="file" id="field1" class="gal_img" name="gallery_photos[]" multiple="" required="">
						</div>
						<br>
							<p style="width: 100%; text-align: center;"><small class="alert-danger" id="galleryPhotosError"></small></p>
							<br>
							<button id="b1" class="btn btn-block btn-primary add-more" type="button">+</button>
					</div>
					<!-- /INPUT CONTAINER -->

					<button id="submit" class="button big dark">Upload <span class="primary">Images</span></button>
				</form>
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
	            <p class="text-header">Gallery photos:</p>
	            <p>Enter more photos of your product. This will more likely boost product’s sale. In order to make them look elegant, upload the photos in ideal resolution (838 x 436 pixels).</p>
	         </div>
	         <!-- /PLAIN TEXT BOX ITEM -->
	      </div>
	      <!-- /PLAIN TEXT BOX -->
	   </div>
	   <!-- /FORM BOX ITEM -->
	</div>
	<!-- /FORM BOX ITEMS -->

	<div class="clearfix"></div>
</div>
<!-- DASHBOARD CONTENT -->


<script>
   $(document).ready(function(){
    var next = 1;
    $(".add-more").click(function(e){
      var counta = $(".remove-me").length;
      if(counta >= 4){
      	$('#galleryPhotosError').empty();
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
	   if (e_size > 10000) {
	     $('#galleryPhotosError').append('<b>Error:</b> Upload only 10MB Image');
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