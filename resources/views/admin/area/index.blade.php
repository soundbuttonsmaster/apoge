@extends('admin.layout.master')
@section('main-content')
    <main>
        <div class="container-fluid">
            <h2 class="mb-4">Area List</h2>
            <div class="row">
                <div class="col-md-12">
                    <div class="card my-4">
                        <div class="card-header">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <i class="fas fa-table mr-1"></i>
                                    View List
                                </div>
                                <a href="{{ route('admin.area.create') }}" class="btn btn-primary btn-sm">Add New</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th width="70">Sl. No</th>
                                            <th>Area Name</th>
                                            <th width="10%">Status</th>
                                            <th width="10%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (!empty($areas))
                                            @foreach ($areas as $key => $item)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>{{ $item->name }}</td>
                                                    <td>{{ $item->status == 1 ? 'Active' : 'Deactive' }}</td>
                                                    <td>
                                                        <a href="{{ route('admin.area.edit', $item->id) }}"
                                                            class="btn btn-sm btn-info"><i class="far fa-edit"></i></a>
                                                        <a href="{{ route('admin.area.delete', $item->id) }}"
                                                            onclick="return confirm('Are you sure you want to delete this item?');"
                                                            class="btn btn-sm btn-danger"><i class="far fa-trash-alt"></i></a>
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
    </main>
@endsection