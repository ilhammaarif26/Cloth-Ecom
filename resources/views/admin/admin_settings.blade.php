  @extends('layouts.admin_layout.admin_layout')
  
  @section('content')
         <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Admin Setting</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Admin Settings</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
          <div class="row">
            <!-- left column -->
            <div class="col-md-6">
              <!-- general form elements -->
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Update Password</h3>
                </div>
                <!-- /.card-header -->

                @if (Session::has('error_message'))
                    <div class="alert alert-danger alert-dismissable fade show">
                      {{Session::get('error_message')}}
                      <button type="buttob" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                @endif
                @if (Session::has('success_message'))
                <div class="alert alert-info alert-dismissable fade show">
                  {{Session::get('success_message')}}
                  <button type="buttob" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
                </div>
            @endif
                <!-- form start -->
                <form role="form" method="POST" action="{{url('/admin/update-current-pwd')}}" name="updatePasswordForm" id="updatePasswordForm">
                  @csrf
                  <div class="card-body">
                    {{-- <div class="form-group">
                        <label for="exampleInputEmail1">Admin Name</label>
                        <input type="email" class="form-control" value="{{$adminDetails->name}}" placeholder="enter admin name " 
                        name="admin_name" id="admin_name">
                    </div> --}}
                    <div class="form-group">
                      <label for="exampleInputEmail1">Email</label>
                      <input type="email" class="form-control" value="{{$adminDetails->email}}" readonly="" >
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Admin type</label>
                        <input type="email" class="form-control" value="{{$adminDetails->type}}" readonly="" >
                      </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Current Password</label>
                      <input type="password" class="form-control" placeholder=" Enter currentPassword" name="current_pwd" id="current_pwd"
                      required="">
                      <span id="checkCurrentPwd"></span>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">New Password</label>
                        <input type="password" class="form-control" name="new_pwd" id="new_pwd" placeholder="Enter new password"
                        required="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Confirm Password</label>
                        <input type="password" class="form-control" name="confirm_pwd" id="confirm_pwd" placeholder=" Confirm new password"
                        required="">
                    </div>
                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer">
                    <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                  </div>
                </form>
              </div>
              <!-- /.card -->  
          </div>
          <!-- /.row -->
        </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->
    
  </div>
  <!-- /.content-wrapper -->
  @endsection
 