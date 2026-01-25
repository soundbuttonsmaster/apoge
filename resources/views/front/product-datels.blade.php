@extends('front.layouts.masterhome')
@section('section')
@section('css')
    <!-- xzoom plugin here -->
    <script src="{{ asset('front') }}/zoom/jquery.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="{{ asset('front') }}/zoom/zoom/xzoom.min.js"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('front') }}/zoom/zoom/xzoom.css" media="all" />
    <script type="text/javascript" src="{{ asset('front') }}/zoom/hammer/jquery.hammer.min.js"></script>
    <link type="text/css" rel="stylesheet" media="all" href="{{ asset('front') }}/zoom/magnific/magnific-popup.css" />
    <script type="text/javascript" src="{{ asset('front') }}/zoom/magnific/magnific-popup.js"></script>
    <script src="{{ asset('front') }}/zoom/setup.js"></script>
@endsection
<div class="inner_bredcumb">
    <div class="tf-container w-1290">
        <div class="row">
            <div class="col-lg-12">
                <div class="content">

                    <div class="breadcrumb">
                        <a href="{{ route('home') }}">Home</a>
                        <div class="icon">
                            <i class="icon-arrow-right1"></i>
                        </div>
                        <a href="javascript:void(0)">Products </a>
                        <div class="icon">
                            <i class="icon-arrow-right1"></i>
                        </div>
                        <a
                            href="javascript:void(0)">{{ !empty($product->product_name) ? $product->product_name : ' ' }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<section class="detail_outer">
    <div class="tf-container w-1290">
        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-12">
                        @php
                            $productImages = json_decode($product->product_image);
                            $firstImage = !empty($productImages) ? $productImages[0] : ''; // Default image if no image found
                        @endphp

                        <img class="xzoom5" id="xzoom-magnific" src="{{ asset('uploads/products/big/' . $firstImage) }}"
                            xoriginal="{{ asset('uploads/products/large/' . $firstImage) }}" />




                        <div id="tabbed-content">
                            <div id="tab-1" class="tab-content xzoom-thumbs">
                                @if (!empty($productImages))
                                    @foreach ($productImages as $item)
                                        <a href="{{ asset('uploads/products/large/' . $item) }}"><img
                                                class="xzoom-gallery5" width="117"
                                                src="{{ asset('uploads/products/thumb/' . $item) }}"
                                                xpreview="{{ asset('uploads/products/big/' . $item) }}" title="">
                                        </a>
                                    @endforeach
                                @endif





                            </div>
                            <!-- thumb 1 end -->
                        </div>
                        <!-- end -->
                    </div>
                </div>
            </div>
            <div class="col-md-6">

                <div class="content-inner">
                    <h2> {{ $product->product_name }} </h2>
                    <!-- <div class="rating-wrap">
                          <div class="wg-rating"> <i class="fa-solid fa-star"></i> <i class="fa-solid fa-star"></i> <i class="fa-solid fa-star"></i> <i class="fa-solid fa-star"></i> <i class="fa-solid fa-star"></i> </div>
                          <p class="font-nunito"> 5.00(1 customer review) </p>
                        </div> -->
                    <!-- <div class="price-wrap price-left"> <span class=" price-1">$5.25</span> <span class=" price-2">$3.00</span> </div> -->
                    <p> {{ $product->short_description }}</p>

                    <div class="wrap-quantity">
                        <a href="{{ route('home.contact_us') }}"> <button type="submit" class="tf-btn btn-add-cart"> <span
                                    class="text-style"> Get a Quote </span> <span class="icon"> <i
                                        class="icon-arrow_right"></i> </span> </button></a>
                                        @if (!empty($product->brochure))
                            <a href="{{ asset('uploads/products/brochure/' . $product->brochure) }}" target="_blank">
                                <button type="submit" class="tf-btn btn-add-cart"> <span class="text-style"> Download
                                        Brochure</span> <span class="icon"> <i class="icon-arrow_right"></i> </span>
                                </button></a>
                        @endif
                    </div>

                    <div class="featuer_contant">
                        <h3>Features & Advantages</h3>
                        {!! $product->features_advantages !!}

                    </div>


                </div>
            </div>




            <div class="col-lg-12">
                <div class="table_content">
                    <h3>Technical Specifications</h3>
                    {!! $product->technical_specifications !!}

                </div>
            </div>



        </div>
    </div>
</section>













<section class="s-relate-product">
    <div class="tf-container">
        <div class="row">
            <div class="col-lg-12">
                <h2> Related Products </h2>
                <div class="swiper-container slider-relate-product">
                    <div class="swiper-wrapper">
                        @if (!empty($RelatedProducts))
                            @foreach ($RelatedProducts as $item)
                                <div class="swiper-slide mtb_20">
                                    <div class="card-provide img-hover">
                                        <div class="has-border">
                                            <a href="{{ route('home.product_datels', $item->slug) }}">
                                                <div class="image">
                                                    @if (!empty($item->product_image) && isset(json_decode($item->product_image)[0]))
                                                        <img src="{{ asset('uploads/products/list/' . json_decode($item->product_image)[0]) }}"
                                                            alt="" class=" ls-is-cached lazyloaded">
                                                    @endif
                                                </div>
                                                <div class="title font-worksans hover-text-secondary">
                                                    {{ Str::limit($item->product_name, 18) }}</div>
                                                <p class="text">{{ Str::limit($item->short_description, 53) }}</p>
                                                <span class="tf-btn-read"> View Details </span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif


                    </div>
                </div>
                <div class="btn-slide-product btn-next"> <i class="fa-solid fa-chevron-right"></i> </div>
                <div class="btn-slide-product btn-prev"> <i class="fa-solid fa-chevron-left"></i> </div>
            </div>
        </div>
    </div>
</section>
@endsection
