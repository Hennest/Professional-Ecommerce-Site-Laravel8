@extends('admin.admin_master')
@section('admin')

<!-- Table content -->
<section class="content">
  <div class="row">
  	<!----------- Edit Brand ----------------->
	  <div class="col-12">
			<div class="box">
				<div class="box-header with-border">
				  <h3 class="box-title">Edit Category</h3>
				</div>
				<div class="box-body">
				  <div class="row">
						<div class="col">
							<form  method="POST" action="{{ route('update.category',$category->id) }}" enctype="multipart/form-data">
								@csrf
							  <div class="row">
								<div class="col">						
									<div class="form-group">
										<h5>Category Name English <span class="text-danger">*</span></h5>
										<div class="controls">
											<input type="text" name="category_name_eng" class="form-control" required="" data-validation-required-message="This field is required" value="{{ $category->category_name_eng }}"> <div class="help-block"></div></div>
											@error('category_name_eng')
												<span class="text-danger">{{ $message }}</span>
											@enderror
									</div>
									<div class="form-group">
										<h5>Category Name Bangla <span class="text-danger">*</span></h5>
										<div class="controls">
											<input type="text" name="category_name_ban" class="form-control" required="" data-validation-required-message="This field is required" value="{{ $category->category_name_ban }}"> <div class="help-block"></div></div>
											@error('category_name_ban')
												<span class="text-danger">{{ $message }}</span>
											@enderror
									</div>

									<div class="form-group">
										<h5>Current Category Icon <span class="text-danger">*</span></h5>
										<div class="controls">
											<input type="text" name="category_icon" class="form-control" required="" data-validation-required-message="This field is required" value="{{ $category->category_icon }}"> <div class="help-block"></div></div>
											{{-- <span><i class="{{$category->category_icon}}"></i></span> --}}
											@error('category_icon')
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