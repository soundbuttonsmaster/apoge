<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />

    <!-- Favicon Icon -->

    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Apogee Group | Admin</title>
    <link rel="shortcut icon" href="{{ asset('admin') }}/favicon.ico" />
    <link href="{{ asset('admin') }}/css/styles.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" crossorigin="anonymous"></script>
</head>

<body class="loginbg">
    <div id="layoutAuthentication" class="logincontainer">
        <div>
            <main>
                <div class="login_outer">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-6 offset-lg-3">
                                <form class="mt-4 pt-2" action="{{ url('admin-login') }}" method="post">
                                    @csrf

                                    @isset($data['error'])
                                        <div class="error"> {{ $data['error'] }} </div>
                                    @endisset
                                    <div class="card shadow-lg border-0 rounded-lg mt-3" style="background: #f3f0eb;">
                                        <div class="card-header d-flex align-items-center justify-content-center logo">
                                            <img src="{{ asset('admin') }}/images/logo.jpg" alt="">
                                        </div>
                                        <div class="card-body px-sm-5">
                                            <h5 class="text-center font-weight-bold">Admin Login</h5>
                                            <div class="frm-box">
                                                <label><i class="fa fa-envelope"></i></label>
                                                <input type="text" placeholder="Username" name="email">
                                                <div class="clear"></div>
                                                @if (!empty($errors))
                                                    <p style="color:red">{{ $errors->first('email') }}</p>
                                                @endif
                                            </div>
                                            <div class="frm-box">
                                                <label><i class="fa fa-lock"></i></label>
                                                <input type="password" placeholder="Password" name="password">
                                                <div class="clear"></div>
                                                @if (!empty($errors))
                                                    <p style="color:red">{{ $errors->first('password') }}</p>
                                                @endif
                                            </div>

                                            <div
                                                class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">


                                                <button class="button button-mat btn--7" type="submit">
                                                    <div class="psuedo-text">Login</div>
                                                </button>
                                                {{-- <a class="small" href="password.html">Forgot Password?</a> --}}

                                                <!-- <a class="btn btn-success btn--7" >Login</a> -->
                                            </div>
                                        </div>
                                    </div>
                                </form>



                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        <!--  <div id="layoutAuthentication_footer">
                <footer class="py-4 mt-auto fotr loginftr">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div>Copyright &copy; 2023 Dharini | All rights reserved</div>
                            <div>
                                <a href="https://www.akswebsoft.com/" title="AKS Websoft Consulting Pvt. Ltd." target="_blank"><img src="{{ asset('admin') }}/images/aks.png" alt="AKS Websoft Consulting Pvt. Ltd." class="powerd"></a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div> -->
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="{{ asset('admin') }}/js/scripts.js"></script>
</body>

</html>
