@extends('frontend.main_master')
@section('front_content')

<div class="breadcrumb">
  <div class="container">
    <div class="breadcrumb-inner">
      <ul class="list-inline list-unstyled">
        <li><a href="#">Home</a></li>
        <li class="active">User Profile</li>
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
            <span>Welcome!</span>{{ Auth::user()->name }}
          </a>
       </h4>
    </div>
    <!-- panel-heading -->

  <div id="collapseOne" class="panel-collapse collapse in">

    <!-- panel-body  -->
      <div class="panel-body">
      <div class="row">   
        <!-- already-registered-login -->
        <div class="col-md-8 col-sm-6 already-registered-login">
            <div class="form-group">
              <label class="info-title" for="exampleInputEmail1">User Name</label>
              <input type="text" class="form-control unicase-form-control text-input" id="name" value="{{ Auth::user()->name }}" readonly>
            </div>
            <div class="form-group">
              <label class="info-title" for="exampleInputEmail1">Email Address</label>
              <input type="email" class="form-control unicase-form-control text-input" id="email" value="{{ Auth::user()->email }}" readonly>
            </div>
            <div class="form-group">
              <label class="info-title" for="exampleInputEmail1">Phone Number</label>
              <input type="text" class="form-control unicase-form-control text-input" id="phone" value="{{ Auth::user()->phone }}" readonly>
            </div> 
        </div>  
        <!-- already-registered-login -->

        <!-- guest-login -->      
        <div class="col-md-4 col-sm-6 guest-login">
          <center><img src="{{ (!empty(Auth::user()->profile_photo_path))? url(Auth::user()->profile_photo_path):url('upload/no_image.jpg') }}" style="border: 2px solid black; height: 150px; width: 150px;"></center>
        </div>
        <!-- guest-login -->   

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