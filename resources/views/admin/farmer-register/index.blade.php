@extends('admin.layout.master')
@section('main-content')
    <main>
        <div class="container-fluid">
            <h2 class="mb-4">Farmer Registration View</h2>

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
                                    Farmer Registration View
                                </div>

                                <div class="card card-primary filter">
                                    <div class="card-body">
                                        <form action="{{ route('admin.farmer_registration_list') }}" method="GET">
                                            <div class="row">
                                                <div class="col-sm-2">
                                                    <div class="form-group">
                                                        <!-- <label for="inputName">Name</label> -->
                                                        <input type="text" name="customer_id"
                                                            value="{{ request()->get('customer_id') }}" class="form-control"
                                                            placeholder="Customer Id">
                                                    </div>
                                                </div>

                                                <div class="col-sm-2">
                                                    <div class="form-group">
                                                        <!-- <label for="inputName">Mobile</label> -->
                                                        <input type="text" name="phone"
                                                            value="{{ request()->get('phone') }}" class="form-control"
                                                            placeholder="Mobile">
                                                    </div>
                                                </div>

                                                <div class="col-sm-2">
                                                    <div class="form-group">
                                                        <!-- <label for="inputName">Name</label> -->
                                                        <input type="text" name="state"
                                                            value="{{ request()->get('state') }}" class="form-control"
                                                            placeholder="State">
                                                    </div>
                                                </div>

                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <!-- <label for="inputName">Name</label> -->
                                                        <input type="text" name="district"
                                                            value="{{ request()->get('district') }}" class="form-control"
                                                            placeholder="District">
                                                    </div>
                                                </div>


                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <!-- <label for="inputName">Name</label> -->
                                                        <input type="text" name="city"
                                                            value="{{ request()->get('city') }}" class="form-control"
                                                            placeholder="City">
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
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th width="70">Sl. No</th>
                                                    <th>Customer Id</th>
                                                    <th width="150">Name</th>
                                                    <th width="150">Mobile</th>
                                                    <th width="150">State</th>
                                                    <th width="150">District</th>
                                                    <th width="150">City</th>
                                                    {{-- <th width="150">Pincode</th> --}}
                                                    <th>Address</th>
                                                    <th width="150">Leveller Manufacturer Name</th>
                                                    <th width="150">Leveller Model No.</th>
                                                    <th width="250">Date</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if (!empty($farmerRegistrationList))
                                                    @foreach ($farmerRegistrationList as $key => $item)
                                                        <tr>
                                                            <td>{{ $key + 1 }}</td>
                                                            <td>{{ $item->customer_id }}</td>
                                                            <td>{{ $item->name }}</td>
                                                            <td>{{ $item->phone }}</td>
                                                            <td>{{ $item->state }}</td>
                                                            <td>{{ $item->district }}</td>
                                                            <td> {{ $item->city }}</td>
                                                            <td>{{ $item->address }}</td>
                                                            {{-- <td>{{ $item->pin_code }}</td> --}}
                                                            <td>{{ $item->leveller_manufacturer }}</td>
                                                            <td>{{ $item->leveller_model_no }}</td>
                                                            <td>{{ \Carbon\Carbon::parse($item->leveller_purchase_date)->format('d F Y') }}
                                                            </td>
                                                            <td>
                                                                {{-- @if ($item->card_ganrate_status == 1) --}}
                                                                <a href="{{ route('admin.view_farmer_card', $item->id) }}"
                                                                    class="btn btn-info">View
                                                                    Coupon</a>
                                                                {{-- @else
                                                                    <a href="{{ route('admin.ganrate_farmer_card', $item->id) }}"
                                                                        class="btn btn-primary">Card Generate</a>
                                                                @endif --}}

                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @endif

                                            </tbody>
                                        </table>
                                        <div class="d-flex justify-content-center mt-3">
                                            {!! $farmerRegistrationList->withQueryString()->links() !!}
                                        </div>

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
