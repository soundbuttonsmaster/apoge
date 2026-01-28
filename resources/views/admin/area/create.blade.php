@extends('admin.layout.master')
@section('main-content')
    <main>
        <div class="container-fluid">
            <h2 class="mb-4">Area Management</h2>
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h6 class="card-title">{{ isset($area) ? 'Edit' : 'Add' }} Area</h6>
                        </div>
                        <div class="card-body">
                            <form action="{{ isset($area) ? route('admin.area.update', $area->id) : route('admin.area.store') }}" method="POST"
                                enctype="multipart/form-data" data-parsley-validate>
                                @csrf
                                @if(isset($area))
                                    @method('POST')
                                @endif
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="name">Area Name:<span>*</span></label>
                                            <input type="text" name="name" id="name" class="form-control"
                                                value="{{ old('name', isset($area) ? $area->name : '') }}" required>
                                            @error('name')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="image">Image:</label>
                                            <input type="file" name="image" id="image" class="form-control">
                                            @if(isset($area) && $area->image)
                                                <div class="mt-2">
                                                    <img src="{{ asset('uploads/areas/' . $area->image) }}" width="100" alt="Area Image">
                                                </div>
                                            @endif
                                            @error('image')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="short_description">Short Description:</label>
                                            <textarea name="short_description" id="short_description" class="form-control">{{ old('short_description', isset($area) ? $area->short_description : '') }}</textarea>
                                        </div>
                                    </div>

                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="full_description">Full Description:</label>
                                            <textarea name="full_description" id="full_description" class="form-control">{{ old('full_description', isset($area) ? $area->full_description : '') }}</textarea>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label><input type="checkbox" name="status" id="status" value="1"
                                                    {{ old('status', isset($area) ? ($area->status == 1 ? 'checked' : '') : 'checked') }}> Active/Deactive</label>
                                        </div>
                                    </div>

                                    <div class="col-sm-12 mt-3">
                                        <div class="form-group">
                                            <button class="button button-mat btn--7">
                                                <div class="psuedo-text">Submit</div>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    <script>
        CKEDITOR.replace('full_description');
    </script>
@endsection
