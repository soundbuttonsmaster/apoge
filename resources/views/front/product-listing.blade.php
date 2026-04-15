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

                        @if(request()->is('p/laser-land-leveller'))
                            <div class="mt-5">
                                <p>A laser land leveller is an advanced agricultural implement designed to create perfectly level fields using laser-guided technology. It provides an even distribution of water across crops, increases crop yield, and significantly reduces time and money spent on irrigation.</p>
                                <p>At Apogee Agrotech we sell high-quality laser land levellers which have been engineered for durability, accuracy, and efficiency to provide farmers with the tools they need to increase their productivity while conserving resources.</p>
                                <br>
                                <h2>What is a Laser Land Leveller?</h2>
                                <p>A laser land leveling system is a tractor-based operation that utilizes a transmitter, receiver, control box, and hydraulic system; combined these parts provide the ability to automatically level land by using laser signals to control the height of the bucket holding material used in land leveling operations.</p>
                                <p>The result is a smooth and level surface on which to plant crops as well as to have improved soil health, reduced water use from irrigation because of the removal of any uneven patches of land.</p>
                                <p>This technology eliminates uneven patches, reduces water wastage, and enhances soil health.</p>
                                <br>                           
                                <h2>Key Features of Our Laser Land Leveller</h2>
                                <ul class="laser-features-list">
                                    <li>Superior laser precision for Land Leveling Accuracy</li>
                                    <li>Tough all welded construction for Durability</li>
                                    <li>Hydraulic System designed for a smooth operating system</li>
                                    <li>Designed for easy compatibility with most tractors</li>
                                    <li>Designed for low maintenance, to minimize down time</li>
                                </ul>
                                <br>
                                <h2>Benefits of Using a Laser Land Leveller</h2>
                                <br>
                                <h3>1. Improved Water Management</h3>
                                <p>Uniform fields allow a pattern of water distribution resulting in as much as 30% less water usage.</p>
                                <h3>2. Increased Crop Production</h3>
                                <p>A level surface provides for better germination and even growth of crops.</p>
                                <h3>3. Reduced Fertilizer Runoff</h3>
                                <p>Prevention of nutrient runoff provides richer soil.</p>
                                <h3>4. Savings in Time and Money</h3>
                                <p>Reduces the need for labor and speeds up the time taken for irrigation.</p>
                                <h3>5. Greater Field Efficiency</h3>
                                <p>Elimination of low and high spots will lead to more efficient farming practices.</p>
                                <br>
                                <h2>Why Choose Apogee Agrotech?</h2>
                                <ul class="laser-features-list">
                                    <li>Trusted manufacturer of agricultural equipment</li>
                                    <li>Advanced laser technology integration</li>
                                    <li>Competitive pricing</li>
                                    <li>Reliable after-sales support</li>
                                    <li>Custom solutions for different farm sizes</li>
                                </ul>
                                <br>
                                <h2>FAQs</h2>
                                <h3>1. What is a laser land leveller used for?</h3>
                                <p>A laser land leveller is used to level agricultural fields with high precision, ensuring uniform water distribution and better crop yield.</p>
                                <h3>2. How does a laser land leveller work?</h3>
                                <p>It uses a laser transmitter to create a reference level. The receiver on the machine detects this signal and automatically adjusts the levelling blade through a hydraulic system.</p>
                                <h3>3. What are the benefits of using a laser land leveller?</h3>
                                <p>It improves crop yield, saves water, reduces fertilizer loss, and enhances overall farming efficiency.</p>
                                <h3>4. Is a laser land leveller suitable for all types of crops?</h3>
                                <p>Yes, it is suitable for various crops like wheat, rice, and other field crops where uniform land leveling is essential.</p>
                                <h3>5. What tractor power is required for a laser land leveller?</h3>
                                <p>Typically, a tractor with 45 HP or above is recommended, depending on the model and field conditions.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        @if(request()->is('p/laser-land-leveller'))
            <style>
                .laser-features-list {
                    list-style: disc !important;
                    margin: 0 0 16px 0;
                    padding-left: 24px !important;
                }

                .laser-features-list li {
                    display: list-item !important;
                    list-style: disc !important;
                    margin-bottom: 6px;
                }
            </style>
        @endif
@endsection