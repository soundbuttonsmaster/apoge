@extends('admin.layout.master')
@section('main-content')
    <main>
        <div class="container-fluid">
            <h2 class="mb-4">Change Password</h2>
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h6 class="card-title">Change Password Form</h6>
                            <!-- <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-toggle="collapse" data-target="#demo">
                                          <i class="fas fa-minus"></i></button>
                                      </div> -->
                        </div>
                        <div class="card-body" id="demo">
                            <form action="{{ route('admin.PsswordChange') }}" method="POST" data-parsley-validate>
                                @csrf
                                <div class="row">

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="inputName">Old Password</label>
                                            <input type="password" class="form-control" name="old_password"
                                                value="{{ old('old_password') }}" required>
                                            @error('old_password')
                                                <p style="color: red">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-6"></div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="inputName">New Password</label>
                                            <input type="password" class="form-control" name="new_password"
                                                value="{{ old('new_password') }}" required>
                                            @error('new_password')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-6"></div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="inputName">Confirm Password</label>
                                            <input type="password" class="form-control" name="confirm_password"
                                                value="{{ old('confirm_password') }}" required>
                                            @error('confirm_password')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-6"></div>
                                    <div class="col-sm-6 mt-3">
                                        <div class="form-group">
                                            <label for="inputName">&nbsp;</label>
                                            <div class="clear"></div>
                                            <input type="submit" value="Change Password" class="btn btn-success">
                                        </div>
                                    </div>

                                </div>
                            </form>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                    <!-- end -->
                </div>
            </div>
        </div>
    </main>
@endsection
