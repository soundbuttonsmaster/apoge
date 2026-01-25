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
                                Blog
                            </h1>
                            <div class="icon-img">
                                <img src="{{ asset('front') }}/images/item/line-throw-title.png" alt="Apogee Agrotech Blog" style="width: auto; height: auto; max-width: 100%; object-fit: contain;">
                            </div>
                            <div class="breadcrumb">
                                <a href="{{ route('home') }}">Home</a>
                                <div class="icon">
                                    <i class="icon-arrow-right1"></i>
                                </div>
                                <a href="javascript:void(0)">Media</a>
                                <div class="icon">
                                    <i class="icon-arrow-right1"></i>
                                </div>
                                <a href="javascript:void(0)">Blog</a>
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


        <!-- Section blog post -->

        <section class="s-blog-post pb-35">
            <div class="tf-container w-1290">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="heading-section has-text text-center mb-81">

                            <p class="title fadeInUp" data-wow-delay="0s">Blog</p>

                            <div class="img-item"> <img class="tf-animate-1"
                                    src="{{ asset('front') }}/images/item/rice-plant-2.png" alt="Apogee Blog Page" /> </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="s-slide">
                <div class="tf-container w-1290">
                    <div class="row">
                        @if (!empty($blog))
                            @foreach ($blog as $item)
                            <div class="col-lg-4">
                                <article class="article-blog-item type-3 style-2 img-hover wow fadeInUp" data-wow-delay="0s">
                                    <div class="image">
                                        <a href="{{ route('home.blog_datels', $item->slug) }}">
                                            <div class="video-wrap hover-item"> <img class="lazyload"
                                                    src="{{ asset('uploads/blog/list/' . $item->image) }}" alt="Apogee Agrotech blog covering modern farming techniques, laser land levelling, and agricultural equipment insights" /> </div>
                                            <div class="entry-date">
                                                <p class="day"> {{ $item->created_at->format('d') }} </p>
                                                <p class="month-year"> {{ $item->created_at->format('M y') }} </p>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="content">
                                        <h3 class="title fw-6"> <a href="{{ route('home.blog_datels', $item->slug) }}"> {{ $item->title }} </a> </h3>
                                        <p>{{ $item->short_description }}</p>
                                        <div class="bot"> <a href="{{ route('home.blog_datels', $item->slug) }}" class="tf-btn-read"> Read More </a>
                                        </div>
                                    </div>
                                </article>
                            </div>    
                            @endforeach
                        @endif
                      
                       
                    </div>
                </div>
            </div>
            <div class="btn-s-blog-post btn-next"> <svg version="1.0" xmlns="http://www.w3.org/2000/svg" width="50px"
                    height="15px" viewBox="0 0 80 20" preserveAspectRatio="xMidYMid meet">
                    <g fill="#0d401c">
                        <path
                            d="M63 19 c0 -0.5 2.6 -2.4 5.8 -4.2 l5.7 -3.3 -19.5 -0.8 c-11 -0.5 -27.1 -0.5 -37 0.1 -9.6 0.5 -17.7 0.7 -17.9 0.5 -2.4 -1.9 22 -3.5 48.7 -3.1 l25.2 0.3 -4.6 -3.9 c-2.5 -2.1 -4.3 -4 -4 -4.3 0.7 -0.7 14.6 8.9 14.6 10.2 0 1.1 -14.3 9.5 -16.2 9.5 -0.4 0 -0.8 -0.4 -0.8 -1z" />
                    </g>
                </svg> </div>
            <div class="btn-s-blog-post btn-prev"> <svg version="1.0" xmlns="http://www.w3.org/2000/svg" width="50px"
                    height="15px" viewBox="0 0 68 18" preserveAspectRatio="xMidYMid meet">
                    <g fill="#0d401c">
                        <path
                            d="M6.3 14.3 c-3.5 -2.1 -6.3 -4.2 -6.3 -4.9 0 -0.6 2.7 -3 6 -5.3 6.4 -4.5 8.3 -4.1 2.6 0.6 l-3.5 2.8 24.7 0 c23.6 0 38.2 0.9 38.2 2.3 0 0.4 -7.3 0.3 -16.3 -0.1 -9 -0.5 -23.3 -0.5 -31.8 0 l-15.4 0.8 5.3 2.9 c5 2.8 6.6 4.6 4 4.6 -0.7 0 -4.1 -1.7 -7.5 -3.7z" />
                    </g>
                </svg> </div>
    </div>
    </section>
    <!-- /.Section blog post -->









    </div><!-- /.Main-content -->

    <!-- Footer -->
@endsection
