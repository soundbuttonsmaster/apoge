@extends('admin.layout.master')
@section('main-content')
    <main>
        <div class="container-fluid">
            <h2 class="mb-4">Add Product</h2>
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h6 class="card-title">Add Product Form</h6>
                            <!-- <div class="card-tools">
                                                                                                                                <button type="button" class="btn btn-tool" data-toggle="collapse" data-target="#demo">
                                                                                                                                  <i class="fas fa-minus"></i></button>
                                                                                                                              </div> -->
                        </div>
                        <div class="card-body" id="demo">
                            <form action="{{ route('admin.product.store') }}" method="POST" id="productForm"
                                enctype="multipart/form-data" data-parsley-validate>
                                @csrf
                                <div class="row">

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="inputName">Select Category<span id="reqioredf">*</span></label>
                                            <select class="form-control form-select" name="category_id"
                                                onchange="LoadSubcategory(this.value)" required>
                                                <option value=" ">Select</option>
                                                @foreach ($category as $item)
                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger" id="error-category_id"></span>
                                        </div>
                                    </div>
                                    <div class="col-sm-12"></div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="inputName">Select Sub Category<span id="reqioredf">*</span></label>
                                            <span id="courseDiv">
                                                <select class="form-control" name="subcategory_id" id="subcategory_id"
                                                    required>
                                                    <option value="">--Loading--</option>
                                                </select>
                                            </span>
                                            <span class="text-danger" id="error-subcategory_id"></span>
                                        </div>
                                    </div>

                                    <div class="col-sm-12"></div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="inputName">Product Name<span id="reqioredf">*</span></label>
                                            <input type="text" name="product_name" class="form-control" required>
                                            <span class="text-danger" id="error-product_name"></span>
                                        </div>
                                    </div>


                                    <div class="col-sm-12"></div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="inputName">Short Description<span id="reqioredf">*</span></label>
                                            <textarea class="form-control" name="short_description" required></textarea>
                                            <span class="text-danger" id="error-short_description"></span>
                                        </div>
                                    </div>

                                    <div class="col-sm-12"></div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="inputName">Product Photo<span id="reqioredf">*</span></label>
                                            <input type="file" name="product_image[]" multiple class="form-control"
                                                required>
                                            <span class="notification">
                                                {{-- Home, Listing Page Photo size: width:380px, height:380px<br> --}}
                                                Detail Page Big size: width:500px, height:468px<br>
                                                {{-- Detail Page Thumb size: width:80px, height:120px<br>
                                                Detail Page Large size: width:770px, height:720px<br> --}}

                                            </span>
                                            <span class="text-danger" id="error-product_image"></span>
                                        </div>
                                    </div>


                                    <div class="col-sm-12"></div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="inputName">Brochure <span id="reqioredf">*</span></label>
                                            <input type="file" name="brochure" class="form-control">
                                            <span class="notification">Brochure only  PDF format.</span>
                                            <span class="text-danger" id="error-brochure"></span>
                                        </div>
                                    </div>


                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="inputName">Features & Advantages<span id="reqioredf">*</span>
                                            </label>
                                            <textarea class="form-control" style="min-height:400px;" name="features_advantages" required></textarea>
                                            <span class="text-danger" id="error-features_advantages"></span>
                                        </div>
                                    </div>



                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="inputName">Technical Specifications<span id="reqioredf">*</span>
                                            </label>
                                            <textarea class="form-control" style="min-height:400px;" name="technical_specifications" required></textarea>
                                            <span class="text-danger" id="error-technical_specifications"></span>

                                        </div>
                                    </div>

                                    <div class="col-sm-12"></div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="inputName">Meta Title</label>
                                            <input type="text" name="meta_title" value="{{ old('meta_title') }}"
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
                                                <textarea name="meta_keywords" class="form-control">{{ old('meta_keywords') }}</textarea>
                                            @error('meta_keywords')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="inputName">Meta Description</label>
                                            <textarea name="meta_description" class="form-control">{{ old('meta_description') }}</textarea>
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
                                            <label><input type="checkbox" name="status" value="1" checked>
                                                Active/Deactive</label>

                                        </div>

                                    </div>
                                    <div class="col-sm-8"></div>




                                    <div class="col-sm-6 mt-3">
                                        <div class="form-group">
                                            <button class="button button-mat btn--7" type="button"
                                                onclick="submitForm()">
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


    <script>
        function LoadSubcategory(catId) {
            $("#courseDiv").html(
                ' <select class="form-control" name="subcategory_id" id="subcategory_id" ><option value="">-----Select----</option></select>'
            );
            $.ajax({
                url: "{{ route('admin.product.loadSubcategory') }}",
                type: 'post',
                data: {
                    "catId": catId,
                    "_token": '{{ csrf_token() }}'
                },
                success: function(res) {
                    $("#courseDiv").html(res.subcategoryDropdown);
                }
            });
        }
    </script>
    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    <script>
        CKEDITOR.replace('features_advantages');
        CKEDITOR.replace('technical_specifications');
    </script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function submitForm() {

            $('.text-danger').text('');

            // Validate the form using Parsley
            var isValid = $('#productForm').parsley().validate();

            // If form validation fails, return
            if (!isValid) {
                return;
            }
            //  CKEditor se value manually textarea me set karo
            for (instance in CKEDITOR.instances) {
                CKEDITOR.instances[instance].updateElement();
            }


            Swal.fire({
                title: 'Please wait...',
                allowOutsideClick: false,
                showConfirmButton: false,
                willOpen: () => {
                    Swal.showLoading()
                }
            });
            var action = $('#productForm').attr('action');
            var formData = new FormData($('#productForm')[0]); // 'this' refers to the form being submitted
            $.ajax({
                type: "post",
                url: action,
                data: formData,
                processData: false,
                contentType: false,
                success: function(data) {
                    // Handle successful response (if needed)
                    if (data.status === 'true') {
                        // Show an alert for successful registration
                        Swal.close();

                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: data.message,
                        }).then(function() {
                            // Redirect to a URL
                            window.location.href = '{{ url('admin/product/list') }}';
                        });

                        // You can also redirect the user or perform other actions here
                    }
                },
                error: function(xhr) {
                    // Handle errors
                    Swal.close();
                    var errors = xhr.responseJSON.errors;
                    $.each(errors, function(key, value) {
                        // Display errors
                        // For example, you can add an element with ID 'error-' + key to display errors next to the corresponding input field
                        $('#error-' + key).text(value[0]);

                        toastr.options = {
                            "closeButton": true,
                            "progressBar": true
                        }
                        toastr.error(value[0]);

                    });
                }
            });

        }
    </script>
@endsection
