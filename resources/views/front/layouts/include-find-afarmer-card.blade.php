        <!-- Page-title -->
        <div class="page-title page-about-us">
            <!--    <div class="rellax" data-rellax-speed="5">
                <img src="{{ asset('front') }}/images/page-title/about-us.jpg" alt="">
            </div> -->
            <div class="content-wrap">
                <div class="tf-container w-1290">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="content">

                                <h1 class="title">
                                    Farmer Coupon
                                </h1>
                                <div class="icon-img">
                                    <img src="{{ asset('front') }}/images/item/line-throw-title.png" alt="">
                                </div>
                                <div class="breadcrumb">
                                    <a href="{{ route('home') }}">Home</a>
                                    <div class="icon">
                                        <i class="icon-arrow-right1"></i>
                                    </div>
                                    <a href="javascript:void(0)">Farmer Coupon</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div><!-- /.Page-title -->

        <!-- Main-content -->
       

        <!--</div><!-- /.Main-content -->-->

   <div class="main-content pb-0 pt-93">
            <section style="display:none">
                <div class="odometer style-5">1000</div>
            </section>
        
            <section class="farmerCardWrapper hindiCoupon">
                <div class="farmerCard">
                    <div class="farmerCardbg">
                    <!-- <img src="images/farmer-cardbg.jpg" alt="img">  -->
                    <div class="farmerCardContainer">
                        <div class="farmercardLogo"><img src="{{ asset('front') }}/images/card-logo-light.png" alt="logo"></div>
                        <div class="couponMainContent">
                          <div class="fcardContent">
                            <div class="ftitles">
                              <h4>{{ $farmerCard->name }}</h4>
                              <h2>{{ chunk_split($farmerCard->card_number, 4, ' ') }}</h2>
                            </div>
                            <div class="fcardexpriy">
                                <span>समाप्ति तिथि</span><h5>{{ \Carbon\Carbon::parse($farmerCard->expiry_date)->format('m-Y') }}</h5>
                            </div>
                            <div class="fcardprname">
                                <h2>एक निःशुल्क सर्विस</h2>
                                <!-- <h5>Product Name</h5> -->
                            </div>
                        </div>
                        <div class="fcardFooter">
                            <div class="fcardfooterCT">
                              <img src="{{ asset('front') }}/images/fcardcall-icon.jpg" alt="icon" class="callicon">
                              <ul>
                                  <li>+91 9760150035,</li>
                                  <li>+91 9557592525</li>
                              </ul>
                            </div>
                            <a href="https://www.apogeeagrotech.com/" class="farcardfooterlink"><img src="{{ asset('front') }}/images/globe-icon.svg" alt="ic">www.apogeeagrotech.com</a>
                        </div>
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
            </div>
        
             <!-- <section class="farmerCardWrapper">
                <div class="farmerCard">
                    <div class="farmerCardbg"><img src="images/farmer-cardbg.jpg" alt="img"></div>
                    <div class="farmerCardContainer">
                        <div class="farmercardLogo"><img src="images/card-logo.png" alt="logo"></div>
                        <div class="fcardContent">
                            <div class="ftitles">
                                <h2>0000 0000 0000 0000</h2>
                                <h4>CUSTOMER NAME</h4>
                            </div>
                            <div class="fcardexpriy">
                                <span>EXPIRY DATE</span><h5>12-2025</h5>
                            </div>
                            <div class="fcardprname">
                                <h2>ONE FREE SERVICE</h2>
                                <h5>Product Name</h5>
                            </div>
                        </div>
                        <div class="fcardFooter">
                            <div class="fcardfooterCT">
                              <img src="images/fcardcall-icon.jpg" alt="icon" class="callicon">
                              <ul>
                                  <li>+91 9760150035,</li>
                                  <li>+91 9557592525</li>
                              </ul>
                            </div>
                            <a href="https://www.apogeeagrotech.com/" class="farcardfooterlink"><img src="images/globe-icon.svg" alt="ic">www.apogeeagrotech.com</a>
                        </div>
                        
                    </div>
                </div>
            </section>
         -->
        
        
        
        
        </div><!-- /.Main-content -->



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
