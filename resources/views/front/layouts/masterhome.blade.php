<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-IN" lang="en-IN">

<head>
    <meta charset="utf-8" />
    
    @php
        // Determine if this is the home page
        $isHomePage = Route::is('home');
        
        // Set default optimized meta tags for home page
        if ($isHomePage) {
            $defaultTitle = 'Laser Land Leveller India | Best Laser Land Leveler Manufacturer | Apogee Agrotech';
            $defaultKeywords = 'laser land leveller, laser land leveler, laser land leveller india, laser land leveler manufacturer india, best laser land leveller, laser guided land leveller, GNSS land leveller, laser land leveller price, laser land leveller machine, laser land leveller for agriculture, laser land leveller bucket, laser land leveller system, precision land levelling, agricultural land leveller, laser leveller equipment, laser land leveller dealer, laser land leveller supplier, laser land leveller UP, laser land leveller Hapur, apogee laser land leveller, bahubali laser land leveller, laser land leveller cost, laser land leveller benefits, laser land leveller technology';
            $defaultDescription = 'Apogee Agrotech - India\'s Leading Manufacturer of Laser Land Leveller & Laser Land Leveler Equipment. Best Quality GNSS & Laser Guided Land Levelling Systems for Precision Agriculture. Get Best Price on Laser Land Levellers in India. Call +91 7624002265';
            $ogImage = asset('front') . '/images/logo.jpg';
            $canonicalUrl = url('/');
        } else {
            $defaultTitle = !empty($meta_title) ? $meta_title : 'Apogee Agrotech - Laser Land Levelling Equipment';
            $defaultKeywords = !empty($meta_keywords) ? $meta_keywords : 'laser land leveller, laser land leveler, GNSS land leveller, agricultural equipment';
            $defaultDescription = !empty($meta_description) ? $meta_description : 'Apogee Agrotech - Leading Manufacturer of Laser Land Leveller Equipment in India';
            $ogImage = asset('front') . '/images/logo.jpg';
            $canonicalUrl = url()->current();
        }
        
        $pageTitle = !empty($meta_title) ? $meta_title : $defaultTitle;
        $pageKeywords = !empty($meta_keywords) ? $meta_keywords : $defaultKeywords;
        $pageDescription = !empty($meta_description) ? $meta_description : $defaultDescription;
    @endphp
    
    <!-- Primary Meta Tags -->
    <title>{{ $pageTitle }}</title>
    <meta name="title" content="{{ $pageTitle }}" />
    <meta name="description" content="{{ $pageDescription }}" />
    <meta name="keywords" content="{{ $pageKeywords }}" />
    <meta name="author" content="Apogee Agrotech Pvt. Ltd." />
    <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1" />
    <meta name="language" content="English" />
    <meta name="geo.region" content="IN-UP" />
    <meta name="geo.placename" content="Hapur, Uttar Pradesh, India" />
    <meta name="geo.position" content="28.7306;77.7806" />
    <meta name="ICBM" content="28.7306, 77.7806" />
    <meta name="revisit-after" content="7 days" />
    <meta name="distribution" content="global" />
    <meta name="rating" content="general" />
    
    <!-- Canonical URL -->
    <link rel="canonical" href="{{ $canonicalUrl }}" />
    
    <!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->
    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5" />
    <meta name="theme-color" content="#1a5f2e" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
    
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="{{ $isHomePage ? 'website' : 'article' }}" />
    <meta property="og:url" content="{{ $canonicalUrl }}" />
    <meta property="og:title" content="{{ $pageTitle }}" />
    <meta property="og:description" content="{{ $pageDescription }}" />
    <meta property="og:image" content="{{ $ogImage }}" />
    <meta property="og:image:width" content="1200" />
    <meta property="og:image:height" content="630" />
    <meta property="og:image:alt" content="Apogee Agrotech - Laser Land Leveller Manufacturer India" />
    <meta property="og:site_name" content="Apogee Agrotech" />
    <meta property="og:locale" content="en_IN" />
    
    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:url" content="{{ $canonicalUrl }}" />
    <meta name="twitter:title" content="{{ $pageTitle }}" />
    <meta name="twitter:description" content="{{ $pageDescription }}" />
    <meta name="twitter:image" content="{{ $ogImage }}" />
    <meta name="twitter:image:alt" content="Apogee Agrotech - Laser Land Leveller Manufacturer India" />
    <meta name="twitter:site" content="@apogeeagrotech" />
    <meta name="twitter:creator" content="@apogeeagrotech" />
    
    <!-- Additional SEO Meta Tags -->
    <meta name="application-name" content="Apogee Agrotech" />
    <meta name="msapplication-TileColor" content="#1a5f2e" />
    <meta name="msapplication-config" content="{{ asset('front') }}/browserconfig.xml" />
    
    <!-- PWA Manifest -->
    <link rel="manifest" href="{{ asset('manifest.json') }}" />
    
    <!-- Favicon and App Icons -->
    <link rel="icon" type="image/png" href="{{ asset('uploads/logo/favicon.png') }}" />
    <link rel="shortcut icon" type="image/png" href="{{ asset('uploads/logo/favicon.png') }}" />
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('uploads/logo/favicon.png') }}" />
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('uploads/logo/favicon.png') }}" />
    <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('uploads/logo/favicon.png') }}" />
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('uploads/logo/favicon.png') }}" />
    <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('uploads/logo/favicon.png') }}" />
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('uploads/logo/favicon.png') }}" />
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('uploads/logo/favicon.png') }}" />
    <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('uploads/logo/favicon.png') }}" />
    <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('uploads/logo/favicon.png') }}" />
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('uploads/logo/favicon.png') }}" />
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('uploads/logo/favicon.png') }}" />
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('uploads/logo/favicon.png') }}" />
    
    <!-- PWA Meta Tags -->
    <meta name="mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-title" content="Apogee Agrotech" />
    <meta name="apple-mobile-web-app-status-bar-style" content="default" />
    
    <!-- Google Site Verification -->
    <meta name="google-site-verification" content="7QDVioBve69fT7GcAvNox_CxgnOc1wEtwqEB8zWTe24" />
    
    <!-- Preconnect to critical origins for faster loading -->
    <link rel="preconnect" href="https://cdnjs.cloudflare.com" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com" crossorigin>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://connect.facebook.net" crossorigin>
    <link rel="dns-prefetch" href="https://cdnjs.cloudflare.com">
    <link rel="dns-prefetch" href="https://fonts.googleapis.com">
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link rel="dns-prefetch" href="https://connect.facebook.net">
    <link rel="dns-prefetch" href="https://www.facebook.com">
    <link rel="dns-prefetch" href="https://parsleyjs.org">
    
    @if($isHomePage)
    <!-- Preload critical LCP image -->
    <link rel="preload" as="image" href="{{ asset('front') }}/images/page-title/slider-1.jpg" fetchpriority="high">
    @endif
    
    <!-- Schema.org Structured Data -->
    @if($isHomePage)
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Organization",
        "name": "Apogee Agrotech Pvt. Ltd.",
        "alternateName": "Apogee Agrotech",
        "url": "{{ url('/') }}",
        "logo": "{{ asset('front') }}/images/logo.jpg",
        "description": "India's Leading Manufacturer of Laser Land Leveller and Laser Land Leveler Equipment for Precision Agriculture",
        "address": {
            "@type": "PostalAddress",
            "streetAddress": "Plot No. 540,541, Near Reliance Petrol Pump, Garh Road",
            "addressLocality": "Hapur",
            "addressRegion": "Uttar Pradesh",
            "postalCode": "245101",
            "addressCountry": "IN"
        },
        "contactPoint": {
            "@type": "ContactPoint",
            "telephone": "+91-7624002265",
            "contactType": "Sales",
            "email": "sales@apogeeagrotech.com",
            "areaServed": "IN",
            "availableLanguage": ["en", "hi"]
        },
        "sameAs": [
            "https://www.youtube.com/@apogee_agro",
            "https://www.facebook.com/apogeeagrotech/",
            "https://www.instagram.com/apogee_agro/",
            "https://www.linkedin.com/company/apogee-agrotech-pvt-ltd"
        ],
        "aggregateRating": {
            "@type": "AggregateRating",
            "ratingValue": "4.8",
            "reviewCount": "150"
        }
    }
    </script>
    
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "LocalBusiness",
        "name": "Apogee Agrotech Pvt. Ltd.",
        "image": "{{ asset('front') }}/images/logo.jpg",
        "@id": "{{ url('/') }}",
        "url": "{{ url('/') }}",
        "telephone": "+91-7624002265",
        "priceRange": "$$",
        "address": {
            "@type": "PostalAddress",
            "streetAddress": "Plot No. 540,541, Near Reliance Petrol Pump, Garh Road",
            "addressLocality": "Hapur",
            "addressRegion": "Uttar Pradesh",
            "postalCode": "245101",
            "addressCountry": "IN"
        },
        "geo": {
            "@type": "GeoCoordinates",
            "latitude": 28.7306,
            "longitude": 77.7806
        },
        "openingHoursSpecification": {
            "@type": "OpeningHoursSpecification",
            "dayOfWeek": [
                "Monday",
                "Tuesday",
                "Wednesday",
                "Thursday",
                "Friday",
                "Saturday"
            ],
            "opens": "09:00",
            "closes": "18:30"
        },
        "areaServed": {
            "@type": "Country",
            "name": "India"
        }
    }
    </script>
    
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "WebSite",
        "name": "Apogee Agrotech",
        "url": "{{ url('/') }}",
        "potentialAction": {
            "@type": "SearchAction",
            "target": {
                "@type": "EntryPoint",
                "urlTemplate": "{{ url('/') }}?s={search_term_string}"
            },
            "query-input": "required name=search_term_string"
        }
    }
    </script>
    
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Product",
        "name": "Laser Land Leveller",
        "image": "{{ asset('front') }}/images/page-title/slider-1.jpg",
        "description": "Professional Laser Land Leveller and Laser Land Leveler Equipment for Precision Agriculture. Best Quality GNSS and Laser Guided Land Levelling Systems manufactured in India.",
        "brand": {
            "@type": "Brand",
            "name": "Apogee Agrotech"
        },
        "manufacturer": {
            "@type": "Organization",
            "name": "Apogee Agrotech Pvt. Ltd."
        },
        "offers": {
            "@type": "Offer",
            "url": "{{ url('/') }}",
            "priceCurrency": "INR",
            "availability": "https://schema.org/InStock",
            "itemCondition": "https://schema.org/NewCondition"
        },
        "aggregateRating": {
            "@type": "AggregateRating",
            "ratingValue": "4.8",
            "reviewCount": "150"
        }
    }
    </script>
    
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "BreadcrumbList",
        "itemListElement": [{
            "@type": "ListItem",
            "position": 1,
            "name": "Home",
            "item": "{{ url('/') }}"
        }]
    }
    </script>
    @else
        {{-- Include dynamic schema for other pages --}}
        @include('front.layouts.partials.schema')
    @endif

