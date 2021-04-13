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
                            <label for="designation" class="col-sm-2 col-form-label">Designation</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control"
                                      id="designation" placeholder="Designation"
                                      value="{{ old('designation', auth()->user()->employee->designation) }}">
                                <span class="text-danger" id="designationError"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="department" class="col-sm-2 col-form-label">Department</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control"
                                      id="department" placeholder="Department"
                                      value="{{ old('department', auth()->user()->employee->department) }}">
                                <span class="text-danger" id="departmentError"></span>
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
                                    value="{{ old('mobile', auth()->user()->employee->mobile) }}">
                            <span class="text-danger" id="mobileError"></span>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="signature" class="col-sm-2 col-form-label">Signature</label>
                          <div class="col-sm-10">
                            <input type="file" name="signature"
                                    id="signature">
                            <span class="text-danger" id="signatureError"></span>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="seal" class="col-sm-2 col-form-label">Seal</label>
                          <div class="col-sm-10">
                            <input type="file" name="signature"
                                    id="seal">
                            <span class="text-danger" id="sealError"></span>
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
                  <div class="col-md-3">
                      <div class="row">
                          <div class="col-md-6">
                              <img id="signaturePreview" src="{{ asset('img/150.png') }}" alt="" height="150px" width="150px">
                          </div>
                          <div class="col-md-6">
                            <div class="col-md-6">
                                <img id="sealPreview" src="{{ asset('img/150.png') }}" alt="" height="150px" width="150px">
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
<script type="text/javascript">
    $(document).ready(function() {

        $('#signature').change(function(){
            let reader = new FileReader()

            if (this.files[0].size < 209715) {
                reader.onload = (e) => {
                    $('#signaturePreview').attr('src', e.target.result)
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
            var signature = $("#signature").val();
            var seal = $("#seal").val();
            var password = $("#password").val();
            console.log(signature)
            console.log(seal)

            $.ajax({
                url: '/admin/profile/',
                type:'PUT',
                data: {_token:_token, name:name, designation:designation, department:department,
                        email:email, mobile:mobile, signature:signature, seal:seal, password:password},
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
                }
            });
        });
    });
</script>
@endpush
