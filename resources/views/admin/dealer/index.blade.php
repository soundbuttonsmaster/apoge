@extends('admin.layout.master')
@section('main-content')
    <main>
        <div class="container-fluid">
            <h2 class="mb-4">Add Dealer</h2>

            <div class="card card-primary filter">
                <div class="card-body">
                  <form action="{{ route('admin.dealer.create') }}" method="GET">
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="form-group">
                                <!-- <label for="inputName">Name</label> -->
                                <input type="text" name="name" value="{{ request()->get('name') }}" class="form-control" placeholder="Typ here...">
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="form-group">
                                <!-- <label class="d-flex" >&nbsp;</label> -->
                                <button type="submit" class="button button-mat btn--7">
                                    <div class="psuedo-text">Search</div>
                                </button>
                            </div>
                        </div>
                    </div>
                   </form>

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
                            <form action="{{ route('admin.dealer.store') }}" method="POST" data-parsley-validate>
                                @csrf
                                <div class="row">





                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="inputName">Name<span id="reqioredf">*</span></label>
                                            <input type="text" class="form-control" name="name"
                                                value="{{ old('name') }}" required>
                                            @error('name')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="inputName">Email<span id="reqioredf">*</span></label>
                                            <input type="text" class="form-control" name="email"
                                                value="{{ old('email') }}" required>
                                            @error('email')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="inputName">Mobile<span id="reqioredf">*</span></label>
                                            <input type="text" class="form-control" name="phone"
                                                value="{{ old('phone') }}" required>
                                            @error('phone')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="inputName">State<span id="reqioredf">*</span></label>
                                            <input type="text" class="form-control" name="state"
                                                value="{{ old('state') }}" required>
                                            @error('state')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="inputName">District<span id="reqioredf">*</span></label>
                                            <input type="text" class="form-control" name="district"
                                                value="{{ old('district') }}" required>
                                            @error('district')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="inputName">Location<span id="reqioredf">*</span></label>
                                            <input type="text" class="form-control" name="location"
                                                value="{{ old('location') }}" required>
                                            @error('location')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>





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
                                    <i class="fas fa-table mr-1"></i>
                                    Dealer List

                                    <div class="download_bt2">
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#importExcelModal">Import Excel</a>
                                    </div>
                                </div>

                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th width="70">Sl. No</th>
                                                    <th width="300">Name</th>
                                                    <th>Email</th>
                                                    <th>Mobile</th>
                                                    <th>State</th>
                                                    <th>District</th>
                                                    <th>Location</th>
                                                    <th width="5%">Status</th>
                                                    <th width="3%">Edit</th>
                                                    <th width="5%">Delete</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if (!empty($dealerList))
                                                    @foreach ($dealerList as $key => $item)
                                                        <tr>
                                                            <td>{{ $key + 1 }}</td>
                                                            <td>{{ $item->name }}</td>
                                                            <td>{{ $item->email }}</td>
                                                            <td>{{ $item->phone }}</td>
                                                            <td>{{ $item->state }}</td>
                                                            <td>{{ $item->district }}</td>
                                                            <td>{{ $item->location }}</td>
                                                            <td>{{ $item->status == 1 ? 'Active' : 'Deactive' }}</td>
                                                            <td><a href="{{ route('admin.dealer.edit', $item->id) }}"><i
                                                                        class="far fa-edit"></i></a></td>
                                                            <td><a href="{{ route('admin.dealer.delete', $item->id) }}"
                                                                    onclick="return confirm('Are you sure you want to delete this item?');"><i
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
    
    
      <!-- Bootstrap Modal -->
    <div class="modal fade" id="importExcelModal" tabindex="-1" aria-labelledby="importExcelModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="importExcelModalLabel">Import Excel File</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.dealer.import') }}" method="POST" enctype="multipart/form-data" data-parsley-validate>
                        @csrf
                        <div class="mb-3">
                            <label for="excelFile" class="form-label">Choose Excel File</label>
                            <input type="file" class="form-control" id="excelFile" name="file" accept=".xls, .xlsx" required>
                            @error('file')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Upload</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


     <!-- Bootstrap JS -->
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

@endsection
