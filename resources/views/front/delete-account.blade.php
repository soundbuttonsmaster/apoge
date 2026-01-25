@extends('front.layouts.masterhome')
@section('section')

<style>
    .step-list {
    counter-reset: step;
    padding-left: 0;
}

.step-list li {
    position: relative;
    padding-left: 40px;
    font-size: 16px;
    line-height: 1.6;
}

.step-number {
    width: 28px;
    height: 28px;
    line-height: 28px;
    text-align: center;
    border-radius: 50%;
    background-color: #dc3545;
    color: #fff;
    font-weight: bold;
    font-size: 14px;
    flex-shrink: 0;
}

</style>
    <!-- Page-title -->
    <div class="page-title page-contact-us">
        <div class="content-wrap">
            <div class="tf-container w-1290">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="content">
                            <h1 class="title">Delete Account</h1>
                            <div class="icon-img">
                                <img src="{{ asset('front') }}/images/item/line-throw-title.png" alt="Delete account decorative separator" style="width: auto; height: auto; max-width: 100%; object-fit: contain;">
                            </div>
                            <div class="breadcrumb">
                                <a href="{{ route('home') }}">Home</a>
                                <div class="icon">
                                    <i class="icon-arrow-right1"></i>
                                </div>
                                <a href="javascript:void(0)">Delete Account</a>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
    <!-- /.Page-title -->



    <!-- Delete Instructions Section -->
    <div class="main-content pt-0 pb-0 page-contact-us">
        <section class="s-contact-us style-2 bg-white pb-88">
            <div class="row mt-5">
                <div class="col-lg-8 offset-lg-2">
                    <div class="delete-account-instructions p-4 rounded shadow-sm bg-light">
                        <h3 class="mb-4 text-center text-danger"><i class="fa fa-warning me-2"></i>How to Delete Your
                            Account</h3>
                        <ul class="list-unstyled step-list">
                            <li class="mb-3 d-flex">
                                <span class="step-number me-3">1</span>
                                <span>Open the app.</span>
                            </li>
                            <li class="mb-3 d-flex">
                                <span class="step-number me-3">2</span>
                                <span>Go to <strong>Settings &gt; Delete My Account</strong>.</span>
                            </li>
                            <li class="mb-3 d-flex">
                                <span class="step-number me-3">3</span>
                                <span>Confirm the deletion.</span>
                            </li>
                            <li class="mb-3 d-flex">
                                <span class="step-number me-3">4</span>
                                <span>Your account and all associated data will be <strong>permanently
                                        deleted</strong>.</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!-- End Instructions -->
@endsection
