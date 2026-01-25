@extends('admin.layout.master')
@section('main-content')
    <main>
        <div class="container-fluid">
            <h2 class="mb-4">Testimonials</h2>
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h6 class="card-title">Testimonials Form</h6>
                            <!-- <div class="card-tools">
                                                                                    <button type="button" class="btn btn-tool" data-toggle="collapse" data-target="#demo">
                                                                                      <i class="fas fa-minus"></i></button>
                                                                                  </div> -->
                        </div>
                        <div class="card-body" id="demo">
                            <form action="{{ route('admin.testimonial.update', $data->id) }}" method="POST"
                                enctype="multipart/form-data" data-parsley-validate>
                                @csrf
                                <div class="row">







                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="inputName">Testimonial Name<span id="reqioredf">*</span> </label>
                                            <input type="text" class="form-control" name="testimonial_name"
                                                value="{{ $data->testimonial_name }}" required>
                                            @error('testimonial_name')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-8"></div>


                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="inputName">City<span id="reqioredf">*</span></label>
                                            <input type="text" class="form-control" name="city"
                                                value="{{ $data->city }}" required>
                                            @error('city')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-8"></div>




                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="inputName">Upload Photo<span id="reqioredf">*</span> </label>
                                            <input type="file" class="form-control" name="image">
                                            <span class="notification"> Logo size: width:140px, height:140px<br>
                                            </span>
                                            @if (!empty($data->image))
                                                <a href="{{ asset('uploads/testimonial/' . $data->image) }}"
                                                    target="_blank">
                                                    <img src="{{ asset('uploads/testimonial/' . $data->image) }}"
                                                        width="40" alt="">
                                                </a>
                                            @endif
                                            @error('image')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-8"></div>


                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="inputName">Star Rating<span id="reqioredf">*</span></label>
                                            <select class="form-control" name="rating" required>
                                                <option value="1" {{ $data->rating == 1 ? 'selected' : '' }}>Star 1
                                                </option>
                                                <option value="2" {{ $data->rating == 2 ? 'selected' : '' }}>Star 2
                                                </option>
                                                <option value="3" {{ $data->rating == 3 ? 'selected' : '' }}>Star 3
                                                </option>
                                                <option value="4" {{ $data->rating == 4 ? 'selected' : '' }}>Star 4
                                                </option>
                                                <option value="5" {{ $data->rating == 5 ? 'selected' : '' }}>Star 5
                                                </option>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-8"></div>


                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="inputName">Testimonial Content<span id="reqioredf">*</span></label>
                                            <textarea class="form-control" name="content" required>{{ $data->content }}</textarea>
                                            @error('content')
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
