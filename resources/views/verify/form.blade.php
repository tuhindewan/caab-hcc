@extends('frontend.master')
@section('title', ' | '.'Login')

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
                  <p><b>Enter your account verification code here</b></p>
                </div>
                <div class="card-body">
                    @if(Session::has('message'))
                    <div class="alert alert-danger">{{Session::get('message')}}</div>
                    @endif
                  <form id="loginForm" method="POST" action="{{ route('verify') }}">
                      @csrf
                      <div class="form-group input-group">
                          <input id="code" type="text"
                              class="form-control @error('code') is-invalid @enderror"
                              name="code" value="{{ old('code') }}" placeholder="Enter code">
                          <div class="input-group-append">
                              <div class="input-group-text">
                                  <span class="fas fa-lock"></span>
                              </div>
                          </div>
                          @error('code')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                      </div>
                      <div class="row">
                          <div class="col-4">
                              <button type="submit" class="btn btn-primary btn-block">Verify</button>
                          </div>
                      </div>
                  </form>
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
      $('#loginForm').validate({
        rules: {
            code: {
                required: true,
            }
        },
        messages: {
            code: {
                required: "Verification code is required",
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
