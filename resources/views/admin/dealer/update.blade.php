@extends('admin.layout.master')
@section('main-content')
    <main>
        <div class="container-fluid">
            <h2 class="mb-4">Add Dealer</h2>

            <div class="card card-primary filter">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="form-group">
                                <!-- <label for="inputName">Name</label> -->
                                <input type="text" name="" class="form-control" placeholder="Typ here...">
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="form-group">
                                <!-- <label class="d-flex" >&nbsp;</label> -->
                                <button class="button button-mat btn--7">
                                    <div class="psuedo-text">Search</div>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- /.card-body -->

                </div>
                <!-- /.card-body -->

            </div>



            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h6 class="card-title">Add Dealer Form</h6>
                            <!-- <div class="card-tools">
                                                            <button type="button" class="btn btn-tool" data-toggle="collapse" data-target="#demo">
                                                              <i class="fas fa-minus"></i></button>
                                                          </div> -->
                        </div>
                        <div class="card-body" id="demo">
                            <form action="{{ route('admin.dealer.update', $data->id) }}" method="POST"
                                data-parsley-validate>
                                @csrf
                                <div class="row">





                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="inputName">Name<span id="reqioredf">*</span></label>
                                            <input type="text" class="form-control" name="name"
                                                value="{{ $data->name }}" required>
                                            @error('name')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="inputName">Email<span id="reqioredf">*</span></label>
                                            <input type="text" class="form-control" name="email"
                                                value="{{ $data->email }}" required>
                                            @error('email')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="inputName">Mobile<span id="reqioredf">*</span></label>
                                            <input type="text" class="form-control" name="phone"
                                                value="{{ $data->phone }}" required>
                                            @error('phone')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="inputName">State<span id="reqioredf">*</span></label>
                                            <input type="text" class="form-control" name="state"
                                                value="{{ $data->state }}" required>
                                            @error('state')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="inputName">District<span id="reqioredf">*</span></label>
                                            <input type="text" class="form-control" name="district"
                                                value="{{ $data->district }}" required>
                                            @error('district')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="inputName">Location<span id="reqioredf">*</span></label>
                                            <input type="text" class="form-control" name="location"
                                                value="{{ $data->location }}" required>
                                            @error('location')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>





                                    <div class="col-4">
                                        <div class="form-group">
                                            <label><input type="checkbox" name="status" value="1"
                                                    {{ $data->status == 1 ? 'checked' : '' }}>
                                                Active/Deactive</label>

                                        </div>

                                    </div>
                                    <div class="col-sm-8"></div>



                                    <div class="col-sm-6 mt-3">
                                        <div class="form-group">
                                            <button class="button button-mat btn--7">
                                                <div class="psuedo-text">Submit</div>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col-sm-6"></div>





                                </div>
                            </form>

                            <!-- /.card-body -->

                        </div>
                        <!-- /.card-body -->

                    </div>

                </div>
            </div>
        </div>
    </main>
@endsection
