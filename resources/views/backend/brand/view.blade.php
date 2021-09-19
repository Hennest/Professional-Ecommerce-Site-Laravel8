@extends('admin.admin_master')
@section('admin')

<!-- Table content -->
<section class="content">
  <div class="row">
		<div class="col-8">
			<div class="box">
				<div class="box-header with-border">
				  <h3 class="box-title">Brand List</h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="table-responsive">
					  <table id="example1" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>Brand Name English</th>
								<th>Brand Name Bangla</th>
								<th>Brand Image</th>
								<th>Actions</th>
							</tr>
						</thead>
						<tbody>
							@foreach($brands as $brand)
							<tr>
								<td>{{ $brand->brand_name_eng }}</td>
								<td>{{ $brand->brand_name_ban }}</td>
								<td> <img src="{{asset($brand->brand_image)}}" style="height: 50px; width: 60px"> </td>
								<td>
									<a class="btn btn-social-icon btn-bitbucket" title="Edit" href="{{ route('edit.brand',$brand->id ) }}"><i class="fa fa-pencil"></i></a>
									<a class="btn btn-social-icon btn-google" title="Delete" id="delete" href="{{ route('delete.brand',$brand->id ) }}"><i class="fa fa-trash"></i></a>
								</td>
							</tr>
							@endforeach
					  </table>
					</div>
				</div><!-- /.box-body -->
			</div><!-- /.box -->
		</div><!-- /.div col -->

		<!----------- Add New Brand ----------------->
	  <div class="col-4">
			<div class="box">
				<div class="box-header with-border">
				  <h3 class="box-title">Add New Brand</h3>
				</div>
				<div class="box-body">
				  <div class="row">
						<div class="col">
							<form novalidate="" method="POST" action="{{ route('store.brand') }}" enctype="multipart/form-data">
								@csrf
							  <div class="row">
								<div class="col">						
									<div class="form-group">
										<h5>Brand Name English <span class="text-danger">*</span></h5>
										<div class="controls">
											<input type="text" name="brand_name_eng" class="form-control" required="" data-validation-required-message="This field is required"> <div class="help-block"></div></div>
											@error('brand_name_eng')
												<span class="text-danger">{{ $message }}</span>
											@enderror
									</div>
									<div class="form-group">
										<h5>Brand Name Bangla <span class="text-danger">*</span></h5>
										<div class="controls">
											<input type="text" name="brand_name_ban" class="form-control" required="" data-validation-required-message="This field is required"> <div class="help-block"></div></div>
											@error('brand_name_ban')
												<span class="text-danger">{{ $message }}</span>
											@enderror
									</div>
									
									<div class="form-group">
										<h5>Brand Image <span class="text-danger">*</span></h5>
										<div class="controls">
											<input type="file" name="brand_image" class="form-control" required=""> <div class="help-block"></div></div>
											@error('brand_image')
												<span class="text-danger">{{ $message }}</span>
											@enderror
									</div>
									
								<div class="text-xs-right">
									<button type="submit" class="btn btn-rounded btn-info">Add</button>
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