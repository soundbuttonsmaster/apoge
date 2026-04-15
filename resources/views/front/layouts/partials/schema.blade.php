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
                        "telephone": "+91-9760150034",
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
              "alternateName": "{{ $product->meta_title ?? $product->product_name }}",
              "url": "{{ $currentUrl }}",
              "image": "{{ !empty($product->product_image) && isset(json_decode($product->product_image)[0]) ? asset('uploads/products/big/' . json_decode($product->product_image)[0]) : asset('front/images/logo.jpg') }}",
              "description": "{{ strip_tags($product->short_description ?? $product->product_name . ' by Apogee Agrotech') }}",
              "brand": {
                "@type": "Brand",
                "name": "Apogee Agrotech"
              },
              "manufacturer": {
                "@type": "Organization",
                "name": "Apogee Agrotech",
                "url": "https://www.apogeeagrotech.com"
              },
              "category": "{{ optional($product->category)->name ?? 'Laser Land Leveller' }}",
              "keywords": "{{ !empty($meta_keywords) ? $meta_keywords : strtolower($product->product_name) . ', laser land leveller, precision farming equipment India' }}"
            }
            </script>
            @endif
            @break

        @case('BlogPosting')
            @if(isset($blogdatels))
            <script type="application/ld+json">
            {
              "@context": "https://schema.org",
              "@type": "Article",
              "headline": "{{ $blogdatels->title }}",
              "description": "{{ strip_tags($blogdatels->short_description ?? $blogdatels->title) }}",
              "image": "{{ !empty($blogdatels->blog_image) ? asset('uploads/blog/datels/' . $blogdatels->blog_image) : asset('front/images/logo.jpg') }}",
              "url": "{{ $currentUrl }}",
              "datePublished": "{{ $blogdatels->created_at ? $blogdatels->created_at->format('Y-m-d') : now()->format('Y-m-d') }}",
              "dateModified": "{{ $blogdatels->updated_at ? $blogdatels->updated_at->format('Y-m-d') : now()->format('Y-m-d') }}",
              "inLanguage": "en",
              "author": {
                "@type": "Organization",
                "name": "Apogee Agrotech",
                "url": "https://www.apogeeagrotech.com"
              },
              "publisher": {
                "@type": "Organization",
                "name": "Apogee Agrotech",
                "url": "https://www.apogeeagrotech.com",
                "logo": {
                  "@type": "ImageObject",
                  "url": "https://www.apogeeagrotech.com/front/images/logo.jpg"
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
                        "telephone": "+91-9760150034",
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

@if(isset($blogdatels) && (!isset($schema_type) || $schema_type !== 'BlogPosting'))
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Article",
  "headline": "{{ $blogdatels->title }}",
  "description": "{{ strip_tags($blogdatels->short_description ?? $blogdatels->title) }}",
  "image": "{{ !empty($blogdatels->image) ? asset('uploads/blog/datels/' . $blogdatels->image) : (!empty($blogdatels->blog_image) ? asset('uploads/blog/datels/' . $blogdatels->blog_image) : asset('front/images/logo.jpg')) }}",
  "url": "{{ $currentUrl }}",
  "datePublished": "{{ $blogdatels->created_at ? $blogdatels->created_at->format('Y-m-d') : now()->format('Y-m-d') }}",
  "dateModified": "{{ $blogdatels->updated_at ? $blogdatels->updated_at->format('Y-m-d') : now()->format('Y-m-d') }}",
  "inLanguage": "en",
  "author": {
    "@type": "Organization",
    "name": "Apogee Agrotech",
    "url": "https://www.apogeeagrotech.com"
  },
  "publisher": {
    "@type": "Organization",
    "name": "Apogee Agrotech",
    "url": "https://www.apogeeagrotech.com",
    "logo": {
      "@type": "ImageObject",
      "url": "https://www.apogeeagrotech.com/front/images/logo.jpg"
    }
  },
  "mainEntityOfPage": {
    "@type": "WebPage",
    "@id": "{{ $currentUrl }}"
  }
}
</script>
@endif

@if(isset($blogdatels) && isset($blogdatels->slug) && $blogdatels->slug === 'why-uttar-pradesh-farmers-choose-apogee-laser-land-leveller')
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "FAQPage",
  "mainEntity": [
    {
      "@type": "Question",
      "name": "What is the main use of Laser Land Leveller?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "The Laser Land Leveller keeps agricultural fields perfectly level, which allows for uniform water distribution across the entire field, resulting in better crop production."
      }
    },
    {
      "@type": "Question",
      "name": "How much water can be saved using Laser Land Leveller?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Compared with conventional irrigation methods, farmers can conserve as much as 20 to 30 percent of irrigation water by using a Laser Land Leveller."
      }
    },
    {
      "@type": "Question",
      "name": "Is subsidy available for Laser Land Leveller in Uttar Pradesh?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Yes, the government of Uttar Pradesh provides rebates on certain approved machines so that farmers can purchase a Laser Land Leveller at a discounted price."
      }
    },
    {
      "@type": "Question",
      "name": "Is Laser Land Leveller easy to use?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Yes, the Laser Land Leveller is easy to operate. With basic training, farmers can use it without any difficulty."
      }
    },
    {
      "@type": "Question",
      "name": "Why is Apogee Laser Land Leveller a good choice?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Apogee is a reliable and high-quality manufacturer of Laser Land Levelling machines. Their machines are easy to operate, durable, and ideal for farmers across India."
      }
    }
  ]
}
</script>
@endif

