<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Aplikasi SIDUK</title>

    <!-- Fonts & CSS -->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
    <style>
        body {
            background: #f8f9fc;
        }
        #content-wrapper, #content {
            background: transparent !important;
        }
        .app-bg {
            position: relative;
            overflow: hidden;
            background: linear-gradient(120deg, rgba(78, 115, 223, 0.12), rgba(28, 200, 138, 0.10), rgba(78, 115, 223, 0.08));
            background-size: 200% 200%;
            animation: gradientShift 18s ease-in-out infinite;
        }
        .app-bg::before,
        .app-bg::after {
            content: "";
            position: absolute;
            width: 380px;
            height: 380px;
            border-radius: 50%;
            background: rgba(78, 115, 223, 0.12);
            filter: blur(2px);
            animation: floaty 14s ease-in-out infinite;
            z-index: 0;
        }
        .app-bg::before {
            top: -120px;
            left: -120px;
        }
        .app-bg::after {
            bottom: -140px;
            right: -140px;
            background: rgba(28, 200, 138, 0.12);
            animation-delay: 2s;
        }
        @keyframes gradientShift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        @keyframes floaty {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(12px); }
        }
        .app-content {
            position: relative;
            z-index: 1;
        }
        .card, .table, .alert {
            background-color: #ffffffee;
            backdrop-filter: blur(2px);
        }
        #accordionSidebar {
            background: linear-gradient(180deg, #7aa2f7 0%, #5b7cda 60%, #4a62c0 100%);
        }
        .app-footer {
            background: transparent;
        }
    </style>
</head>

<body id="page-top">
    <div id="wrapper" class="app-bg">
        




    
        {{-- Sidebar --}}
        @include('layouts.sidebar')

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                
                {{-- Navbar --}}
                @include('layouts.navbar')

                <!-- Main Content -->
                <div class="container-fluid app-content">
                    @yield('content')
                </div>
            </div>

            {{-- Footer --}}
            @include('layouts.footer')
        </div>
    </div>

    <!-- Script JS -->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>
    <script src="{{ asset('vendor/chart.js/Chart.min.js') }}"></script>
    @stack('scripts')
</body>
</html>
