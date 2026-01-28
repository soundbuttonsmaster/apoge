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
                                <div class="area-box p-3 border rounded text-center shadow-sm h-100">
                                    @if($area->image)
                                        <div class="mb-3">
                                            <img src="{{ asset('uploads/areas/' . $area->image) }}" alt="{{ $area->name }}"
                                                class="img-fluid rounded" style="max-height: 150px; object-fit: cover;">
                                        </div>
                                    @endif
                                    <h5 class="m-0 mb-2">{{ $area->name }}</h5>
                                    @if($area->short_description)
                                        <p class="small text-muted mb-0">{{ Str::limit($area->short_description, 100) }}</p>
                                    @endif
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
        .area-box {
            transition: transform 0.3s, box-shadow 0.3s;
            background-color: #fff;
        }

        .area-box:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1) !important;
            border-color: #db5518 !important;
        }

        .area-box h5 {
            font-size: 16px;
            font-weight: 600;
        }
    </style>
@endsection