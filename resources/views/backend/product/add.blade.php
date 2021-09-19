@extends('admin.admin_master')
@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!-- Main content -->
<section class="content">

 <!-- Basic Forms -->
  <div class="box">
	<div class="box-header with-border">
	  <h3 class="box-title">Add Product</h3>
	</div>
	<!-- /.box-header -->
	<div class="box-body">
	  <div class="row">
		<div class="col">
			<form novalidate method="POST" action="{{ route('store.product') }}" enctype="multipart/form-data">
				@csrf
				<!-- 1st row -->
				<div class="row">
					<div class="col-md-4">		
						<div class="form-group">
							<h5>Select Brand<span class="text-danger">*</span></h5>
							<div class="controls">
								<select name="brand_id" id="brand_id" required class="form-control">
									<option value="" selected="" disabled="">Select...</option>
									@foreach($brands as $item)
										<option value="{{ $item->id }}">{{ $item->brand_name_eng }}</option>
									@endforeach
								</select>
								@error('brand_id')
									<span class="text-danger">{{ $message }}</span>
								@enderror
							</div>
						</div>
					</div>

					<div class="col-md-4">
						<div class="form-group">
							<h5>Select Category<span class="text-danger">*</span></h5>
							<div class="controls">
								<select name="category_id" id="category_id" required class="form-control">
									<option value="" selected="" disabled="">Select...</option>
									@foreach($categories as $item)
										<option value="{{ $item->id }}">{{ $item->category_name_eng }}</option>
									@endforeach
								</select>
								@error('category_id')
									<span class="text-danger">{{ $message }}</span>
								@enderror
							</div>
						</div>
					</div>

					<div class="col-md-4">
						<div class="form-group">
							<h5>Select Sub-Category<span class="text-danger">*</span></h5>
							<div class="controls">
								<select name="sub_category_id" id="sub_category_id" required class="form-control">
									<option value="" selected="" disabled="">Select...</option>
								</select>
								@error('sub_category_id')
									<span class="text-danger">{{ $message }}</span>
								@enderror
							</div>
						</div>	
					</div>					
				</div>

				<!-- 2nd row -->
				<div class="row">
					<div class="col-md-4">		
						<div class="form-group">
							<h5>Select Sub-Sub-Category<span class="text-danger">*</span></h5>
							<div class="controls">
								<select name="sub_subcategory_id" id="sub_subcategory_id" required class="form-control">
									<option value="">Select...</option>
									<option value="1">India</option>
								</select>
								@error('sub_subcategory_id')
									<span class="text-danger">{{ $message }}</span>
								@enderror
							</div>
						</div>
					</div>

					<div class="col-md-4">
						<div class="form-group">
							<h5>Product Name English<span class="text-danger">*</span></h5>
							<div class="controls">
								<input type="text" name="product_name_eng" class="form-control" required data-validation-required-message="This field is required">
								@error('product_name_eng')
									<span class="text-danger">{{ $message }}</span>
								@enderror 
							</div>
						</div>
					</div>

					<div class="col-md-4">
						<div class="form-group">
							<h5>Product Name Bangla<span class="text-danger">*</span></h5>
							<div class="controls">
								<input type="text" name="product_name_ban" class="form-control" required data-validation-required-message="This field is required">
								@error('product_name_ban')
									<span class="text-danger">{{ $message }}</span>
								@enderror 
							</div>
						</div>
					</div>					
				</div>

				<!-- 3rd row -->
				<div class="row">
					<div class="col-md-4">
						<div class="form-group">
							<h5>Product Code<span class="text-danger">*</span></h5>
							<div class="controls">
								<input type="text" name="product_code" class="form-control" required data-validation-required-message="This field is required">
								@error('product_code')
									<span class="text-danger">{{ $message }}</span>
								@enderror 
							</div>
						</div>
					</div>

					<div class="col-md-4">
						<div class="form-group">
							<h5>Product Quantity<span class="text-danger">*</span></h5>
							<div class="controls">
								<input type="text" name="product_quantity" class="form-control" required data-validation-required-message="This field is required">
								@error('product_quantity')
									<span class="text-danger">{{ $message }}</span>
								@enderror  
							</div>
						</div>
					</div>

					<div class="col-md-4">
						<div class="form-group">
							<h5>Selling Price<span class="text-danger">*</span></h5>
							<div class="controls">
								<input type="text" name="selling_price" class="form-control" required data-validation-required-message="This field is required">
								@error('selling_price')
									<span class="text-danger">{{ $message }}</span>
								@enderror 
							</div>
						</div>
					</div>						
				</div>

				<!-- 4th row -->
				<div class="row">
					<div class="col-md-4">
						<div class="form-group">
							<h5>Product Discount Price</h5>
							<div class="controls">
								<input type="text" name="discount_price" class="form-control" required data-validation-required-message="This field is required">
								@error('discount_price')
									<span class="text-danger">{{ $message }}</span>
								@enderror 
							</div>
						</div>
					</div>

					<div class="col-md-4">
						<div class="form-group">
							<h5>Product Thambnail<span class="text-danger">*</span></h5>
							<div class="controls">
								<input type="file" name="product_thambnail" class="form-control" required data-validation-required-message="This field is required">
								 @error('product_thambnail')
									<span class="text-danger">{{ $message }}</span>
								@enderror
							</div>
						</div>
					</div>

					<div class="col-md-4">
						<div class="form-group">
							<h5>Product Multiple Images<span class="text-danger">*</span></h5>
							<div class="controls">
								<input type="file" name="multi_img[]" class="form-control" required data-validation-required-message="This field is required">
								@error('multi_img')
									<span class="text-danger">{{ $message }}</span>
								@enderror 
							</div>
						</div>
					</div>						
				</div>
				
				<!-- 5th row -->
				<div class="row">
					<div class="col-md-4">
						<div class="form-group">
							<h5>Product Tags English<span class="text-danger">*</span></h5>
							<div class="input-group">
								<input type="text" name="product_tags_eng" data-role="tagsinput" placeholder="add tags"> <span class="input-group-addon">Tags</span>
								@error('product_tags_eng')
									<span class="text-danger">{{ $message }}</span>
								@enderror
							</div>
						</div>
					</div>

					<div class="col-md-4">
						<div class="form-group">
							<h5>Product Tags Bangla<span class="text-danger">*</span></h5>
							<div class="input-group">
								<input type="text" name="product_tags_ban" data-role="tagsinput" placeholder="add tags"> <span class="input-group-addon">Tags</span>
								@error('product_tags_ban')
									<span class="text-danger">{{ $message }}</span>
								@enderror
							</div>
						</div>
					</div>

					<div class="col-md-4">
						<div class="form-group">
							<h5>Product Size English</h5>
							<div class="input-group">
								<input type="text" name="product_size_eng" data-role="tagsinput" placeholder="add tags"> <span class="input-group-addon">Tags</span>
								@error('product_size_eng')
									<span class="text-danger">{{ $message }}</span>
								@enderror
							</div>
						</div>
					</div>						
				</div>

				<!-- 6th row -->
				<div class="row">
					<div class="col-md-4">
						<div class="form-group">
							<h5>Product Size Bangla</h5>
							<div class="input-group">
								<input type="text" name="product_size_ban" data-role="tagsinput" placeholder="add tags"> <span class="input-group-addon">Tags</span>
								@error('product_size_ban')
									<span class="text-danger">{{ $message }}</span>
								@enderror
							</div>
						</div>
					</div>

					<div class="col-md-4">
						<div class="form-group">
							<h5>Product Color English<span class="text-danger">*</span></h5>
							<div class="input-group">
								<input type="text" name="product_color_eng" data-role="tagsinput" placeholder="add tags"> <span class="input-group-addon">Tags</span>
								@error('product_color_eng')
									<span class="text-danger">{{ $message }}</span>
								@enderror
							</div>
						</div>
					</div>

					<div class="col-md-4">
						<div class="form-group">
							<h5>Product Color Bangla<span class="text-danger">*</span></h5>
							<div class="input-group">
								<input type="text" name="product_color_ban" data-role="tagsinput" placeholder="add tags"> <span class="input-group-addon">Tags</span>
								@error('product_color_ban')
									<span class="text-danger">{{ $message }}</span>
								@enderror
							</div>
						</div>
					</div>						
				</div>

				<!-- 7th row -->
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<h5>Short-Description English <span class="text-danger">*</span></h5>
							<div class="controls">
								<textarea name="short_des_eng" id="textarea" class="form-control" required="" placeholder="Textarea text"></textarea>
								<div class="help-block"></div>
							</div>
						</div>
					</div>

					<div class="col-md-6">
						<div class="form-group">
							<h5>Short-Description Bangla <span class="text-danger">*</span></h5>
							<div class="controls">
								<textarea name="short_des_ban" id="textarea" class="form-control" required="" placeholder="Textarea text"></textarea>
								<div class="help-block"></div>
							</div>
						</div>
					</div>
				</div>

				<!-- 8th row -->
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<h5>Long-Description English <span class="text-danger">*</span></h5>
							<div class="controls">
								<textarea id="editor1" name="long_des_eng" rows="10" cols="80"></textarea>
							</div>
						</div>
					</div>

					<div class="col-md-6">
						<div class="form-group">
							<h5>Long-Description Bangla <span class="text-danger">*</span></h5>
							<div class="controls">
								<textarea id="editor2" name="long_des_ban" rows="10" cols="80"></textarea>
							</div>
						</div>
					</div>
				</div><hr>

				<!-- 9th row -->
				<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<div class="controls">
										<fieldset>
											<input type="checkbox" id="hot_deal" name="hot_deal">
											<label for="hot_deal">Hot Deal</label>
										</fieldset>
										<fieldset>
											<input type="checkbox" id="featured" name="featured">
											<label for="featured">Featured</label>
										</fieldset>
									</div>								
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<div class="controls">
										<fieldset>
											<input type="checkbox" id="special_offer" name="special_offer">
											<label for="special_offer">Special Offer</label>
										</fieldset>
										<fieldset>
											<input type="checkbox" id="special_deal" name="special_deal">
											<label for="special_deal">Special Deal</label>
										</fieldset>
									</div>
								</div>
							</div>
						</div>

				<div class="text-xs-right">
					<button type="submit" class="btn btn-rounded btn-info">Add Product</button>
				</div>
			</form>

		</div>
		<!-- /.col -->
	  </div>
	  <!-- /.row -->
	</div>
	<!-- /.box-body -->
  </div>
  <!-- /.box -->

