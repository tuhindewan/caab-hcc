@extends('layouts.master')

@section('title', ' - '.'Employee Create')
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
              <h3 class="card-title">Employee Create</h3>
            </div>
            <form id="createForm" action="{{ route('admin.employee.store') }}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <input type="text" name="name"
                          class="form-control"placeholder="Enter name">
                    </div>
                    <div class="form-group">
                      <input type="text" name="designation"
                        class="form-control" placeholder="Enter Designation">
                    </div>
                    <div class="form-group">
                      <input type="text" name="department"
                        class="form-control" placeholder="Enter Department">
                    </div>
                    <div class="form-group">
                      <input type="email" name="email"
                        class="form-control" placeholder="Enter email">
                    </div>
                    <div class="form-group">
                        <select class="selectpicker form-control"
                            title="Select Role" data-live-search="true" multiple name="roleID">
                            <option style="display: none"></option>
                            @foreach ($roles as $role)
                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="text" name="mobile"
                          class="form-control" placeholder="Enter mobile number">
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-success btn-sm">
                    <b>Create</b> <i class="fas fa-share-square"></i>
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

//   function submitFunction(event){
// 	event.preventDefault();
// }
// $("#createForm").submit(submitFunction);

});
</script>
@endpush

@endsection
