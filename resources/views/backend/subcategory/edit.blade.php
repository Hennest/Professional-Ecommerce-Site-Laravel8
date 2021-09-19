@extends('admin.admin_master')
@section('admin')

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
							<form  method="POST" action="{{ route('update.sub_category',$sub_category->id) }}">
								@csrf
							  <div class="row">
								<div class="col">						
									<div class="form-group">
										<h5>Select Category<span class="text-danger">*</span></h5>
										<div class="controls">
											<select name="category_id" id="category_id" required="" class="form-control" aria-invalid="false">
												<option value="" selected="" disabled="">Select Category</option>
												@foreach($categories as $category)
													<option value="{{ $category->id }}" {{ $category->id==$sub_category->category_id ? 'selected':''; }}>{{ $category->category_name_eng }}</option>
												@endforeach
											</select>
										<div class="help-block"></div></div>
									</div>						
	
									<div class="form-group">
										<h5>Sub-Category Name English <span class="text-danger">*</span></h5>
										<div class="controls">
											<input type="text" name="sub_category_name_eng" class="form-control" required="" value="{{ $sub_category->sub_category_name_eng }}"> <div class="help-block"></div></div>
											@error('sub_category_name_eng')
												<span class="text-danger">{{ $message }}</span>
											@enderror
									</div>

									<div class="form-group">
										<h5>Sub-Category Name Bangla <span class="text-danger">*</span></h5>
										<div class="controls">
											<input type="text" name="sub_category_name_ban" class="form-control" required="" value="{{ $sub_category->sub_category_name_ban }}"> <div class="help-block"></div></div>
											@error('sub_category_name_ban')
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

@endsection