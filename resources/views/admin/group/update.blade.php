@extends('admin.layout.master')
@section('main-content')
    <main>
        <div class="container-fluid">
            <h2 class="mb-4">Add Group</h2>
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h6 class="card-title">Add Group Form</h6>
                            <!-- <div class="card-tools">
                                                                <button type="button" class="btn btn-tool" data-toggle="collapse" data-target="#demo">
                                                                  <i class="fas fa-minus"></i></button>
                                                              </div> -->
                        </div>
                        <div class="card-body" id="demo">
                            <form action="{{ route('admin.group.update', $data->id) }}" method="POST"
                                data-parsley-validate>
                                @csrf
                                <div class="row">



                                    <div class="col-sm-12">
                                        <hr>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="inputName">Select Session<span id="reqioredf">*</span></label>
                                            <select class="form-control" name="session_id" required>
                                                <option value=" ">Select</option>
                                                @foreach ($Session as $item)
                                                    <option value="{{ $item->id }}"
                                                        {{ $data->session_id == $item->id ? 'selected' : '' }}>
                                                        {{ $item->session }}</option>
                                                @endforeach
                                            </select>
                                            @error('session_id')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="col-sm-8"></div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="inputName">Add Group</label>

                                            <input type="text" name="group" value="{{ $data->group }}"
                                                class="form-control" placeholder="" required>
                                            @error('group')
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
