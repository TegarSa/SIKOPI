<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SIKOPI - Sistem Informasi Koperasi Internal')</title>
    
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/custom.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #ffffff;
            margin: 0;
            padding: 0;
        }

        .topbar {
            font-size: 13px;
            color: #e5ded9;
        }

        .navbar-container {
            position: relative;
            z-index: 1030;
        }

        .custom-navbar {
            background: #fcfdfd !important;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
            border-radius: 4px;
        }

        .nav-link {
            color: #5d524f !important; 
            font-weight: 600;
            font-size: 15px;
            padding-top: 30px !important;
            padding-bottom: 30px !important;
            transition: color 0.2s;
        }

        .nav-link:hover {
            color: #162224 !important;
        }

        .btn-login-navbar:hover {
            background-color: #5d524f !important; 
        }

        .footer-global a {
            color: #8e847e;
            transition: all 0.2s ease;
        }

        .footer-global a:hover {
            color: #856053 !important;
            padding-left: 4px;
        }

        .footer-social-icon {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            border: 1px solid #5d524f;
            color: #e5ded9 !important;
            transition: all 0.3s ease;
        }

        .footer-social-icon:hover {
            background-color: #856053;
            border-color: #856053;
            color: #fcfdfd !important;
            transform: translateY(-2px);
        }

        .back-to-top-btn {
            box-shadow: 0 4px 14px rgba(133, 96, 83, 0.3);
            overflow: visible;
        }

        .progress-circle {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            transform: rotate(-90deg); 
            z-index: 1;
        }

        .progress-circle circle {
            opacity: 0.8; 
        }

        .back-to-top-btn:hover {
            background-color: #162224 !important;
            transform: translateY(-6px);
            box-shadow: 0 8px 24px rgba(22, 34, 36, 0.4);
        }

        .back-to-top-btn:hover .back-to-top-icon {
            transform: translateY(-2px);
        }

        .back-to-top-btn:hover .progress-circle circle {
            stroke: #856053; 
        }
    </style>
    @stack('css')
</head>
<body>

    @include('frontend.layouts.navbar')

    <main style="min-height: 60vh;">
        @yield('content')
    </main>

    @include('frontend.layouts.footer')

    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    
    <script src="{{ asset('frontend/js/custom.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
    
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            if (typeof feather !== 'undefined') {
                feather.replace();
            }
        });

        document.addEventListener("DOMContentLoaded", function () {
            const progressCircle = document.querySelector('.progress-circle circle');
            
            if (progressCircle) {
                window.addEventListener('scroll', () => {
                    const scrollTop = window.scrollY;
                    const docHeight = document.documentElement.scrollHeight - window.innerHeight;
                    
                    if (docHeight > 0) {
                        const scrollPercent = scrollTop / docHeight;
                        const offset = 290 - (scrollPercent * 290);
                        progressCircle.style.strokeDashoffset = offset;
                    }
                });
            }
        });
    </script>
    @stack('js')
</body>
</html>