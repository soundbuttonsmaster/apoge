{{--
  Static Apogee blog card: feature panel (image) + text card below.
  Expects: $item (Blog), optional $variant = 'card'|'detail'|'sidebar'
--}}
@php
    $variant = $variant ?? 'card';
    $url = route('home.blog_datels', $item->slug);
    $snippet = \Illuminate\Support\Str::limit(strip_tags($item->short_description ?? ''), 100);
    $excerpt = \Illuminate\Support\Str::limit(strip_tags($item->short_description ?? ''), 160);
@endphp

@if ($variant === 'sidebar')
    <a href="{{ $url }}" class="apogee-blog-thumb" aria-label="{{ $item->title }}">
        <span class="apogee-blog-thumb__glow" aria-hidden="true"></span>
        <img src="{{ asset('front/images/card-logo-light.png') }}" alt="" width="72" height="24" loading="lazy">
    </a>
@elseif ($variant === 'detail')
    <div class="apogee-blog-stack apogee-blog-stack--detail">
        <div class="apogee-og-card__panel">
            <span class="apogee-og-card__glow apogee-og-card__glow--tr" aria-hidden="true"></span>
            <span class="apogee-og-card__glow apogee-og-card__glow--bl" aria-hidden="true"></span>
            <div class="apogee-og-card__head">
                <div class="apogee-og-card__brand">
                    <img src="{{ asset('front/images/card-logo-light.png') }}" alt="Apogee Agrotech" width="150" height="40" loading="lazy">
                    <span class="apogee-og-card__eyebrow">Articles · Apogee</span>
                </div>
                <span class="apogee-og-card__badge">Article</span>
            </div>
            <p class="apogee-og-card__title">{{ $item->title }}</p>
            @if ($snippet !== '')
                <p class="apogee-og-card__excerpt">{{ $snippet }}</p>
            @endif
            <div class="apogee-og-card__foot">
                <span class="apogee-og-card__site">apogeeagrotech.com</span>
                <span class="apogee-og-card__cta apogee-og-card__cta--static">Apogee Agrotech</span>
            </div>
        </div>
    </div>
@else
    <article class="apogee-blog-stack wow fadeInUp" data-wow-delay="0s">
        {{-- Feature / image panel (static) --}}
        <div class="apogee-og-card__panel">
            <span class="apogee-og-card__glow apogee-og-card__glow--tr" aria-hidden="true"></span>
            <span class="apogee-og-card__glow apogee-og-card__glow--bl" aria-hidden="true"></span>

            <div class="apogee-og-card__head">
                <div class="apogee-og-card__brand">
                    <img src="{{ asset('front/images/card-logo-light.png') }}" alt="Apogee Agrotech" width="150" height="40" loading="lazy">
                    <span class="apogee-og-card__eyebrow">Articles · Apogee</span>
                </div>
                <span class="apogee-og-card__badge">Article</span>
            </div>

            <h3 class="apogee-og-card__title">
                <a href="{{ $url }}">{{ $item->title }}</a>
            </h3>

            @if ($snippet !== '')
                <p class="apogee-og-card__excerpt">{{ $snippet }}</p>
            @endif

            <div class="apogee-og-card__foot">
                <span class="apogee-og-card__site">apogeeagrotech.com</span>
                <a href="{{ $url }}" class="apogee-og-card__cta">
                    Read on Apogee <span aria-hidden="true">→</span>
                </a>
            </div>
        </div>

        {{-- Text card --}}
        <div class="apogee-text-card">
            @if (!empty($item->created_at))
                <p class="apogee-text-card__date">{{ $item->created_at->format('d M Y') }}</p>
            @endif
            <h3 class="apogee-text-card__title">
                <a href="{{ $url }}">{{ $item->title }}</a>
            </h3>
            @if ($excerpt !== '')
                <p class="apogee-text-card__excerpt">{{ $excerpt }}</p>
            @endif
            <a href="{{ $url }}" class="apogee-text-card__more">
                Read More <span aria-hidden="true">→</span>
            </a>
        </div>
    </article>
@endif
