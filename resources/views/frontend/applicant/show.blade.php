@extends('layouts.master')
@section('title', ' | '.'Account Details')

@section('content')
<section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
                <h3 class="card-title">Account Information</h3>
            </div>
            <div class="card-body">
              <div class="row">
                  <div class="col-md-8">
                    <form id="updateForm">
                        <div class="card-body">
                            <div class="row">
                                <label for="name" class="col-sm-2 col-form-label">Name</label>
                                <div class="col-sm-10">
                                    <div class="form-group">
                                        <input type="text" name="name" class="form-control"
                                            value="{{ old('name', $data->name) }}"
                                            id="name" placeholder="Enter name">
                                        <span class="text-danger" id="nameError"></span>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <label for="nid" class="col-sm-2 col-form-label">NID</label>
                                <div class="col-sm-10">
                                    <div class="form-group">
                                        <input type="text" name="nid" class="form-control"
                                            value="{{ old('nid', $data->applicant->nid) }}"
                                            id="nid" placeholder="Enter NID Number">
                                        <span class="text-danger" id="nidError"></span>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <label for="email" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <div class="form-group">
                                        <input type="email" name="email" class="form-control"
                                            value="{{ old('email', $data->email) }}"
                                            id="email" placeholder="Enter Email address">
                                        <span class="text-danger" id="emailError"></span>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <label for="mobile" class="col-sm-2 col-form-label">Mobile</label>
                                <div class="col-sm-10">
                                    <div class="form-group">
                                        <input type="text" name="mobile" class="form-control"
                                            value="{{ old('mobile', $data->applicant->mobile) }}"
                                            id="mobile" placeholder="Enter Mobile Number">
                                        <span class="text-danger" id="mobileError"></span>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <label for="username" class="col-sm-2 col-form-label">Username</label>
                                <div class="col-sm-10">
                                    <div class="form-group">
                                        <input type="text" name="username" class="form-control"
                                            value="{{ old('username', $data->username) }}"
                                            id="username" placeholder="Enter Username">
                                        <span class="text-danger" id="usernameError"></span>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <label for="password" class="col-sm-2 col-form-label">Password</label>
                                <div class="col-sm-10">
                                    <div class="form-group">
                                        <input type="text" name="password" class="form-control"
                                            id="password" placeholder="Enter Password">
                                        <span class="text-danger" id="passwordError"></span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="offset-sm-2 col-sm-10">
                                  <button type="submit" class="btn btn-danger btn-sm btn-submit"><b>Update</b> <i class="fas fa-edit"></i></button>
                                </div>
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
  </section>
@endsection

@push('page-js')
<script src="{{ asset('plugins/jquery-validation/jquery.validate.min.js') }}"></script>
<script src="{{ asset('plugins/jquery-validation/additional-methods.min.js') }}"></script>
<script>
$(function () {
  $('#updateForm').validate({
    rules: {
      name: {
        required: true,
        maxlength: 191,
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
      username: {
          required: true,
      }
    },
    messages: {
      name: {
        required: "Full name is required",
        maxlength: "More than 191 characters is not acceptable"
      },
      nid: {
        required: "NID number is required",
        minlength: "NID number is not valid",
        maxlength: "NID number is not valid"
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
      username: {
          required: "Username is required"
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

<script type="text/javascript">
    $(document).ready(function() {
        $(".btn-submit").click(function(e){
            e.preventDefault();

            var _token = $("input[name='_token']").val();
            var name = $("#name").val();
            var nid = $("#nid").val();
            var email = $("#email").val();
            var mobile = $("#mobile").val();
            var username = $("#username").val();
            var password = $("#password").val();

            $.ajax({
                url: "{{ route('applicant.account.update') }}",
                type:'PUT',
                data: {_token:_token, name:name, nid:nid, email:email, mobile:mobile, username:username, password:password},
                success:function(response) {
                    Toast.fire({
                        icon: 'success',
                        title: 'Employee created successfully'
                        })
                },
                error:function (response) {
                    $('#nameError').text(response.responseJSON.errors.name);
                    $('#nidError').text(response.responseJSON.errors.nid);
                    $('#passwordError').text(response.responseJSON.errors.password);
                    $('#usernameError').text(response.responseJSON.errors.username);
                    $('#emailError').text(response.responseJSON.errors.email);
                    $('#mobileError').text(response.responseJSON.errors.mobile);
                }
            });
        });
    });
</script>
@endpush