<!-- Google tag (gtag.js) --> <script async src="https://www.googletagmanager.com/gtag/js?id=G-139HDX1VWS"></script> <script>   window.dataLayer = window.dataLayer || [];   function gtag(){dataLayer.push(arguments);}   gtag('js', new Date());   gtag('config', 'G-139HDX1VWS'); </script>
 
 
 
 <!-- Meta Pixel Code -->
<script>
!function(f,b,e,v,n,t,s)
{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};
if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];
s.parentNode.insertBefore(t,s)}(window, document,'script',
'https://connect.facebook.net/en_US/fbevents.js');
fbq('init', '851416281111227');
fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none"
src="https://www.facebook.com/tr?id=851416281111227&ev=PageView&noscript=1"
/></noscript>
<!-- End Meta Pixel Code -->


    @if (!empty($header_content))
        {!! $header_content !!}
    @endif

    <!-- Bootstrap  -->
    <link rel="stylesheet" type="text/css" href="{{ asset('front') }}/css/bootstrap.css" />
    <!-- Theme Style -->
    <link rel="stylesheet" type="text/css" href="{{ asset('front') }}/css/magnific-popup.min.css" />
    <link rel="stylesheet" type="text/css" href="{{ asset('front') }}/css/odometer.min.css" />
    <link rel="stylesheet" type="text/css" href="{{ asset('front') }}/css/swiper-bundle.min.css" />
    <link rel="stylesheet" type="text/css" href="{{ asset('front') }}/css/styles.css" />
    <!-- Animation Style -->
    <link rel="stylesheet" type="text/css" href="{{ asset('front') }}/css/animate.min.css" />
    <link rel="stylesheet" type="text/css" href="{{ asset('front') }}/css/animate2.min.css" />
    <link rel="stylesheet" type="text/css" href="{{ asset('front') }}/css/textanimation.css" />
    <!-- Font - Preload critical fonts -->
    <link rel="preload" href="{{ asset('front') }}/font/Farmhouse.otf" as="font" type="font/otf" crossorigin>
    <link rel="preload" href="{{ asset('front') }}/font/Glittery-Snowfall.ttf" as="font" type="font/ttf" crossorigin>
    <link rel="preload" href="{{ asset('front') }}/icons/fontawesome/webfonts/fa-solid-900.ttf" as="font" type="font/ttf" crossorigin>
    <link rel="preload" href="{{ asset('front') }}/icons/fontawesome/webfonts/fa-brands-400.ttf" as="font" type="font/ttf" crossorigin>
    <link rel="stylesheet" href="{{ asset('front') }}/font/fonts.css" />
    <!-- Icon -->
    <link rel="stylesheet" type="text/css" href="{{ asset('front') }}/icons/icomoon/style.css" />
    <link rel="stylesheet" type="text/css" href="{{ asset('front') }}/icons/fontawesome/css/all.min.css" />
    <!--[if lt IE 9]>
        <script src="{{ asset('front') }}/javascript/html5shiv.js"></script>
        <script src="{{ asset('front') }}/javascript/respond.min.js"></script>
    <![endif]-->
    @yield('css')

    <!-- css for toaster - loaded asynchronously to prevent render blocking -->
    <link rel="preload" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"></noscript>
    <script>
        // LoadCSS polyfill for async CSS loading
        !function(e){"use strict";var t=function(t,n,r){var o,i=e.document,a=i.createElement("link");if(n)o=n;else{var l=(i.body||i.getElementsByTagName("head")[0]).childNodes;o=l[l.length-1]}var d=i.styleSheets;a.rel="stylesheet",a.href=t,a.media="only x",function e(t){if(i.body)return t();setTimeout(function(){e(t)})}(function(){o.parentNode.insertBefore(a,n?o:o.nextSibling)});var f=function(e){for(var t=a.href,n=d.length;n--;)if(d[n].href===t)return e();setTimeout(function(){f(e)})};return a.addEventListener&&a.addEventListener("load",function(){this.media=r||"all"}),a.onloadcssdefined=f,f(function(){a.media!==r&&(a.media=r||"all")}),a};"undefined"!=typeof exports?exports.loadCSS=t:e.loadCSS=t}("undefined"!=typeof global?global:this);
    </script>
    <!-- end css for toaster -->
    
    
       

 
