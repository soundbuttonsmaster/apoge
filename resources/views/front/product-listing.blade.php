@extends('front.layouts.masterhome')
@section('section')
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
                            @if (!empty($category_name))
                                <div class="icon">
                                    <i class="icon-arrow-right1"></i>
                                </div>
                                <a href="javascript:void(0)">{{ $category_name }}</a>
                            @endif
                            @if (!empty($subcategory_name))
                                <div class="icon">
                                    <i class="icon-arrow-right1"></i>
                                </div>
                                <a href="javascript:void(0)">{{ $subcategory_name }}</a>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Page-title -->
    <!-- Main-content -->
    <div class="main-content pb-0 pt-93">
        <section style="display:none">
            <div class="odometer style-5">1000</div>
        </section>


        <div class="main-content page-shop-product pt-0">
            <div class="tf-container">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="tf-sidebar">
                            <div class="sidebar-item sb-category">
                                <h5 class="sb-title">Products</h5>
                                <div class="sb-content">



                                    <ul id="accordion" class="accordion">
                                        @if (!empty($AllCategory))
                                            @foreach ($AllCategory as $cat)
                                                <li>
                                                    <div class="link">{{ $cat->name }}<i class="fa fa-chevron-down"></i></div>
                                                    @php
                                                        $subcategory = \App\Models\SubCategory::where(
                                                            'category_id',
                                                            $cat->id,
                                                        )
                                                            ->where('status', 1)
                                                            ->latest()
                                                            ->get();
                                                    @endphp
                                                    <ul class="submenu">
                                                        @if (!empty($subcategory))
                                                            @foreach ($subcategory as $subcat)
                                                                <li><a
                                                                        href="{{ route('home.product_listing', [$cat->slug, $subcat->slug]) }}">{{ $subcat->name }}</a>
                                                                </li>
                                                            @endforeach
                                                        @endif
                                                    </ul>
                                                </li>
                                            @endforeach
                                        @endif

                                    </ul>


                                    <!--
                                                                          <ul class="category-list">
                                                                            <li class="item"> <a href="laser-land-leveller.html">Laser Land Leveller</a> </li>





                                                                            <li class="item"> <a href="#">GNSS Land Leveller</a> </li>
                                                                            <li class="item"> <a href="#">Rotavator</a> </li>

                                                                          </ul> -->
                                </div>
                            </div>



                        </div>
                    </div>
                    <div class="col-lg-9">
                        <div class="tf-shop-control">
                            <div class="control-lef">

                                <h1>{{ $subcategory_name ?? ($category_name ?? '') }}</h1>
                            </div>
                            <!--  <div class="control-right">
                                                                        <div class="tf-control-sorting">
                                                                          <div class="tf-dropdown-sort">
                                                                            <div class="tf-btn style-2" data-bs-toggle="dropdown"> <span class="text-sort-value">Default sorting</span> <i class="icon-arrow_down"></i> </div>
                                                                            <div class="dropdown-menu ">
                                                                              <div class="select-item "> <span class="text-value-item"> New Post </span> </div>
                                                                              <div class="select-item"> <span class="text-value-item"> Regular Post </span> </div>
                                                                              <div class="select-item active"> <span class="text-value-item"> Lastest Posts </span> </div>
                                                                              <div class="select-item "> <span class="text-value-item"> All Post </span> </div>
                                                                            </div>
                                                                          </div>
                                                                        </div>
                                                                      </div> -->
                        </div>


                        <div class="row">

                            @if (!empty($productlisting))
                                @foreach ($productlisting as $item)
                                    <div class="col-lg-4">
                                        <div class="card-provide img-hover">
                                            <div class="has-border"> <a href="{{ route('home.product_datels', $item->slug) }}">
                                                    <div class="image">
                                                        @if (!empty($item->product_image) && isset(json_decode($item->product_image)[0]))
                                                            <img src="{{ asset('uploads/products/list/' . json_decode($item->product_image)[0]) }}"
                                                                alt="" class=" ls-is-cached lazyloaded">
                                                        @endif

                                                    </div>
                                                    <div class="title font-worksans hover-text-secondary">
                                                        {{ Str::limit($item->product_name, 18) }}
                                                    </div>
                                                    <p class="text">{{ Str::limit($item->short_description, 53) }} </p>
                                                    <span class="tf-btn-read"> View Details </span>
                                                </a> </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif






                        </div>




                        <!--  <div class=" tf-page-pagination">
                                                                      <ul>
                                                                        <li> <a class="active" href="javascript:void(0)">1</a> </li>
                                                                        <li> <a href="#">2</a> </li>
                                                                        <li> <a href="#">3</a> </li>
                                                                      </ul>
                                                                    </div> -->
                    </div>
                </div>
            </div>
        </div>
@endsection