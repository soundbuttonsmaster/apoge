@extends('front.layouts.masterhome')
@section('section')
    <section class="flat-spacing-9">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="heading-section text-center">
                        <h2 class="heading">Areas We Cover</h2>
                        <p class="sub-heading">We are providing our services in the following areas.</p>
                    </div>
                </div>
            </div>

            <div class="row mt-5">
                @if(isset($areas) && count($areas) > 0)
                    @foreach($areas as $area)
                        <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                            <a href="{{ route('home.area_detail', $area->slug) }}" class="text-decoration-none text-dark">
                                <div class="area-card h-100 shadow-sm">
                                    <div class="img-wrapper">
                                        @if($area->image)
                                            <img src="{{ asset('uploads/areas/' . $area->image) }}" alt="{{ $area->name }}" class="img-fluid">
                                        @else
                                             <img src="https://via.placeholder.com/400x300?text={{ $area->name }}" alt="{{ $area->name }}" class="img-fluid">
                                        @endif
                                        <div class="overlay">
                                            <span class="btn-view">View Details</span>
                                        </div>
                                    </div>
                                    <div class="card-content p-3 text-center">
                                        <h5 class="area-title mb-2">{{ $area->name }}</h5>
                                        @if($area->short_description)
                                            <p class="area-desc text-muted mb-0 small">{{ Str::limit($area->short_description, 80) }}</p>
                                        @endif
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                @else
                    <div class="col-12 text-center">
                        <p>No areas found.</p>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <style>
        .area-card {
            background: #fff;
            border-radius: 12px;
            overflow: hidden;
            border: 1px solid #eee;
            transition: all 0.4s ease;
            position: relative;
        }

        .area-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.1) !important;
            border-color: #db5518;
        }

        .img-wrapper {
            position: relative;
            height: 200px;
            overflow: hidden;
        }

        .img-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .area-card:hover .img-wrapper img {
            transform: scale(1.1);
        }

        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.3);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .area-card:hover .overlay {
            opacity: 1;
        }

        .btn-view {
            color: #fff;
            border: 1px solid #fff;
            padding: 8px 20px;
            border-radius: 30px;
            font-size: 14px;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 1px;
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(5px);
        }

        .area-title {
            font-weight: 700;
            font-size: 18px;
            color: #333;
            margin-top: 5px;
            transition: color 0.3s;
        }

        .area-card:hover .area-title {
            color: #db5518;
        }

        .area-desc {
            line-height: 1.5;
            color: #777;
        }
    </style>
@endsection