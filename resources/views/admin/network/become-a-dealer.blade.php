@extends('front.layouts.masterhome')
@section('section')
@section('css')
    <link rel="stylesheet" href="{{ asset('front') }}/css/jquery.fancybox.min.css" media="screen">
@endsection
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
                        <h1 class="title">Become a Dealer</h1>
                        <div class="icon-img"> <img src="{{ asset('front') }}/images/item/line-throw-title.png"
                                alt=""> </div>
                        <div class="breadcrumb"> <a href="{{ route('home') }}">Home</a>
                            <div class="icon"> <i class="icon-arrow-right1"></i> </div>
                            <a href="javascript:void(0)">Network</a>
                            <div class="icon"> <i class="icon-arrow-right1"></i> </div>
                            <a href="javascript:void(0)">Become a Dealer</a>
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
    <!-- Section contact us -->

</div>
<!-- /.Main-content -->
<section class="s-contact-us style-2 pb-88">
    <div class="section-wrap">
        <div class="tf-container w-1290">
            <div class="row">
                <div class="col-lg-8">
                    <div class="heading-section has-text mb-50">
                        <p class="sub-title">Why Apogee Agrotech</p>
                        <h3 class="wow fadeInUp" data-wow-delay="0s"> Become a Dealer</h3>
                        <div class="img-item"> <img class="tf-animate-1" src="{{ asset('front') }}/images/item/rice-plant-2.png" alt="" /> </div>
                      </div>
                    <div class="become-dealer">
                        <p><strong>Partner with the Apogee Agrotech to be in an era of smart farming. Join us in our successful
                            journey!</strong></p>
        
        
                        <ul>
        
                          <li>Becoming a dealer of Apogee Agrotech benefits in many aspects such as investing in a
                            profitable business, customized products, highest standards of land levelling implements
                            such as laser land leveller, GNSS land leveller & 3D land levelling system.</li>
                          <li>In-house R&D and manufacturing unit to provide quick delivery of quality products.</li>
                          <li>One-stop solution of Industry expertise knowledge with immediate after-sales service.</li>
                          <li>Training and demonstration programs for dealers/ distributors are available upon request.
                            Training on product features, handling, sales process and customer interaction is available in
                            the regional language.</li>
                          <li>Outstanding online customer support and warranty assistance.</li>
                          <li>A devoted team committed to meeting customer needs through their exceptional dedication
                            and hard work.</li>
        
                        </ul>
        
                        <p>Some aspects we are interested in</p>
        
        
                      </div>
                </div>
                <div class="col-lg-4">
                    <div class="content-section">
                        <div class="heading-section has-text mb-50">
                            <p class="sub-title">Some aspects we are interested in</p>
                            <h3> Basic Information</h3>
                            <div class="img-item"> <img class="tf-animate-1" src="{{ asset('front') }}/images/item/rice-plant-2.png" alt="" /> </div>
                          </div>
                        <form class="form-send-message style-2" action="{{ route('home.save_becom_form') }}"
                            method="POST" id="becomeform" data-parsley-validate>
                            @csrf

                            <div class="cols style-2 mb-15">
                                <fieldset>
                                    <input type="text" class="form-control" name="name" placeholder="Name:*"
                                        aria-required="true" required />
                                    <span class="text-danger" id="error-name"></span>
                                </fieldset>
                            </div>
                            <div class="cols style-2 mb-15">
                                <fieldset>
                                    <input type="email" class="form-control" id="mail" name="email"
                                        placeholder="Email:*" required />
                                    <span class="text-danger" id="error-email"></span>
                                </fieldset>
                            </div>
                            <div class="cols style-2 mb-15">
                                <fieldset>
                                    <input type="text" class="form-control" name="phone" placeholder="Mobile:*"
                                        aria-required="true" onkeypress="return /[0-9-/]/i.test(event.key)"
                                        maxlength="10" minlength="10" required />
                                    <span class="text-danger" id="error-phone"></span>
                                </fieldset>
                            </div>
                            <div class="cols style-2 mb-15">
                                <fieldset>
                                    <input type="text" class="form-control" id="state" name="state"
                                        placeholder="State:*" aria-required="true" required />
                                    <span class="text-danger" id="error-state"></span>
                                </fieldset>
                            </div>
                            <div class="cols style-2 mb-15">
                                <fieldset>
                                    <input type="text" class="form-control" name="district" placeholder="District:*"
                                        aria-required="true" required />
                                    <span class="text-danger" id="error-district"></span>
                                </fieldset>
                            </div>
                            <div class="cols style-2 mb-15">
                                <fieldset>
                                    <input type="text" class="form-control" name="village" placeholder="Village:*"
                                        aria-required="true" required />
                                    <span class="text-danger" id="error-village"></span>
                                </fieldset>
                            </div>
                            <div class="cols style-2 mb-15">
                                <fieldset>
                                    <!--<select class="form-control select" name="intersted_in" required>-->
                                    <!--    <option value="Interested in">Interested in</option>-->
                                    <!--</select>-->
                                    <input type="text" class="form-control" name="intersted_in"
                                        placeholder="Interested in:*" aria-required="true" required />
                                    <span class="text-danger" id="error-intersted_in"></span>
                                </fieldset>
                            </div>





                            <div class="checkbox-item send-wrap">
                                <button type="button" onclick="SubmitForm()" class="tf-btn"><span
                                        class="text-style">Submit</span> <span class="icon"> <i
                                            class="icon-arrow_right"></i> </span> </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /.Section contact us -->

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function SubmitForm() {

        $('.text-danger').text('');

        // Validate the form using Parsley
        var isValid = $('#becomeform').parsley().validate();

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
        var action = $('#becomeform').attr('action');
        var formData = new FormData($('#becomeform')[0]); // 'this' refers to the form being submitted
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
                        // window.location.href = '{{ url('admin/product/list') }}';
                        window.location.reload();
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