<script type="text/javascript">
    $(document).ready(function(){
      $('select[name="category_id"]').on('change',function(){
          var category_id = $(this).val();
          if (category_id) {      
            $.ajax({
              url: "{{ url('/product/subcategory/ajax') }}/"+category_id,
              type:"GET",
              dataType:"json",
              success:function(data) { 
              var d =$('select[name="sub_category_id"]').empty();
              $.each(data, function(key, value){
              
	              $('select[name="sub_category_id"]').append('<option value="'+ value.id + '">' + value.sub_category_name_eng + '</option>');

	              });
              },
            });
          }else{
            alert('danger');
          }
      });
    });

 </script>

<script type="text/javascript">
    $(document).ready(function(){
      $('select[name="sub_category_id"]').on('change',function(){
          var sub_category_id = $(this).val();
          if (sub_category_id) {      
            $.ajax({
              url: "{{ url('/product/sub_subcategory/ajax') }}/"+sub_category_id,
              type:"GET",
              dataType:"json",
              success:function(data) { 
              var d =$('select[name="sub_subcategory_id"]').empty();
              $.each(data, function(key, value){
              
	              $('select[name="sub_subcategory_id"]').append('<option value="'+ value.id + '">' + value.sub_sub_cat_name_eng + '</option>');

	              });
              },
            });
          }else{
            alert('danger');
          }
      });
    });

 </script>
@endsection