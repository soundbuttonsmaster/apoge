@extends('admin.layout.master')
@section('main-content')
    <main>
        <div class="container-fluid">
            <h2 class="mb-4">Blog</h2>
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h6 class="card-title">Blog Form</h6>
                            <!-- <div class="card-tools">
                                                    <button type="button" class="btn btn-tool" data-toggle="collapse" data-target="#demo">
                                                      <i class="fas fa-minus"></i></button>
                                                  </div> -->
                        </div>
                        <div class="card-body" id="demo">
                            <form action="{{ route('admin.blog.update', $data->id) }}" method="POST"
                                enctype="multipart/form-data" data-parsley-validate>
                                @csrf
                                <div class="row">



                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="inputName">Photo Upload</label>
                                            <input type="file" class="form-control" name="image">
                                            <span class="notification">
                                                {{-- Photo size: width:380px, height:200px<br>
                                                Thumb size: width:90px, height:90px<br> --}}
                                                Detail page: width:800px, height:400px

                                            </span>
                                            @if (!empty($data->image))
                                                <a href="{{ asset('uploads/blog/datels/' . $data->image) }}"
                                                    target="_blank">
                                                    <img src="{{ asset('uploads/blog/thumb/' . $data->image) }}"
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
                                            <label for="inputName">Title</label>
                                            <input type="text" class="form-control" name="title"
                                                value="{{ $data->title }}" required>
                                            @error('title')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror


                                        </div>
                                    </div>
                                    <div class="col-sm-8"></div>


                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="inputName">Short Description</label>
                                            <textarea class="form-control" name="short_description" required>{{ $data->short_description }}</textarea>
                                            @error('short_description')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-8"></div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="inputName">Full Description</label>
                                            <textarea class="form-control" style="min-height:400px;" name="full_description" required>{{ $data->full_description }}</textarea>

                                        </div>
                                    </div>

                                    <div class="col-sm-12"></div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="inputName">Meta Title</label>
                                            <input type="text" name="meta_title" value="{{ $data->meta_title }}"
                                                class="form-control">
                                            @error('meta_title')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-12"></div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="inputName">Meta Keywords</label>
                                                <textarea name="meta_keywords" class="form-control">{{ $data->meta_keywords }}</textarea>
                                            @error('meta_keywords')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="inputName">Meta Description</label>
                                            <textarea name="meta_description" class="form-control">{{ $data->meta_description }}</textarea>
                                            @error('meta_description')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    
                                                                         <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="inputName">Head Content</label>
                                            <textarea name="head_content" id="head_content" class="form-control">{{ $data->head_content }}</textarea>
                                            @error('head_content')
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
                                                <div class="psuedo-text">Save</div>
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
                    <!-- /.card -->

                    <!-- end -->
                </div>
            </div>
        </div>
    </main>



    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    <script>
        CKEDITOR.replace('full_description');
    </script>
@endsection
