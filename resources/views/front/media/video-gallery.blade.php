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
                            <h1 class="title">Video Gallery</h1>
                            <div class="icon-img"> <img src="{{ asset('front') }}/images/item/line-throw-title.png"
                                    alt="Apogee Youtube Video Gallery"> </div>
                            <div class="breadcrumb"> <a href="{{ route('home') }}">Home</a>
                                <div class="icon"> <i class="icon-arrow-right1"></i> </div>
                                <a href="javascript:void(0)">Media</a>
                                <div class="icon"> <i class="icon-arrow-right1"></i> </div>
                                <a href="javascript:void(0)">Video Gallery</a>
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
            
                            <h2 class="title wow fadeInUp animated animated" data-wow-delay="0s" style="visibility: visible; animation-delay: 0s; animation-name: fadeInUp;">Video Gallery</h2>
                              <p class="sub-title text-center">Visual Stories of Our Journey !</p>
                            <div class="text-center"> <img class="tf-animate-1 active-animate" src="{{ asset('front') }}/images/item/rice-plant-2.png" alt="Apogee Agrotech Youtube Channel"> </div>
                          </div>
                    </div>
                    <div class="row">
                        @if (!empty($videoGallery))
                            @foreach ($videoGallery as $item)
                                <div class="col-lg-4 col-md-4 col-xs-6">
                                    <div class="video-item">
                                        @php
                                            $videoId = extractYoutubeID($item->url);
                                        @endphp
                                        <iframe src="https://www.youtube.com/embed/{{ $videoId }}""
                                            title="YouTube video player" frameborder="0"
                                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                            referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                                        <!-- <div class="gallery_name">Innovative Packtech</div> -->
                                    </div>
                                </div>
                            @endforeach
                        @endif

                    </div>
                </div>
            </div>
        </section>
    </div>
    <!-- /.Main-content -->
@endsection