@if(isset($area) && isset($area->slug) && $area->slug === 'uttar-pradesh')
<script type="application/ld+json">
{
  "@context": "https://schema.org/",
  "@type": "WebPage",
  "name": "Laser Land Leveller in Uttar Pradesh",
  "description": "Apogee Agrotech provides premium Laser Land Levellers in Uttar Pradesh. Save 25-30% irrigation water, increase crop yield by 15-20%, and get 40-50% government subsidy. Free farm demo available.",
  "url": "https://www.apogeeagrotech.com/areas-we-cover/uttar-pradesh",
  "inLanguage": "en",
  "image": "https://www.apogeeagrotech.com/uploads/areas/1769680648.jpg",
  "provider": {
    "@type": "Organization",
    "name": "Apogee Agrotech",
    "url": "https://www.apogeeagrotech.com/",
    "telephone": "+917624002265",
    "email": "sales@apogeeagrotech.com",
    "address": {
      "@type": "PostalAddress",
      "streetAddress": "Plot No. 540, 541, Near Reliance Petrol Pump, Garh Road",
      "addressLocality": "Hapur",
      "addressRegion": "Uttar Pradesh",
      "postalCode": "245101",
      "addressCountry": "IN"
    },
    "areaServed": {
      "@type": "State",
      "name": "Uttar Pradesh",
      "addressCountry": "IN"
    }
  }
}
</script>
@endif

{{-- Breadcrumb Schema for all pages --}}
@php
    if (isset($product)) {
        $productCategoryName = optional($product->category)->name ?? 'Products';
        $productCategorySlug = optional($product->category)->slug ?? '';
        $productCategoryUrl = !empty($productCategorySlug) ? ($baseUrl . '/p/' . $productCategorySlug) : ($baseUrl . '/');
        $breadcrumbItems = [
            [
                "@type" => "ListItem",
                "position" => 1,
                "name" => "Home",
                "item" => "https://www.apogeeagrotech.com/"
            ],
            [
                "@type" => "ListItem",
                "position" => 2,
                "name" => $productCategoryName,
                "item" => $productCategoryUrl
            ],
            [
                "@type" => "ListItem",
                "position" => 3,
                "name" => $product->product_name ?? "Product Detail",
                "item" => $currentUrl
            ]
        ];
    } elseif (isset($blogdatels)) {
        $breadcrumbItems = [
            [
                "@type" => "ListItem",
                "position" => 1,
                "name" => "Home",
                "item" => "https://www.apogeeagrotech.com/"
            ],
            [
                "@type" => "ListItem",
                "position" => 2,
                "name" => "Blog",
                "item" => "https://www.apogeeagrotech.com/media/blog"
            ],
            [
                "@type" => "ListItem",
                "position" => 3,
                "name" => $blogdatels->title ?? "Blog Detail",
                "item" => $currentUrl
            ]
        ];
    } elseif (isset($area)) {
        $breadcrumbItems = [
            [
                "@type" => "ListItem",
                "position" => 1,
                "name" => "Home",
                "item" => "https://www.apogeeagrotech.com/"
            ],
            [
                "@type" => "ListItem",
                "position" => 2,
                "name" => "Areas We Cover",
                "item" => "https://www.apogeeagrotech.com/areas-we-cover"
            ],
            [
                "@type" => "ListItem",
                "position" => 3,
                "name" => $area->name ?? "Area Detail",
                "item" => $currentUrl
            ]
        ];
    } else {
        $breadcrumbItems = [
            [
                "@type" => "ListItem",
                "position" => 1,
                "name" => "Home",
                "item" => $baseUrl
            ]
        ];
        
        $position = 2;
        
        if (isset($category_name)) {
            $breadcrumbItems[] = [
                "@type" => "ListItem",
                "position" => $position++,
                "name" => $category_name,
                "item" => $baseUrl . '/p/' . (isset($category) ? $category->slug : '')
            ];
        }
        
        if (isset($subcategory_name)) {
            $breadcrumbItems[] = [
                "@type" => "ListItem",
                "position" => $position++,
                "name" => $subcategory_name,
                "item" => $currentUrl
            ];
        }
        
        if (isset($product)) {
            $breadcrumbItems[] = [
                "@type" => "ListItem",
                "position" => $position++,
                "name" => $product->product_name,
                "item" => $currentUrl
            ];
        }
        
        if (isset($blogdatels)) {
            $breadcrumbItems[] = [
                "@type" => "ListItem",
                "position" => $position++,
                "name" => "Blog",
                "item" => $baseUrl . '/media/blog'
            ];
            $breadcrumbItems[] = [
                "@type" => "ListItem",
                "position" => $position++,
                "name" => $blogdatels->title,
                "item" => $currentUrl
            ];
        }
    }
@endphp
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "BreadcrumbList",
    "itemListElement": @json($breadcrumbItems)
}
</script>
