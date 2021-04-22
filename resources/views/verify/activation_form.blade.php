@extends('frontend.master')

@section('title', ' | '.'Account Activation')

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
                  <p><b>Enter your registered mobile number to get verification code</b></p>
                </div>
                <div class="card-body">
                    @include('layouts.partials.flash_messages')
                  <form id="form" method="POST" action="{{ route('activation.submit') }}">
                      @csrf
                      <div class="form-group input-group">
                          <input id="mobile" type="text"
                              class="form-control @error('mobile') is-invalid @enderror"
                              name="mobile" value="{{ old('mobile') }}" placeholder="Enter Mobile Number">
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
                      <div class="row">
                          <div class="col-6">
                              <button type="submit" class="btn btn-primary btn-block">Get Code</button>
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
      $('#form').validate({
        rules: {
            mobile: {
                required: true,
            }
        },
        messages: {
            mobile: {
                required: "Nobile number is required",
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

