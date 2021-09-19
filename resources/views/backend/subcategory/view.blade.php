@extends('admin.admin_master')
@section('admin')

<!-- Table content -->
<section class="content">
  <div class="row">
		<div class="col-8">
			<div class="box">
				<div class="box-header with-border">
				  <h3 class="box-title">Sub-Category List</h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="table-responsive">
					  <table id="example1" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>Category</th>
								<th>Sub-Category English</th>
								<th>Sub-Category Bangla</th>
								<th>Actions</th>
							</tr>
						</thead>
						<tbody>
							@foreach($sub_cat as $item)
							<tr>
								<td>{{ $item->category->category_name_eng }}</td>
								<td>{{ $item->sub_category_name_eng }}</td>
								<td>{{ $item->sub_category_name_ban }}</td>
								<td>
									<a class="btn btn-social-icon btn-bitbucket" title="Edit" href="{{ route('edit.sub_category',$item->id) }}"><i class="fa fa-pencil"></i></a>
									<a class="btn btn-social-icon btn-google" title="Delete" id="delete" href="{{ route('delete.sub_category',$item->id) }}"><i class="fa fa-trash"></i></a>
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
				  <h3 class="box-title">Add New Sub-Category</h3>
				</div>
				<div class="box-body">
				  <div class="row">
						<div class="col">
							<form method="POST" action="{{ route('store.sub_category') }}">
								@csrf
							  <div class="row">
								<div class="col">
									<div class="form-group">
										<h5>Select Category<span class="text-danger">*</span></h5>
										<div class="controls">
											<select name="category_id" id="category_id" required="" class="form-control" aria-invalid="false">
												<option value="" selected="" disabled="">Select Category</option>
												@foreach($category as $item)
													<option value="{{ $item->id }}">{{ $item->category_name_eng }}</option>
												@endforeach
											</select>
										<div class="help-block"></div></div>
									</div>						
	
									<div class="form-group">
										<h5>Sub-Category Name English <span class="text-danger">*</span></h5>
										<div class="controls">
											<input type="text" name="sub_category_name_eng" class="form-control" required=""> <div class="help-block"></div></div>
											@error('sub_category_name_eng')
												<span class="text-danger">{{ $message }}</span>
											@enderror
									</div>

									<div class="form-group">
										<h5>Sub-Category Name Bangla <span class="text-danger">*</span></h5>
										<div class="controls">
											<input type="text" name="sub_category_name_ban" class="form-control" required=""> <div class="help-block"></div></div>
											@error('sub_category_name_ban')
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