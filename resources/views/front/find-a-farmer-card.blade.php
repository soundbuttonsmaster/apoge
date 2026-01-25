@extends('front.layouts.masterhome')
@section('section')
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
                                Farmer Card
                            </h1>
                            <div class="icon-img">
                                <img src="{{ asset('front') }}/images/item/line-throw-title.png" alt="">
                            </div>
                            <div class="breadcrumb">
                                <a href="{{ route('home') }}">Home</a>
                                <div class="icon">
                                    <i class="icon-arrow-right1"></i>
                                </div>
                                <a href="javascript:void(0)">Farmer Card</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div><!-- /.Page-title -->


    <div class="main-content pb-0 pt-93" id="find-a-farmer-card">
        <section style="display:none">
            <div class="odometer style-5">1000</div>
        </section>
        <section class="s-welcome-to">
            <div class="" >
                <div class="tf-container">
                    <div class="content-section text-center">
                        <div class="heading-section style-4">
                            <p class="sub-title text-center">Apogee Agrotech</p>
                            <h2 class="title wow fadeInUp animated animated" data-wow-delay="0s"
                                style="visibility: visible; animation-delay: 0s; animation-name: fadeInUp;">Find a
                                Farmer Card</h2>
                            <div class="text-center"> <img class="tf-animate-1 active-animate"
                                    src="{{ asset('front') }}/images/item/rice-plant-2.png" alt=""> </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-xs-6">
                            <div class="form-send-message style-2 dealer_form">
                                <form action="{{ route('home.find_a_farmer_card_form') }}" method="POST"
                                    id="findAfarmerCard" data-parsley-validate>
                                    @csrf
                                    <div class="cols style-2 mb-15">
                                        <fieldset>
                                            <label>Name:*</label>
                                            <input type="text" class="form-control" name="name" placeholder="Name"
                                                aria-required="true" required />
                                            <span class="text-danger" id="error-name"></span>
                                        </fieldset>
                                    </div>

                                    <div class="cols style-2 mb-15">
                                        <fieldset>
                                            <label>Mobile:*</label>
                                            <input type="text" class="form-control" name="phone"
                                                onkeypress="return /[0-9-/]/i.test(event.key)" maxlength="10" minlength="10"
                                                placeholder="Mobile" aria-required="true" required />
                                            <span class="text-danger" id="error-phone"></span>
                                        </fieldset>
                                    </div>





                                    <div class="checkbox-item send-wrap">

                                        <button type="button" onclick="SubmitForm()" class="tf-btn "> <span
                                                class="text-style"> Submit
                                            </span> <span class="icon"> <i class="icon-arrow_right"></i> </span>
                                        </button>



                                    </div>
                                </form>
                            </div>
                        </div>

                        {{-- <div class="col-lg-6 col-md-6 col-xs-6">
                            <div class="map_er">
                                <img src="{{ asset('front') }}/images/dealer.jpg">


                            </div>
                        </div> --}}




                    </div>
                </div>
            </div>
        </section>
    </div>


    {{-- @include('front.layouts.include-find-afarmer-card') --}}


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function SubmitForm() {

            $('.text-danger').text('');

            // Validate the form using Parsley
            var isValid = $('#findAfarmerCard').parsley().validate();

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
            var action = $('#findAfarmerCard').attr('action');
            var formData = new FormData($('#findAfarmerCard')[0]); // 'this' refers to the form being submitted
            $.ajax({
                type: "post",
                url: action,
                data: formData,
                processData: false,
                contentType: false,
                success: function(data) {
                    Swal.close();
                    // Handle successful response (if needed)
                    //  $('#find-a-dealer-list').empty();
                    //  $('#find-a-dealer-list').append(data);

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
