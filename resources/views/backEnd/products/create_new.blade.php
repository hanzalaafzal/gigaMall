@extends('backEnd.layout')

@section('content')
<div class="padding">
   <div class="box">
      <div class="box-header dker">
         <h3><i class="material-icons"></i> Add New Product</h3>
      </div>
      <div class="box-tool">
         <ul class="nav">
            <li class="nav-item inline">
               <a class="nav-link" href="{{url('/admin')}}">
               <i class="material-icons md-18">×</i>
               </a>
            </li>
         </ul>
      </div>
      <div class="box-body">
         <form method="POST" action="{{route('storeProduct')}}" accept-charset="UTF-8" enctype="multipart/form-data">
            {{ csrf_field() }}
            <input type="hidden" name="id" value="{{$product->id}}">
            <div class="form-group row">
               <label for="title_ar" class="col-sm-2 form-control-label">Product Name*</label>
               <div class="col-sm-10">
                  <input type="text" id="title" class="form-control" name="title" required maxlength="190" placeholder="Enter Product Name...">
               </div>
            </div>
            <div class="form-group row">
               <label for="title_ar" class="col-sm-2 form-control-label">Description</label>
               <div class="col-sm-10">
                  <textarea id="description" class="form-control" name="description" placeholder="Enter Product Description..."></textarea>
               </div>
            </div>
            <div class="form-group row">
               <label class="col-sm-2 form-control-label">Original Price*</label>
               <div class="col-sm-10">
                  <input type="number" id="price" class="form-control" name="original_price" required placeholder="Enter Original Product Price...">
               </div>
            </div>
            <div class="form-group row">
               <label class="col-sm-2 form-control-label">Discount Price*</label>
               <div class="col-sm-10">
                  <input type="number" id="price" class="form-control" name="price" required placeholder="Enter Product Discounted Price...">
               </div>
            </div>

            <div class="form-group row">
               <label class="col-sm-2 form-control-label">Shipping Price*</label>
               <div class="col-sm-10">
                  <input type="number" id="shipping_price" class="form-control"  name="shipping_price" required placeholder="Enter Product Shipping Price...">
               </div>
            </div>
            <div class="form-group row">
               <label class="col-sm-2 form-control-label">Quantity*</label>
               <div class="col-sm-10">
                  <input type="number" id="quantity" class="form-control" name="quantity" required placeholder="Enter Product Quantity...">
               </div>
            </div>
            <div class="form-group row">
               <label class="col-sm-2 form-control-label">Daily Sale:</label>
               <div class="col-sm-10">
                  <input class="form-check-input" type="checkbox" name="daily_sale" id="flexCheckDefault">
               </div>
            </div>
            <div class="form-group row">
               <label class="col-sm-2 form-control-label">Select Product Image*</label>
               <div class="col-sm-10">
                  <input type="file" id="photo" name="photo" required="">
               </div>
            </div>
            <div class="form-group row">
               <label class="col-sm-2 form-control-label">Select Shop*</label>
               <div class="col-sm-10">
                 <select class="form-control" name="shop_id" id="shop_id">
                   <option value="" disabled="" selected="">Choose Shop</option>
                   @foreach($shops as $shop)
                     <option value="{{$shop->slug}}">{{$shop->title}}</option>
                   @endforeach
                 </select>
               </div>
            </div>
            <div class="form-group row">
               <label class="col-sm-2 form-control-label">Select Product Type*</label>
               <div class="col-sm-10">
                 <select class="form-control" name="product_type" id="product_type" required>
                   <option value="" disabled="" selected="">Choose Product Type</option>
                   @foreach($product_types as $product_type)
                     <option value="{{$product_type->id}}">{{$product_type->name}}</option>
                   @endforeach
                 </select>
               </div>
            </div>
            <div class="form-group row">
               <label class="col-sm-2 form-control-label">Select Category*</label>
               <div class="col-sm-10">
                 <select class="form-control" name="category_id" id="category_id" required>

                 </select>
               </div>
            </div>
            <div class="form-group row">
               <label class="col-sm-2 form-control-label">Select Sub Category*</label>
               <div class="col-sm-10">
                 <select class="form-control" name="sub_category_id" id="sub_category_id" required>

                 </select>
               </div>
            </div>
            <div class="form-group row">
               <label class="col-sm-2 form-control-label">Add Gallery Images <p><small> Ideal resolution: 838 x 436 px</small></p></label>

               <div class="col-sm-2">
                  <input onchange="gal_img(id)" type="file" id="field1" class="gal_img" name="gallery_photos[]" >
               </div>
               <div class="col-sm-2">
                  <button id="b1" class="btn-sm add-more" type="button">+</button>
               </div>
               <div class="col-sm-4">
                 <p style="width: 100%; text-align: center;"><small class="alert-danger" id="galleryPhotosError"></small></p>
               </div>
            </div>
            <div class="form-group row m-t-md">
               <div class="col-sm-offset-2 col-sm-10">
                  <button type="submit" class="btn btn-primary m-t"><i class="material-icons">
                  </i> Add</button>
               </div>
            </div>

         </form>
      </div>
   </div>
</div>

@endsection

@section('footerInclude')
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
      	$('#galleryPhotosError').empty();
      $('#galleryPhotosError').append('You can upload only 5 images in gallery.');
      return false;}
        e.preventDefault();
        var addto = "#field" + next;
        var addRemove = "#field" + (next);
        next = next + 1;
        var newIn = '<input onchange="gal_img(id)" class="gal_img" type="file" id="field'+next+'" name="gallery_photos[]"required>';
        var newInput = $(newIn);
        var removeBtn = '<button id="remove' + (next - 1) + '" class="btn-sm btn-danger remove-me" >-</button></div><div id="field">';
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

@endsection
