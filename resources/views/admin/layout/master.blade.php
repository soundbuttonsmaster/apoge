<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Apogee Group | Admin</title>
    <link href="{{ asset('admin') }}/css/styles.css" rel="stylesheet" />
    <link href="{{ asset('admin') }}/css/all.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet"
        crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" crossorigin="anonymous"></script>
    
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="{{ asset('admin/css/additional-fonts.css') }}">

    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">


    <style>
        #reqioredf {
            color: red;
            font-size: 15px;
        }
    </style>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <a class="navbar-brand logo2" href="{{ route('admin.dashboard') }}"><img
                src="{{ asset('admin') }}/images/logo.jpg" alt="logo image"></a>
        <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i
                class="fas fa-bars"></i></button>
        <div class="col-sm-5 d-flex flex-sm-row-reverse">
            <h4 class="panelhd">Admin Panel</h4>
        </div>
        <!-- Navbar Search-->
        <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
        </form>
        <!-- Navbar-->
        <ul class="navbar-nav ml-auto ml-md-0">
            <li class="nav-item dropdown"> <a class="nav-link dropdown-toggle" id="userDropdown" href="#"
                    role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                        class="fas fa-user fa-fw"></i></a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                    <h6 class="pl-3">Welcome Admin!</h6>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{ url('admin/change-password') }}">Change Password</a> <a
                        class="dropdown-item" href="{{ route('admin.logout') }}">Logout</a>
                </div>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading"></div>
                        <a class="nav-link {{ Route::is('admin.dashboard' ? 'active' : '') }}"
                            href="{{ route('admin.dashboard') }}">
                            <div class="sb-nav-link-icon"> <i class="fas fa-tachometer-alt"></i></div>
                            Dashboard
                        </a>

                        <a class="nav-link {{ Route::is('admin.header_content.create') ? 'active' : '' }}"
                            href="{{ route('admin.header_content.create') }}">
                            <div class="sb-nav-link-icon"><i class="fa fa-search"></i></div>
                            Header Content
                        </a>


                        <a class="nav-link collapsed {{ Route::is('admin.category.create') || Route::is('admin.sub_category.create') ? 'active' : '' }}"
                            href="#" data-toggle="collapse" data-target="#category" aria-expanded="false"
                            aria-controls="collapsePages">
                            <div class="sb-nav-link-icon"><i class="fab fa-buffer"></i></div>
                            Category
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>


                        <div class="collapse" id="category" aria-labelledby="headingTwo"
                            data-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">

                                <a class="nav-link" href="{{ route('admin.category.create') }}">Add Category</a>
                                <a class="nav-link" href="{{ route('admin.sub_category.create') }}">Add Sub
                                    Category</a>


                            </nav>
                        </div>







                        <a class="nav-link collapsed {{ Route::is('admin.product.create') || Route::is('admin.product.list') ? 'active' : '' }}"
                            href="#" data-toggle="collapse" data-target="#product" aria-expanded="false"
                            aria-controls="collapsePages">
                            <div class="sb-nav-link-icon"><i class="fab fa-buffer"></i></div>
                            Products
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="product" aria-labelledby="headingTwo"
                            data-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages"> <a
                                    class="nav-link" href="{{ route('admin.product.create') }}">Add Product</a> <a
                                    class="nav-link" href="{{ route('admin.product.list') }}">View Product</a> </nav>
                        </div>
                        <a class="nav-link collapsed {{ Route::is('admin.session.create') || Route::is('admin.group.create') || Route::is('admin.gallery.create') || Route::is('admin.video_gallery.create') || Route::is('admin.blog.create') ? 'active' : '' }}"
                            href="#" data-toggle="collapse" data-target="#media" aria-expanded="false"
                            aria-controls="collapsePages">
                            <div class="sb-nav-link-icon"><i class="fa fa-file-image"></i></div>
                            Media
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="media" aria-labelledby="headingTwo"
                            data-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">

                                <a class="nav-link" href="{{ route('admin.session.create') }}">Add Session</a>
                                <a class="nav-link" href="{{ route('admin.group.create') }}">Add Group</a>
                                <a class="nav-link" href="{{ route('admin.gallery.create') }}">Add Image Gallery</a>
                                <a class="nav-link" href="{{ route('admin.video_gallery.create') }}">Add Video
                                    Gallery</a>
                                <a class="nav-link" href="{{ route('admin.blog.create') }}">Add Blog</a>



                            </nav>
                        </div>
                        <a class="nav-link {{ Route::is('admin.testimonial.create') ? 'active' : '' }}"
                            href="{{ route('admin.testimonial.create') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-star-half-alt"></i></div>
                            Testimonials
                        </a>
                        <!-- <a class="nav-link" href="clients.html">
            <div class="sb-nav-link-icon"><i class="fa fa-users"></i></div>
            Clients </a>  -->
                        <a class="nav-link {{ Route::is('admin.become_a_dealer') ? 'active' : '' }}"
                            href="{{ route('admin.become_a_dealer') }}">
                            <div class="sb-nav-link-icon"><i class="fab fa-buffer"></i></div>
                            Become a Dealer view
                        </a>
                        <a class="nav-link {{ Route::is('admin.find_a_dealer') ? 'active' : '' }}""
                            href="{{ route('admin.find_a_dealer') }}">
                            <div class="sb-nav-link-icon"><i class="fa fa-user"></i></div>
                            Find a Dealer view
                        </a>
                        <a class="nav-link {{ Route::is('admin.dealer.create') ? 'active' : '' }}""
                            href="{{ route('admin.dealer.create') }}">
                            <div class="sb-nav-link-icon"><i class="fa fa-user"></i></div>
                            Add Dealer
                        </a>


                        <a class="nav-link {{ Route::is('admin.enquriy_list') ? 'active' : '' }}""
                            href="{{ route('admin.enquriy_list') }}">
                            <div class="sb-nav-link-icon"><i class="far fa-window-restore"></i></div>
                            Enquiry View
                        </a>
                        
                          <a class="nav-link {{ Route::is('admin.farmer_registration_list') ? 'active' : '' }}""
                        href="{{ route('admin.farmer_registration_list') }}">
                        <div class="sb-nav-link-icon"><i class="far fa-window-restore"></i></div>
                        Farmer Registration
                    </a>
                        
                        <a class="nav-link {{ Route::is('admin.subscribe.subscribe') ? 'active' : '' }}""
                        href="{{ route('admin.subscribe.subscribe') }}">
                        <div class="sb-nav-link-icon"><i class="far fa-window-restore"></i></div>
                        Subscribe
                    </a>


                    </div>
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">



            @yield('main-content')

            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div>Copyright &copy; 2025 Apogee Group | All rights reserved</div>
                        <div><a href="https://www.akswebsoft.com/" title="AKS Websoft Consulting Pvt. Ltd."
                                target="_blank"><img src="{{ asset('admin') }}/images/aks2.png"
                                    alt="AKS Websoft Consulting Pvt. Ltd." class="powerd"></a></div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="{{ asset('admin') }}/js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="{{ asset('admin') }}/assets/demo/chart-area-demo.js"></script>
    <script src="{{ asset('admin') }}/assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
    <script src="{{ asset('admin') }}/assets/demo/datatables-demo.js"></script>




    <script type="text/javascript" src="https://parsleyjs.org/dist/parsley.js"></script>
    <!---------------- Toaster ------------------->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        @if (Session::has('message'))
            var type = "{{ Session::get('alert-type', 'info') }}"
            switch (type) {
                case 'info':
                    toastr.info("{{ Session::get('message') }}");
                    break;
                case 'success':
                    toastr.success("{{ Session::get('message') }}");
                    break;
                case 'warning':
                    toastr.warning("{{ Session::get('message') }}");
                    break;
                case 'error':
                    toastr.error("{{ Session::get('message') }}");
                    break;
            }
        @endif
    </script>
</body>

</html>
