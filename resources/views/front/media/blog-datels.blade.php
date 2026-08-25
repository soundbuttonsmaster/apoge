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
                                <a href="{{ route('home.blog') }}">Blog</a>
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
                                @include('front.media.partials.blog-featured', ['item' => $blogdatels, 'variant' => 'detail'])
                                <div class="apogee-blog-body" id="apogee-blog-body">
                                    {!! $blogContentHtml !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <aside class="tf-sidebar apogee-blog-sidebar">

                                @if (!empty($blogToc) && count($blogToc))
                                    <nav class="apogee-toc" id="apogee-toc" aria-label="On this page">
                                        <p class="apogee-toc__label">On this page</p>
                                        <ul class="apogee-toc__list">
                                            @foreach ($blogToc as $index => $tocItem)
                                                <li class="apogee-toc__item apogee-toc__item--h{{ $tocItem['level'] }}">
                                                    <a class="apogee-toc__link{{ $index === 0 ? ' is-active' : '' }}"
                                                       href="#{{ $tocItem['id'] }}"
                                                       data-toc-target="{{ $tocItem['id'] }}">
                                                        {{ $tocItem['text'] }}
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </nav>
                                @endif

                                <div class="sidebar-item sb-latest-new apogee-latest-posts">
                                    <h5 class="sb-title"> Latest Post </h5>
                                    <div class="sb-content">
                                        <ul class="latest-list">
                                            @if (!empty($blogs))
                                                @foreach ($blogs as $item)
                                                <li class="item img-hover">
                                                    @include('front.media.partials.blog-featured', ['item' => $item, 'variant' => 'sidebar'])
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

                            </aside>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div><!-- /.Main-content -->

    <script>
    (function () {
        var toc = document.getElementById('apogee-toc');
        if (!toc) return;

        var links = Array.prototype.slice.call(toc.querySelectorAll('[data-toc-target]'));
        var sections = links.map(function (link) {
            return document.getElementById(link.getAttribute('data-toc-target'));
        }).filter(Boolean);

        function setActive(id) {
            links.forEach(function (link) {
                link.classList.toggle('is-active', link.getAttribute('data-toc-target') === id);
            });
        }

        links.forEach(function (link) {
            link.addEventListener('click', function (e) {
                var id = link.getAttribute('data-toc-target');
                var el = document.getElementById(id);
                if (!el) return;
                e.preventDefault();
                var top = el.getBoundingClientRect().top + window.pageYOffset - 100;
                window.scrollTo({ top: top, behavior: 'smooth' });
                setActive(id);
                if (history.replaceState) {
                    history.replaceState(null, '', '#' + id);
                }
            });
        });

        function onScroll() {
            var scrollPos = window.pageYOffset + 120;
            var current = sections[0] ? sections[0].id : null;
            for (var i = 0; i < sections.length; i++) {
                if (sections[i].offsetTop <= scrollPos) {
                    current = sections[i].id;
                }
            }
            if (current) setActive(current);
        }

        window.addEventListener('scroll', onScroll, { passive: true });
        onScroll();
    })();
    </script>
@endsection
