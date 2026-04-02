@extends('admin.layout.master')
@section('main-content')
    <section class="farmerCardWrapper hindiCoupon">
        <div class="farmerCard">
            <div class="farmerCardbg"><img src="{{ asset('admin') }}/images/farmer-card/farmer-cardbg.jpg" alt="img">
            </div>
            <div class="farmerCardContainer">
                <div class="farmercardLogo"><img src="{{ asset('admin') }}/images/farmer-card/card-logo-light.png" alt="logo" style="filter: none">
                </div>
                <div class="couponMainContent">
                    <div class="fcardContent">
                        <div class="ftitles">
                            <h4>{{ $farmerCard->name }}</h4>
                            <h2>{{ chunk_split($farmerCard->card_number, 4, ' ') }}</h2>
                        </div>
                        <div class="fcardexpriy">
                            <span>समाप्ति तिथि</span>
                            <h5>{{ \Carbon\Carbon::parse($farmerCard->expiry_date)->format('m-Y') }}</h5>
                        </div>
                        <div class="fcardprname">
                            <h2>एक निःशुल्क सर्विस</h2>
                            <!-- <h5>Product Name</h5> -->
                        </div>
                    </div>
                    <div class="fcardFooter">
                        <div class="fcardfooterCT">
                            <img src="{{ asset('admin') }}/images/farmer-card/fcardcall-icon.jpg" alt="icon" class="callicon">
                            <ul>
                                <li>+91 9760150034</li>
                            </ul>
                        </div>
                        <a href="https://www.apogeeagrotech.com/" class="farcardfooterlink"><img
                                src="{{ asset('front') }}/images/globe-icon.svg" alt="ic">www.apogeeagrotech.com</a>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <div style="text-align:center; margin:20px 0;">
        <button id="downloadBtn"
                    style="padding: 17px 100px; background: #f15a22; color: #fff; border:none; border-radius:5px; cursor:pointer; font-size: 20px;">
                    Download Coupon
                </button>
        <!-- Libraries -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

        <!-- Download Script -->
        <script>
            document.getElementById('downloadBtn').addEventListener('click', function() {
                const card = document.querySelector('.farmerCard');

                html2canvas(card, {
                    scale: 2
                }).then(canvas => {
                    const imgData = canvas.toDataURL('image/png');
                    const {
                        jsPDF
                    } = window.jspdf;
                    const pdf = new jsPDF('p', 'mm', 'a4');

                    const pdfWidth = pdf.internal.pageSize.getWidth();
                    const pdfHeight = (canvas.height * pdfWidth) / canvas.width;

                    pdf.addImage(imgData, 'PNG', 0, 10, pdfWidth, pdfHeight);
                    pdf.save('farmer-card.pdf');
                });
            });
        </script>
    @endsection
