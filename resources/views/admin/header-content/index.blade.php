@extends('admin.layout.master')
@section('main-content')
    <main>
        <div class="container-fluid">
            <h2 class="mb-4">Add Header Content</h2>
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h6 class="card-title">Add Header Content Form</h6>
                            <!-- <div class="card-tools">
                                                            <button type="button" class="btn btn-tool" data-toggle="collapse" data-target="#demo">
                                                              <i class="fas fa-minus"></i></button>
                                                          </div> -->
                        </div>
                        <div class="card-body" id="demo">
                            <form action="{{ route('admin.header_content.store') }}" method="POST"
                                enctype="multipart/form-data" data-parsley-validate id="headerContentForm">
                                @csrf
                                <input type="hidden" name="id" id="record_id"> <!-- Hidden field for update -->

                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="inputName">Page Name:<span>*</span></label>
                                            <select class="form-control" name="page_name" id="page_name"
                                                onchange="LoadExistingData(this.value)" required>
                                                <option value="">Select Page</option>
                                                <option value="home">Home</option>
                                                {{-- <option value="product_list">Product List</option> --}}
                                                <option value="photo_gallery">Photo Gallery</option>
                                                <option value="video_gallery">Video Gallery</option>
                                                {{-- <option value="blogs">Blogs</option> --}}
                                            </select>
                                            @error('page_name')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="url">Page URL:<span>*</span></label>
                                            <input type="text" name="url" id="url" class="form-control"
                                                required>
                                            @error('url')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div> --}}

                                 
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="inputName">Meta Title</label>
                                            <input type="text" name="meta_title" id="meta_title" value="{{ old('meta_title') }}"
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
                                                <textarea name="meta_keywords" id="meta_keywords" class="form-control">{{ old('meta_keywords') }}</textarea>
                                            @error('meta_keywords')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                 

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="inputName">Meta Description</label>
                                            <textarea name="meta_description" id="meta_description" class="form-control">{{ old('meta_description') }}</textarea>
                                            @error('meta_description')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                                                        <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="inputName">Head Content</label>
                                            <textarea name="head_content" id="head_content" class="form-control">{{ old('head_content') }}</textarea>
                                            @error('head_content')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-4">
                                        <div class="form-group">
                                            <label><input type="checkbox" name="status" id="status" value="1"
                                                    checked> Active/Deactive</label>
                                        </div>
                                    </div>

                                    <div class="col-sm-6 mt-3">
                                        <div class="form-group">
                                            <button class="button button-mat btn--7">
                                                <div class="psuedo-text">Submit</div>
                                            </button>
                                        </div>
                                    </div>
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
                                <div class="card-header"> <svg class="svg-inline--fa fa-table fa-w-16 mr-1"
                                        aria-hidden="true" focusable="false" data-prefix="fas" data-icon="table"
                                        role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"
                                        data-fa-i2svg="">
                                        <path fill="currentColor"
                                            d="M464 32H48C21.49 32 0 53.49 0 80v352c0 26.51 21.49 48 48 48h416c26.51 0 48-21.49 48-48V80c0-26.51-21.49-48-48-48zM224 416H64v-96h160v96zm0-160H64v-96h160v96zm224 160H288v-96h160v96zm0-160H288v-96h160v96z">
                                        </path>
                                    </svg>
                                    View List </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th width="70">Sl. No</th>
                                                    <th>Page Name</th>
                                                    <th width="300">Meta Title</th>
                                                    <th width="300">Meta Keywords</th>
                                                    <th width="300">Meta Description</th>
                                                    <th width="5%">Status</th>
                                                    {{-- <th width="5%">Edit</th> --}}
                                                    <th width="5%">Delete</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if (!empty($headerContentList))
                                                    @forelse ($headerContentList as $key => $item)
                                                    <tr>
                                                        <td>{{ $key + 1 }}</td>
                                                        <td>{{ $item->page_name }}</td>
                                                        <td>{{ $item->meta_title }}</td>
                                                        <td>{{ $item->meta_keywords }}</td>
                                                        <td>{{ $item->meta_description }}</td>
                                                        <td>{{ $item->status == 1  ?'Active' : 'Deactive' }}</td>
                                                        {{-- <td><a href="#"><i class="far fa-edit"></i></a></td> --}}
                                                        <td><a href="{{ route('admin.header_content.delete', $item->id) }}" onclick="return confirm('Are you sure you want to delete this item?');"><i class="far fa-trash-alt"></i></a>
                                                        </td>
                                                    </tr>                                                           
                                                    @endforeach
                                                @endif
                                           
                                               
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </main>

    
    <script>
        function LoadExistingData(pageName) {
            // alert(page_name);
            $.ajax({
                url: "{{ route('admin.header_content.get') }}",
                type: "GET",
                data: {
                    page_name: pageName
                },
                success: function(response) {
                    if (response.status) {
                        $('#record_id').val(response.data.id);
                        $('#meta_title').val(response.data.meta_title);
                        $('#meta_keywords').val(response.data.meta_keywords);
                        $('#meta_description').val(response.data.meta_description);
                         $('#head_content').val(response.data.head_content);
                        $('#status').prop('checked', response.data.status == 1);
                    } else {
                        $('#record_id').val('');
                        $('#meta_title').val('');
                        $('#meta_keywords').val('');
                        $('#meta_description').val('');
                        $('#head_content').val('');
                        $('#status').prop('checked', true);
                    }
                }
            });
        }
    </script>
@endsection
