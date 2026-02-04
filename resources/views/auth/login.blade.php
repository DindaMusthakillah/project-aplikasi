<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Login</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">

    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('css/sb-admin-2.min.css')}}" rel="stylesheet">
    <style>
        body.auth-bg {
            background: linear-gradient(120deg, rgba(78, 115, 223, 0.55), rgba(28, 200, 138, 0.45), rgba(78, 115, 223, 0.35));
            background-size: 200% 200%;
            animation: gradientShift 18s ease-in-out infinite;
        }
        @keyframes gradientShift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
    </style>

</head>

<body class="auth-bg">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-flex align-items-center justify-content-center" style="background: linear-gradient(135deg, #7aa2f7 0%, #5b7cda 60%, #4a62c0 100%); color: #fff;">
                                <div class="text-center px-4">
                                    <div style="font-size: 42px; font-weight: 700; letter-spacing: 1px;">SIDUK</div>
                                    <div style="opacity: 0.9; margin-top: 6px;">Sistem Informasi Data Kependudukan</div>
                                    <div style="opacity: 0.8; margin-top: 18px; font-size: 13px;">
                                        Kelola data penduduk, mutasi, dan laporan secara cepat dan rapi.
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                    </div>
                                    <!-- form login -->
                                    <form class="user" method="POST" action="{{ route('login.process') }}">
                                        @csrf
                                        <div class="form-group">
                                            <input type="email" 
                                                name="email" 
                                                class="form-control form-control-user"
                                                placeholder="Enter Email Address..." 
                                                value="{{ old('email') }}" required autofocus>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" 
                                                name="password" 
                                                class="form-control form-control-user"
                                                placeholder="Password" required>
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">Remember Me</label>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                            Login
                                        </button>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="#">Forgot Password?</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="{{ route('register') }}">Create an Account!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js')}}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('js/sb-admin-2.min.js')}}"></script>

</body>

</html>
