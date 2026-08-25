@extends('front.layouts.masterhome')
@section('css')
    <link rel="stylesheet" href="{{ asset('front/css/blog-featured.css') }}?v={{ @filemtime(public_path('front/css/blog-featured.css')) ?: time() }}">
@endsection
@section('section')
    <!-- Page-title -->
    <div class="page-title page-about-us">
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
                    <div class="row apogee-blog-grid">
                        @if (!empty($blog))
                            @foreach ($blog as $item)
                            <div class="col-lg-4 col-md-6 apogee-blog-grid__col">
                                @include('front.media.partials.blog-featured', ['item' => $item, 'variant' => 'card'])
                            </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </section>
        <!-- /.Section blog post -->

    </div><!-- /.Main-content -->

    <!-- Footer -->
@endsection
