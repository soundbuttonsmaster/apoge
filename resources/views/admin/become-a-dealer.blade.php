@extends('admin.layout.master')
@section('main-content')
    <main>
        <div class="container-fluid">
            <h2 class="mb-4">Become a Dealer</h2>


            {{-- <div class="card card-primary filter">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <!-- <label for="inputName">Type Here</label> -->
                                <input type="text" name="" class="form-control" placeholder="Typ here...">
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="form-group">
                                <!-- <label class="d-flex" >&nbsp;</label> -->
                                <button class="button button-mat btn--7">
                                    <div class="psuedo-text">Search</div>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- /.card-body -->

                </div>
                <!-- /.card-body -->

            </div> --}}




            <div class="row">
                <div class="col-md-12">

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
                                    Become a Dealer View
                                    <a href="{{ route('admin.become_a_dealer_export') }}" class="btn btn-primary"
                                    style="float: right;"><i class="fa fa-download"></i> Export in Excel</a>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th width="70">Sl. No</th>
                                                    <th width="150">Date</th>
                                                    <th width="150">Name</th>
                                                    <th>Email</th>
                                                    <th>Mobile</th>
                                                    <th>State</th>
                                                    <th>District</th>
                                                    <th>Village</th>
                                                    <th>Interested</th>
                                                    {{-- <th width="100">Download</th> --}}
                                                    <th width="5%">Delete</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                               
                                                @if (!empty($becomeaDelearList))
                                                    @foreach ($becomeaDelearList as $key => $item)
                                                    <tr>
                                                        <td>{{ $key + 1 }}</td>
                                                        <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d F Y') }}</td>
                                                        <td>{{ $item->name }}</td>
                                                        <td>{{ $item->email }}</td>
                                                        <td>{{ $item->phone }}</td>
                                                        <td>{{ $item->state }}</td>
                                                        <td>{{ $item->district }}</td>
                                                        <td>{{ $item->village }}</td>
                                                        <td>{{ $item->intersted_in }}</td>
                                                        {{-- <td><span class="download_bt"><a href="#">Download</a></span></td> --}}
                                                        <td><a href="{{ route('admin.delete_become_dealer', $item->id) }}" onclick="return confirm('Are you sure you want to delete this item?');"><i class="far fa-trash-alt"></i></a>
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
