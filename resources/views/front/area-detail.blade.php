@extends('front.layouts.masterhome')
@section('section')
    <section class="flat-spacing-9">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="text-center mb-5">
                        <h2 class="heading">{{ $area->name }}</h2>
                    </div>

                    @if($area->image)
                        <div class="mb-5 text-center">
                            <img src="{{ asset('uploads/areas/' . $area->image) }}" alt="{{ $area->name }}"
                                class="img-fluid rounded shadow" style="max-height: 500px;">
                        </div>
                    @endif

                    <div class="content-area">
                        {!! $area->full_description !!}
                    </div>

                    <div class="mt-5 text-center">
                        <a href="{{ route('home.areas_we_cover') }}" class="tf-btn btn-fill animate-hover-btn">Back to All
                            Areas</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>
        .content-area {
            font-size: 16px;
            line-height: 1.8;
            color: #555;
        }
    </style>
@endsection