@extends('admin.admin_master')
@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Table content -->
<section class="content">
  <div class="row">
		<div class="col-8">
			<div class="box">
				<div class="box-header with-border">
				  <h3 class="box-title">Sub-Sub-Category List</h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="table-responsive">
					  <table id="example1" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>Category</th>
								<th>Sub-Category</th>
								<th>Sub-Sub-Category Eng</th>
								<th>Sub-Sub-Category Ban</th>
								<th>Actions</th>
							</tr>
						</thead>
						<tbody>
							@foreach($sub_sub_cats as $item)
							<tr>
								<td>{{ $item->category->category_name_eng }}</td>
								<td>{{ $item->subcategory->sub_category_name_eng }}</td>
								<td>{{ $item->sub_sub_cat_name_eng }}</td>
								<td>{{ $item->sub_sub_cat_name_ban }}</td>
								<td>
									<a class="btn btn-social-icon btn-bitbucket" title="Edit" href="{{ route('edit.sub_sub_category',$item->id) }}"><i class="fa fa-pencil"></i></a>
									<a class="btn btn-social-icon btn-google" title="Delete" id="delete" href="{{ route('delete.sub_sub_category',$item->id) }}"><i class="fa fa-trash"></i></a>
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
							<form method="POST" action="{{ route('store.sub_sub_category') }}">
								@csrf
							  <div class="row">
								<div class="col">
									<div class="form-group">
										<h5>Select Category<span class="text-danger">*</span></h5>
										<div class="controls">
											<select name="category_id" required="" class="form-control" aria-invalid="false">
												<option value="" selected="" disabled="">Select....</option>
												@foreach($categories as $item)
													<option value="{{ $item->id }}">{{ $item->category_name_eng }}</option>
												@endforeach
											</select>
										<div class="help-block"></div></div>
									</div>

									<div class="form-group">
										<h5>Select Sub-Category<span class="text-danger">*</span></h5>
										<div class="controls">
											<select name="sub_category_id" required="" class="form-control" aria-invalid="false">
												<option value="" selected="" disabled="">Select....</option>
											</select>
										<div class="help-block"></div></div>
									</div>						
	
									<div class="form-group">
										<h5>Sub-Sub-Category Name English <span class="text-danger">*</span></h5>
										<div class="controls">
											<input type="text" name="sub_sub_cat_name_eng" class="form-control" required=""> <div class="help-block"></div></div>
											@error('sub_sub_cat_name_eng')
												<span class="text-danger">{{ $message }}</span>
											@enderror
									</div>

									<div class="form-group">
										<h5>Sub-Sub-Category Name Bangla <span class="text-danger">*</span></h5>
										<div class="controls">
											<input type="text" name="sub_sub_cat_name_ban" class="form-control" required=""> <div class="help-block"></div></div>
											@error('sub_sub_cat_name_ban')
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