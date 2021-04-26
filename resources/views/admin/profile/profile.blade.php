@extends('layouts.master')
@section('title', ' | '.'Employee Profile')

@section('content')
<section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Profile</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                    <div class="col-md-8">
                        <form id="profileUpdateForm">
                            @csrf
                            <div class="row">
                                <label for="name" class="col-sm-2 col-form-label">Name</label>
                                <div class="col-sm-10">
                                    <div class="form-group">
                                        <input type="text" name="name" class="form-control"
                                            value="{{ old('name', auth()->user()->name) }}"
                                            id="name" placeholder="Enter name">
                                        <span class="text-danger" id="nameError"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label for="designation" class="col-sm-2 col-form-label">Designation</label>
                                <div class="col-sm-10">
                                    <div class="form-group">
                                        <input type="text" name="designation" class="form-control"
                                            value="{{ old('designation', auth()->user()->employee->designation) }}"
                                            id="designation" placeholder="Enter designation">
                                        <span class="text-danger" id="designationError"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label for="department" class="col-sm-2 col-form-label">Department</label>
                                <div class="col-sm-10">
                                    <div class="form-group">
                                        <input type="text" name="department" class="form-control"
                                            value="{{ old('department', auth()->user()->employee->department) }}"
                                            id="department" placeholder="Enter department">
                                        <span class="text-danger" id="departmentError"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label for="email" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <div class="form-group">
                                        <input type="email" name="email" class="form-control"
                                            value="{{ old('email', auth()->user()->email) }}"
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
                                            value="{{ old('mobile', auth()->user()->employee->mobile) }}"
                                            id="mobile" placeholder="Enter Mobile Number">
                                        <span class="text-danger" id="mobileError"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label for="signature" class="col-sm-2 col-form-label">Signature</label>
                                <div class="col-sm-10">
                                    <div class="form-group">
                                        <input type="file" name="signature"
                                        id="signature">
                                        <span class="text-danger" id="signatureError"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label for="seal" class="col-sm-2 col-form-label">seal</label>
                                <div class="col-sm-10">
                                    <div class="form-group">
                                        <input type="file" name="signature"
                                        id="seal">
                                        <span class="text-danger" id="sealError"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label for="username" class="col-sm-2 col-form-label">Username</label>
                                <div class="col-sm-10">
                                    <div class="form-group">
                                        <input type="text" name="username" class="form-control"
                                            value="{{ old('username', auth()->user()->username) }}"
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
                          </form>
                    </div>
                        <div class="col-md-4 pl-0">
                            <div class="row">
                                <div class="col-md-6">
                                    @if (auth()->user()->employee->signature)
                                    <img id="signaturePreview" src="{{ url('storage/images/signatures/'.auth()->user()->employee->signature) }}" alt="" height="150px" width="150px">
                                    @else
                                    <img id="signaturePreview" src="{{ asset('img/150.png') }}" alt="" height="150px" width="150px">
                                    @endif
                                </div>
                                <div class="col-md-6">
                                <div class="col-md-6">
                                    @if (auth()->user()->employee->seal)
                                    <img id="sealPreview" src="{{ url('storage/images/seals/'.auth()->user()->employee->seal) }}" alt="" height="150px" width="150px">
                                        @else
                                    <img id="sealPreview" src="{{ asset('img/150.png') }}" alt="" height="150px" width="150px">
                                    @endif
                                </div>
                                </div>
                            </div>
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
      $.validator.setDefaults({
        submitHandler: function () {
          alert( "Form successful submitted!" );
        }
      });
      $('#profileUpdateForm').validate({
        rules: {
          name: {
            required: true,
            maxlength: 191,
          },
          designation: {
            required: true,
            maxlength: 191,
          },
          department: {
            required: true,
            maxlength: 191,
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
          },
          terms: {
            required: true
          },
        },
        messages: {
          name: {
            required: "Full name is required",
            maxlength: "More than 191 characters is not acceptable"
          },
          designation: {
            required: "Designation title is required",
            maxlength: "More than 191 characters is not acceptable"
          },
          department: {
            required: "Department title is required",
            maxlength: "More than 191 characters is not acceptable"
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
          },
          terms: "Please accept our terms"
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
        signatureBase64 = null
        sealBase64 = null
        $('#signature').change(function(){
            let reader = new FileReader()

            if (this.files[0].size < 209715) {
                reader.onload = (e) => {
                    $('#signaturePreview').attr('src', e.target.result)
                    signatureBase64 = e.target.result
                }
                reader.readAsDataURL(this.files[0])
            }else{
                Toast.fire({
                        icon: 'error',
                        title: 'More than 2MB file is not supported'
                    })
            }
        })

        $('#seal').change(function(){
            let reader = new FileReader()

            if (this.files[0].size < 209715) {
                reader.onload = (e) => {
                    $('#sealPreview').attr('src', e.target.result)
                    sealBase64 = e.target.result
                    // console.log(data)
                }
                reader.readAsDataURL(this.files[0])
            }else{
                Toast.fire({
                        icon: 'error',
                        title: 'More than 2MB file is not supported'
                    })
            }
        })

        $(".btn-submit").click(function(e){
            e.preventDefault();

            var _token = $("input[name='_token']").val();
            var name = $("#name").val();
            var designation = $("#designation").val();
            var department = $("#department").val();
            var email = $("#email").val();
            var mobile = $("#mobile").val();
            var signature = signatureBase64;
            var seal = sealBase64;
            var password = $("#password").val();
            var username = $("#username").val();

            $.ajax({
                url: '/admin/profile/',
                type:'PUT',
                data: {_token:_token, name:name, designation:designation, department:department,
                        email:email, mobile:mobile, signature:signature, seal:seal, password:password, username:username},
                success:function(response) {
                    Toast.fire({
                        icon: 'success',
                        title: 'Profile information updated successfully'
                        })
                },
                error:function (response) {
                    $('#nameError').text(response.responseJSON.errors.name);
                    $('#designationError').text(response.responseJSON.errors.designation);
                    $('#departmentError').text(response.responseJSON.errors.department);
                    $('#emailError').text(response.responseJSON.errors.email);
                    $('#mobileError').text(response.responseJSON.errors.mobile);
                    $('#signatureError').text(response.responseJSON.errors.signature);
                    $('#sealError').text(response.responseJSON.errors.seal);
                    $('#passwordError').text(response.responseJSON.errors.password);
                    $('#usernameError').text(response.responseJSON.errors.username);
                }
            });
        });
    });
</script>
@endpush
