@extends('frontend.master')
@section('title', ' | '.'Register New Account')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-12" style="text-align: center">
            <h1 class="m-0"> Height Clearence Certificate Management</h1>
          </div>
        </div>
      </div>
    </div>
    <div class="content">
      <div class="container">
        <div class="row">
          <div class="col-md-4"></div>
          <div class="col-md-4">
            <div class="card card-outline">
                <div class="card-header text-center">
                  <p><b>Register a new membership</b></p>
                </div>
                <div class="card-body">
                  <p class="login-box-msg"></p>

                  <form id="registerForm" action="{{ route('register') }}" method="POST">
                        @csrf
                        <div class="input-group mb-3 form-group">
                            <input type="text" name="name" id="name"
                                    class="form-control @error('username') is-invalid @enderror" placeholder="Full name"
                                    value="{{ old('name') }}">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-user"></span>
                                </div>
                            </div>
                            @error('username')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <span class="text-danger" id="nameError"></span>

                        <div class="input-group mb-3 form-group">
                            <input type="text" name="nid" id="nid" value="{{ old('nid') }}"
                                    class="form-control @error('nid') is-invalid @enderror" placeholder="National ID">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-id-card"></span>
                                </div>
                            </div>
                            @error('nid')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="input-group mb-3 form-group">
                            <input type="email" name="email" value="{{ old('email') }}" id="email"
                                    class="form-control @error('email') is-invalid @enderror" placeholder="Email">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="input-group mb-3 form-group">
                            <input type="text" name="mobile" value="{{ old('mobile') }}" id="mobile"
                                    class="form-control @error('mobile') is-invalid @enderror" placeholder="Mobile">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-phone"></span>
                                </div>
                            </div>
                            @error('mobile')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group input-group">
                            <input id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror"
                                name="password" placeholder="Enter Password">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group input-group">
                            <input id="password-confirm" type="password"
                                class="form-control @error('password-confirm') is-invalid @enderror"
                                name="password_confirmation" placeholder="Retype Password">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                            @error('password_confirmation')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="col-8">
                                <div class="form-group mb-0">
                                    <div class="custom-control custom-checkbox">
                                    <input type="checkbox" name="terms" class="custom-control-input" id="exampleCheck1">
                                    <label class="custom-control-label" for="exampleCheck1">I agree to the <a href="#">terms of service</a>.</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <button type="submit" class="btn btn-primary btn-block btn-submit">Register</button>
                            </div>
                        </div>
                  </form>
                  <a href="{{ route('login') }}" class="text-center">I already have a membership</a>
                </div>
              </div>
          </div>
        </div>

      </div>
    </div>
</div>
@endsection

@push('page-js')
<script src="{{ asset('plugins/jquery-validation/jquery.validate.min.js') }}"></script>
<script src="{{ asset('plugins/jquery-validation/additional-methods.min.js') }}"></script>
<script>
    $(function () {
      $('#registerForm').validate({
        rules: {
            name: {
                required: true,
                maxlength: 191
            },
            nid: {
                required: true,
                minlength: 10,
                maxlength: 10
                },
            email: {
                required: true,
                email: true,
            },
            mobile: {
                required: true,
                minlength: 11,
                maxlength: 11
            },
            password: {
                required: true,
                minlength: 6,
            },
            password_confirmation: {
                required: true
            },
            terms:{
                required: true
            }
        },
        messages: {
            name: {
                required: "Full name is required",
                maxlength: "More than 191 characters is not acceptable"
            },
            nid: {
                required: "National ID number is required",
                minlength: "NID number is not valid",
                maxlength: "NID number is not valid",
            },
            email: {
                required: "Email address is required",
                email: "Email address is not valid"
            },
            mobile: {
                required: "Mobile number is required",
                maxlength: "Mobile number is not valid",
                minlength: "Mobile number is not valid"
            },
            password: {
                required: "Password is required",
                minlength: "Password must be at least 6 characters"
            },
            password_confirmation: {
                required: "Password confirmation is required",
            },
            terms:{
                required: "Please accept our terms"
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
