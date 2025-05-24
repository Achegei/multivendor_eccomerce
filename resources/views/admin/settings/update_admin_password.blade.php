
@extends('admin.layout.layout')
@section('content')

<div class="main-panel">        
        <div class="content-wrapper">
          <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Settings</h4>
                  <p class="card-description">
                    <strong>Update Admin Password</strong>
                  </p>
                  @if(Session::has('error_message'))
                  <div class="alert alert-danger" role="alert">
                    <strong>Error:</strong><p>{{Session::get('error_message')}}</p>
                  </div>
                  <h6 class="font-weight-light">Sign in to continue.</h6>
                  @endif
                  @if(Session::has('success_message'))
                    <div class="alert alert-success" role="alert">
                      <strong>Success:</strong> {{ Session::get('success_message') }}
                    </div>
                  @endif
                  <form class="forms-sample" action="{{url('admin/update_password')}}" method="post">
                    @csrf
                    <div class="form-group">
                      <label>Admin Username/Email</label>
                      <input type="text" class="form-control" id="exampleInputUsername1" placeholder="{{'adminDetails'}}">
                    </div>
                    <div class="form-group">
                      <label>Email address</label>
                      <input type="email" class="form-control" id="exampleInputEmail1" value="{{$adminDetails['type']}}" readonly="">
                    </div>
                    <div class="form-group">
                      <label for="current_password"> Current Password</label>
                      <input type="password" class="form-control" id="current_password" placeholder="Enter current password" name="current_password" required="">
                      <span id="check_password"></span>
                    </div>
                    <div class="form-group">
                      <label for="new_password"> New Password</label>
                      <input type="password" class="form-control" id="new_password" placeholder="Enter New Password" name="new_password" required="">
                    </div>
                    <div class="form-group">
                      <label for="confirm_password">Confirm Password</label>
                      <input type="password" class="form-control" id="confirm_passwor" placeholder="Confirm Password" name="confirm_passwor" required="">
                    </div>
                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    <button class="btn btn-light">Cancel</button>
                  </form>
                </div>
              </div>
            </div>
@endsection