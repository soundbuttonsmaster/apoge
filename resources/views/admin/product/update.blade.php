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
                            <form action="{{ route('admin.product.update', $data->id) }}" method="POST" id="productForm"
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
                                                    <option value="{{ $item->id }}"
                                                        {{ $data->category_id == $item->id ? 'selected' : '' }}>
                                                        {{ $item->name }}</option>
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
                                            <input type="text" name="product_name" value="{{ $data->product_name }}"
                                                class="form-control" required>
                                            <span class="text-danger" id="error-product_name"></span>
                                        </div>
                                    </div>


                                    <div class="col-sm-12"></div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="inputName">Short Description<span id="reqioredf">*</span></label>
                                            <textarea class="form-control" name="short_description" required>{{ $data->short_description }}</textarea>
                                            <span class="text-danger" id="error-short_description"></span>
                                        </div>
                                    </div>

                                    <div class="col-sm-12"></div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="inputName">Product Photo<span id="reqioredf">*</span></label>
                                            <input type="file" name="product_image_new[]" multiple class="form-control">
                                            <span class="notification">
                                                {{-- Home, Listing Page Photo size: width:380px, height:380px<br>
                                                Detail Page Big size: width:500px, height:468px<br>
                                                Detail Page Thumb size: width:80px, height:120px<br> --}}
                                                Detail Page Large size: width:770px, height:720px<br>

                                            </span>
                                            @php
                                                $productImages = !empty($data->product_image)
                                                    ? json_decode($data->product_image)
                                                    : [];
                                            @endphp

                                            @if (count($productImages))
                                                @foreach ($productImages as $key => $_productImage)
                                                    <div id="sliderImage{{ $key }}">
                                                        <a href="{{ asset('uploads/products/thumb/' . $_productImage) }}"
                                                            target="_blank">
                                                            <img src="{{ asset('uploads/products/thumb/' . $_productImage) }}"
                                                                height="50px" alt="">
                                                        </a>
                                                        @if ($key != 0)
                                                            <a href="javascript:void(0)"
                                                                onclick="deleteProductSliderImage('{{ $data->id }}','{{ $key }}')"
                                                                class="text-danger">delete</a>
                                                        @else
                                                            <a href="javascript:void(0)"
                                                                onclick="showFileInput()">replace</a>
                                                            <input type="file" name="replace_first_image" id="fileInput"
                                                                class="form-control" style="display: none;"
                                                                accept="image/*">
                                                        @endif

                                                    </div>
                                                @endforeach
                                            @endif
                                            <span class="text-danger" id="error-product_image"></span>
                                        </div>
                                    </div>



                                    <div class="col-sm-12"></div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="inputName">Brochure <span id="reqioredf">*</span></label>
                                            <input type="file" name="brochure" class="form-control">
                                            <span class="notification">Brochure only  PDF format.</span>
                                            @if (!empty($data->brochure))
                                                <a href="{{ asset('uploads/products/brochure/' . $data->brochure) }}" target="_blank">view file</a>                                                
                                            @endif
                                            <span class="text-danger" id="error-brochure"></span>
                                        </div>
                                    </div>

                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="inputName">Features & Advantages<span
                                                    id="reqioredf">*</span></label>
                                            <textarea class="form-control" style="min-height:400px;" name="features_advantages" required>{{ $data->features_advantages }}</textarea>
                                            <span class="text-danger" id="error-features_advantages"></span>
                                        </div>
                                    </div>



                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="inputName">Technical Specifications<span
                                                    id="reqioredf">*</span></label>
                                            <textarea class="form-control" style="min-height:400px;" name="technical_specifications" required>{{ $data->technical_specifications }}</textarea>
                                            <span class="text-danger" id="error-technical_specifications"></span>

                                        </div>
                                    </div>

                                    <div class="col-sm-12"></div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="inputName">Meta Title</label>
                                            <input type="text" name="meta_title" value="{{ $data->meta_title }}"
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
                                                <textarea name="meta_keywords" class="form-control">{{ $data->meta_keywords }}</textarea>
                                            @error('meta_keywords')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="inputName">Meta Description</label>
                                            <textarea name="meta_description" class="form-control">{{ $data->meta_description }}</textarea>
                                            @error('meta_description')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    
                                                                         <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="inputName">Head Content</label>
                                            <textarea name="head_content" id="head_content" class="form-control">{{ $data->head_content }}</textarea>
                                            @error('head_content')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>


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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            var categoryId = "{{ $data->category_id }}";
            var subcategoryId = "{{ $data->subcategory_id }}";

            LoadSubcategory(categoryId, subcategoryId);
        });
    </script>
    <script>
        function LoadSubcategory(catId, selectedSubcatId) {
            $("#courseDiv").html(
                ' <select class="form-control" name="subcategory_id" id="subcategory_id" ><option value="">-----Select----</option></select>'
            );
            $.ajax({
                url: "{{ route('admin.product.loadSubcategory') }}",
                type: 'post',
                data: {
                    "catId": catId,
                    'subcategory_id': selectedSubcatId,
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

    <script>
        function showFileInput() {
            const fileInput = document.getElementById('fileInput');
            fileInput.style.display = 'block';
            // fileInput.click(); // Optional: This will automatically open the file dialog.
        }
    </script>


    <script>
        function deleteProductSliderImage(product_id, key) {
            if (confirm("Are You Sure you want to delete this Image ?")) {
                $.ajax({
                    type: "get",
                    url: "{{ route('admin.product.deleteProductImage') }}",
                    data: {
                        'product_id': product_id,
                        'key': key,
                    },
                    success: function(response) {



                        if (response == 'success') {
                            $('#sliderImage' + key).empty();
                        }
                    }
                });
            }


        }
    </script>
@endsection
