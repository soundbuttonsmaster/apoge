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
                                <img src="{{ asset('front') }}/images/item/line-throw-title.png" alt="Blog post decorative separator" style="width: auto; height: auto; max-width: 100%; object-fit: contain;">
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

        <!-- Main-content -->

        <div class="main-content page-blog-single">
            <div class="blog-single">
                <div class="tf-container w-1290">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="content">
                                <h3 class="title-name fw-bold"> {{ $blogdatels->title }}</h3>
                                <div class="entry-meta">
                                    <ul class="meta-list">

                                        <li class="entry date"> <i class="fa-solid fs-14 fa-calendar"></i>
                                            <p class=""> <a href="#">
                                                    {{ $blogdatels->created_at->format('d F Y') }} </a> </p>
                                        </li>

                                    </ul>
                                </div>
                                <div class="entry-image"> <img class="lazyload"
                                        src="{{ asset('uploads/blog/datels/' . $blogdatels->image) }}" alt="">
                                </div>
                                {!! $blogdatels->full_description !!}
                               
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="tf-sidebar">


                                <div class="sidebar-item sb-latest-new">
                                    <h5 class="sb-title"> Latest Post </h5>
                                    <div class="sb-content">
                                        <ul class="latest-list">
                                            @if (!empty($blogs))
                                                @foreach ($blogs as $item)
                                                <li class="item img-hover">
                                                    <div class="image hover-item"> <img
                                                            src="{{ asset('uploads/blog/thumb/' . $item->image) }}"
                                                            alt=""> </div>
                                                    <div class="content">
                                                        <p class="date">{{ $item->created_at->format('d F Y') }}</p>
                                                        <a class="name-post " href="{{ route('home.blog_datels', $item->slug) }}"> {{$item->title}} </a>
                                                    </div>
                                                </li> 
                                                @endforeach
                                            @endif
                                        </ul>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.Main-content -->
        <!-- /.Section blog post -->









    </div><!-- /.Main-content -->
@endsection
