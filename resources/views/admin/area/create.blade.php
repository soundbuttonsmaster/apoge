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
                                data-parsley-validate>
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
@endsection
