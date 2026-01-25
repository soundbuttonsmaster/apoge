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
                            <h1 class="title"> Image Gallery </h1>
                            <div class="icon-img"> <img src="{{ asset('front') }}/images/item/line-throw-title.png"
                                    alt="">
                            </div>
                            <div class="breadcrumb"> <a href="index.html">Home</a>
                                <div class="icon"> <i class="icon-arrow-right1"></i> </div>
                                <a href="javascript:void(0)">Media</a>
                                <div class="icon"> <i class="icon-arrow-right1"></i> </div>
                                <a href="javascript:void(0)">Image Gallery</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- /.Page-title -->



    <div class="main-content page-gallery">
        <div class="tf-container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="wg-tabs">
                        <ul class="overflow-x-auto menu-tab mb-61">
                            <li class="item active"><a href="javascript:void(0)" class="btn-tab">2010</a>
                            </li>
                            <li class="item"><a href="javascript:void(0)" class="btn-tab">2011</a></li>
                            <li class="item"><a href="javascript:void(0)" class="btn-tab">2012</a></li>
                            <li class="item"><a href="javascript:void(0)" class="btn-tab">2013</a></li>
                            <!--  <li class="item"><a href="javascript:void(0)" class="btn-tab">Vegetable</a></li>
                                    <li class="item"><a href="javascript:void(0)" class="btn-tab">Fruit</a></li>
                                    <li class="item"><a href="javascript:void(0)" class="btn-tab">Cattle</a></li> -->
                        </ul>
                        <div class="widget-content-tab">
                            <div class="widget-content-inner active">
                                <div class="exhibition_h">
                                    <h2>Exhibition Image</h2>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-3 col-xs-6 thumb">
                                        <div class="gallery-item2"> <a href="images/gallery/1.jpg" class="fancybox"
                                                rel="ligthbox"> <img src="{{ asset('front') }}/images/gallery/1.jpg"
                                                    class="zoom img-fluid" alt=""> </a> </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-xs-6 thumb">
                                        <div class="gallery-item2"> <a href="images/gallery/2.jpg" class="fancybox"
                                                rel="ligthbox"> <img src="{{ asset('front') }}/images/gallery/2.jpg"
                                                    class="zoom img-fluid" alt=""> </a> </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-xs-6 thumb">
                                        <div class="gallery-item2"> <a href="images/gallery/3.jpg" class="fancybox"
                                                rel="ligthbox"> <img src="{{ asset('front') }}/images/gallery/3.jpg"
                                                    class="zoom img-fluid" alt=""> </a> </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-xs-6 thumb">
                                        <div class="gallery-item2"> <a href="images/gallery/4.jpg" class="fancybox"
                                                rel="ligthbox"> <img src="{{ asset('front') }}/images/gallery/4.jpg"
                                                    class="zoom img-fluid" alt=""> </a> </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-xs-6 thumb">
                                        <div class="gallery-item2"> <a href="images/gallery/5.jpg" class="fancybox"
                                                rel="ligthbox"> <img src="{{ asset('front') }}/images/gallery/5.jpg"
                                                    class="zoom img-fluid" alt=""> </a> </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-xs-6 thumb">
                                        <div class="gallery-item2"> <a href="images/gallery/6.jpg" class="fancybox"
                                                rel="ligthbox"> <img src="{{ asset('front') }}/images/gallery/6.jpg"
                                                    class="zoom img-fluid" alt=""> </a> </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-xs-6 thumb">
                                        <div class="gallery-item2"> <a href="images/gallery/7.jpg" class="fancybox"
                                                rel="ligthbox"> <img src="{{ asset('front') }}/images/gallery/7.jpg"
                                                    class="zoom img-fluid" alt=""> </a> </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-xs-6 thumb">
                                        <div class="gallery-item2"> <a href="images/gallery/8.jpg" class="fancybox"
                                                rel="ligthbox"> <img src="{{ asset('front') }}/images/gallery/8.jpg"
                                                    class="zoom img-fluid" alt=""> </a> </div>
                                    </div>
                                </div>
                                <div class="exhibition_h">
                                    <h2>Feedback Image</h2>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-3 col-xs-6 thumb">
                                        <div class="gallery-item2"> <a href="images/gallery/8.jpg" class="fancybox"
                                                rel="ligthbox"> <img src="{{ asset('front') }}/images/gallery/8.jpg"
                                                    class="zoom img-fluid" alt=""> </a> </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-xs-6 thumb">
                                        <div class="gallery-item2"> <a href="images/gallery/9.jpg" class="fancybox"
                                                rel="ligthbox"> <img src="{{ asset('front') }}/images/gallery/9.jpg"
                                                    class="zoom img-fluid" alt=""> </a> </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-xs-6 thumb">
                                        <div class="gallery-item2"> <a href="images/gallery/5.jpg" class="fancybox"
                                                rel="ligthbox"> <img src="{{ asset('front') }}/images/gallery/5.jpg"
                                                    class="zoom img-fluid" alt=""> </a> </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-xs-6 thumb">
                                        <div class="gallery-item2"> <a href="images/gallery/6.jpg" class="fancybox"
                                                rel="ligthbox"> <img src="{{ asset('front') }}/images/gallery/6.jpg"
                                                    class="zoom img-fluid" alt=""> </a> </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-xs-6 thumb">
                                        <div class="gallery-item2"> <a href="images/gallery/7.jpg" class="fancybox"
                                                rel="ligthbox"> <img src="{{ asset('front') }}/images/gallery/7.jpg"
                                                    class="zoom img-fluid" alt=""> </a> </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-xs-6 thumb">
                                        <div class="gallery-item2"> <a href="images/gallery/8.jpg" class="fancybox"
                                                rel="ligthbox"> <img src="{{ asset('front') }}/images/gallery/8.jpg"
                                                    class="zoom img-fluid" alt=""> </a> </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-xs-6 thumb">
                                        <div class="gallery-item2"> <a href="images/gallery/9.jpg" class="fancybox"
                                                rel="ligthbox"> <img src="{{ asset('front') }}/images/gallery/9.jpg"
                                                    class="zoom img-fluid" alt=""> </a> </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-xs-6 thumb">
                                        <div class="gallery-item2"> <a href="images/gallery/5.jpg" class="fancybox"
                                                rel="ligthbox"> <img src="{{ asset('front') }}/images/gallery/5.jpg"
                                                    class="zoom img-fluid" alt=""> </a> </div>
                                    </div>
                                </div>
                            </div>


                            <!-- =========================second-tab======================= -->
                            <div class="widget-content-inner">
                                <div class="exhibition_h">
                                    <h2>Exhibition Image</h2>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-3 col-xs-6 thumb">
                                        <div class="gallery-item2"> <a href="images/gallery/3.jpg" class="fancybox"
                                                rel="ligthbox"> <img src="{{ asset('front') }}/images/gallery/3.jpg"
                                                    class="zoom img-fluid" alt=""> </a> </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-xs-6 thumb">
                                        <div class="gallery-item2"> <a href="images/gallery/1.jpg" class="fancybox"
                                                rel="ligthbox"> <img src="{{ asset('front') }}/images/gallery/1.jpg"
                                                    class="zoom img-fluid" alt=""> </a> </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-xs-6 thumb">
                                        <div class="gallery-item2"> <a href="images/gallery/2.jpg" class="fancybox"
                                                rel="ligthbox"> <img src="{{ asset('front') }}/images/gallery/2.jpg"
                                                    class="zoom img-fluid" alt=""> </a> </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-xs-6 thumb">
                                        <div class="gallery-item2"> <a href="images/gallery/4.jpg" class="fancybox"
                                                rel="ligthbox"> <img src="{{ asset('front') }}/images/gallery/4.jpg"
                                                    class="zoom img-fluid" alt=""> </a> </div>
                                    </div>

                                </div>
                                <div class="exhibition_h">
                                    <h2>Feedback Image</h2>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-3 col-xs-6 thumb">
                                        <div class="gallery-item2"> <a href="images/gallery/8.jpg" class="fancybox"
                                                rel="ligthbox"> <img src="{{ asset('front') }}/images/gallery/8.jpg"
                                                    class="zoom img-fluid" alt=""> </a> </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-xs-6 thumb">
                                        <div class="gallery-item2"> <a href="images/gallery/9.jpg" class="fancybox"
                                                rel="ligthbox"> <img src="{{ asset('front') }}/images/gallery/9.jpg"
                                                    class="zoom img-fluid" alt=""> </a> </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-xs-6 thumb">
                                        <div class="gallery-item2"> <a href="images/gallery/5.jpg" class="fancybox"
                                                rel="ligthbox"> <img src="{{ asset('front') }}/images/gallery/5.jpg"
                                                    class="zoom img-fluid" alt=""> </a> </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-xs-6 thumb">
                                        <div class="gallery-item2"> <a href="images/gallery/6.jpg" class="fancybox"
                                                rel="ligthbox"> <img src="{{ asset('front') }}/images/gallery/6.jpg"
                                                    class="zoom img-fluid" alt=""> </a> </div>
                                    </div>

                                </div>
                            </div>


                            <!-- =========================third-tab======================= -->
                            <div class="widget-content-inner">
                                <div class="exhibition_h">
                                    <h2>Exhibition Image</h2>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-3 col-xs-6 thumb">
                                        <div class="gallery-item2"> <a href="images/gallery/4.jpg" class="fancybox"
                                                rel="ligthbox"> <img src="{{ asset('front') }}/images/gallery/4.jpg"
                                                    class="zoom img-fluid" alt=""> </a> </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-xs-6 thumb">
                                        <div class="gallery-item2"> <a href="images/gallery/1.jpg" class="fancybox"
                                                rel="ligthbox"> <img src="{{ asset('front') }}/images/gallery/1.jpg"
                                                    class="zoom img-fluid" alt=""> </a> </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-xs-6 thumb">
                                        <div class="gallery-item2"> <a href="images/gallery/2.jpg" class="fancybox"
                                                rel="ligthbox"> <img src="{{ asset('front') }}/images/gallery/2.jpg"
                                                    class="zoom img-fluid" alt=""> </a> </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-xs-6 thumb">
                                        <div class="gallery-item2"> <a href="images/gallery/3.jpg" class="fancybox"
                                                rel="ligthbox"> <img src="{{ asset('front') }}/images/gallery/3.jpg"
                                                    class="zoom img-fluid" alt=""> </a> </div>
                                    </div>

                                </div>
                                <div class="exhibition_h">
                                    <h2>Feedback Image</h2>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-3 col-xs-6 thumb">
                                        <div class="gallery-item2"> <a href="images/gallery/9.jpg" class="fancybox"
                                                rel="ligthbox"> <img src="{{ asset('front') }}/images/gallery/9.jpg"
                                                    class="zoom img-fluid" alt=""> </a> </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-xs-6 thumb">
                                        <div class="gallery-item2"> <a href="images/gallery/8.jpg" class="fancybox"
                                                rel="ligthbox"> <img src="{{ asset('front') }}/images/gallery/8.jpg"
                                                    class="zoom img-fluid" alt=""> </a> </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-xs-6 thumb">
                                        <div class="gallery-item2"> <a href="images/gallery/5.jpg" class="fancybox"
                                                rel="ligthbox"> <img src="{{ asset('front') }}/images/gallery/5.jpg"
                                                    class="zoom img-fluid" alt=""> </a> </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-xs-6 thumb">
                                        <div class="gallery-item2"> <a href="images/gallery/6.jpg" class="fancybox"
                                                rel="ligthbox"> <img src="{{ asset('front') }}/images/gallery/6.jpg"
                                                    class="zoom img-fluid" alt=""> </a> </div>
                                    </div>

                                </div>
                            </div>



                            <!-- =========================forth-tab======================= -->
                            <div class="widget-content-inner">
                                <div class="exhibition_h">
                                    <h2>Exhibition Image</h2>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-3 col-xs-6 thumb">
                                        <div class="gallery-item2"> <a href="images/gallery/6.jpg" class="fancybox"
                                                rel="ligthbox"> <img src="{{ asset('front') }}/images/gallery/6.jpg"
                                                    class="zoom img-fluid" alt=""> </a> </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-xs-6 thumb">
                                        <div class="gallery-item2"> <a href="images/gallery/1.jpg" class="fancybox"
                                                rel="ligthbox"> <img src="{{ asset('front') }}/images/gallery/1.jpg"
                                                    class="zoom img-fluid" alt=""> </a> </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-xs-6 thumb">
                                        <div class="gallery-item2"> <a href="images/gallery/2.jpg" class="fancybox"
                                                rel="ligthbox"> <img src="{{ asset('front') }}/images/gallery/2.jpg"
                                                    class="zoom img-fluid" alt=""> </a> </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-xs-6 thumb">
                                        <div class="gallery-item2"> <a href="images/gallery/3.jpg" class="fancybox"
                                                rel="ligthbox"> <img src="{{ asset('front') }}/images/gallery/3.jpg"
                                                    class="zoom img-fluid" alt=""> </a> </div>
                                    </div>

                                </div>
                                <div class="exhibition_h">
                                    <h2>Feedback Image</h2>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-3 col-xs-6 thumb">
                                        <div class="gallery-item2"> <a href="images/gallery/9.jpg" class="fancybox"
                                                rel="ligthbox"> <img src="{{ asset('front') }}/images/gallery/9.jpg"
                                                    class="zoom img-fluid" alt=""> </a> </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-xs-6 thumb">
                                        <div class="gallery-item2"> <a href="images/gallery/8.jpg" class="fancybox"
                                                rel="ligthbox"> <img src="{{ asset('front') }}/images/gallery/8.jpg"
                                                    class="zoom img-fluid" alt=""> </a> </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-xs-6 thumb">
                                        <div class="gallery-item2"> <a href="images/gallery/5.jpg" class="fancybox"
                                                rel="ligthbox"> <img src="{{ asset('front') }}/images/gallery/5.jpg"
                                                    class="zoom img-fluid" alt=""> </a> </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-xs-6 thumb">
                                        <div class="gallery-item2"> <a href="images/gallery/6.jpg" class="fancybox"
                                                rel="ligthbox"> <img src="{{ asset('front') }}/images/gallery/6.jpg"
                                                    class="zoom img-fluid" alt=""> </a> </div>
                                    </div>

                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
@endsection
