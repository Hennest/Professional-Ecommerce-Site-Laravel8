@extends('admin.admin_master')
@section('admin')
<section class="content">

	<div class="box box-widget widget-user">
					<!-- Add the bg color to the header using any of the bg-* classes -->
					<div class="widget-user-header bg-black">
  <form method="POST" action="{{ route('admin.profile.update') }}" enctype="multipart/form-data">
	@csrf
					  <a href="{{ route('admin.photo.remove') }}" style="float: right;" class="btn btn-rounded btn-danger mb-5">Remove Photo</a>
					  <input type="file" id="new_photo" name="new_photo" hidden/ onchange="showPreviewOne(event);">
					  <label class="btn btn-rounded btn-success mb-5" style="float: right; margin-right: 5px;" for="new_photo">Change Photo</label>

					  <h3 class="widget-user-username">Admin Name: {{ $adminData->name }}</h3>
					  <h6 class="widget-user-desc">Admin Email: {{ $adminData->email }}</h6>
					</div>
					<div class="widget-user-image">
					  <img class="rounded-circle" id="file-ip-1-preview" src="{{ (!empty($adminData->profile_photo_path))? url($adminData->profile_photo_path):url('upload/no_image.jpg') }}">
					</div>
					<div class="box-footer">
					  <div class="row">
						<div class="col-sm-4">
						  <div class="description-block">
							<h5 class="description-header">12K</h5>
							<span class="description-text">FOLLOWERS</span>
						  </div>
						  <!-- /.description-block -->
						</div>
						<!-- /.col -->
						<div class="col-sm-4 br-1 bl-1">
						  <div class="description-block">
							<h5 class="description-header">550</h5>
							<span class="description-text">FOLLOWERS</span>
						  </div>
						  <!-- /.description-block -->
						</div>
						<!-- /.col -->
						<div class="col-sm-4">
						  <div class="description-block">
							<h5 class="description-header">158</h5>
							<span class="description-text">TWEETS</span>
						  </div>
						  <!-- /.description-block -->
						</div>
						<!-- /.col -->
					  </div>
					  <!-- /.row -->
					</div>
				  </div>

	<div class="box">
		<div class="box-header with-border">
		  <h4 class="box-title">Edit Profile Information</h4>
		</div>
		<div class="box-body">
			  <h6 class="mt-15 mb-5">Name</h6>
			  <div class="input-group">
				<span class="input-group-addon">@</span>
				<input type="text" name="name" class="form-control" value="{{ $adminData->name }}" required>
			  </div>
			  <br>

			  <h6 class="mt-15 mb-5">Email</h6>
			  <div class="input-group">
				<span class="input-group-addon"><i class="fa fa-envelope"></i></span>
				<input type="email" name="email" class="form-control" value="{{ $adminData->email }}" required>
			  </div>

			  <br>
			  <div>
			  	<button class="btn btn-rounded btn-info mb-5" type="submit">Save</button>
			  </div>
			  <br>
  </form>
		</div>			 
	</div>
</section>

	<script>
    function showPreviewOne(event){
      if(event.target.files.length > 0){
        let src = URL.createObjectURL(event.target.files[0]);
        let preview = document.getElementById("file-ip-1-preview");
        preview.src = src;
        preview.style.display = "block";
      } 
    }
  </script>

@endsection