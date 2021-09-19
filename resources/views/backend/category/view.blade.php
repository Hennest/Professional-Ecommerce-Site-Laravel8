@extends('admin.admin_master')
@section('admin')

<!-- Table content -->
<section class="content">
  <div class="row">
		<div class="col-8">
			<div class="box">
				<div class="box-header with-border">
				  <h3 class="box-title">Category List</h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="table-responsive">
					  <table id="example1" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>Category Name English</th>
								<th>Category Name Bangla</th>
								<th>Category Icon</th>
								<th>Actions</th>
							</tr>
						</thead>
						<tbody>
							@foreach($categories as $category)
							<tr>
								<td>{{ $category->category_name_eng }}</td>
								<td>{{ $category->category_name_ban }}</td>
								<td> <span><i class="{{$category->category_icon}}"></i></span> </td>
								<td>
									<a class="btn btn-social-icon btn-bitbucket" title="Edit" href="{{ route('edit.category',$category->id) }}"><i class="fa fa-pencil"></i></a>
									<a class="btn btn-social-icon btn-google" title="Delete" id="delete" href="{{ route('delete.category',$category->id) }}"><i class="fa fa-trash"></i></a>
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
				  <h3 class="box-title">Add New Category</h3>
				</div>
				<div class="box-body">
				  <div class="row">
						<div class="col">
							<form method="POST" action="{{ route('store.category') }}">
								@csrf
							  <div class="row">
								<div class="col">						
									<div class="form-group">
										<h5>Category Name English <span class="text-danger">*</span></h5>
										<div class="controls">
											<input type="text" name="category_name_eng" class="form-control" required="" data-validation-required-message="This field is required"> <div class="help-block"></div></div>
											@error('category_name_eng')
												<span class="text-danger">{{ $message }}</span>
											@enderror
									</div>
									<div class="form-group">
										<h5>Category Name Bangla <span class="text-danger">*</span></h5>
										<div class="controls">
											<input type="text" name="category_name_ban" class="form-control" required="" data-validation-required-message="This field is required"> <div class="help-block"></div></div>
											@error('category_name_ban')
												<span class="text-danger">{{ $message }}</span>
											@enderror
									</div>
									
									<div class="form-group">
										<h5>Category Icon<span class="text-danger">*</span></h5>
										<div class="controls">
											<input type="text" name="category_icon" class="form-control" required=""> <div class="help-block"></div></div>
											@error('category_icon')
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