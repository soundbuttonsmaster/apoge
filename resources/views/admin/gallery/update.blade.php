@extends('admin.layout.master')
@section('main-content')
    <main>
        <div class="container-fluid">
            <h2 class="mb-4">Gallery</h2>
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h6 class="card-title">Gallery Form</h6>
                            <!-- <div class="card-tools">
                                                                                                                                        <button type="button" class="btn btn-tool" data-toggle="collapse" data-target="#demo">
                                                                                                                                          <i class="fas fa-minus"></i></button>
                                                                                                                                      </div> -->
                        </div>
                        <div class="card-body" id="demo">
                            <form action="{{ route('admin.gallery.update', $data->id) }}" method="POST"
                                enctype="multipart/form-data" data-parsley-validate>
                                @csrf
                                <div class="row">


                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="inputName">Select session<span id="reqioredf">*</span></label>
                                            <select class="form-control" name="session_id" onchange="LoadGroup(this.value)"
                                                required>
                                                <option value=" ">Select</option>
                                                @foreach ($session as $item)
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
                                            <label for="inputName">Select group<span id="reqioredf">*</span></label>
                                            {{-- <select class="form-control">
                                            <option selected>Select</option>
                                            <option>Exhibition</option>
                                            <option>Feedback</option>
                                        </select> --}}
                                            <span id="courseDiv">
                                                <select class="form-control" name="group_id" id="group_id" required>
                                                    <option value="">--Loading--</option>
                                                </select>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-sm-8"></div>




                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="inputName">Upload Photo<span id="reqioredf">*</span> </label>
                                            <input type="file" class="form-control" name="image">
                                            <span class="notification">
                                                {{-- Photo size: width:268px, height:268px<br> --}}
                                                Large photo: width:800px, height:800px

                                            </span>
                                            @if (!empty($data->image))
                                                <a href="{{ asset('uploads/gallery/large/' . $data->image) }}"
                                                    target="_blank">
                                                    <img src="{{ asset('uploads/gallery/small/' . $data->image) }}"
                                                        width="40" alt="">
                                                </a>
                                            @endif
                                            @error('image')
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
                    <!-- /.card -->

                    <!-- end -->
                </div>
            </div>
        </div>
    </main>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            var sessionId = "{{ $data->session_id }}";
            var groupId = "{{ $data->group_id }}";

            LoadGroup(sessionId, groupId);
        });
    </script>
    <script>
        function LoadGroup(sessionId, groupId) {
            $("#courseDiv").html(
                ' <select class="form-control" name="group_id" id="group_id" ><option value="">-----Select----</option></select>'
            );
            $.ajax({
                url: "{{ route('admin.gallery.loadgroup') }}",
                type: 'post',
                data: {
                    "sessionId": sessionId,
                    'groupId': groupId,
                    "_token": '{{ csrf_token() }}'
                },
                success: function(res) {
                    $("#courseDiv").html(res.groupDropdown);
                    // $('#themecategoryDiv').html(res.themecategoryDropdown);
                }
            });
        }
    </script>
@endsection
