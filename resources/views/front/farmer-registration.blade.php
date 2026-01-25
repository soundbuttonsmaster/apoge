@extends('front.layouts.masterhome')
@section('section')
    <div id="find-a-farmer-card">
        <!-- Page-title -->
        <div class="page-title page-about-us">
            <!--    <div class="rellax" data-rellax-speed="5">
                                                <img src="{{ asset('front') }}/images/page-title/about-us.jpg" alt="">
                                            </div> -->
            <div class="content-wrap">
                <div class="tf-container w-1290">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="content">

                                <h1 class="title">
                                    Registration
                                </h1>
                                <div class="icon-img">
                                    <img src="{{ asset('front') }}/images/item/line-throw-title.png" alt="Online registration form to enquire about Apogee Agrotech agricultural equipment ">
                                </div>
                                <div class="breadcrumb">
                                    <a href="{{ route('home') }}">Home</a>
                                    <div class="icon">
                                        <i class="icon-arrow-right1"></i>
                                    </div>
                                    <a href="javascript:void(0)">Registration</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div><!-- /.Page-title -->

        <!-- Main-content -->
        <div class="main-content pb-0 pt-93">
            <section style="display:none">
                <div class="odometer style-5">1000</div>
            </section>



            <section class="s-welcome-to farmerRegisterSec">
                <div class="s-content-wrap">
                    <div class="tf-container w-1290">
                        <div class="registerformWrap">
                            <div class="row align-items-center">
                                <div class="col-md-6 p-0">
                                    <div class="formRightImg">
                                        <img src="{{ asset('front') }}/images/Apogee_8.png" alt="img">
                                    </div>
                                </div>
                                <div class="col-md-6 p-0">
                                    <div class="fromWrapper">
                                        <div class="heading-section">
                                            <h1 class="title text-container tf-animate-2 active-animate"> किसान पंजीकरण
                                            </h1>
                                        </div>
                                        {{-- <form id="farmerregistrionform" method="post"
                                        action="{{ route('home.save_farmer_registration') }}" novalidate="novalidate"
                                        class="form-send-message style-2" data-parsley-validate>
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group mb-4">
                                                    <!-- <label for="" class="mb-3"></label> -->
                                                    <input type="text" class="form-control" name="name"
                                                        placeholder="नाम" aria-required="true" required="">
                                                    <span class="text-danger" id="error-name"></span>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group mb-4">
                                                    <!-- <label for="" class="mb-3">Mobile No.</label> -->
                                                    <input type="text" class="form-control" name="phone"
                                                        onkeypress="return /[0-9-/]/i.test(event.key)" maxlength="10"
                                                        minlength="10" placeholder="मोबाइल न." aria-required="true"
                                                        required="">
                                                    <span class="text-danger" id="error-phone"></span>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group mb-4">
                                                    <!-- <label for="" class="mb-3">State</label> -->
                                                    <select name="state" id="state" class="form-control"
                                                        onchange="setState(this)" required>
                                                        <option value=" ">राज्य</option>
                                                        @if (!empty($state))
                                                            @foreach ($state as $ste)
                                                                <option data-id="{{ $ste->id }}"
                                                                    value="{{ $ste->name }}">{{ $ste->name }}
                                                                </option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                    <span class="text-danger" id="error-state"></span>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group mb-4">
                                                    <!-- <label for="" class="mb-3">District</label> -->
                                                    <span id="courseDiv">
                                                        <select class="form-select" name="district" id="district" required>
                                                            <option value="">जिला</option>
                                                        </select>
                                                    </span>
                                                    <span class="text-danger" id="error-district"></span>
                                                  
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group mb-4">
                                                    <!-- <label for="" class="mb-3">City</label> -->
                                                     <span id="cityDiv">
                                                        <select class="form-select" name="city" id="city" required>
                                                            <option value="">शहर</option>
                                                        </select>
                                                    </span>
                                                     <span class="text-danger" id="error-city"></span>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group mb-4">
                                                    <!-- <label for="" class="mb-3">Pincode</label> -->
                                                    <input type="text" class="form-control"  name="pin_code" onkeypress="return /[0-9-/]/i.test(event.key)" maxlength="6" minlength="6"
                                                        placeholder="पिन कोड" aria-required="true" required="">
                                                        <span class="text-danger" id="error-pin_code"></span>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group mb-4">
                                                    <!-- <label for="" class="mb-3">Leveller Manufacturer Name</label> -->
                                                    <input type="text" class="form-control" name="leveller_manufacturer"
                                                        placeholder="लेवलर निर्माता का नाम" aria-required="true"
                                                        required="">
                                                        <span class="text-danger" id="error-leveller_manufacturer"></span>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group mb-4">
                                                    <!-- <label for="" class="mb-3">Leveller Model No.</label> -->
                                                    <input type="text" class="form-control" name="leveller_model_no"
                                                        placeholder="लेवलर मॉडल न." aria-required="true" required="">
                                                         <span class="text-danger" id="error-leveller_model_no"></span>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group mb-4">
                                                      <label for="" class="mb-3">लेवलर खरीद की तारीख</label>
                                                    <input type="date" class="form-control" name="leveller_purchase_date"
                                                        placeholder="लेवलर खरीद की तारीख" aria-required="true"
                                                        required="">
                                                        <span class="text-danger" id="error-leveller_purchase_date"></span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="checkbox-item send-wrap">
                                            <button type="button" onclick="SubmitForm()" class="tf-btn ">
                                                <span class="text-style">
                                                    सबमिट
                                                </span>
                                                <span class="icon">
                                                    <i class="icon-arrow_right"></i>
                                                </span>
                                            </button>
                                        </div>
                                    </form> --}}

                                        <!-- Form HTML -->
                                        <form id="farmerregistrionform" method="post"
                                            action="{{ route('home.save_farmer_registration') }}" novalidate="novalidate"
                                            class="form-send-message style-2" data-parsley-validate>

                                            @csrf
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group mb-4">
                                                        <input type="text" class="form-control" name="name"
                                                            placeholder="नाम" required
                                                            data-parsley-required-message="कृपया नाम दर्ज करें।">
                                                        <span class="text-danger" id="error-name"></span>
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="form-group mb-4">
                                                        <input type="text" class="form-control" name="phone"
                                                            placeholder="मोबाइल न." required minlength="10" maxlength="10"
                                                            onkeypress="return /[0-9]/i.test(event.key)"
                                                            data-parsley-required-message="कृपया मोबाइल नंबर दर्ज करें।"
                                                            data-parsley-minlength-message="मोबाइल नंबर 10 अंकों का होना चाहिए।"
                                                            data-parsley-maxlength-message="मोबाइल नंबर 10 अंकों का होना चाहिए।">
                                                        <span class="text-danger" id="error-phone"></span>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group mb-4">
                                                        <select name="state" id="state" class="form-control"
                                                            onchange="setState(this)" required
                                                            data-parsley-required-message="कृपया राज्य चुनें।">
                                                            <option value="">राज्य</option>
                                                            @if (!empty($state))
                                                                @foreach ($state as $ste)
                                                                    <option data-id="{{ $ste->id }}"
                                                                        value="{{ $ste->name }}">{{ $ste->name }}
                                                                    </option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                        <span class="text-danger" id="error-state"></span>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group mb-4">
                                                        <span id="courseDiv">
                                                            <select class="form-select" name="district" id="district"
                                                                required data-parsley-required-message="कृपया जिला चुनें।">
                                                                <option value="">जिला</option>
                                                            </select>
                                                        </span>
                                                        <span class="text-danger" id="error-district"></span>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group mb-4">
                                                        <span id="cityDiv">
                                                            <select class="form-select" name="city" id="city"
                                                                required data-parsley-required-message="कृपया शहर चुनें।">
                                                                <option value="">शहर</option>
                                                            </select>
                                                        </span>
                                                        <span class="text-danger" id="error-city"></span>
                                                    </div>
                                                </div>

                                                {{-- <div class="col-md-6">
                                                    <div class="form-group mb-4">
                                                        <input type="text" class="form-control" name="pin_code"
                                                            placeholder="पिन कोड" required minlength="6" maxlength="6"
                                                            onkeypress="return /[0-9]/i.test(event.key)"
                                                            data-parsley-required-message="कृपया पिन कोड दर्ज करें।"
                                                            data-parsley-length="[6, 6]"
                                                            data-parsley-length-message="पिन कोड 6 अंकों का होना चाहिए।">
                                                        <span class="text-danger" id="error-pin_code"></span>
                                                    </div>
                                                </div> --}}



                                                 <div class="col-md-12">
                                                    <div class="form-group mb-4">
                                                       <textarea name="address" class="form-control" placeholder="पता"  required data-parsley-required-message="कृपया पता दर्ज करें।"></textarea>
                                                        <span class="text-danger" id="error-address"></span>
                                                    </div>
                                                </div>



                                                <div class="col-md-12">
                                                    <div class="form-group mb-4">
                                                        <input type="text" class="form-control"
                                                            name="leveller_manufacturer"
                                                            placeholder="लेवलर निर्माता का नाम" required
                                                            data-parsley-required-message="कृपया निर्माता का नाम दर्ज करें।">
                                                        <span class="text-danger" id="error-leveller_manufacturer"></span>
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="form-group mb-4">
                                                        <input type="text" class="form-control"
                                                            name="leveller_model_no" placeholder="लेवलर मॉडल न." required
                                                            data-parsley-required-message="कृपया मॉडल नंबर दर्ज करें।">
                                                        <span class="text-danger" id="error-leveller_model_no"></span>
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="form-group mb-4">
                                                        <label for="" class="mb-3">लेवलर खरीद की तारीख</label>
                                                        <input type="date" class="form-control"
                                                            name="leveller_purchase_date"
                                                            placeholder="लेवलर खरीद की तारीख" required
                                                            data-parsley-required-message="कृपया खरीद की तारीख चुनें।">
                                                        <span class="text-danger"
                                                            id="error-leveller_purchase_date"></span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="checkbox-item send-wrap">
                                                <button type="button" onclick="SubmitForm()" class="tf-btn">
                                                    <span class="text-style">सबमिट</span>
                                                    <span class="icon">
                                                        <i class="icon-arrow_right"></i>
                                                    </span>
                                                </button>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="s-img-item item-1 scroll-element-3">
                        <img class="scale-1-1" src="{{ asset('front') }}/images/section/yellow-f.png" alt="Apogee Agrotech equipment in a yellow plain field ready for harvesting">
                    </div>
                </div>

            </section>





        </div><!-- /.Main-content -->
    </div>
    <!-- Footer -->


    <script>
        function setState(selectElement) {
            const selectedOption = selectElement.options[selectElement.selectedIndex];
            const stateId = selectedOption.getAttribute('data-id');
            $("#courseDiv").html(
                ' <select class="form-control" name="district" id="district" ><option value="">जिला</option></select>'
            );
            $.ajax({
                url: "{{ route('home.loaddistrict') }}",
                type: 'post',
                data: {
                    "state_id": stateId,
                    "_token": '{{ csrf_token() }}'
                },
                success: function(res) {
                    $("#courseDiv").html(res.districtDropdown);
                }
            });
        }


        function setCity(selectElement) {
            const selectedOption = selectElement.options[selectElement.selectedIndex];
            const cityId = selectedOption.getAttribute('data-id');
            // alert(cityId);

            $("#cityDiv").html(
                ' <select class="form-select" name="city" id="city" ><option value="">शहर</option></select>'
            );
            $.ajax({
                url: "{{ route('home.loadcity') }}",
                type: 'post',
                data: {
                    "city_id": cityId,
                    "_token": '{{ csrf_token() }}'
                },
                success: function(res) {
                    $("#cityDiv").html(res.cityDropdown);

                }
            });
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function SubmitForm() {

            $('.text-danger').text('');

            // Validate the form using Parsley
            var isValid = $('#farmerregistrionform').parsley().validate();

            // If form validation fails, return
            if (!isValid) {
                return;
            }

            Swal.fire({
                title: 'Please wait...',
                allowOutsideClick: false,
                showConfirmButton: false,
                willOpen: () => {
                    Swal.showLoading()
                }
            });
            var action = $('#farmerregistrionform').attr('action');
            var formData = new FormData($('#farmerregistrionform')[0]); // 'this' refers to the form being submitted
            $.ajax({
                type: "post",
                url: action,
                data: formData,
                processData: false,
                contentType: false,
                success: function(data) {
                    Swal.close();
                    // Handle successful response (if needed)
                    // if (data.status === 'true') {
                    //     Swal.close();

                    //     Swal.fire({
                    //         icon: 'success',
                    //         title: 'Success!',
                    //         text: data.message,
                    //     }).then(function() {
                    //         window.location.reload();
                    //     });
                    // }
                    if (data.status == true) {

                        $('#find-a-farmer-card').empty();
                        $('#find-a-farmer-card').append(data.html); // data.html
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: data.message, // data.message
                        });
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