</head>

<body class="counter-scroll">
    <!-- Wrapper -->
    <div id="wrapper">
        <!-- Top-bar -->

        <!-- /.Top-bar -->
        <div class="tf-topbar style-3">
            <div class="tf-container w-1780">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="topbar-inner">
                            <div class="topbar-left"> <span class="">Welcome to Apogeeagrotech</span> <span
                                    class="">India's Agriculture Sector</span> </div>
                            <div class="topbar-right">
                                <ul class="contact-list">
                                    <li class="item"> <a href="tel:+91 7624002265" class="icon" aria-label="Call us"> <i
                                                class="fa-solid fa-phone-volume"></i> </a> <a
                                            href="tel:+91 7624002265">+91 7624002265</a> </li>
                                    <li class="item"> <a href="mailto:sales@apogeeagrotech.com" class="icon" aria-label="Email us"> <i
                                                class="far fa-envelope"></i> </a> <a
                                            href="mailto:sales@apogeeagrotech.com">sales@apogeeagrotech.com</a> </li>
                                    <li class="item"> <a href="#" class="icon" aria-label="Our location"> <i
                                                class="fa-solid fa-location-dot"></i> </a> <a href="#">Garh Road,
                                            Hapur, UP, 245101</a> </li>
                                </ul>
                                <ul class="social-list">
                                    <li class="item"> <a href="https://www.youtube.com/@apogee_agro" target="_blank" aria-label="Follow us on YouTube">
                                            <i class="fa-brands fa-youtube"></i> </a> </li>
                                    <li class="item"> <a href="https://www.facebook.com/apogeeagrotech/"
                                            target="_blank" aria-label="Follow us on Facebook"> <i class="fa-brands fa-facebook-f"></i> </a> </li>
                                    <li class="item"> <a href="https://www.instagram.com/apogee_agro/"
                                            target="_blank" aria-label="Follow us on Instagram"> <i class="fa-brands fa-instagram"></i> </a> </li>
                                    <li class="item"> <a href="https://www.linkedin.com/company/apogee-agrotech-pvt-ltd" target="_blank" aria-label="Follow us on LinkedIn"> <i
                                                class="fa-brands fa-linkedin-in"></i> </a> </li>

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Header  -->
        <header class="header has-item-bot" id="header-main">
            <div class="tf-container w-1780">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="header-inner">
                            <div class="header-left">
                                <div class="logo-site"> <a href="{{ route('home') }}"> <img
                                            src="{{ asset('front') }}/images/logo.jpg" alt="Apogee Agrotech Logo" /> </a> </div>
                            </div>
                            <div>
                                <div class="main-nav">
                                    <ul class="nav-list">
                                        <li class="item has-child {{ Route::is('home') ? 'current-menu' : '' }}"><a
                                                href="{{ route('home') }}">Home</a></li>
                                        <li
                                            class="item has-child {{ Route::is('home.about_us') || Route::is('home.time_line') ? 'current-menu' : '' }}">
                                            <a href="{{ route('home.about_us') }}" aria-label="Company - About Us and Timeline">Company</a>
                                            <ul class="sub-nav">
                                                <li><a href="{{ route('home.about_us') }}"><span>About us</span></a>
                                                </li>
                                                <li><a href="{{ route('home.time_line') }}"><span>Time line</span></a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="item has-child {{ Request::is('p*') ? 'current-menu' : '' }}"> <a
                                                href="{{ route('home.product_listing_category', \App\Models\Category::where('status', 1)->first()->slug ?? '#') }}" aria-label="Products - Laser Land Leveller Equipment">Products</a>
                                            <ul class="sub-nav">
                                                @php
                                                    $category = \App\Models\Category::where('status', 1)
                                                        ->latest()
                                                        ->get();
                                                @endphp
                                                @if (!empty($category))
                                                    @foreach ($category as $cat)
                                                        <li><a href="{{ route('home.product_listing_category', $cat->slug) }}"><span>{{ $cat->name }}</span></a>
                                                            @php
                                                                $subcategory = \App\Models\SubCategory::where(
                                                                    'category_id',
                                                                    $cat->id,
                                                                )
                                                                    ->where('status', 1)
                                                                    ->latest()
                                                                    ->get();
                                                            @endphp
                                                            <ul class="sub-sub-nav">
                                                                @if (!empty($subcategory))
                                                                    @foreach ($subcategory as $subcat)
                                                                        <li><a
                                                                                href="{{ route('home.product_listing', [$cat->slug, $subcat->slug]) }}"><span>{{ $subcat->name }}</span></a>
                                                                        </li>
                                                                    @endforeach
                                                                @endif
                                                            </ul>
                                                        </li>
                                                    @endforeach
                                                @endif

                                            </ul>
                                        </li>

                                        <!-- <li class="item has-child"><a href="#">Testimonial</span></a></li>  -->
                                        <li
                                            class="item has-child {{ Route::is('home.image_gallery') || Route::is('home.video_gallery') || Route::is('home.blog') ? 'current-menu' : '' }}">
                                            <a href="{{ route('home.image_gallery') }}" aria-label="Media - Image Gallery, Video Gallery and Blog">Media</a>
                                            <ul class="sub-nav">
                                                <li><a href="{{ route('home.image_gallery') }}"><span>Image
                                                            Gallery</span></a></li>
                                                <li><a href="{{ route('home.video_gallery') }}"><span>Video
                                                            Gallery</span></a></li>
                                                <li><a href="{{ route('home.blog') }}"><span>Blog</span></a></li>
                                            </ul>
                                        </li>
                                        <li
                                            class="item has-child {{ Route::is('home.become_a_dealer') || Route::is('home.find_a_dealer') ? 'current-menu' : '' }}">
                                            <a href="{{ route('home.become_a_dealer') }}" aria-label="Network - Become a Dealer and Find a Dealer">Network</a>
                                            <ul class="sub-nav">
                                                <li><a href="{{ route('home.become_a_dealer') }}"><span>Become
                                                            Dealer</span></a></li>
                                                <li><a href="{{ route('home.find_a_dealer') }}"><span>Find a Dealer
                                                        </span></a></li>
                                            </ul>
                                        </li>
                                        <li
                                            class="item has-child {{ Route::is('home.testimonials') ? 'current-menu' : '' }}">
                                            <a href="{{ route('home.testimonials') }}"><span>Testimonials</span></a>
                                        </li>
                                        <!-- <li class="item has-child"><a href="#">Dealer</span></a></li> -->
                                        <li
                                            class="item has-child {{ Route::is('home.contact_us') ? 'current-menu' : '' }}">
                                            <a href="{{ route('home.contact_us') }}">Contact
                                                Us</span></a>
                                        </li>

                                        <li
                                            class="item has-child {{ Route::is('home.farmer_registration') ? 'current-menu' : '' }}">
                                            <a href="{{ route('home.farmer_registration') }}">Farmer
                                                Registration</span></a>
                                        </li>


                                        {{-- <li
                                        class="item has-child {{ Route::is('home.farmer_registration') || Route::is('home.find_a_farmer_card') ? 'current-menu' : '' }}">
                                        <a href="javascript:void(0)">Registration</span></a>
                                        <ul class="sub-nav">
                                            <li><a href="{{ route('home.farmer_registration') }}"><span>Farmer
                                                Registration</span></a></li>
                                            <li><a href="{{ route('home.find_a_farmer_card') }}"><span>Find a Farmer Card
                                                    </span></a></li>
                                        </ul>
                                    </li> --}}
                                        <!-- <li class="item has-child"><a href="#">Contact</span></a></li>                                         -->

                                    </ul>
                                </div>
                            </div>
                            <div class="header-right"> <a href="{{ asset('front/brochure/Company-Profile-Apogee-Agrotech.pdf') }}" target="_blank" class="tf-btn gap-30" style="color: #ffffff !important; background-color: #1a5f2e !important;"> <span
                                        class="text-style" style="color: #ffffff !important;"> Download Brochure </span>
                                    <div class="icon"> <i class="icon-arrow_down"></i> </div>
                                </a>
                                <div class="icon-wrap">
                                    <!--  <a class="icon header-search" href="#canvasSearch" data-bs-toggle="offcanvas">
                                        <i class="icon-magnifying-glass fs-21"></i>
                                    </a> -->
                                    <!-- <a href="shop-products.html" class="icon wg-bag">
                                        <i class="icon-basket"></i>
                                    </a> -->
                                </div>
                                <div class="wg-welcome"><a href="https://api.whatsapp.com/send?phone=917624002265"
                                        target="_blank" aria-label="Contact us on WhatsApp"> <i class="fab fa-whatsapp"></i></a> </div>
                                <div class="mobile-button"> <span></span> </div>
                            </div>
                        </div>
                        <div class="mobile-nav-wrap">
                            <div class="overlay-mobile-nav"></div>
                            <div class="inner-mobile-nav overflow-y-auto">
                                <div class="top">
                                    <div class="logo"> <a href="{{ route('home') }}" rel="home"
                                            class="main-logo"> <img id="mobile-logo_header" alt="Apogee Agrotech Mobile Logo"
                                                src="{{ asset('front') }}/images/logo.jpg" /> </a>
                                        <div class="mobile-nav-close"> <i class="icon-close"></i> </div>
                                    </div>
                                    <nav id="mobile-main-nav" class="mobile-main-nav">
                                        <ul id="menu-mobile-menu" class="menu">
                                            <li class="menu-item menu-item-has-children-mobile current-nav"> <a
                                                    class="item-menu-mobile current" href="{{ route('home') }}"> Home
                                                    <!-- <i class="icon-arrow_down"></i> -->
                                                </a> </li>
                                            <li class="menu-item menu-item-has-children-mobile"> <a
                                                    href="{{ route('home.about_us') }}" class="item-menu-mobile" aria-label="Company - About Us and Timeline">Company <i
                                                        class="icon-arrow_down"></i></a>
                                                <ul class="sub-menu-mobile">
                                                    <li class="menu-item"><a
                                                            href="{{ route('home.about_us') }}">About Us</a></li>
                                                    <li class="menu-item"><a
                                                            href="{{ route('home.time_line') }}">Time line</a></li>
                                                </ul>
                                            </li>
                                            <li class="menu-item menu-item-has-children-mobile"> <a
                                                    href="{{ route('home.product_listing_category', \App\Models\Category::where('status', 1)->first()->slug ?? '#') }}" class="item-menu-mobile" aria-label="Products - Laser Land Leveller Equipment">Products <i
                                                        class="icon-arrow_down"></i></a>
                                                <ul class="sub-menu-mobile">
                                                    @php
                                                        $category = \App\Models\Category::where('status', 1)
                                                            ->latest()
                                                            ->get();
                                                    @endphp
                                                    @if (!empty($category))
                                                        @foreach ($category as $cat)
                                                            <li class="menu-item"><a
                                                                    href="#">{{ $cat->name }}</a>
                                                                @php
                                                                    $subcategory = \App\Models\SubCategory::where(
                                                                        'category_id',
                                                                        $cat->id,
                                                                    )
                                                                        ->where('status', 1)
                                                                        ->latest()
                                                                        ->get();
                                                                @endphp
                                                                <ul class="mobile_sub-sub-nav">
                                                                    @if (!empty($subcategory))
                                                                        @foreach ($subcategory as $subcat)
                                                                            <li><a
                                                                                    href="{{ route('home.product_listing', [$cat->slug, $subcat->slug]) }}"><span>{{ $subcat->name }}</span></a>
                                                                            </li>
                                                                        @endforeach
                                                                    @endif
                                                                </ul>
                                                            </li>
                                                        @endforeach
                                                    @endif

                                                </ul>
                                            </li>
                                            <li class="menu-item menu-item-has-children-mobile"> <a
                                                    href="{{ route('home.image_gallery') }}" class="item-menu-mobile" aria-label="Media - Image Gallery, Video Gallery and Blog">Media <i
                                                        class="icon-arrow_down"></i></a>
                                                <ul class="sub-menu-mobile">
                                                    <li class="menu-item"><a
                                                            href="{{ route('home.image_gallery') }}">Image
                                                            Gallery</a></li>
                                                    <li class="menu-item"><a
                                                            href="{{ route('home.video_gallery') }}">Video
                                                            Gallery</a></li>
                                                    <li class="menu-item"><a href="{{ route('home.blog') }}">Blog</a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li class="menu-item menu-item-has-children-mobile"> <a
                                                    href="{{ route('home.become_a_dealer') }}" class="item-menu-mobile" aria-label="Network - Become a Dealer and Find a Dealer">Network <i
                                                        class="icon-arrow_down"></i></a>
                                                <ul class="sub-menu-mobile">
                                                    <li class="menu-item"><a
                                                            href="{{ route('home.become_a_dealer') }}">Become
                                                            Dealer</a></li>
                                                    <li class="menu-item"><a
                                                            href="{{ route('home.find_a_dealer') }}">Find a
                                                            Dealer</a></li>
                                                </ul>
                                            </li>
                                            {{-- <li class="menu-item menu-item-has-children-mobile"><a
                                                    href="infrastructure.html"
                                                    class="item-menu-mobile">Infrastructure</a></li> --}}
                                            <li class="menu-item menu-item-has-children-mobile"> <a
                                                    href="{{ route('home.testimonials') }}" class="item-menu-mobile">Testimonials</a></li>
                                            <!-- <li class="menu-item menu-item-has-children-mobile"><a href="#" class="item-menu-mobile">Dealer</a></li> -->
                                            <li class="menu-item menu-item-has-children-mobile"><a
                                                    href="{{ route('home.contact_us') }}"
                                                    class="item-menu-mobile">Contact</a></li>

                                            <li class="menu-item menu-item-has-children-mobile"><a
                                                    href="{{ route('home.farmer_registration') }}"
                                                    class="item-menu-mobile">Farmer Registration</a></li>

                                            {{-- <li class="menu-item menu-item-has-children-mobile"> <a
                                                        href="javascript:void(0)" class="item-menu-mobile">Registration <i
                                                            class="icon-arrow_down"></i></a>
                                                    <ul class="sub-menu-mobile">
                                                        <li class="menu-item"><a
                                                                href="{{ route('home.farmer_registration') }}">Farmer
                                                                Registration</a></li>
                                                        <li class="menu-item"><a
                                                                href="{{ route('home.find_a_farmer_card') }}">Find a
                                                                Farmer Card</a></li>
                                                    </ul>
                                                </li> --}}
                                        </ul>
                                    </nav>
                                    <!--  <div class="group-icon">
                                        <a class="site-nav-icon header-search" href="#canvasSearch"
                                            data-bs-toggle="offcanvas">
                                            <i class="icon-magnifying-glass fs-21"> </i>
                                            Search
                                        </a>
                                        <a href="shop-products.html" class="site-nav-icon wg-bag">
                                            <i class="icon-basket"></i>
                                            Shop
                                        </a>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="fixed-header style-absolute">
                <div class="tf-container w-1780">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="header-inner ">
                                <div class="header-left">
                                    <div class="logo-site"> <a href="{{ route('home') }}"> <img
                                                src="{{ asset('front') }}/images/logo.jpg" alt="Apogee Agrotech logo – Manufacturer of laser land levellers and advanced agricultural equipment in India" /> </a>
                                    </div>
                                </div>
                                <div>
                                    <div class="main-nav">
                                        <ul class="nav-list">
                                            <li class="item has-child current-menu"> <a
                                                    href="{{ route('home') }}">Home</a>
                                            </li>
                                            <li class="item has-child"> <a href="{{ route('home.about_us') }}" aria-label="Company - About Us and Timeline">Company</a>
                                                <ul class="sub-nav">
                                                    <li><a href="{{ route('home.about_us') }}"><span> About Us
                                                            </span></a></li>
                                                    <li><a href="{{ route('home.time_line') }}"><span> Time line
                                                            </span></a></li>
                                                </ul>
                                            </li>
                                            <li class="item has-child"> <a href="{{ route('home.product_listing_category', \App\Models\Category::where('status', 1)->first()->slug ?? '#') }}" aria-label="Products - Laser Land Leveller Equipment">Products</a>
                                                <ul class="sub-nav">
                                                    @php
                                                    $category = \App\Models\Category::where('status', 1)
                                                    ->latest()
                                                    ->get();
                                                    @endphp
                                                    @if (!empty($category))
                                                        @foreach ($category as $cat)
                                                            <li><a href="#"><span>{{ $cat->name }}</span></a>
                                                                @php
                                                                    $subcategory = \App\Models\SubCategory::where(
                                                                        'category_id',
                                                                        $cat->id,
                                                                    )
                                                                        ->where('status', 1)
                                                                        ->latest()
                                                                        ->get();
                                                                @endphp
                                                                <ul class="sub-sub-nav">
                                                                    @if (!empty($subcategory))
                                                                        @foreach ($subcategory as $subcat)
                                                                            <li><a
                                                                                    href="{{ route('home.product_listing', [$cat->slug, $subcat->slug]) }}"><span>{{ $subcat->name }}</span></a>
                                                                            </li>
                                                                        @endforeach
                                                                    @endif
                                                                </ul>
                                                            </li>
                                                        @endforeach
                                                    @endif
                                                </ul>
                                            </li>
                                            <li class="item has-child"><a href="{{ route('home.image_gallery') }}" aria-label="Media - Image Gallery, Video Gallery and Blog">Media</a>
                                                <ul class="sub-nav">
                                                    <li><a href="{{ route('home.image_gallery') }}"><span>Image
                                                                Gallery</span></a>
                                                    </li>
                                                    <li><a href="{{ route('home.video_gallery') }}"><span>Video
                                                                Gallery</span></a>
                                                    </li>
                                                    <li><a href="{{ route('home.blog') }}"><span>Blog</span></a></li>
                                                </ul>
                                            </li>
                                            <li class="item has-child"><a href="{{ route('home.become_a_dealer') }}" aria-label="Network - Become a Dealer and Find a Dealer">Network</a>
                                                <ul class="sub-nav">
                                                    <li><a href="{{ route('home.become_a_dealer') }}"><span>Become
                                                                Dealer</span></a>
                                                    </li>
                                                    <li><a href="{{ route('home.find_a_dealer') }}"><span>Find a
                                                                Dealer </span></a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li class="item has-child"><a
                                                    href="{{ route('home.testimonials') }}">Testimonials</a>
                                            </li>
                                            <li class="item has-child"> <a
                                                    href="{{ route('home.contact_us') }}">Contact</a> </li>

                                            <li class="item has-child"> <a
                                                    href="{{ route('home.farmer_registration') }}">Farmer
                                                    Registration</a> </li>


                                            {{-- <li class="item has-child"><a href="javascript:void(0)">Registration</a>
                                                <ul class="sub-nav">
                                                    <li><a href="{{ route('home.farmer_registration') }}"><span>Farmer
                                                        Registration</span></a>
                                                    </li>
                                                    <li><a href="{{ route('home.find_a_farmer_card') }}"><span>Find a
                                                        Farmer Card</span></a>
                                                    </li>
                                                </ul>
                                            </li> --}}



                                        </ul>
                                    </div>
                                </div>
                                <div class="header-right"> <a href="{{ asset('front/brochure/Company-Profile-Apogee-Agrotech.pdf') }}" target="_blank" class="tf-btn gap-30"> <span
                                            class="text-style"> Download Brochure </span>
                                        <div class="icon"> <i class="icon-arrow_down"></i> </div>
                                    </a>
                                    <!--  <div class="icon-wrap">
                                        <a class="icon header-search" href="#canvasSearch" data-bs-toggle="offcanvas">
                                            <i class="icon-magnifying-glass fs-21"></i>
                                        </a>
                                        <a href="shop-products.html" class="icon wg-bag">
                                            <i class="icon-basket"></i>
                                        </a>
                                    </div> -->
                                    <div class="wg-welcome"> <a
                                            href="https://api.whatsapp.com/send?phone=917624002265" target="_blank" aria-label="Contact us on WhatsApp">
                                            <i class="fab fa-whatsapp"></i></a></div>
                                    <div class="mobile-button"> <span></span> </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="header-item children"> <img src="{{ asset('front') }}/images/item/page-title-top.png"
                        alt="Top laser land leveller models by Apogee used in Indian agriculture" width="1920" height="60" style="width: 100%; height: auto; object-fit: contain;"> </div>
            </div>
            <div class="header-item"> <img src="{{ asset('front') }}/images/item/page-title-top.png" alt="Apogee Group's top GNSS and laser-based land levelling equipment lineup" width="1920" height="60" style="width: 100%; height: auto; object-fit: contain;">
            </div>
        </header>
        <!-- /.Header -->
        <main id="main-content">
            @yield('section')
        </main>

        <!-- Footer -->
        <footer class="footer" id="footer-main">
            <div class="tf-container w-1290">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="footer-top">
                            <div class="footer-left">
                                <div class="logo"> <a href="{{ route('home') }}"> <img src="{{ asset('front') }}/images/footer_logo.png"
                                            alt="Apogee Agrotech Pvt.Ltd Logo" /> </a> </div>
                            </div>
                            <div class="footer-center">
                                <p class="font-snowfall"> Farm and happiness! </p>
                            </div>
                            <div class="footer-right">
                                <div class="wg-social">
                                    <ul class="list">
                                        <!-- <li class="item"> <a href="#"> <i class="fa-brands fa-x-twitter"></i> </a> </li> -->
                                        <li class="item"> <a href="https://www.youtube.com/@apogee_agro"
                                                target="_blank" aria-label="Visit Apogee Agrotech YouTube channel"> <i class="fa-brands fa-youtube"></i> </a> </li>
                                        <li class="item"> <a href="https://www.facebook.com/apogeeagrotech/"
                                                target="_blank" aria-label="Visit Apogee Agrotech Facebook page"> <i class="fa-brands fa-facebook-f"></i> </a> </li>
                                        <li class="item"> <a href="https://www.instagram.com/apogee_agro/"
                                                target="_blank" aria-label="Visit Apogee Agrotech Instagram profile"> <i class="fa-brands fa-instagram"></i> </a> </li>
                                        <li class="item"> <a href="https://www.linkedin.com/company/apogee-agrotech-pvt-ltd" target="_blank" aria-label="Visit Apogee Agrotech LinkedIn company page">
                                                <i class="fa-brands fa-linkedin-in"></i> </a> </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-inner">
                <div class="tf-container w-1290">
                    <div class="row">
                        <div class="col-lg-3 col-md-6 ">
                            <div class="footer-inner-wrap footer-col-block">
                                <h2 class="footer-title footer-title-desktop mb-23"> Contact Info </h2>
                                <h2 class="footer-title footer-title-mobile mb-23"> Contact Us! </h2>
                                <ul class="contact-list tf-collapse-content">
                                    <li> <i class="fa-solid fa-location-dot fs-17"></i>
                                        <p class="address"> Plot No. 540,541, Near Reliance Petrol Pump, Garh Road,
                                            Hapur, UP, 245101 </p>
                                    </li>
                                    <li> <i class="fa-solid fa-phone"></i>
                                        <p class="phone-number fs-15">7624002265, 9760150034 </p>
                                    </li>
                                    <li> <i class="icon-package-box"></i>
                                        <p class="email fs-15"> sales@apogeeagrotech.com </p>
                                    </li>
                                    <li> <i class="fa-solid fa-clock"></i>
                                        <p class="time-open fs-15"> Mon – sat : 9:00 am to 6:30 pm </p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 ">
                            <div class="footer-inner-wrap footer-col-block">
                                <h2 class="footer-title footer-title-desktop mb-28"> Quick Links </h2>
                                <h2 class="footer-title footer-title-mobile mb-28"> Quick Links </h2>
                                <ul class="link-list tf-collapse-content">
                                    <li class="item"> <a href="{{ route('home') }}"> Home </a> </li>
                                    <li class="item"><a href="{{ route('home.about_us') }}">About Us</a></li>
                                    <li class="item"><a href="{{ route('home.blog') }}">Blog</a></li>
                                    <li class="item"><a href="{{ route('home.testimonials') }}">Testimonials</a></li>
                                    <li class="item"><a href="{{ route('home.contact_us') }}">Contact Us</a></li>
                                     <li class="item"><a href="{{ url('privacy-policy') }}">Privacy & Policy</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 ">
                            <div class="footer-inner-wrap footer-col-block">
                                <h2 class="footer-title footer-title-desktop mb-28"> Products </h2>
                                <h2 class="footer-title footer-title-mobile mb-28"> Products </h2>
                                <ul class="link-list tf-collapse-content">
                                     @php
                                        $category = \App\Models\Category::where('status', 1)->latest()->get();
                                    @endphp
                                    @if (!empty($category))
                                        @foreach ($category as $cat)
                                            <li class="item"><a
                                                    href="{{ route('home.product_listing_category', $cat->slug) }}">{{ $cat->name }}</a>
                                            </li>
                                        @endforeach
                                    @endif
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="footer-inner-wrap">
                                <h2 class="footer-title fs-20"> Newsletter </h2>
                                <form id="subscribe" method="post" class="form-email style-2" data-parsley-validate>
                                    @csrf

                                    <div id="subscribe-content" class="w-100">
                                        <input id="subscribe-email" type="email" name="email"
                                            class="email style-2" placeholder="Email address:" aria-required="true"
                                            required>
                                        <button type="button" onclick="SubscribeNow()" class="tf-btn full scale-40">
                                            <span class="text-style cl-primary"> Subscribe Now! </span> <span
                                                class="icon"> <i class="fa-solid fa-paper-plane fs-14"></i>
                                            </span> </button>
                                    </div>
                                    <div id="subscribe-msg"></div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tf-container w-1290">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="footer-bottom">
                            <p class="no-copy font-nunito"> © 2024 Apogee Group | All Rights Reserved. </p>
                            <ul class="policy-list">
                                <li class="item"> <a href="https://www.akswebsoft.com"
                                        title="AKS Websoft Consulting Pvt. Ltd." target="_blank"> <img
                                            src="{{ asset('front') }}/images/aks.png" alt="AKS Websoft Consulting Pvt. Ltd."
                                            class="powerd"> </a> </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="img-item item-1"> <img src="{{ asset('front') }}/images/item/grass-2.png" alt="Lush green grass in leveled agricultural farmland" /> </div>
            <div class="img-item item-2">
                <div class="  scroll-element-3"> <img class="wow zoomIn" src="{{ asset('front') }}/images/item/silo.png"
                        alt="High Capacity Land Leveling Bucket Silo by Apogee Agrotech for Modern Agriculture Farming" /> </div>
            </div>
        </footer>
        <!-- /.Footer -->

    </div>
    <!-- /#Wapper -->

    <!-- Open-search -->
    <div class="offcanvas offcanvas-top offcanvas-search" id="canvasSearch">
        <button class="btn-close-search" type="button" data-bs-dismiss="offcanvas" aria-label="Close"> <i
                class="icon-close"></i> </button>
        <div class="tf-container">
            <div class="row">
                <div class="col-12">
                    <div class="offcanvas-body">
                        <form action="#" class="form-search-courses">
                            <div class="icon"> <i class="icon-keyboard"></i> </div>
                            <fieldset>
                                <input class="" type="text" placeholder="Search for anything"
                                    name="text" tabindex="2" value="" aria-required="true" required />
                            </fieldset>
                            <div class="button-submit">
                                <button class="" type="submit" aria-label="Search"> <i class="icon-magnifying-glass"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/.Open-search-->
    <!-- Prograss -->
    <div class="progress-wrap"> <svg class="progress-circle svg-content" width="100%" height="100%"
            viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98"
                style="transition: stroke-dashoffset 10ms linear; stroke-dasharray: 307.919, 307.919; stroke-dashoffset: 307.919;">
            </path>
        </svg> </div>
    <!-- /.Prograss -->

    <!-- Javascript - Critical scripts loaded first -->
    <script type="text/javascript" src="{{ asset('front') }}/js/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('front') }}/js/bootstrap.min.js"></script>
    
    <!-- Non-critical scripts loaded with defer -->
    <script type="text/javascript" src="{{ asset('front') }}/js/lazysize.min.js" defer></script>
    <script type="text/javascript" src="{{ asset('front') }}/js/wow.min.js" defer></script>
    <script type="text/javascript" src="{{ asset('front') }}/js/magnific-popup.min.js" defer></script>
    <script type="text/javascript" src="{{ asset('front') }}/js/swiper-bundle.min.js" defer></script>
    <script type="text/javascript" src="{{ asset('front') }}/js/swiper.js" defer></script>
    <script type="text/javascript" src="{{ asset('front') }}/js/odometer.min.js" defer></script>
    <script type="text/javascript" src="{{ asset('front') }}/js/counter.js" defer></script>
    <script type="text/javascript" src="{{ asset('front') }}/js/count-down.js" defer></script>
    <script type="text/javascript" src="{{ asset('front') }}/js/jquery-validate.js" defer></script>
    <script type="text/javascript" src="{{ asset('front') }}/js/gsap-animation.js" defer></script>
    <script type="text/javascript" src="{{ asset('front') }}/js/gsap.min.js" defer></script>
    <script type="text/javascript" src="{{ asset('front') }}/js/ScrollTrigger.min.js" defer></script>
    <script type="text/javascript" src="{{ asset('front') }}/js/Splitetext.js" defer></script>
    <script type="text/javascript" src="{{ asset('front') }}/js/main.js" defer></script>
    <script src="{{ asset('front') }}/js/timeline.js" defer></script>
    <script src="{{ asset('front') }}/js/jquery.fancybox.min.js" defer></script>
    <!-- /Javascript -->

    <!-- /Javascript -->
    <script>
        $(document).ready(function() {
            $(".fancybox").fancybox({
                openEffect: "none",
                closeEffect: "none"
            });

            $(".zoom").hover(function() {

                $(this).addClass('transition');
            }, function() {

                $(this).removeClass('transition');
            });
        });
    </script>


    <script type="text/javascript" src="https://parsleyjs.org/dist/parsley.js" defer></script>

    <!---------------- Toaster ------------------->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" defer></script>
    <script>
        @if (Session::has('message'))
            var type = "{{ Session::get('alert-type', 'info') }}"
            switch (type) {
                case 'info':
                    toastr.info("{{ Session::get('message') }}");
                    break;
                case 'success':
                    toastr.success("{{ Session::get('message') }}");
                    break;
                case 'warning':
                    toastr.warning("{{ Session::get('message') }}");
                    break;
                case 'error':
                    toastr.error("{{ Session::get('message') }}");
                    break;
            }
        @endif
    </script>


    <script>
        function SubscribeNow() {
            $('.text-danger').text('');
            var isValid = $('#subscribe').parsley().validate();
            // If form validation fails, return
            if (!isValid) {
                return;
            }
            // var action = 
            var formData = new FormData($('#subscribe')[0]);
            $.ajax({
                type: "post",
                url: '/subscribe',
                data: formData,
                processData: false,
                contentType: false,
                success: function(data) { // If the request is successful
                    console.log(data); // Log the response data to console

                    toastr.success(data.message);
                    // $(formData).reset();
                    $('#subscribe')[0].reset();
                    $('#subscribe').parsley().reset();
                },
                error: function(error) { // If there is an error with the request
                    console.log(error); // Log the error to console
                    // Handle error response here
                    // alert(error.message);
                    toastr.error('The email has already been taken.');
                }
            });
        }
    </script>

    <!-- PWA Service Worker Registration -->
    <script>
        if ('serviceWorker' in navigator) {
            window.addEventListener('load', function() {
                navigator.serviceWorker.register('/service-worker.js')
                    .then(function(registration) {
                        console.log('ServiceWorker registration successful with scope: ', registration.scope);
                        
                        // Check for updates every hour
                        setInterval(function() {
                            registration.update();
                        }, 3600000);
                    })
                    .catch(function(err) {
                        console.log('ServiceWorker registration failed: ', err);
                    });
            });

            // Handle install prompt
            let deferredPrompt;
            window.addEventListener('beforeinstallprompt', (e) => {
                // Prevent Chrome 67 and earlier from automatically showing the prompt
                e.preventDefault();
                // Stash the event so it can be triggered later
                deferredPrompt = e;
                // Show custom install button or notification
                console.log('PWA install prompt available');
            });

            // Listen for app installed event
            window.addEventListener('appinstalled', (evt) => {
                console.log('PWA was installed');
                deferredPrompt = null;
            });
        }
    </script>
</body>

</html>
