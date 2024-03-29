@extends('layouts.master')

@section('title', ' | '.'Employee Create')
@push('page-css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
<style>
    .card-footer{
        border-top: none !important;
    }
</style>
@endpush
@section('content')
<section class="content">
    <div class="container-fluid">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- jquery validation -->
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Employee Edit</h3>
            </div>
            <form id="createForm">
                @csrf
                <input type="hidden" id="EmployeeID" name="EmployeeID" value="{{ $employee->id }}">
                <div class="card-body">
                    <div class="form-group">
                        <input type="text" name="name" id="name"
                          class="form-control" value="{{old('name', $employee->user->name)}}"
                          placeholder="Enter name">
                          <span class="text-danger" id="nameError"></span>
                    </div>
                    <div class="form-group">
                      <input type="text" name="designation" id="designation"
                        class="form-control" value="{{old('designation', $employee->designation)}}"
                        placeholder="Enter Designation">
                        <span class="text-danger" id="designationError"></span>
                    </div>
                    <div class="form-group">
                      <input type="text" name="department" id="department"
                        class="form-control"  value="{{old('department', $employee->department)}}"
                        placeholder="Enter Department">
                        <span class="text-danger" id="departmentError"></span>
                    </div>
                    <div class="form-group">
                      <input type="email" name="email" id="email"
                        class="form-control" value="{{old('email', $employee->user->email)}}"
                        placeholder="Enter email">
                        <span class="text-danger" id="emailError"></span>
                    </div>
                    <div class="form-group">
                        <select class="selectpicker form-control" id="roles"
                            title="Select Role" data-live-search="true" multiple name="roles[]">
                            <option style="display: none"></option>
                            @foreach ($roles as $role)
                            <option value="{{ $role->id }}"
                                @foreach ($employee->user->roles as $empRole)
                                {{ $role->id == $empRole->id ? 'selected' : ''}}
                                @endforeach
                            >
                                {{ $role->name }}
                            </option>
                            @endforeach
                        </select>
                        <span class="text-danger" id="rolesError"></span>
                    </div>
                    <div class="form-group">
                        <input type="text" name="mobile" id="mobile"
                          class="form-control" value="{{old('mobile', $employee->mobile)}}"
                          placeholder="Enter mobile number">
                          <span class="text-danger" id="mobileError"></span>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-success btn-sm btn-submit">
                        <b>update</b> <i class="fas fa-share-square"></i>
                    </button>
                    <a class="btn btn-danger btn-sm" href="{{ route('admin.employees.index') }}">
                        <b>Cancel</b> <i class="fas fa-window-close"></i>
                    </a>
                </div>
            </form>
          </div>
      </div>
    </div>
  </section>

@push('page-js')
<script src="{{ asset('plugins/jquery-validation/jquery.validate.min.js') }}"></script>
<script src="{{ asset('plugins/jquery-validation/additional-methods.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
<script>
$(function () {
  $('#createForm').validate({
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
      roleID: {
        required: true,
      },
      mobile: {
            required: true,
            minlength: 11,
            maxlength: 11
      }
    },
    messages: {
      name: {
        required: "Employee name is required",
        maxlength: "More than 191 characters is not acceptable"
      },
      designation: {
        required: "Employee designation is required",
        maxlength: "More than 191 characters is not acceptable"
      },
      department: {
        required: "Employee department is required",
        maxlength: "More than 191 characters is not acceptable"
      },
      email: {
        required: "Employee email address is required",
        email: "Email address is not valid"
      },
      roleID: {
        required: "Employee role selection is required",
      },
      mobile: {
        required: "Employee mobile number is required",
        maxlength: "Mobile number is not valid",
        minlength: "Mobile number is not valid"
      },
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
            var EmployeeID = $("#EmployeeID").val();
            var name = $("#name").val();
            var designation = $("#designation").val();
            var department = $("#department").val();
            var email = $("#email").val();
            var mobile = $("#mobile").val();
            var roles = $("#roles").val();

            $.ajax({
                url: '/admin/employee/'+EmployeeID,
                type:'PUT',
                data: {_token:_token, name:name, designation:designation, department:department, EmployeeID:EmployeeID,
                        email:email, mobile:mobile, roles:roles},
                success:function(response) {
                    Toast.fire({
                        icon: 'success',
                        title: 'Employee updated successfully'
                        })
                },
                error:function (response) {
                    $('#nameError').text(response.responseJSON.errors.name);
                    $('#designationError').text(response.responseJSON.errors.designation);
                    $('#departmentError').text(response.responseJSON.errors.department);
                    $('#rolesError').text(response.responseJSON.errors.roles);
                    $('#emailError').text(response.responseJSON.errors.email);
                    $('#mobileError').text(response.responseJSON.errors.mobile);
                }
            });
        });
    });
</script>
@endpush

@endsection
