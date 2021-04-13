@extends('layouts.master')
@section('title', ' | '.'Employee Profile')

@section('content')
<section class="content">
    <div class="container-fluid">
      <div class="row">
        <!-- /.col -->
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
                <h3 class="card-title">Profile</h3>
            </div>
            <div class="card-body">
              <div class="row">
                  <div class="col-md-9">
                    <form class="form-horizontal">
                        <div class="form-group row">
                          <label for="name" class="col-sm-2 col-form-label">Name</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control"
                                    id="name" placeholder="Name"
                                    value="{{ old('name', auth()->user()->name) }}">
                          </div>
                        </div>
                        <div class="form-group row">
                            <label for="designation" class="col-sm-2 col-form-label">Designation</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control"
                                      id="designation" placeholder="Designation"
                                      value="{{ old('designation', auth()->user()->employee->designation) }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="department" class="col-sm-2 col-form-label">Department</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control"
                                      id="department" placeholder="Department"
                                      value="{{ old('department', auth()->user()->employee->department) }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control"
                                        id="email" placeholder="Mobile"
                                        value="{{ old('department', auth()->user()->email) }}">
                            </div>
                        </div>
                        <div class="form-group row">
                          <label for="mobile" class="col-sm-2 col-form-label">Mobile</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control"
                                    id="mobile" placeholder="Mobile"
                                    value="{{ old('mobile', auth()->user()->employee->mobile) }}">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="signature" class="col-sm-2 col-form-label">Signature</label>
                          <div class="col-sm-10">
                            <input type="file" name="signature"
                                    id="signature">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="seal" class="col-sm-2 col-form-label">Seal</label>
                          <div class="col-sm-10">
                            <input type="file" name="signature"
                                    id="seal">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="password" class="col-sm-2 col-form-label">Password</label>
                          <div class="col-sm-10">
                            <input type="password" class="form-control"
                                    id="password" placeholder="Password">
                          </div>
                        </div>

                        <div class="form-group row">
                          <div class="offset-sm-2 col-sm-10">
                            <button type="submit" class="btn btn-danger btn-sm"><b>Update</b> <i class="fas fa-edit"></i></button>
                          </div>
                        </div>
                      </form>
                  </div>
                  <div class="col-md-3">
                      <div class="row">
                          <div class="col-md-6">
                              <img src="{{ asset('img/150.png') }}" alt="">
                          </div>
                          <div class="col-md-6">
                            <div class="col-md-6">
                                <img src="{{ asset('img/150.png') }}" alt="">
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
