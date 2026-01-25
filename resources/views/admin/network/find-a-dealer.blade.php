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
                                <h1 class="title">Find a Dealer</h1>
                                <div class="icon-img"> <img src="{{ asset('front') }}/images/item/line-throw-title.png" alt="">
                                </div>
                                <div class="breadcrumb"> <a href="{{ route('home') }}">Home</a>

                                    <div class="icon"> <i class="icon-arrow-right1"></i> </div>
                                    <a href="javascript:void(0)">Find a Dealer</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- /.Page-title -->

        <!-- Main-content -->
        <div class="main-content pb-0 pt-93">
            <section style="display:none">
                <div class="odometer style-5">1000</div>
            </section>
            <section class="s-welcome-to">
                <div class="">
                    <div class="tf-container">
                        <div class="content-section text-center">
                            <div class="heading-section style-4">
                                <p class="sub-title text-center">A large network of dealerships</p>
                                <h2 class="title wow fadeInUp animated animated" data-wow-delay="0s"
                                    style="visibility: visible; animation-delay: 0s; animation-name: fadeInUp;">Find a
                                    Dealer</h2>
                                <div class="text-center"> <img class="tf-animate-1 active-animate"
                                        src="{{ asset('front') }}/images/item/rice-plant-2.png" alt=""> </div>

                            <p class="text-center"> 
Find the dealers/distributors here to experience our complete range of land levelling implements in
your region.</p>

                            </div>
                        </div>
                        
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-xs-6">
                            <div class="form-send-message style-2 dealer_form">
                                <form action="{{ route('home.save_find_a_dealer_form') }}" method="POST"
                                    id="finddealerform" data-parsley-validate>
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
                                            <label>Email:</label>
                                            <input type="email" class="form-control" name="email" placeholder="Email"
                                                required />
                                            <span class="text-danger" id="error-email"></span>
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
                                    <div class="cols style-2 mb-15">
                                        <fieldset>
                                            <label>State</label>
                                            <input type="text" class="form-control" name="state" placeholder="State"
                                                aria-required="true" required />
                                            {{-- <select name="state" class="form-control">
                                                <option value="">Select your state</option>
                                                <option value="Andhra Pradesh">Andhra Pradesh</option>
                                                <option value="Arunachal Pradesh">Arunachal Pradesh</option>
                                                <option value="Assam">Assam</option>
                                                <option value="Bihar">Bihar</option>
                                                <option value="Chhattisgarh">Chhattisgarh</option>
                                                <option value="Delhi">Delhi</option>
                                                <option value="Goa">Goa</option>
                                                <option value="Gujarat">Gujarat</option>
                                                <option value="Haryana">Haryana</option>
                                                <option value="Himachal Pradesh">Himachal Pradesh</option>
                                                <option value="Jammu & Kashmir">Jammu & Kashmir</option>
                                                <option value="Jharkhand">Jharkhand</option>
                                                <option value="Karnataka">Karnataka</option>
                                                <option value="Kerala">Kerala</option>
                                                <option value="Madhya Pradesh">Madhya Pradesh</option>
                                                <option value="Maharashtra">Maharashtra</option>
                                                <option value="Manipur">Manipur</option>
                                                <option value="Meghalaya">Meghalaya</option>
                                                <option value="Mizoram">Mizoram</option>
                                                <option value="Nagaland">Nagaland</option>
                                                <option value="Odisha">Odisha</option>
                                                <option value="Punjab">Punjab</option>
                                                <option value="Rajasthan">Rajasthan</option>
                                                <option value="Sikkim">Sikkim</option>
                                                <option value="Tamil Nadu">Tamil Nadu</option>
                                                <option value="Telangana">Telangana</option>
                                                <option value="Tripura">Tripura</option>
                                                <option value="Uttar Pradesh">Uttar Pradesh</option>
                                                <option value="Uttarakhand">Uttarakhand</option>
                                                <option value="West Bengal">West Bengal</option>
                                            </select> --}}
                                            <span class="text-danger" id="error-state"></span>
                                        </fieldset>
                                    </div>
                                    <div class="cols style-2 mb-15">
                                        <fieldset>
                                            <label>District</label>
                                            <input type="text" name="district" class="form-control" id="">
                                            <span class="text-danger" id="error-district"></span>
                                        </fieldset>
                                    </div>





                                    <div class="checkbox-item send-wrap">

                                        <button type="button" onclick="SubmitForm()" class="tf-btn "> <span
                                                class="text-style"> Submit
                                            </span> <span class="icon"> <i class="icon-arrow_right"></i> </span>
                                        </button>

                                        <button type="button" onclick="ResetForm()" class="tf-btn "> <span
                                                class="text-style"> Reset
                                            </span> <span class="icon"> <i class="icon-arrow_right"></i> </span>
                                        </button>

                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6 col-xs-6">
                            <div class="map_er" id="find-a-dealer-list">
                                <img src="{{ asset('front') }}/images/dealer.jpg">


                            </div>
                        </div>




                    </div>
                    </div>
                </div>
            </section>
        </div>
        <!-- /.Main-content -->


        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            function SubmitForm() {
    
                $('.text-danger').text('');
    
                // Validate the form using Parsley
                var isValid = $('#finddealerform').parsley().validate();
    
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
                var action = $('#finddealerform').attr('action');
                var formData = new FormData($('#finddealerform')[0]); // 'this' refers to the form being submitted
                $.ajax({
                    type: "post",
                    url: action,
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        Swal.close();
                        // Handle successful response (if needed)
                        $('#find-a-dealer-list').empty();
                        $('#find-a-dealer-list').append(data);
    
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
            function ResetForm() {
                document.getElementById("finddealerform").reset();
                $('#find-a-dealer-list').empty();
            }
        </script>
    @endsection