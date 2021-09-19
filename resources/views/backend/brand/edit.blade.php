@extends('admin.admin_master')
@section('admin')

<!-- Table content -->
<section class="content">
  <div class="row">
  	<!----------- Edit Brand ----------------->
	  <div class="col-12">
			<div class="box">
				<div class="box-header with-border">
				  <h3 class="box-title">Edit Brand</h3>
				</div>
				<div class="box-body">
				  <div class="row">
						<div class="col">
							<form novalidate="" method="POST" action="{{ route('update.brand',$brand->id) }}" enctype="multipart/form-data">
								@csrf
							  <div class="row">
								<div class="col">						
									<div class="form-group">
										<h5>Brand Name English <span class="text-danger">*</span></h5>
										<div class="controls">
											<input type="text" name="brand_name_eng" class="form-control" required="" data-validation-required-message="This field is required" value="{{ $brand->brand_name_eng }}"> <div class="help-block"></div></div>
											@error('brand_name_eng')
												<span class="text-danger">{{ $message }}</span>
											@enderror
									</div>
									<div class="form-group">
										<h5>Brand Name Bangla <span class="text-danger">*</span></h5>
										<div class="controls">
											<input type="text" name="brand_name_ban" class="form-control" required="" data-validation-required-message="This field is required" value="{{ $brand->brand_name_ban }}"> <div class="help-block"></div></div>
											@error('brand_name_ban')
												<span class="text-danger">{{ $message }}</span>
											@enderror
									</div>

									<div class="form-group">
										<h5>Current Brand Image <span class="text-danger">*</span></h5>
										<div class="controls">
											<img src="{{ asset($brand->brand_image) }}" style="height: 80px; width: 80px; border: 1px white solid;">
										</div>	
									</div>
									
									<div class="form-group">
										<h5>New Brand Image <span class="text-danger">*</span></h5>
										<div class="controls">
											<input type="file" name="brand_image" class="form-control" required=""> <div class="help-block"></div></div>
											@error('brand_image')
												<span class="text-danger">{{ $message }}</span>
											@enderror
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