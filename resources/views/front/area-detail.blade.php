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

        /* Reset Headings for Content Area */
        .content-area h1,
        .content-area h2,
        .content-area h3,
        .content-area h4,
        .content-area h5,
        .content-area h6 {
            font-family: "Nunito Sans", sans-serif;
            font-weight: 700;
            line-height: 1.3;
            margin-top: 30px;
            margin-bottom: 15px;
            color: #333;
            text-transform: none;
            /* Reset uppercase if global */
        }

        .content-area h1 {
            font-size: 32px;
        }

        .content-area h2 {
            font-size: 28px;
        }

        .content-area h3 {
            font-size: 24px;
        }

        .content-area h4 {
            font-size: 20px;
        }

        .content-area h5 {
            font-size: 18px;
        }

        .content-area h6 {
            font-size: 16px;
        }

        /* Reset Lists */
        .content-area ul {
            list-style: disc;
            margin-left: 20px;
            margin-bottom: 20px;
        }

        .content-area ol {
            list-style: decimal;
            margin-left: 20px;
            margin-bottom: 20px;
        }

        .content-area li {
            margin-bottom: 10px;
        }

        /* Reset Links */
        .content-area a {
            color: #db5518;
            text-decoration: underline;
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

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Remove animation classes that might come from copy-paste
            const contentArea = document.querySelector('.content-area');
            if (contentArea) {
                const elements = contentArea.querySelectorAll('*');
                elements.forEach(el => {
                    el.classList.remove('text-anime-style-1', 'text-anime-style-2', 'text-anime-style-3');
                });
            }
        });
    </script>
@endsection