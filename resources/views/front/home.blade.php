@extends('front.layouts.masterhome')
@section('section')
    <!-- Page-title-home-1 -->
    <div class="page-title-home-1">
        <div class="swiper-container slider-home-1">
            <div class="swiper-wrapper">


                <div class="swiper-slide">
                    <div class="slide-home-1">
                        <div class="image overflow-hidden">
                            <img src="{{ asset('front') }}/images/page-title/slider-1.jpg"
                                alt="Apogee Bahubali Laser Land Leveller Bucket" class="tf-animate-zoom-in-out"
                                fetchpriority="high" width="1920" height="1080" loading="eager" decoding="async" />
                        </div>
                        <div class="content-wrap">
                            <div class="tf-container w-1780">
                                <div class="row">
                                    <div class="col-lg-7">
                                        <div class="content">
                                            <p class="sub-title font-snowfall tf-fade-top fade-item-1"> Redefining the
                                                Agriculture</p>
                                            <h1 class="title font-farmhouse tf-fade-right fade-item-2"> Laser Land Leveller
                                                for Precision Agriculture</h1>
                                            <div class="img-item "> <img
                                                    src="{{ asset('front') }}/images/item/line-throw-title.png"
                                                    class="tf-trainsition-draw-left access-trainsition"
                                                    alt="Horizontal line divider graphic used to separate sections on the Apogee Agrotech website"
                                                    style="width: auto; height: auto; max-width: 100%; object-fit: contain;" />
                                            </div>
                                            <p class="text font-nunito tf-fade-left fade-item-4">Simplify the land levelling
                                                process with our
                                                state-of-the-art agricultural levelling
                                                implements</p>
                                            <a href="{{ route('home.contact_us') }}"
                                                class="tf-btn btn-view tf-fade-bottom fade-item-5"> <span
                                                    class="text-style cl-primary"> Contact Us </span>
                                                <div class="icon"> <i class="icon-arrow_right"></i> </div>
                                            </a>
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="slide-home-1">
                        <div class="image overflow-hidden"> <img src="{{ asset('front') }}/images/page-title/slider-2.jpg"
                                alt="Farmer using GNSS land leveller by Apogee Agrotech for accurate and efficient land preparation in agriculture"
                                class="tf-animate-zoom-in-out" width="1920" height="1080" /> </div>
                        <div class="content-wrap">
                            <div class="tf-container w-1780">
                                <div class="row">
                                    <div class="col-lg-7">
                                        <div class="content">
                                            <p class="sub-title font-snowfall tf-fade-top fade-item-1"> Redefining the
                                                Agriculture </p>
                                            <h2 class="title font-farmhouse tf-fade-right fade-item-2">Exceptional GNSS Land
                                                Levelling equipment
                                            </h2>
                                            <div class="img-item "> <img class="tf-trainsition-draw-left access-trainsition"
                                                    src="{{ asset('front') }}/images/item/line-throw-title.png"
                                                    alt="Line of Apogee Agrotech land levellers arranged for display, showing product range and uniform build quality"
                                                    style="width: auto; height: auto; max-width: 100%; object-fit: contain;" />
                                            </div>
                                            <p class="text font-nunito tf-fade-left fade-item-4"> Transform land levelling
                                                to offer precise data
                                                by minimizing challenges posed by operations & weather conditions.</p>
                                            <a href="{{ route('home.contact_us') }}"
                                                class="tf-btn btn-view tf-fade-bottom fade-item-5"> <span
                                                    class="text-style cl-primary"> Contact Us </span>
                                                <div class="icon"> <i class="icon-arrow_right"></i> </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="slide-home-1">
                        <div class="image overflow-hidden"> <img src="{{ asset('front') }}/images/page-title/slider-3.jpg"
                                alt="Apogee Auto Steering Set" class="tf-animate-zoom-in-out" width="1920" height="1080" />
                        </div>
                        <div class="content-wrap">
                            <div class="tf-container w-1780">
                                <div class="row">
                                    <div class="col-lg-7">
                                        <div class="content">
                                            <p class="sub-title font-snowfall tf-fade-top fade-item-1"> Redefining the
                                                Agriculture </p>
                                            <h2 class="title font-farmhouse tf-fade-right fade-item-2"> Automated Steering
                                                System for Precision
                                                Agriculture </h2>
                                            <div class="img-item"> <img class="tf-trainsition-draw-left access-trainsition"
                                                    src="{{ asset('front') }}/images/item/line-throw-title.png"
                                                    alt="Decorative horizontal line used as a visual separator in Apogee Agrotech's website layout or section design"
                                                    style="width: auto; height: auto; max-width: 100%; object-fit: contain;" />
                                            </div>
                                            <p class="text font-nunito tf-fade-left fade-item-4"> Automate the steering of
                                                tractors and farming
                                                machinery to make precision farming easy. </p>
                                            <a href="{{ route('home.contact_us') }}"
                                                class="tf-btn btn-view tf-fade-bottom fade-item-5"> <span
                                                    class="text-style cl-primary"> Contact Us </span>
                                                <div class="icon"> <i class="icon-arrow_right"></i> </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="btn-slide-home-1 btn-next"> <svg version="1.0" xmlns="http://www.w3.org/2000/svg" width="80px"
                    height="20px" viewBox="0 0 80 20" preserveAspectRatio="xMidYMid meet">
                    <g fill="#ffffff">
                        <path
                            d="M63 19 c0 -0.5 2.6 -2.4 5.8 -4.2 l5.7 -3.3 -19.5 -0.8 c-11 -0.5 -27.1 -0.5 -37 0.1 -9.6 0.5 -17.7 0.7 -17.9 0.5 -2.4 -1.9 22 -3.5 48.7 -3.1 l25.2 0.3 -4.6 -3.9 c-2.5 -2.1 -4.3 -4 -4 -4.3 0.7 -0.7 14.6 8.9 14.6 10.2 0 1.1 -14.3 9.5 -16.2 9.5 -0.4 0 -0.8 -0.4 -0.8 -1z" />
                    </g>
                </svg> </div>
            <div class="btn-slide-home-1 btn-prev"> <svg version="1.0" xmlns="http://www.w3.org/2000/svg" width="80px"
                    height="20px" viewBox="0 0 80 20" preserveAspectRatio="xMidYMid meet">
                    <g fill="#ffffff">
                        <path
                            d="M7 15.4 c-3.6 -2.4 -6.6 -5 -6.8 -5.7 -0.2 -1.2 13.8 -9.7 16 -9.7 2.4 0 0.2 2.4 -4.9 5.2 l-5.8 3.3 19.5 0.8 c11 0.5 27.1 0.5 37 -0.1 9.6 -0.5 17.7 -0.7 17.9 -0.5 2.4 1.9 -22 3.5 -48.6 3.1 l-25.2 -0.3 4.7 4.2 c6.1 5.5 4.4 5.3 -3.8 -0.3z" />
                    </g>
                </svg> </div>
        </div>
    </div>
    <!-- /.Page-title-home-1 -->

    <!-- Main-content -->
    <div class="main-content pt-0 page-index">

        <!-- Section-break-page -->
        <section class="s-break-page">
            <!-- <div class="img-item item-1"> <img src="{{ asset('front') }}/images/item/grass-4.png" alt="" class="" /> </div> -->
            <!--   <div class="img-item item-2 wow zoomIn">
                                                                                        <div class="scroll-element-3"> <img src="{{ asset('front') }}/images/item/barn.png" alt="" class="" /> </div>
                                                                                      </div> -->
            <!-- <div class="img-item item-3"> <img src="{{ asset('front') }}/images/item/page-title-top.png" alt="" class="" /> </div> -->
        </section>
        <!-- /.Section-break-page -->

        <!-- Section box portfolio -->
        <section class="s-box-portfolio">
            <div class="tf-container w-1290">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="box-portfolio style-4 tf-img-hover mb-s-991">
                            <div class="image hover01"> <img src="{{ asset('front') }}/images/we-use-new-technology.jpg"
                                    alt="Advanced technology in agriculture - GPS-guided equipment and smart farming solutions by Apogee Agrotech"
                                    class="lazyload" /> </div>
                            <div class="content">
                                <div class="icon hover02"> <img src="{{ asset('front') }}/images/logo.jpg"
                                        alt="Apogee Agrotech Logo" /> </div>
                                <a href="{{ route('home.about_us') }}" class="title hover-text-4"> We use new technology</a>
                                <p class="text font-nunito"> We use advanced technology in agriculture to improve
                                    productivity, precision,
                                    and sustainability. From GPS-guided equipment to smart farming solutions, we bring
                                    innovation to the
                                    field. </p>
                                <div class="bot"> <a href="{{ route('home.about_us') }}" class="btn-read font-worksans fw-5"
                                        aria-label="Read more about how we use new technology in agriculture"> Read More
                                    </a> </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="box-portfolio style-4 tf-img-hover mb-s-991">
                            <div class="image hover01"> <img
                                    src="{{ asset('front') }}/images/quality-value-and-services.jpg"
                                    alt="Quality value and services - Apogee Agrotech commitment to excellence in agricultural equipment"
                                    class="lazyload" />
                            </div>
                            <div class="content">
                                <div class="icon"> <img src="{{ asset('front') }}/images/logo.jpg"
                                        alt="Apogee Agrotech Logo" /> </div>
                                <a href="{{ route('home.about_us') }}" class="title hover-text-4">
                                    <!-- We are committed to delivering top- -->
                                    Quality Value and Services</a>
                                <p class="text font-nunito"> We are committed to delivering the highest quality,
                                    cost-effective solution,
                                    and reliable
                                    services to our customers. Our focus is on excellence that builds trust and long-term
                                    relationships.
                                    <!-- Click here to explore our company catalogue, offering a comprehensive understanding of our solutions. -->
                                </p>
                                <div class="bot"> <a href="{{ route('home.about_us') }}" class="btn-read font-worksans fw-5"
                                        aria-label="Read more about quality value and services"> Read More </a> </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="box-portfolio style-4 tf-img-hover">
                            <div class="image hover01"> <img src="{{ asset('front') }}/images/our-mission.jpg"
                                    alt="Apogee Agrotech's mission to empower farmers with innovative, reliable, and efficient agricultural machinery solutions"
                                    class="lazyload" /> </div>
                            <div class="content">
                                <div class="icon"> <img src="{{ asset('front') }}/images/logo.jpg"
                                        alt="Apogee Agrotech Logo" /> </div>
                                <a href="{{ route('home.about_us') }}" class="title hover-text-4"> Our Mission </a>
                                <p class="text font-nunito"> Our mission is to empower farmers with innovative, efficient,
                                    and sustainable
                                    agricultural solutions. We strive to enhance productivity and improve
                                    livelihoods through technology and service excellence.
                                </p>
                                <div class="bot"> <a href="{{ route('home.about_us') }}" class="btn-read font-worksans fw-5"
                                        aria-label="Read more about our mission"> Read More </a> </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /.Section box portfolio -->

        <!-- Section about -->
        <section class="s-about-us">
            <div class="tf-container w-1290">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="main-section">
                            <div class="content-left img-hover">
                                <div class="heading-section">
                                    <p class="sub-title wow fadeInUp" data-wow-delay="0s">We have 15 years of agriculture
                                        farming experience
                                    </p>
                                    <h2 class="title text-container tf-animate-2"> Apogee Group</h2>
                                </div>
                                <p class="text-1">APOGEE Agrotech, with its headquarters located in Hapur, stands as one of
                                    the highly
                                    esteemed companies within India's agriculture sector. APOGEE GROUP offers top-tier
                                    agricultural
                                    implements, such as the 3D Land Levelling System equipped with its GNSS sensors, GNSS
                                    Land Leveller
                                    including its base and antennas, and Laser Guided Land Levelling System complete with
                                    Laser Transmitter,
                                    Laser Receiver, Laser Control Box, and Bucket/Scrapper.
                                </p>
                                <a href="{{ route('home.about_us') }}" class="tf-btn btn-read-more gap-34"
                                    aria-label="Read more about Apogee Group and our agricultural equipment"
                                    style="color: #ffffff !important; background-color: #1a5f2e !important;"> <span
                                        class="text-style" style="color: #ffffff !important;">Read more about Apogee
                                        Group</span>
                                    <div class="icon"> <i class="icon-arrow_right"></i> </div>
                                </a>
                                <div class="image hover-item"> <img src="{{ asset('front') }}/images/s-about.jpg"
                                        alt="Leading provider of laser land levellers and modern agricultural solutions for Indian farmers" />
                                </div>
                            </div>
                            <div class="content-right">
                                <div class="wg-counter style-2">
                                    <div class="has-border">
                                        <div class="counter-item">
                                            <div class="icon style-circle"> <i class="icon-wheat-grains"></i> </div>
                                            <p class="title font-worksans">Trust By Clients</p>
                                            <div class="counter">
                                                <div class="odometer style-2">500</div>
                                                <span class="sub-odo">+</span>
                                            </div>
                                            <p class="text font-nunito"> Trusted by clients for our reliability, quality,
                                                and commitment to
                                                excellence.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="box-trust">
                                    <div class="has-border">
                                        <ul class="benefit-list ">
                                            <li> <i class="fa-solid fa-circle-check"></i>
                                                <p> Modern Agriculture Equipment </p>
                                            </li>
                                            <li> <i class="fa-solid fa-circle-check"></i>
                                                <p> 3D GNSS Land Levelling Equipment

                                                </p>
                                            </li>
                                            <li> <i class="fa-solid fa-circle-check"></i>
                                                <p>Auto Steering System</p>
                                            </li>
                                        </ul>
                                        <ul class="box-icon-list">
                                            <li>
                                                <div class="box-icon  style-3 ic-hover wow fadeInUp" data-wow-delay="0s">
                                                    <div class="icon style-circle hover-icon"> <i><img
                                                                src="{{ asset('front') }}/images/highly-efficient-and-precised-equipment.png"
                                                                alt="Highly efficient and precise agricultural equipment icon"></i>
                                                    </div>
                                                    <a href="{{ route('home.about_us') }}"
                                                        class="caption fw-6 font-worksans text-upper hover-text-secondary">
                                                        Highly efficient and precised Equipment </a>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="box-icon style-3 ic-hover wow fadeInUp" data-wow-delay="0s">
                                                    <div class="icon style-circle hover-icon"> <i><img
                                                                src="{{ asset('front') }}/images/save-water-labour-and-increase-yields.png"
                                                                alt="Save water, labour and increase yields icon"></i>
                                                    </div>
                                                    <a href="{{ route('home.about_us') }}"
                                                        class="caption fw-6 font-worksans text-upper hover-text-secondary">
                                                        Save
                                                        water, labour and increase yields </a>
                                                </div>
                                            </li>
                                        </ul>
                                        <!-- <a href="#" class="tf-btn-read text-white hover-text-secondary"> Read More </a> </div> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </section>
        <!-- /.Section about -->

        <!-- Section our expertise -->
        @if (!empty($products))
            <section class="s-service has-img-item">
                <div class="heading-section text-center has-text has-img-item  mt-0">
                    <p class="sub-title">What We Provide </p>
                    <p class="title text-anime-style-1 overflow-hidden">Land Levelling Implements</p>
                    <!--  <p class=" text">
                                                                                                                                                                                                                Duis eleifend euismod arcu, nec faucibus mauris finibus id. Integer mattis, tellus non finibus
                                                                                                                                                                                                                rutrum.
                                                                                                                                                                                                            </p> -->
                    <div class="img-item"> <img class="tf-animate-1" src="{{ asset('front') }}/images/item/rice-plant-2.png"
                            alt="Rice Image Icon" /> </div>
                </div>
                <div class="s-slider">
                    <div class="tf-container w-1290">
                        <div class="row">
                            @foreach ($products as $item)
                                <div class="col-lg-3">
                                    <div class="card-provide img-hover">
                                        <div class="has-border"> <a href="{{ route('home.product_datels', $item->slug) }}">
                                                <div class="image">
                                                    @if (!empty($item->product_image) && isset(json_decode($item->product_image)[0]))
                                                        <img src="{{ asset('uploads/products/list/' . json_decode($item->product_image)[0]) }}"
                                                            alt="{{ $item->product_name }} - Laser Land Leveller by Apogee Agrotech"
                                                            class="lazyload">
                                                    @endif

                                                </div>
                                                <div class="title font-worksans hover-text-secondary">
                                                    {{ Str::limit($item->product_name, 18) }}
                                                </div>
                                                <p class="text"> {{ Str::limit($item->short_description, 53) }}</p>
                                                <span class="tf-btn-read" aria-label="Read more about {{ $item->product_name }}"
                                                    style="color: #1a5f2e !important; font-weight: 600;"> Read More </span>
                                            </a> </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            </section>
        @endif
        <!-- /.Section our expertise -->



        <!-- Section why us -->
        <section class="s-why-us has-img-item">
            <div class="tf-container w-1290">
                <div class="row align-items-center">
                    <div class="col-lg-12">
                        <div class="main-section">
                            <div class="image">
                                <div class="video-wrap style-4"> <img class="lazyload tf-animate-2 "
                                        data-src="{{ asset('front') }}/images/section/s-why-us.jpg"
                                        src="{{ asset('front') }}/images/section/s-why-us.jpg"
                                        alt="Why choose GNSS land leveller – For high-precision, GPS-based field leveling and improved agricultural productivity" />
                                    <div class="box-video tf-animate__box animate__slow "> <a href="#"
                                            class="style-icon-play popup-youtube"> <i class="icon-play3"></i>
                                            <div class="wave"></div>
                                            <div class="wave-1"></div>
                                        </a> </div>
                                </div>
                            </div>
                            <div class="content-section">
                                <div class="heading-section style-2">
                                    <div class="img-item">
                                        <div class="item"> <img class="tf-animate-1"
                                                src="{{ asset('front') }}/images/item/rice-plant-2.png"
                                                alt="Rice crop icon representing paddy farming and agricultural solutions on Apogee Agrotech website" />
                                        </div>
                                        <p class="sub-title"> What We Do? </p>
                                    </div>
                                    <h2 class="title tf-animate-4"> Apogee Agrotech pioneered the introduction of 3G Land
                                        Levelling
                                        technology, </h2>
                                </div>
                                <p class="text"> Apogee Agrotech pioneered the introduction of 3G Land Levelling
                                    technology, alongside the
                                    standard GNSS Land Levelling technology and Laser Levelling technology for farms or
                                    lands in India, all
                                    with approved subsidies. Our primary focus is on manufacturing cutting-edge and
                                    highlysophisticated
                                    levelling equipment to automate the farming process. </p>
                                <a href="{{ route('home.about_us') }}" class="tf-btn btn-read-more scale-40"
                                    aria-label="Read more about what Apogee Agrotech does"
                                    style="color: #ffffff !important; background-color: #1a5f2e !important;"> <span
                                        class="text-style" style="color: #ffffff !important;">Read more about Apogee
                                        Agrotech</span>
                                    <div class="icon"> <i class="icon-arrow_right"></i> </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="bot relative">
                        <ul class="benefit-list">
                            <li>
                                <div class="h5 hover-text-secondary title fw-6 font-worksans"> We are committed to
                                    delivering top-quality
                                    value and services</div>
                                <!-- <p class="sub">
                                                                                                                            Ultrices sagittis orci a
                                                                                                                            scelerisque purus semper eget
                                                                                                                            duis at. Sollicitudin nibh sit
                                                                                                                            amet commodo nulla.
                                                                                                                        </p> -->
                            </li>
                            <li>
                                <p class="sub"> We, here, ensure the best service across PAN India and internationally.
                                    Click here to
                                    explore our </p>
                                <a href="{{ asset('front/brochure/Company-Profile-Apogee-Agrotech.pdf') }}" target="_blank"
                                    class="download btn-read-more scale-40"
                                    style="color: #ffffff !important; background-color: #1a5f2e !important;"> Download
                                    Brochure </a>
                            </li>
                            <li> <img src="{{ asset('front') }}/images/make-in-india.png"
                                    alt="Make in India logo - Apogee Agrotech supports Indian manufacturing"> </li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
        <!-- /.Section why us -->

        <!-- Section our commitments -->

        <!-- Section project -->
        <section class="s-project">
            <div class="heading-side has-img-item" style="margin-bottom: 0px; padding-bottom: 0px;">
                <div class="tf-container w-1290">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="heading-section style-3 has-text text-center">
                                <p class="sub-title" style="color: #333333 !important; font-weight: 600;">Apogeeagrotech</p>
                                <p class="title tf-animate-3" style="color: #1a5f2e !important;"> Experience Our Journey
                                </p>
                                <div class="img-item"> <img class="tf-animate-1"
                                        src="{{ asset('front') }}/images/item/rice-plant-2.png"
                                        alt="Rice icon representing paddy crop section on Apogee Agrotech website" /> </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="s-img-item item-1"> <img src="{{ asset('front') }}/images/item/page-title-top.png"
                        alt="Page title icon used to highlight section headers on the Apogee Agrotech website" width="1920"
                        height="60" style="width: 100%; height: auto; object-fit: contain;" /> </div>
                <div class="s-img-item item-2 wow zoomIn"> <img src="{{ asset('front') }}/images/item/windmill.png"
                        alt="Windmill icon used as page title symbol representing sustainability and innovation on Apogee Agrotech website" />
                </div>
                <div class="s-img-item item-3"> <img src="{{ asset('front') }}/images/item/green.png"
                        alt="Decorative green line separator" width="1920" height="89"
                        style="width: 100%; height: auto; object-fit: contain;" />
                </div>
            </div>
            <div class="slider-side">
                <div class="tf-container w-1290">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="swiper-container slider-s-project">
                                <div class="swiper-wrapper">
                                    @php
                                        $journeyImages = [
                                            'web-exh-01.jpg',
                                            'web-exh-02.jpg',
                                            'web-exh-03.jpg',
                                            'web-exh-04.jpg',
                                            'web-exh-05.jpg',
                                            'web-exh-06.jpg',
                                            'web-exh-07.jpg',
                                            'web-exh-08.jpg',
                                            'web-exh-09.jpg',
                                            'web-exh-10.jpg',
                                            'web-exh-11.jpg',
                                            'web-exh-12.jpg',
                                            'web-exh-13.jpg',
                                            'web-exh-14.jpg',
                                            'web-exh-15.jpg',
                                            'web-exh-16.jpg',
                                            'web-exh-17.jpg',
                                            'web-exh-18.jpg',
                                        ];
                                    @endphp

                                    @foreach ($journeyImages as $index => $journeyImage)
                                        <div class="swiper-slide">
                                            <div class="box-portfolio style-5">
                                                <div class="image">
                                                    <img src="{{ asset('front') }}/images/homepage/journey/{{ $journeyImage }}"
                                                        data-src="{{ asset('front') }}/images/homepage/journey/{{ $journeyImage }}"
                                                        alt="Apogee Agrotech journey image {{ $index + 1 }}" class="lazyload" />
                                                </div>
                                                <div class="content">
                                                    <p class="sub font-farmhouse text-upper"> Agriculture - farm </p>
                                                    <a href="#"
                                                        class="title fs-23 font-worksans fw-6 hover-text-secondary">Apogeeagrotech
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

                                </div>
                            </div>
                        </div>
                        <!--  <div class="col-lg-12">
                                                                                              <div class="bot">
                                                                                                <div class="swiper-pagination style-1 pagination-s-project"></div>
                                                                                                <a href="#" class="hover-text-4">View All</a> </div>
                                                                                            </div> -->
                    </div>
                </div>
            </div>
            <div class="s-img-item item-4"> <img src="{{ asset('front') }}/images/item/page-title-top.png"
                    alt="Decorative page title separator" width="1920" height="60"
                    style="width: 100%; height: auto; object-fit: contain;" /> </div>
        </section>
        <!-- /.Section project -->

        <!-- Section testimonial 3 -->
        <section class="s-testimonial-3 overflow-hidden">
            <div class="tf-container w-1290">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="heading-section text-center has-text relative">
                            <p class="sub-title ">What they are thinking about <i class="icon-quote tf-animate__box-2 "></i>
                            </p>
                            <p class="title wow fadeInUp" data-wow-delay="0s">Customer's Feedback </p>
                            <p class="text"> </p>
                            <div class="img-item"> <img class="tf-animate-1"
                                    src="{{ asset('front') }}/images/item/rice-plant-2.png" alt="img" /> </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="s-slider">
                <div class="tf-container w-1290">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="testimonial-thumbs">
                                <div class="swiper-container slider-testimonial-3-thumb">
                                    <div class="swiper-wrapper">
                                        {{-- <div class="swiper-slide">
                                            <div class="image-avt"> <img
                                                    src="{{ asset('front') }}/images/section/customer-say-4.jpg"
                                                    alt="Customer Icon"> </div>
                                        </div>
                                        <div class="swiper-slide">
                                            <div class="image-avt"> <img
                                                    src="{{ asset('front') }}/images/section/customer-say-4.jpg"
                                                    alt="Customer Icon img"> </div>
                                        </div>
                                        <div class="swiper-slide">
                                            <div class="image-avt"> <img
                                                    src="{{ asset('front') }}/images/section/customer-say-4.jpg"
                                                    alt="Customer img icon"> </div>
                                        </div> --}}
                                    </div>
                                </div>
                                <div class="swiper-container slider-testimonial-3">
                                    <div class="swiper-wrapper">
                                        @if (!empty($testimonials))
                                            @foreach ($testimonials as $item)
                                                <div class="swiper-slide">
                                                    <div class="testimonial style-3">
                                                        <div class="comment">
                                                            <div class="swiper-slide">
                                                                <div class="image-avt"> <img
                                                                        src="{{ asset('uploads/testimonial/' . $item->image) }}"
                                                                        alt="Testimonial Image Icon"> </div>
                                                            </div>

                                                            <p class="caption fs-30 font-snowfall"> {{ $item->content }}
                                                            </p>
                                                        </div>
                                                        <div class="infor">
                                                            <div class="name-wrap"> <a href="#"
                                                                    class="name fs-18 fw-6 text-upper hover-text-4">
                                                                    {{ $item->testimonial_name }}
                                                                </a>
                                                                <div class="wg-rating">
                                                                    @for ($i = 1; $i <= $item->rating; $i++)
                                                                        <i class="fa-solid fa-star"></i>
                                                                    @endfor
                                                                </div>
                                                            </div>
                                                            <p class="duty"> {{ $item->city }} </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="btn-slide-testimonial-3 btn-prev"> <svg version="1.0" xmlns="http://www.w3.org/2000/svg"
                        width="50px" height="15px" viewBox="0 0 68 18" preserveAspectRatio="xMidYMid meet">
                        <g fill="#0d401c">
                            <path
                                d="M6.3 14.3 c-3.5 -2.1 -6.3 -4.2 -6.3 -4.9 0 -0.6 2.7 -3 6 -5.3 6.4 -4.5 8.3 -4.1 2.6 0.6 l-3.5 2.8 24.7 0 c23.6 0 38.2 0.9 38.2 2.3 0 0.4 -7.3 0.3 -16.3 -0.1 -9 -0.5 -23.3 -0.5 -31.8 0 l-15.4 0.8 5.3 2.9 c5 2.8 6.6 4.6 4 4.6 -0.7 0 -4.1 -1.7 -7.5 -3.7z" />
                        </g>
                    </svg> </div>
                <div class="btn-slide-testimonial-3 btn-next"> <svg version="1.0" xmlns="http://www.w3.org/2000/svg"
                        width="50px" height="15px" viewBox="0 0 80 20" preserveAspectRatio="xMidYMid meet">
                        <g fill="#0d401c">
                            <path
                                d="M63 19 c0 -0.5 2.6 -2.4 5.8 -4.2 l5.7 -3.3 -19.5 -0.8 c-11 -0.5 -27.1 -0.5 -37 0.1 -9.6 0.5 -17.7 0.7 -17.9 0.5 -2.4 -1.9 22 -3.5 48.7 -3.1 l25.2 0.3 -4.6 -3.9 c-2.5 -2.1 -4.3 -4 -4 -4.3 0.7 -0.7 14.6 8.9 14.6 10.2 0 1.1 -14.3 9.5 -16.2 9.5 -0.4 0 -0.8 -0.4 -0.8 -1z" />
                        </g>
                    </svg> </div>
            </div>
            <div class="s-img-item scroll-element-3"> <img class="scale-1-1 lazyload"
                    src="{{ asset('front') }}/images/section/yellow-f.png"
                    data-src="{{ asset('front') }}/./images/section/yellow-f.png"
                    alt="Golden yellow agricultural field ready for harvest, representing a successful and well-managed crop season">
            </div>
        </section>
        <!-- /.Section testimonial 3 -->

        <!-- Section counter -->
        <section class="s-counter has-img-item ">
            <div class="tf-container w-1290">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="wg-counter p-0">
                            <div class="counter-item">
                                <div class="icon"> <i class="icon-barley"></i> </div>
                                <div class="counter">
                                    <div class="odometer fs-65 style-1 style-1-1"> 1000 </div>
                                </div>
                                <p class="sub">Agricultural Implements</p>
                            </div>
                            <div class="counter-item">
                                <div class="icon"> <i class="fa fa-users"></i> </div>
                                <div class="counter">
                                    <div class="odometer fs-65 style-1 style-1-2"> 1000 </div>
                                    <span class="sub-odo">+</span>
                                </div>
                                <p class="sub">Dealers Nationwide</p>
                            </div>
                            <div class="counter-item">
                                <div class="icon"> <i class="fa-solid fa-tractor"></i> </div>
                                <div class="counter">
                                    <div class="odometer fs-65 style-1-3"> 1000 </div>
                                </div>
                                <p class="sub">Years Of Experience</p>
                            </div>
                            <div class="counter-item">
                                <div class="icon"> <i class="icon-barley"></i> </div>
                                <div class="counter">
                                    <div class="odometer fs-65 style-1-4"> 1000 </div>
                                </div>
                                <p class="sub">Company</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="s-img-item item-1"> <img src="{{ asset('front') }}/images/item/brown-top.png"
                    alt="Brown Top decorative separator" width="1920" height="72"
                    style="width: 100%; height: auto; object-fit: contain;" />
            </div>
            <div class="s-img-item item-2 zoomIn wow">
                <div class="scroll-element-4"> <img src="{{ asset('front') }}/images/item/tructor.png" alt="img" />
                </div>
            </div>
            <div class="s-img-item item-bottom"> <img src="{{ asset('front') }}/images/item/brown-bottom.png"
                    alt="Brown Bottom decorative separator" width="1920" height="72"
                    style="width: 100%; height: auto; object-fit: contain;" /> </div>
        </section>
        <!-- /.Section counter -->

        <!-- Section break page -->
        <section class="s-break-page style-2">
            <div class="content">
                <h2 class="font-farmhouse text-center text-anime-style-1"> Take a look at our indigenous <br>
                    agriculture equipment to <br>
                    overcome the farming challenges </h2>
            </div>
        </section>
        <!-- /.Section break page -->

        <!-- Section faq -->
        <section class="s-faq has-img-item tf-pt-0">
            <div class="tf-container w-1290">
                <div class="row">
                    <div class="col-lg-7">
                        <div class="content-section">
                            <div class="heading-section style-2 has-text mb-43">
                                <div class="img-item">
                                    <div class="item mr-16"> <img class="tf-animate-1"
                                            src="{{ asset('front') }}/images/item/rice-plant-2.png" alt="img" />
                                    </div>
                                    <p class="sub-title"> Frequently Asked Questions </p>
                                </div>
                                <p class="title wow fadeInUp" data-wow-delay="0s"> Most Frequently Asked Questions</p>

                            </div>
                            <div class="tf-accordion accordion" id="accordionExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapseOne" aria-expanded="true"
                                            aria-controls="collapseOne">What is a laser land leveller?
                                        </button>
                                    </h2>
                                    <div id="collapseOne" class="accordion-collapse collapse show"
                                        data-bs-parent="#accordionExample">
                                        <div class="accordion-body">A laser land leveller is a precision farming machine
                                            used to level agricultural land accurately for better water distribution and
                                            higher crop yield.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapseTwo" aria-expanded="false"
                                            aria-controls="collapseTwo">What is the difference between laser land leveller
                                            and GNSS land leveller?</button>
                                    </h2>
                                    <div id="collapseTwo" class="accordion-collapse collapse"
                                        data-bs-parent="#accordionExample">
                                        <div class="accordion-body">A laser land leveller uses laser signals, while a GNSS
                                            land leveller uses GPS satellite technology and is ideal for larger and uneven
                                            fields</div>
                                    </div>
                                </div>

                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapseThree" aria-expanded="false"
                                            aria-controls="collapseThree">
                                            Does laser land levelling really save water?
                                        </button>
                                    </h2>
                                    <div id="collapseThree" class="accordion-collapse collapse"
                                        data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            Yes. Lasers level the ground to ensure that water is used uniformly throughout
                                            the field.


                                            <br>
                                            Mahindra, Allied, JSW, huade, murata, ST
                                        </div>
                                    </div>
                                </div>

                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapseFour" aria-expanded="false"
                                            aria-controls="collapseFour">
                                            Which crops are suitable for laser land levelling in India?
                                        </button>
                                    </h2>
                                    <div id="collapseFour" class="accordion-collapse collapse"
                                        data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            Crops that can be grown using the laser land levelling technology in India
                                            include wheat, rice, cane, cotton, and maize, which are all grown in the various
                                            types of soil conditions found in India.
                                        </div>
                                    </div>
                                </div>

                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapseFive" aria-expanded="false"
                                            aria-controls="collapseFive">
                                            Who is a trusted laser land leveller manufacturer in India?
                                        </button>
                                    </h2>
                                    <div id="collapseFive" class="accordion-collapse collapse"
                                        data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            Apogee Agrotech is the leading and most reliable manufacturer of both laser land
                                            levellers and GNSS land levellers in India.
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="s-right img-hover">
                            <div class="image-wrap hover-item">
                                <div class="image"> <img src="{{ asset('front') }}/images/section/s-faq.jpg"
                                        data-src="{{ asset('front') }}/images/section/s-faq.jpg"
                                        alt="Apogee Rotavator in action, preparing soil efficiently for farming with powerful blades and durable design" />
                                </div>
                            </div>
                            <div class="img-item  tf-animate__box-2 "> <img class="up-down-move"
                                    src="{{ asset('front') }}/images/item/question.png" alt="Question Icon" /> </div>
                            <div class="content">
                                <p class="text fs-30 font-snowfall"> You didn't find your question? See
                                    more questions and ask us today! </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="s-img-item item-1 t--40 z-3"> <img src="{{ asset('front') }}/images/item/page-title-top.png"
                    alt="Decorative page title separator" width="1920" height="60"
                    style="width: 100%; height: auto; object-fit: contain;" /> </div>
        </section>
        <!-- /.Section faq -->

        <!-- Section banner -->
        <!-- /.Section banner -->

        <!-- Section blog post -->
        <!-- /.Section blog post -->



        <!-- Section partner -->
        <section class="s-partner pb-100">
            <div class="tf-container w-1780">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="slider-wrap">
                            <div class="swiper-container slider-partner">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide">
                                        <div class="slide-partner">
                                            <div class="image"><img src="{{ asset('front') }}/images/partner/01.jpg"
                                                    alt="Apogee Partner 01"></div>
                                        </div>
                                    </div>
                                    <!--  <div class="swiper-slide">
                                                                                                    <div class="slide-partner">
                                                                                                      <div class="image"><img src="{{ asset('front') }}/images/partner/02.jpg" alt=""></div>
                                                                                                    </div>
                                                                                                  </div> -->
                                    <div class="swiper-slide">
                                        <div class="slide-partner">
                                            <div class="image"> <img src="{{ asset('front') }}/images/partner/03.jpg"
                                                    alt="Apogee Agrotech Partner 03"></div>
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="slide-partner">
                                            <div class="image"><img src="{{ asset('front') }}/images/partner/04.jpg"
                                                    alt="Apogee Partenr 04"></div>
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="slide-partner">
                                            <div class="image"> <img src="{{ asset('front') }}/images/partner/05.jpg"
                                                    alt="Apogee Partner 05"> </div>
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="slide-partner">
                                            <div class="image"><img src="{{ asset('front') }}/images/partner/06.jpg"
                                                    alt="Apogee Partner 06"> </div>
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="slide-partner">
                                            <div class="image"><img src="{{ asset('front') }}/images/partner/07.jpg"
                                                    alt="Apogee Partner 07"> </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /.Section partner -->

    </div>
    <!-- /.Main-content -->

@endsection
