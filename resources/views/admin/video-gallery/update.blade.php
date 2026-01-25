@extends('admin.layout.master')
@section('main-content')
    <main>
        <div class="container-fluid">
            <h2 class="mb-4">Video Gallery</h2>
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h6 class="card-title">Video Gallery Form</h6>
                            <!-- <div class="card-tools">
                                                            <button type="button" class="btn btn-tool" data-toggle="collapse" data-target="#demo">
                                                              <i class="fas fa-minus"></i></button>
                                                          </div> -->
                        </div>
                        <div class="card-body" id="demo">
                            <form action="{{ route('admin.video_gallery.update', $data->id) }}" method="POST"
                                enctype="multipart/form-data" data-parsley-validate>
                                @csrf
                                <div class="row">






                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="inputName">Video
                                                URL</label> <input type="url" name="url" value="{{ $data->url }}"
                                                class="form-control" required>
                                            @error('url')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror

                                        </div>
                                    </div>


                                    <div class="col-sm-8"></div>
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
