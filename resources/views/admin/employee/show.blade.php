@extends('layouts.master')
@section('title', ' - '.'Employee Details')

@section('content')
<section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header p-2">
              <ul class="nav nav-pills">
                <li class="nav-item"><a class="nav-link active" href="#about" data-toggle="tab">About</a></li>
                <li class="nav-item"><a class="nav-link" href="#documents" data-toggle="tab">Documents</a></li>
              </ul>
            </div><!-- /.card-header -->
            <div class="card-body">
              <div class="tab-content">
                <div class="tab-pane active" id="about">
                  <table class="table">
                    <tbody>
                      <tr>
                        <td style="border-top: none">Name</td>
                        <td style="border-top: none">{{ $employee->user->name }}</td>
                      </tr>
                      <tr>
                        <td>Designation</td>
                        <td>{{ $employee->designation }}</td>
                      </tr>
                      <tr>
                        <td>Department</td>
                        <td>{{ $employee->department }}</td>
                      </tr>
                      <tr>
                          <td>Roles</td>
                          <td>
                            @foreach ($employee->user->roles as $role)
                            {{ $role->name }}
                            @endforeach
                          </td>
                        </tr>
                      <tr>
                        <td>Email</td>
                        <td>{{ $employee->user->email }}</td>
                      </tr>
                      <tr>
                        <td>Mobile</td>
                        <td>{{ $employee->mobile }}</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <div class="tab-pane" id="documents">
                  <div class="row">
                      <div class="col-md-6">
                          @if ($employee->signature)
                          <img class="img-fluid" src="{{ asset('img/photo1.png') }}" alt="Photo">
                          @endif
                          <p style="text-align: center">No Signature file uploaded yet</p>
                      </div>
                      <div class="col-md-6">
                        @if ($employee->seal)
                        <img class="img-fluid" src="{{ asset('img/photo1.png') }}" alt="Photo">
                        @endif
                        <p style="text-align: center">No seal file uploaded yet</p>
                      </div>
                  </div>
                </div>


                <!-- /.tab-pane -->
              </div>
              <!-- /.tab-content -->
            </div>
            <div class="card-footer">
                <a href="{{ route('admin.employee.edit', $employee->id) }}" class="btn btn-success btn-sm btn-submit">
                <b>Edit</b> <i class="fas fa-edit"></i>
                </a>
                <a class="btn btn-danger btn-sm" href="{{ route('admin.employees.index') }}">
                    <b>Cancel</b> <i class="fas fa-window-close"></i>
                </a>
            </div>
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>
@endsection
