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
                                Testimonials
                            </h1>
                            <div class="icon-img">
                                <img src="{{ asset('front') }}/images/item/line-throw-title.png" alt="apogeeagrotech testimonials">
                            </div>
                            <div class="breadcrumb">
                                <a href="{{ route('home') }}">Home</a>

                                <div class="icon">
                                    <i class="icon-arrow-right1"></i>
                                </div>
                                <a href="javascript:void(0)">Testimonials</a>
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





        <!-- Section customer-say-->
        <section class="s-customer-say tf-pt-0">
            <div class="tf-container">
                <div class="row">

                    <div class="col-lg-12">
                        <div class="heading-section has-text text-center">
                            <p class="sub-title text-center">What they are thinking about</p>
                            <p class="title wow fadeInUp" data-wow-delay="0s"> Customer's Feedback </p>


                            <div class="text-center"> <img class="tf-animate-1 active-animate"
                                    src="{{ asset('front') }}/images/item/rice-plant-2.png" alt="Paddy cultivation becomes easier and more efficient using a land leveler and rotavator on the farm"> </div>


                            <div class="img-item"><img class="tf-animate-1"
                                    src="{{ asset('front') }}/../../images/item/rice-plant-2.html" alt="Paddy farming made easy and efficient with the use of a land leveler and rotavator on agricultural fields"></div>
                        </div>
                    </div>



                    @if (!empty($testimonials))
                        @foreach ($testimonials as $item)
                            
                            <div class="col-lg-12">
                                <div class="main-customer">
                                    <div class="testimonial shadow wow fadeInUp" data-wow-delay="0s">
                                        <div class="author-wrap">
                                            <div class="left">
                                                <div class="image-avt"> <img src="{{ asset('uploads/testimonial/' . $item->image) }}"
                                                        alt="Apogee Agrotech Happy Customer"> </div>
                                                <div class="infor">
                                                    <div class="wg-rating">
                                                          @for ($i = 1; $i <= $item->rating; $i++)
                                                            <i class="fa-solid fa-star"></i>
                                                        @endfor
                                                    </div>
                                                    <div class="name-wrap">
                                                        <div class="name text-upper hover-text-4"> {{ $item->testimonial_name }} 
                                                        </div>

                                                    </div>
                                                    <p class="duty">{{ $item->city }}</p>
                                                </div>
                                            </div>
                                            <div class="right"> <i class="icon-quote"></i> </div>
                                        </div>
                                        <div class="comment">
                                            <p class="text">{{ $item->content }} </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif

                </div>
            </div>

        </section><!-- /.Section customer-say-->





    </div><!-- /.Main-content -->
@endsection
