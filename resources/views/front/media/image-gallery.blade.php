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
                            <h1 class="title"> Image Gallery </h1>
                            <div class="icon-img"> <img src="{{ asset('front') }}/images/item/line-throw-title.png"
                                    alt="Apogee Agrotech images">
                            </div>
                            <div class="breadcrumb"> <a href="{{ route('home') }}">Home</a>
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
                            @if (!empty($session))
                                @foreach ($session as $key => $_session)
                                    <li class="item {{ $key == 0 ? 'active' : '' }}"><a href="javascript:void(0)"
                                            class="btn-tab">{{ $_session->session }}</a>
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                        <div class="widget-content-tab">
                            @if (!empty($session))
                                @foreach ($session as $key => $_session)
                                    <div class="widget-content-inner {{ $key == 0 ? 'active' : '' }}">
                                        @php
                                            $group = \App\Models\Group::where('session_id', $_session->id)
                                                ->where('status', 1)
                                                ->latest()
                                                ->get();
                                        @endphp
                                        @if (!empty($group))
                                            @foreach ($group as $_group)
                                                <div class="exhibition_h">
                                                    <h2>{{ $_group->group }}</h2>
                                                </div>
                                                <div class="row">
                                                    @php
                                                        $gallery = \App\Models\Gallery::where(
                                                            'session_id',
                                                            $_session->id,
                                                        )
                                                            ->where('group_id', $_group->id)
                                                            ->where('status', 1)
                                                            ->latest()
                                                            ->get();
                                                    @endphp
                                                    @if (!empty($gallery))
                                                        @foreach ($gallery as $_gallery)
                                                            <div class="col-lg-3 col-md-3 col-xs-6 thumb">
                                                                <div class="gallery-item2"> <a href="{{ asset('uploads/gallery/large/' . $_gallery->image) }}"
                                                                        class="fancybox" rel="ligthbox"> <img
                                                                            src="{{ asset('uploads/gallery/small/' . $_gallery->image) }}"
                                                                            class="zoom img-fluid" alt="Apogee gallery image"> </a>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    @endif


                                                </div>
                                            @endforeach
                                        @endif

                                    </div>
                                @endforeach
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
@endsection
