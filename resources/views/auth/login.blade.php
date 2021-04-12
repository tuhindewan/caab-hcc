@extends('layouts.public_master')
@section('title', ' | '.'Login')

@section('content')
<div class="login-box">
    <div class="card card-outline">
      <div class="card-header text-center">
        <a href="" class="h1">HCC Management System</a>
      </div>
      <div class="card-body">
        <p class="login-box-msg">Sign in to start your session</p>

        <form id="loginForm">
            <div class="form-group input-group">
                <input type="text" name="username" id="username"
                  class="form-control" placeholder="Enter Username">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-envelope"></span>
                    </div>
                </div>
            </div>
            <div class="form-group input-group">
                <input type="password" name="password" id="password"
                    class="form-control" placeholder="Password">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-8">
                    <div class="icheck-primary">
                        <input type="checkbox" id="remember">
                        <label for="remember">
                        Remember Me
                        </label>
                    </div>
                </div>
                <div class="col-4">
                    <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                </div>
            </div>
        </form>

        <p class="mb-1">
          <a href="forgot-password.html">I forgot my password</a>
        </p>
      </div>
    </div>
  </div>
@endsection

@push('page-js')
<script src="{{ asset('plugins/jquery-validation/jquery.validate.min.js') }}"></script>
<script src="{{ asset('plugins/jquery-validation/additional-methods.min.js') }}"></script>
<script>
    $(function () {
      $('#loginForm').validate({
        rules: {
            username: {
                required: true,
          },
            password: {
                required: true,
                minlength: 6,
          }
        },
        messages: {
            username: {
                required: "Employee username is required",
                maxlength: "More than 191 characters is not acceptable"
            },
            password: {
                required: "Employee password is required",
                minlength: "Password must be at least 6 characters"
            }
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
          error.addClass('invalid-feedback');
          element.closest('.form-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
          $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
          $(element).removeClass('is-invalid');
        }
      });
    });
</script>
@endpush
