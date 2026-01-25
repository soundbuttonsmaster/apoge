@extends('front.layouts.masterhome')
@section('section')
<!-- Page-title -->
<div class="page-title page-contact-us">
    <!--  <div class="rellax" data-rellax-speed="5">
                <img src="{{ asset('front') }}/images/page-title/contact-us.jpg" alt="">
            </div> -->
    <div class="content-wrap">
        <div class="tf-container w-1290">
            <div class="row">
                <div class="col-lg-12">
                    <div class="content">

                        <h1 class="title">
                            Contact Us
                        </h1>
                        <div class="icon-img">
                            <img src="{{ asset('front') }}/images/item/line-throw-title.png" alt="Contact us Apogee Agrotech Pvt.Ltd" style="width: auto; height: auto; max-width: 100%; object-fit: contain;">
                        </div>
                        <div class="breadcrumb">
                            <a href="{{ route('home') }}">Home</a>
                            <div class="icon">
                                <i class="icon-arrow-right1"></i>
                            </div>
                            <a href="javascript:void(0)">Contact Us </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div><!-- /.Page-title -->

<!-- Main-content -->
<div class="main-content pt-0 pb-0 page-contact-us">

    <!-- Section contact us -->
    <section class="s-contact-us style-2 bg-white pb-88">
        <div class="section-wrap">
            <div class="tf-container w-1290">




                <div class="content-section">

                    <div class="row align-items-center">
                        <div class="col-lg-6">
                            <div class="heading-section has-text mb-50">
                                <p class="sub-title">We are here to help</p>
                                <p class="title wow fadeInUp" data-wow-delay="0s">Trying to reaching us out ?
                                </p>

                                <div class="img-item">
                                    <img class="tf-animate-1" src="{{ asset('front') }}/images/item/rice-plant-2.png"
                                        alt="Apogee Customer services and support are available 24x7" />
                                </div>
                                <p class="text">
                                    Our Customer services and support are available <strong>24x7</strong>.
                                    Please feel free to write us at <strong><a href="mailto:sales@apogeeagrotech.com">
                                            sales@apogeeagrotech.com</a></strong>. We will contact you as soon
                                    as possible
                                </p>
                            </div>
                        </div>


                        <div class="col-lg-6">
                            <form id="contactform" method="post" action="{{ route('home.contact_form') }}"
                                novalidate="novalidate" class="form-send-message style-2" data-parsley-validate>
                                @csrf
                                <div class="cols style-2 mb-15">
                                    <fieldset>
                                        <input type="text" class="form-control" name="name" placeholder="Name:*"
                                            aria-required="true" required />
                                        <span class="text-danger" id="error-name"></span>
                                    </fieldset>
                                    <fieldset>
                                        <input type="email" class="form-control email" name="email"
                                            placeholder="Email" required />
                                        <span class="text-danger" id="error-email"></span>
                                    </fieldset>
                                </div>
                                <div class="cols style-2 mb-15">
                                    <fieldset>
                                        <input type="text" class="form-control" name="phone"
                                            onkeypress="return /[0-9-/]/i.test(event.key)" maxlength="10" minlength="10"
                                            placeholder="Phone:*" aria-required="true" required />
                                        <span class="text-danger" id="error-phone"></span>
                                    </fieldset>
                                    <fieldset>
                                        <input type="text" class="form-control" name="location"
                                            placeholder="Location:*" aria-required="true" required />
                                        <span class="text-danger" id="error-location"></span>
                                    </fieldset>

                                </div>
                                <div class="cols mb-30">
                                    <fieldset>
                                        <textarea name="message" placeholder="Message..."></textarea>
                                        <span class="text-danger" id="error-message"></span>
                                    </fieldset>
                                </div>
                                <div class="checkbox-item send-wrap">

                                    <button type="button" onclick="SubmitForm()" class="tf-btn ">
                                        <span class="text-style">
                                            Send Message
                                        </span>
                                        <span class="icon">
                                            <i class="icon-arrow_right"></i>
                                        </span>
                                    </button>
                                </div>
                            </form>
                        </div>

                    </div>




                </div>








                <div class="row">

                    <div class="col-lg-3">
                        <div class="content-left">
                            <ul class="contact-list">
                                <li class="wow fadeInUp" data-wow-duration="1.4s">
                                    <div class="icon style-circle"> <i class="fa-solid fa-location-dot"></i>
                                    </div>
                                    <div class="infor">
                                        <p class="title">Uttar Pradesh </p>
                                        <p class="text"> Plot No. 540, Near Reliance Petrol Pump, Garh Road,
                                            Hapur, <strong>UP</strong>, 245101 </p>
                                    </div>
                                </li>
                                <li class="wow fadeInUp" data-wow-duration="1.4s">
                                    <div class="infor">
                                        <p class="text"><a href="mailto:sales@apogeeagrotech.com"><i
                                                    class="fa fa-envelope"></i>
                                                sales@apogeeagrotech.com</a><br>
                                            <a href="tel:+91 7624002265"><i class="fa fa-phone"></i>+91
                                                7624002265</a>
                                        </p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>




                    <div class="col-lg-3">
                        <div class="content-left">
                            <ul class="contact-list">
                                <li class="wow fadeInUp" data-wow-duration="1.4s">
                                    <div class="icon style-circle"> <i class="fa-solid fa-location-dot"></i>
                                    </div>
                                    <div class="infor">
                                        <p class="title">Gujarat</p>
                                        <p class="text"> First Floor, Shri Ram Complex, #1401, Kailashpati
                                            Chokdi, GIDC, Vitthal Udyognagar, <strong>Anand (Gujarat)</strong>,
                                            388121</p>
                                    </div>
                                </li>
                                <li class="wow fadeInUp" data-wow-duration="1.4s">
                                    <div class="infor">
                                        <p class="text"><a href="mailto:sales@apogeeagrotech.com"><i
                                                    class="fa fa-envelope"></i>
                                                sales@apogeeagrotech.com</a><br>
                                            <a href="tel:+91 7624002261"><i class="fa fa-phone"></i> +91
                                                7624002261</a>
                                        </p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>



                    <div class="col-lg-3">
                        <div class="content-left">
                            <ul class="contact-list">
                                <li class="wow fadeInUp" data-wow-duration="1.4s">
                                    <div class="icon style-circle"> <i class="fa-solid fa-location-dot"></i>
                                    </div>
                                    <div class="infor">
                                        <p class="title">Madhya Pradesh</p>
                                        <p class="text">Shanti Market, New Bypass Road, Near Imalia,
                                            <strong>Bhopal</strong> (MP)
                                        </p>
                                    </div>
                                </li>
                                <li class="wow fadeInUp" data-wow-duration="1.4s">
                                    <div class="infor">
                                        <p class="text"><a href="mailto:sales@apogeeagrotech.com"><i
                                                    class="fa fa-envelope"></i>
                                                sales@apogeeagrotech.com</a><br>
                                            <a href="tel:+91 7624002266"><i class="fa fa-phone"></i>+91
                                                7624002266</a>
                                        </p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>



                    <div class="col-lg-3">
                        <div class="content-left">
                            <ul class="contact-list">
                                <li class="wow fadeInUp" data-wow-duration="1.4s">
                                    <div class="icon style-circle"> <i class="fa-solid fa-location-dot"></i>
                                    </div>
                                    <div class="infor">
                                        <p class="title">Haryana</p>
                                        <p class="text">Near Jat Dharamshala Ladhot Road, Sukhpura Chowk,
                                            Rohtak, <strong>Haryana,</strong> 124001</p>
                                    </div>
                                </li>
                                <li class="wow fadeInUp" data-wow-duration="1.4s">
                                    <div class="infor">
                                        <p class="text"><a href="mailto:sales@apogeeagrotech.com"><i
                                                    class="fa fa-envelope"></i>
                                                sales@apogeeagrotech.com</a><br>
                                            <a href="tel:+91 9896830281"><i class="fa fa-phone"></i>+91
                                                9896830281</a>
                                            <a href="tel:+91 9837212286">+91 9837212286</a>
                                        </p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>




                </div>
            </div>
        </div>
    </section><!-- /.Section contact us -->


</div><!-- /.Main-content -->
<div class="location"><iframe
        src="https://www.google.com/maps/d/embed?mid=17IBfe7Ld203yGGlvoig_0r2Yn2aHeTid&ehbc=2E312F"></iframe>
</div>
<!-- Footer -->



<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function SubmitForm() {

        $('.text-danger').text('');

        // Validate the form using Parsley
        var isValid = $('#contactform').parsley().validate();

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
        var action = $('#contactform').attr('action');
        var formData = new FormData($('#contactform')[0]); // 'this' refers to the form being submitted
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
