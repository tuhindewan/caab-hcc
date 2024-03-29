@extends('layouts.master')
@section('title', ' | '.'Employee List')

@push('page-css')
<link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endpush

@section('content')
<section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Employee List</h3>
                <div class="card-tools">
                    <a href="{{ route('admin.employee.create') }}" class="btn btn-success">
                        Add New
                        <i class="fas fa-user-plus"></i>
                    </a>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Name</th>
                  <th>Designation</th>
                  <th>Department</th>
                  <th>Email</th>
                  <th>Mobile</th>
                  <th>Roles</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($employees as $employee)
                    <tr id="EmpID{{$employee->id}}">
                        <td>{{ $employee->user->name }}</td>
                        <td>{{ $employee->designation }}</td>
                        <td>{{ $employee->department }}</td>
                        <td>{{ $employee->user->email }}</td>
                        <td>{{ $employee->mobile }}</td>
                        <td>
                            @foreach ($employee->user->roles as $role)
                            <span class="badge badge-info">{{ $role->name }}</span>
                            @endforeach
                        </td>
                        <td>
                            <a type="button" title="Details"
                                href="{{ route('admin.employee.show', $employee->id) }}">
                                <i class="fas fa-eye text-cyan"></i>
                            </a>
                            /
                            <a type="button" title="Edit"
                                href="{{ route('admin.employee.edit', $employee->id) }}">
                                <i class="fas fa-edit text-blue"></i>
                            </a>
                            /
                            <a type="button" href="javascript:void(0)"
                                onclick="deleteEmployee({{ $employee->id }})" title="Delete">
                                <i class="fas fa-trash text-red"></i>
                            </a>
                            /
                            @if ($employee->user->status == 1)
                            <a type="button" href="javascript:void(0)"
                                onclick="inactiveEmployee({{ $employee->user->id }})"
                                title="Active">
                                <i class="fas fa-lock text-green"></i>
                            </a>
                            @else
                            <a type="button" href="javascript:void(0)"
                            onclick="activeEmployee({{ $employee->user->id }})"
                                title="Inactive">
                                <i class="fas fa-lock-open text-yellow"></i>
                            </a>
                            @endif
                        </td>
                    </tr>
                    @endforeach

              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection

@push('page-js')
<script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>

<script>
    $(function () {
      $("#example1").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });
    });
</script>

<script>
    function deleteEmployee(EmployeeID) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '/admin/employee/'+EmployeeID,
                        type:'DELETE',
                        data: {
                            _token: $("input[name='_token']").val()
                        },
                        success:function(response) {
                            $("#EmpID"+EmployeeID).remove()
                            Toast.fire({
                                icon: 'success',
                                title: 'Employee deleted successfully'
                                })
                        },
                    })
                }
        })
    }
</script>

<script>
    function inactiveEmployee(EmployeeID) {
        Swal.fire({
            title: 'Are you sure?',
            text: "Employee can't be able to access",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, inactive it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '/admin/inactive/'+EmployeeID,
                        type:'PUT',
                        data: {
                            _token: $("input[name='_token']").val()
                        },
                        success:function(response) {
                            window.location.reload()
                            Toast.fire({
                                icon: 'success',
                                title: 'Employee successfully inactivated'
                                })
                        },
                    })
                }
        })
    }
</script>

<script>
    function activeEmployee(EmployeeID) {
        Swal.fire({
            title: 'Are you sure?',
            text: "Employee can be able to access",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, active it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '/admin/active/'+EmployeeID,
                        type:'PUT',
                        data: {
                            _token: $("input[name='_token']").val()
                        },
                        success:function(response) {
                            window.location.reload()
                            Toast.fire({
                                icon: 'success',
                                title: 'Employee successfully activated'
                                })
                        },
                    })
                }
        })
    }
</script>

@endpush
