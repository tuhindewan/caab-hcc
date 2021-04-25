@extends('layouts.master')
@section('title', ' | '.'Account Details')

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
                  <div class="col-md-8">
                    <form class="profileUpdateForm">
                        @csrf
                        <div class="form-group row">
                          <label for="name" class="col-sm-2 col-form-label">Name</label>
                          <div class="col-sm-10">
                                <input type="text" class="form-control"
                                    id="name" placeholder="Name"
                                    value="{{ old('name', auth()->user()->name) }}">
                                <span class="text-danger" id="nameError"></span>
                          </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control"
                                        id="email" placeholder="Email"
                                        value="{{ old('department', auth()->user()->email) }}">
                                <span class="text-danger" id="emailError"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                          <label for="mobile" class="col-sm-2 col-form-label">Mobile</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control"
                                    id="mobile" placeholder="Mobile"
                                    value="{{ old('mobile', auth()->user()) }}">
                            <span class="text-danger" id="mobileError"></span>
                          </div>
                        </div>
                        <div class="form-group row">
                            <label for="username" class="col-sm-2 col-form-label">Username</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control"
                                      id="username" placeholder="Username"
                                      value="{{ old('username', auth()->user()->username) }}">
                              <span class="text-danger" id="usernameError"></span>
                            </div>
                          </div>
                        <div class="form-group row">
                          <label for="password" class="col-sm-2 col-form-label">Password</label>
                          <div class="col-sm-10">
                            <input type="password" class="form-control"
                                    id="password" placeholder="Password">
                            <span class="text-danger" id="passwordError"></span>
                          </div>
                        </div>

                        <div class="form-group row">
                          <div class="offset-sm-2 col-sm-10">
                            <button type="submit" class="btn btn-danger btn-sm btn-submit"><b>Update</b> <i class="fas fa-edit"></i></button>
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
