@extends('admin.admin_master')
@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Table content -->
<section class="content">
  <div class="row">
  	<!----------- Edit Brand ----------------->
	  <div class="col-12">
			<div class="box">
				<div class="box-header with-border">
				  <h3 class="box-title">Edit Sub-Category</h3>
				</div>
				<div class="box-body">
				  <div class="row">
						<div class="col">
							<form  method="POST" action="{{ route('update.sub_sub_category',$sub_sub_cat->id) }}">
								@csrf
							  <div class="row">
								<div class="col">						
									<div class="form-group">
										<h5>Select Category<span class="text-danger">*</span></h5>
										<div class="controls">
											<select name="category_id" id="category_id" required="" class="form-control" aria-invalid="false">
												<option value="" selected="" disabled="">Select Category</option>
												@foreach($categories as $category)
													<option value="{{ $category->id }}" {{ $category->id==$sub_sub_cat->category_id ? 'selected':''; }}>{{ $category->category_name_eng }}</option>
												@endforeach
											</select>
										<div class="help-block"></div></div>
									</div>

									<div class="form-group">
										<h5>Select Sub-Category<span class="text-danger">*</span></h5>
										<div class="controls">
											<select name="sub_category_id" required="" class="form-control" aria-invalid="false">
												<option value="" selected="" disabled="">Select....</option>
												@foreach($sub_cat as $item)
													<option value="{{ $item->id }}" {{ $item->id==$sub_sub_cat->sub_category_id ? 'selected':''; }}>{{ $item->sub_category_name_eng }}</option>
												@endforeach
											</select>
										<div class="help-block"></div></div>
									</div>							
	
									<div class="form-group">
										<h5>Sub-Sub-Category Name English <span class="text-danger">*</span></h5>
										<div class="controls">
											<input type="text" name="sub_sub_cat_name_eng" class="form-control" value="{{ $sub_sub_cat->sub_sub_cat_name_eng }}" required=""> <div class="help-block"></div></div>
											@error('sub_sub_cat_name_eng')
												<span class="text-danger">{{ $message }}</span>
											@enderror
									</div>

									<div class="form-group">
										<h5>Sub-Sub-Category Name Bangla <span class="text-danger">*</span></h5>
										<div class="controls">
											<input type="text" name="sub_sub_cat_name_ban" class="form-control" value="{{ $sub_sub_cat->sub_sub_cat_name_ban }}" required=""> <div class="help-block"></div></div>
											@error('sub_sub_cat_name_ban')
												<span class="text-danger">{{ $message }}</span>
											@enderror
									</div>
								</div>
							</div>
								<div class="text-xs-right">
									<button type="submit" class="btn btn-rounded btn-info">Update</button>
								</div>
							</form>
						</div><!-- /.col -->
				  </div><!-- /.row -->
				</div>
			</div><!-- /.box -->
		</div><!-- /.col -->
	</div><!-- /.row -->
</section>

<script type="text/javascript">
    $(document).ready(function(){
      $('select[name="category_id"]').on('change',function(){
          var category_id = $(this).val();
          if (category_id) {      
            $.ajax({
              url: "{{ url('/category/subcategory/ajax') }}/"+category_id,
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
@endsection