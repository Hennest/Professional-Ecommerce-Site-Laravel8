@extends('frontend.main_master')
@section('front_content')

<div class="breadcrumb">
  <div class="container">
    <div class="breadcrumb-inner">
      <ul class="list-inline list-unstyled">
        <li><a href="#">Home</a></li>
        <li class="active">Update Password</li>
      </ul>
    </div><!-- /.breadcrumb-inner -->
  </div><!-- /.container -->
</div>

<div class="body-content">
  <div class="container">
    <div class="checkout-box ">
      <div class="row">
        <div class="col-md-8">
          <div class="panel-group checkout-steps" id="accordion">
            <!-- checkout-step-01  -->
<div class="panel panel-default checkout-step-01">

  <!-- panel-heading -->
    <div class="panel-heading">
      <h4 class="unicase-checkout-title">
          <a data-toggle="collapse" class="" data-parent="#accordion" href="#collapseOne">
            <span>Welcome!</span>Change Your Password.</a>
       </h4>
    </div>
    <!-- panel-heading -->

    <!-- alert message-->
    @if(session('warning'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
      <strong>{{ session('warning') }}</strong>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    @endif

  <div id="collapseOne" class="panel-collapse collapse in">

    <!-- panel-body  -->
      <div class="panel-body">
      <div class="row">   
        <!-- already-registered-login -->
        <div class="col-md-8 col-sm-6 already-registered-login">
          <form class="register-form" role="form" method="POST" action="{{ route('user.change.password') }}">
            @csrf
            <div class="form-group">
              <label class="info-title" for="exampleInputEmail1">Current Password</label>
              <input type="password" class="form-control unicase-form-control text-input" name="old_password" required="">
            </div>
            <div class="form-group">
              <label class="info-title" for="exampleInputEmail1">New Password</label>
              <input type="password" class="form-control unicase-form-control text-input" id="password" name="password">
              @error('password')
                <span class="text-danger">{{$message}}</span>
              @enderror
            </div>
            <div class="form-group">
              <label class="info-title" for="exampleInputEmail1">Confirm Password</label>
              <input type="password" class="form-control unicase-form-control text-input" id="password_confirmation" name="password_confirmation">
              @error('password_confirmation')
                <span class="text-danger">{{$message}}</span>
              @enderror
            </div>

            <button type="submit" class="btn-upper btn btn-primary checkout-page-button checkout-continue ">Change</button>
          </form> 
        </div>  
        <!-- already-registered-login -->  

      </div>      
    </div>
    <!-- panel-body  -->

  </div><!-- row -->
</div>
<!-- checkout-step-01  -->
             
          </div><!-- /.checkout-steps -->
        </div>
        <div class="col-md-4">
          <!-- checkout-progress-sidebar -->
<div class="checkout-progress-sidebar ">
  <div class="panel-group">
    <div class="panel panel-default">
      <div class="panel-heading">
          <h4 class="unicase-checkout-title">Your Checkout Progress</h4>
        </div>
        <div class="">
        <ul class="nav nav-checkout-progress list-unstyled">
          <li><a href="{{ url('/') }}">Home</a></li>
          <li><a href="{{ route('user.update.profile') }}">Update Profile</a></li>
          <li><a href="{{ route('user.update.password') }}">Change Password</a></li>
          <!-- Authentication -->
          <form method="POST" action="{{ route('logout') }}">
              @csrf
              <li><a href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                          this.closest('form').submit();">
                        Logout
                  </a>
              </li>
          </form>
        </ul>   
      </div>
    </div>
  </div>
</div> 
<!-- checkout-progress-sidebar -->        </div>
      </div><!-- /.row -->
    </div><!-- /.checkout-box -->

</div><!-- /.container -->
</div>

              
@endsection