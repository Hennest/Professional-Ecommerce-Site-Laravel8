@extends('admin.admin_master')
@section('admin')

<section class="content">
	<!-- alert message-->
    @if(session('warning'))
      	<div class="alert alert-warning alert-dismissible fade show" role="alert">
		  <strong>{{ session('warning') }}</strong>
		  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		    <span aria-hidden="true">&times;</span>
		  </button>
		</div>
    @endif

	<div class="box">
	<div class="box-header with-border">
	  <h4 class="box-title">Edit Password Information</h4>
	</div>
	<!-- /.box-header -->
	<div class="box-body">
	  <div class="row">
		<div class="col">
		<form method="POST" action="{{ route('admin.update.password') }}">
			@csrf
			<div class="row">
				<div class="col-12">
					<div class="form-group">
						<h5>Current Password <span class="text-danger">*</span></h5>
						<div class="controls">
							<input type="password" name="old_password" class="form-control" required=""data-validation-required-message="This field is required"> <div class="help-block"></div>
						</div>
					</div>						
					<div class="form-group">
						<h5>New Password <span class="text-danger">*</span></h5>
						<div class="controls">
							<input type="password" id="password" name="password" class="form-control" required="" data-validation-required-message="This field is required"> <div class="help-block"></div>
						</div>
						<div class="form-control-feedback"><small>password has to be minimum of 6 degit.</small></div>
						@error('password')
							<span class="text-danger">{{$message}}</span>
						@enderror
					</div>
					<div class="form-group">
						<h5>Repeat New Password <span class="text-danger">*</span></h5>
						<div class="controls">
							<input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required=""> <div class="help-block"></div>
						</div>
						@error('password_confirmation')
							<span class="text-danger">{{$message}}</span>
						@enderror
					</div>
				</div>
			</div>

			<div class="text-xs-right">
				<button type="submit" class="btn btn-rounded btn-info">Submit</button>
			</div>
		</form>

		</div>
		<!-- /.col -->
	  </div>
	  <!-- /.row -->
	</div>	

</section>

@endsection