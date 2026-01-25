@extends('admin.layout.master')
@section('main-content')
    <main>
        <div class="container-fluid">
            <h2 class="mb-4">View Product</h2>
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
                                    View List
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th width="70">Sl. No</th>
                                                    <th>Category</th>
                                                    <th>Sub Category</th>
                                                    <th>Product Name</th>
                                                    <th>Short Description</th>
                                                    <th>Product Photo</th>
                                                    {{-- <th>Features & Advantages</th>
                                                    <th>Technical Specifications</th>
                                                    <th>Rotavator</th> --}}
                                                    <th>Show In Home</th>
                                                    <th width="5%">Status</th>
                                                    <th width="5%">Edit</th>
                                                    <th width="5%">Delete</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if (!empty($productListing))
                                                    @foreach ($productListing as $key => $item)
                                                        <tr>
                                                            <td>{{ $key + 1 }}</td>

                                                            <td>{{ @$item->category->name }}</td>
                                                            <td>{{ @$item->subcategory->name }}</td>
                                                            <td>{{ $item->product_name }}</td>
                                                            <td>
                                                                {{ $item->short_description }}
                                                            </td>


                                                            <td>
                                                                @if (!is_null($item->product_image) && isset(json_decode($item->product_image)[0]))
                                                                    <a href="{{ asset('uploads/products/large/' . json_decode($item->product_image)[0]) }}"
                                                                        target="_blank">
                                                                        <img src="{{ asset('uploads/products/thumb/' . json_decode($item->product_image)[0]) }}"
                                                                            alt="">
                                                                    </a>
                                                                @endif
                                                            </td>
                                                            <td>
                                                                <input type="checkbox" name="show_in_home"
                                                                    id="showinhome{{ $item->id }}"
                                                                    onclick="ShowHome('{{ $item->id }}')"
                                                                    {{ $item->show_in_home == 1 ? 'checked' : '' }}>
                                                            </td>
                                                            <td>{{ $item->status == 1 ? 'Active' : 'Deactive' }}</td>
                                                            <td><a href="{{ route('admin.product.edit', $item->id) }}"><i
                                                                        class="far fa-edit"></i></a></td>
                                                            <td><a href="{{ route('admin.product.delete', $item->id) }}"
                                                                    onclick="return confirm('Are you sure you want to delete this item?');">
                                                                    <i class="far fa-trash-alt"></i>
                                                                </a>
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


    <script> 
        function ShowHome(id) {
            let chekbox = $('#showinhome' + id)
            let ShowInHome = 0;
            if (chekbox.prop('checked')) {
                ShowInHome = 1;
            } else {
                ShowInHome = 0;
            }
            $.ajax({
                type: "POST",
                url: "{{ route('admin.product.showinhome') }}",
                data: {
                    id: id,
                    show_in_home: ShowInHome,
                    _token: "{{ csrf_token() }}"
                },
                success: function(data) {
                    if (data == 'success') {
                        // toastr.success('asdf');
                        // alert('Product Updated Successfully !');
                    }
                }
            });
        }
    </script>
@endsection
