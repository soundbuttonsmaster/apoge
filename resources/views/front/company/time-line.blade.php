@extends('front.layouts.masterhome')
@section('section')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('front') }}/css/timeline.css" />
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

                        <h1 class="title">
                            Time line
                        </h1>
                        <div class="icon-img">
                            <img src="{{ asset('front') }}/images/item/line-throw-title.png" alt="Apogee Agrotech company timeline showcasing key milestones and growth in agricultural technology over the years">
                        </div>
                        <div class="breadcrumb">
                            <a href="{{ route('home') }}">Home</a>
                            <div class="icon">
                                <i class="icon-arrow-right1"></i>
                            </div>
                            <a href="javascript:void(0)">Company </a>
                            <div class="icon">
                                <i class="icon-arrow-right1"></i>
                            </div>
                            <a href="javascript:void(0)">Time line</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div><!-- /.Page-title -->

<!-- Main-content -->
<div class="main-content pb-0 pt-0">
    <section style="display:none">
        <div class="odometer style-5">1000</div>
    </section>





    <section class="milestone-section companyTimeline">
        <div class="s-content-wrap">

            <div class="content-section text-center">
                <div class="heading-section style-4">
                    <p class="sub-title text-center">Welcome to Apogee Agrotech</p>
                    <h2 class="title wow fadeInUp animated" data-wow-delay="0s"
                        style="visibility: visible; animation-delay: 0s; animation-name: fadeInUp;">Our Timeline</h2>


                    <div class="text-center"> <img class="tf-animate-1 active-animate"
                            src="{{ asset('front') }}/images/item/rice-plant-2.png" alt="Laser & GNSS Land Leveller Timeline">
                    </div>

                </div>

            </div>





            <div class="h--timeline js-h--timeline">
                <div class="h--timeline-container">
                    <div class="h--timeline-dates">
                        <div class="h--timeline-line">
                            <ol>
                                <li><a href="#0" data-date="16/01/2003"
                                        class="h--timeline-date h--timeline-date--selected">2010</a></li>
                                <li><a href="#0" data-date="28/02/2006" class="h--timeline-date">2011</a></li>
                                <li><a href="#0" data-date="20/05/2009" class="h--timeline-date">2012</a></li>
                                <li><a href="#0" data-date="09/07/2014" class="h--timeline-date">2016</a></li>
                                <li><a href="#0" data-date="30/08/2017" class="h--timeline-date">2019</a></li>
                                <li><a href="#0" data-date="15/09/2020" class="h--timeline-date">2021</a></li>
                                <li><a href="#0" data-date="01/11/2021" class="h--timeline-date">2022</a></li>
                                <li><a href="#0" data-date="10/12/2022" class="h--timeline-date">2024</a></li>
                                <li><a href="#0" data-date="19/01/2023" class="h--timeline-date">2025</a></li>
                            </ol>

                            <span class="h--timeline-filling-line" aria-hidden="true"></span>
                        </div> <!-- .h--timeline-line -->
                    </div> <!-- .h--timeline-dates -->

                    <nav class="h--timeline-navigation-container">
                        <ul>
                            <li><a href="#0"
                                    class="text-replace h--timeline-navigation h--timeline-navigation--prev h--timeline-navigation--inactive">Prev</a>
                            </li>
                            <li><a href="#0"
                                    class="text-replace h--timeline-navigation h--timeline-navigation--next">Next</a>
                            </li>
                        </ul>
                    </nav>
                </div> <!-- .h--timeline-container -->

                <div class="h--timeline-events">
                    <ol>
                        <li class="h--timeline-event h--timeline-event--selected text-component">
                            <div class="h--timeline-event-content container">
                                <div class="timelineWrapper">
                                    <div class="timelineContent">
                                        <h2 class="h--timeline-event-title">2010</h2>
                                        <!-- <em class="h--timeline-event-date">January 16th, 2014</em> -->
                                        <p class="h--timeline-event-description">
                                            Apogee Group established itself as a leading manufacturer of innovative
                                            agricultural machinery.
                                        </p>
                                    </div>
                                    <div class="timelineImg">
                                        <img src="{{ asset('front') }}/images/cutting-edge.jpg" alt="Apogee Group, established in 2010, is a leading manufacturer of innovative agricultural machinery">
                                    </div>
                                </div>
                            </div>
                        </li>

                        <li class="h--timeline-event text-component">
                            <div class="h--timeline-event-content container">
                                <div class="timelineWrapper">
                                    <div class="timelineContent">
                                        <h2 class="h--timeline-event-title">2011</h2>
                                        <!-- <em class="h--timeline-event-date">January 16th, 2014</em> -->
                                        <p class="h--timeline-event-description">
                                            The company launched its first office in Rohtak and Karnal, marking the
                                            beginning of independent development in laser-based agricultural equipment.
                                        </p>
                                    </div>
                                    <div class="timelineImg">
                                        <img src="{{ asset('front') }}/images/laser-agriculture-equipment.jpg" alt="Apogee Agrotech service centre providing maintenance and support for laser land levellers and farm equipment">
                                    </div>
                                </div>
                            </div>
                        </li>

                        <li class="h--timeline-event text-component">
                            <div class="h--timeline-event-content container">
                                <div class="timelineWrapper">
                                    <div class="timelineContent">
                                        <h2 class="h--timeline-event-title">2012</h2>
                                        <!-- <em class="h--timeline-event-date">January 16th, 2014</em> -->
                                        <p class="h--timeline-event-description">
                                            Apogee set up its first manufacturing facility and corporate headquarters in
                                            Anand, Ahmedabad, Gujarat.
                                        </p>
                                    </div>
                                    <div class="timelineImg">
                                        <img src="{{ asset('front') }}/images/headquarters.jpg" alt="Apogee Agrotech Hapur headquarters managing production, service, and distribution of agricultural machinery in India">
                                    </div>
                                </div>
                            </div>
                        </li>

                        <li class="h--timeline-event text-component">
                            <div class="h--timeline-event-content container">
                                <div class="timelineWrapper">
                                    <div class="timelineContent">
                                        <h2 class="h--timeline-event-title">2016</h2>
                                        <!-- <em class="h--timeline-event-date">January 16th, 2014</em> -->
                                        <p class="h--timeline-event-description">
                                            Expanded into automation and surveying technologies, initiating work on
                                            advanced geospatial solutions. A second manufacturing plant with double the
                                            capacity was established in Hapur, Uttar Pradesh.
                                        </p>
                                    </div>
                                    <div class="timelineImg">
                                        <img src="{{ asset('front') }}/images/hapur.jpg" alt="Apogee Agrotech facility located in Hapur">
                                    </div>
                                </div>
                            </div>
                        </li>

                        <li class="h--timeline-event text-component">
                            <div class="h--timeline-event-content container">
                                <div class="timelineWrapper">
                                    <div class="timelineContent">
                                        <h2 class="h--timeline-event-title">2019</h2>
                                        <!-- <em class="h--timeline-event-date">January 16th, 2014</em> -->
                                        <p class="h--timeline-event-description">
                                            Successfully developed a GNSS-based Land Leveller system to improve the
                                            efficiency and precision of land levelling operations.
                                        </p>
                                    </div>
                                    <div class="timelineImg">
                                        <img src="{{ asset('front') }}/images/GNSS-Land-Leveller-system.jpg" alt="Apogee GNSS Land Leveller System">
                                    </div>
                                </div>
                            </div>
                        </li>

                        <li class="h--timeline-event text-component">
                            <div class="h--timeline-event-content container">
                                <div class="timelineWrapper">
                                    <div class="timelineContent">
                                        <h2 class="h--timeline-event-title">2021</h2>
                                        <!-- <em class="h--timeline-event-date">January 16th, 2014</em> -->
                                        <p class="h--timeline-event-description">
                                            Achieved a breakthrough with the development of an Auto-Steering for
                                            tractors, Rice Transplanter, etc. advancing precision farming practices.
                                        </p>
                                    </div>
                                    <div class="timelineImg">
                                        <img src="{{ asset('front') }}/images/Auto-Steering-Rice-transplanter.jpg" alt="Auto Steering Rice Transplanter">
                                    </div>
                                </div>
                            </div>
                        </li>

                        <li class="h--timeline-event text-component">
                            <div class="h--timeline-event-content container">
                                <div class="timelineWrapper">
                                    <div class="timelineContent">
                                        <h2 class="h--timeline-event-title">2022</h2>
                                        <!-- <em class="h--timeline-event-date">January 16th, 2014</em> -->
                                        <p class="h--timeline-event-description">
                                            Founded a new division, Apogee GNSS, in Noida, Uttar Pradesh. This branch
                                            developed India’s first indigenously made survey-grade GNSS receiver, CORS
                                            network solutions, and UAV technologies.
                                        </p>
                                    </div>
                                    <div class="timelineImg">
                                        <img src="{{ asset('front') }}/images/apogee-gnss-up.jpg" alt="Apogee GNSS Office in UP">
                                    </div>
                                </div>
                            </div>
                        </li>


                        <li class="h--timeline-event text-component">
                            <div class="h--timeline-event-content container">
                                <div class="timelineWrapper">
                                    <div class="timelineContent">
                                        <h2 class="h--timeline-event-title">2024</h2>
                                        <!-- <em class="h--timeline-event-date">January 16th, 2014</em> -->
                                        <p class="h--timeline-event-description">
                                            Introduced another subsidiary, Apogee Agrotech, under the Apogee Group.
                                        </p>
                                    </div>
                                    <div class="timelineImg">
                                        <img src="{{ asset('front') }}/images/Introduced.jpg" alt="Apogee Agrotech introduced advanced laser land leveller technology to revolutionize modern Indian agriculture">
                                    </div>
                                </div>
                            </div>
                        </li>

                        <li class="h--timeline-event text-component">
                            <div class="h--timeline-event-content container">
                                <div class="timelineWrapper">
                                    <div class="timelineContent">
                                        <h2 class="h--timeline-event-title">2025</h2>
                                        <!-- <em class="h--timeline-event-date">January 16th, 2014</em> -->
                                        <p class="h--timeline-event-description">
                                            Launched the 3D GNSS Land Leveller, a cutting-edge agricultural machine
                                            offering graphical field representation for precise land levelling.
                                        </p>
                                    </div>
                                    <div class="timelineImg">
                                        <img src="{{ asset('front') }}/images/Launched.jpg" alt="Apogee Agrotech launched Bahubali Bucket with advanced equipment for efficient land levelling and farming tasks">
                                    </div>
                                </div>
                            </div>
                        </li>





                    </ol>
                </div> <!-- .h--timeline-events -->
            </div>
        </div>
    </section>








</div><!-- /.Main-content -->

<!-- Footer -->
@endsection
