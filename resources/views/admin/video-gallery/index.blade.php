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
                            <form action="{{ route('admin.video_gallery.store') }}" method="POST"
                                enctype="multipart/form-data" data-parsley-validate>
                                @csrf
                                <div class="row">






                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="inputName">Video
                                                URL</label> <input type="url" name="url" value="{{ old('url') }}"
                                                class="form-control" required>
                                            @error('url')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror

                                        </div>
                                    </div>


                                    <div class="col-sm-8"></div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label><input type="checkbox" name="status" value="1" checked>
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
                    <!-- /.card -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card my-4">
                                <div class="card-header">
                                    <svg class="svg-inline--fa fa-table fa-w-16 mr-1" aria-hidden="true" focusable="false"
                                        data-prefix="fas" data-icon="table" role="img"
                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg="">
                                        <path fill="currentColor"
                                            d="M464 32H48C21.49 32 0 53.49 0 80v352c0 26.51 21.49 48 48 48h416c26.51 0 48-21.49 48-48V80c0-26.51-21.49-48-48-48zM224 416H64v-96h160v96zm0-160H64v-96h160v96zm224 160H288v-96h160v96zm0-160H288v-96h160v96z">
                                        </path>
                                    </svg><!-- <i class="fas fa-table mr-1"></i> -->
                                    Gallery List
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th width="70">Sl. No</th>
                                                    <th width="750">Video URL</th>
                                                    <th width="5%">Status</th>
                                                    <th width="5%">Edit</th>
                                                    <th width="5%">Delete</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if (!empty($videoGalleryList))
                                                    @foreach ($videoGalleryList as $key => $item)
                                                        <tr>
                                                            <td>{{ $key + 1 }}</td>
                                                            <td>{{ $item->url }}
                                                            </td>

                                                            <td>{{ $item->status == 1 ? 'Active' : 'Deactive' }}</td>
                                                            <td><a
                                                                    href="{{ route('admin.video_gallery.edit', $item->id) }}"><i
                                                                        class="far fa-edit"></i></a></td>
                                                            <td><a
                                                                    href="{{ route('admin.video_gallery.delete', $item->id) }}"><i
                                                                        class="far fa-trash-alt"></i></a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @endif



                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- end -->
                        </div>
                    </div>
                    <!-- end -->
                </div>
            </div>
        </div>
    </main>
@endsection
