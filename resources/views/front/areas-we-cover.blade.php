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
                            <div class="area-box p-3 border rounded text-center shadow-sm">
                                <h5 class="m-0">{{ $area->name }}</h5>
                            </div>
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