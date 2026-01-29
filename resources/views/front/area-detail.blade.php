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
                                class="img-fluid rounded shadow" style="width: 100%; height: 450px; object-fit: cover;">
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
            text-align: justify;
        }

        .content-area p {
            margin-bottom: 20px;
        }

        .tf-btn.btn-fill {
            background-color: #333;
            color: #fff;
            padding: 12px 30px;
            border-radius: 4px;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .tf-btn.btn-fill:hover {
            background-color: #db5518;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(219, 85, 24, 0.3);
        }
    </style>
@endsection