@php
    $baseUrl = url('/');
    $currentUrl = url()->current();
@endphp

@if(isset($schema_type))
    @switch($schema_type)
        @case('AboutPage')
            <script type="application/ld+json">
            {
                "@context": "https://schema.org",
                "@type": "AboutPage",
                "name": "About Apogee Agrotech",
                "description": "{{ $meta_description ?? 'Learn about Apogee Agrotech - India\'s leading manufacturer of Laser Land Leveller equipment' }}",
                "url": "{{ $currentUrl }}",
                "mainEntity": {
                    "@type": "Organization",
                    "name": "Apogee Agrotech Pvt. Ltd.",
                    "url": "{{ $baseUrl }}",
                    "logo": "{{ asset('front') }}/images/logo.jpg",
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
                        "email": "sales@apogeeagrotech.com"
                    }
                }
            }
            </script>
            @break

        @case('Product')
            @if(isset($product))
            <script type="application/ld+json">
            {
                "@context": "https://schema.org",
                "@type": "Product",
                "name": "{{ $product->product_name }}",
                "description": "{{ strip_tags($product->short_description ?? $product->product_name . ' by Apogee Agrotech') }}",
                "image": "{{ !empty($product->product_image) && isset(json_decode($product->product_image)[0]) ? asset('uploads/products/list/' . json_decode($product->product_image)[0]) : asset('front/images/logo.jpg') }}",
                "brand": {
                    "@type": "Brand",
                    "name": "Apogee Agrotech"
                },
                "manufacturer": {
                    "@type": "Organization",
                    "name": "Apogee Agrotech Pvt. Ltd.",
                    "url": "{{ $baseUrl }}"
                },
                "offers": {
                    "@type": "Offer",
                    "url": "{{ $currentUrl }}",
                    "priceCurrency": "INR",
                    "availability": "https://schema.org/InStock",
                    "itemCondition": "https://schema.org/NewCondition",
                    "seller": {
                        "@type": "Organization",
                        "name": "Apogee Agrotech Pvt. Ltd."
                    }
                },
                "aggregateRating": {
                    "@type": "AggregateRating",
                    "ratingValue": "4.8",
                    "reviewCount": "150"
                },
                "sku": "{{ $product->id }}",
                "mpn": "{{ $product->id }}"
            }
            </script>
            @endif
            @break

        @case('BlogPosting')
            @if(isset($blogdatels))
            <script type="application/ld+json">
            {
                "@context": "https://schema.org",
                "@type": "BlogPosting",
                "headline": "{{ $blogdatels->title }}",
                "description": "{{ strip_tags($blogdatels->short_description ?? $blogdatels->title) }}",
                "image": "{{ !empty($blogdatels->blog_image) ? asset('uploads/blog/' . $blogdatels->blog_image) : asset('front/images/logo.jpg') }}",
                "datePublished": "{{ $blogdatels->created_at ? $blogdatels->created_at->toIso8601String() : now()->toIso8601String() }}",
                "dateModified": "{{ $blogdatels->updated_at ? $blogdatels->updated_at->toIso8601String() : now()->toIso8601String() }}",
                "author": {
                    "@type": "Organization",
                    "name": "Apogee Agrotech"
                },
                "publisher": {
                    "@type": "Organization",
                    "name": "Apogee Agrotech",
                    "logo": {
                        "@type": "ImageObject",
                        "url": "{{ asset('front') }}/images/logo.jpg"
                    }
                },
                "mainEntityOfPage": {
                    "@type": "WebPage",
                    "@id": "{{ $currentUrl }}"
                }
            }
            </script>
            @endif
            @break

        @case('Blog')
            <script type="application/ld+json">
            {
                "@context": "https://schema.org",
                "@type": "Blog",
                "name": "Apogee Agrotech Blog",
                "description": "{{ $meta_description ?? 'Latest articles and news about Laser Land Leveller and precision agriculture' }}",
                "url": "{{ $currentUrl }}",
                "publisher": {
                    "@type": "Organization",
                    "name": "Apogee Agrotech",
                    "logo": {
                        "@type": "ImageObject",
                        "url": "{{ asset('front') }}/images/logo.jpg"
                    }
                }
            }
            </script>
            @break

        @case('ImageGallery')
            <script type="application/ld+json">
            {
                "@context": "https://schema.org",
                "@type": "ImageGallery",
                "name": "Image Gallery - Apogee Agrotech",
                "description": "{{ $meta_description ?? 'Image gallery showcasing Laser Land Leveller equipment and precision agriculture solutions' }}",
                "url": "{{ $currentUrl }}"
            }
            </script>
            @break

        @case('VideoGallery')
            <script type="application/ld+json">
            {
                "@context": "https://schema.org",
                "@type": "VideoGallery",
                "name": "Video Gallery - Apogee Agrotech",
                "description": "{{ $meta_description ?? 'Video gallery featuring Laser Land Leveller demonstrations and tutorials' }}",
                "url": "{{ $currentUrl }}"
            }
            </script>
            @break

        @case('CollectionPage')
            <script type="application/ld+json">
            {
                "@context": "https://schema.org",
                "@type": "CollectionPage",
                "name": "{{ $category_name ?? 'Product Collection' }}{{ isset($subcategory_name) ? ' - ' . $subcategory_name : '' }}",
                "description": "{{ $meta_description ?? 'Browse our collection of Laser Land Leveller products' }}",
                "url": "{{ $currentUrl }}"
            }
            </script>
            @break

        @case('ContactPage')
            <script type="application/ld+json">
            {
                "@context": "https://schema.org",
                "@type": "ContactPage",
                "name": "Contact Apogee Agrotech",
                "description": "{{ $meta_description ?? 'Contact Apogee Agrotech for Laser Land Leveller inquiries and support' }}",
                "url": "{{ $currentUrl }}",
                "mainEntity": {
                    "@type": "Organization",
                    "name": "Apogee Agrotech Pvt. Ltd.",
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
                    }
                }
            }
            </script>
            @break

        @case('WebPage')
            <script type="application/ld+json">
            {
                "@context": "https://schema.org",
                "@type": "WebPage",
                "name": "{{ $meta_title ?? 'Apogee Agrotech' }}",
                "description": "{{ $meta_description ?? '' }}",
                "url": "{{ $currentUrl }}"
            }
            </script>
            @break
    @endswitch
@endif

{{-- Breadcrumb Schema for all pages --}}
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "BreadcrumbList",
    "itemListElement": [
        {
            "@type": "ListItem",
            "position": 1,
            "name": "Home",
            "item": "{{ $baseUrl }}"
        }@if(isset($category_name)),
        {
            "@type": "ListItem",
            "position": 2,
            "name": "{{ $category_name }}",
            "item": "{{ $baseUrl }}/p/{{ isset($category) ? $category->slug : '' }}"
        }@endif@if(isset($subcategory_name)),
        {
            "@type": "ListItem",
            "position": 3,
            "name": "{{ $subcategory_name }}",
            "item": "{{ $currentUrl }}"
        }@endif@if(isset($product)),
        {
            "@type": "ListItem",
            "position": {{ isset($category_name) ? (isset($subcategory_name) ? 4 : 3) : 2 }},
            "name": "{{ $product->product_name }}",
            "item": "{{ $currentUrl }}"
        }@endif@if(isset($blogdatels)),
        {
            "@type": "ListItem",
            "position": 2,
            "name": "Blog",
            "item": "{{ $baseUrl }}/media/blog"
        },
        {
            "@type": "ListItem",
            "position": 3,
            "name": "{{ $blogdatels->title }}",
            "item": "{{ $currentUrl }}"
        }@endif
    ]
}
</script>
