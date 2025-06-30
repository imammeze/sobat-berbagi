<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="description"
        content="Lazismu atau Lembaga Zakat Infaq dan Shadaqah Muhammadiyah adalah lembaga zakat tingkat nasional yang berkhidmat dalam pemberdayaan masyarakat">
    <title>{{ $title }}</title>

    <link rel="shortcut icon" type="image/png" href="{{ asset('frontend/assets/images/logo.png') }}" />

    <link rel="stylesheet" href="{{ asset('frontend/css/app.css') }}?v={{ uniqid() }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/custom.css') }}?v={{ uniqid() }}">

    <!-- PWA  -->
    <meta name="apple-mobile-web-app-title" content="Lazismu Banyumas">
    <meta name="application-name" content="Lazismu Banyumas">
    <meta name="theme-color" content="#fff" />
    <link rel="apple-touch-icon" href="{{ asset('frontend/assets/images/logo.png') }}">
    <link rel="manifest" href="{{ asset('manifest.json') }}">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <script src="https://kit.fontawesome.com/7b36f2302d.js" crossorigin="anonymous"></script>


    @stack('plugin-styles')

    @stack('styles')

    <style>
        body {
            overflow-x: hidden;
        }

        .main-wrapper {
            display: flex;
        }

        .sidebar {
            width: 240px;
            height: 100%;
            position: fixed;
            left: 0;
            top: 0;
            transition: width 0.1s ease, margin 0.1s ease-in-out;
            z-index: 999;
        }

        .main-wrapper .page-wrapper {
            min-height: 100vh;
            background: #f9fafb;
            width: calc(100% - 240px);
            margin-left: 240px;
            display: flex;
            flex-direction: column;
            transition: margin 0.1s ease, width 0.1s ease;
        }

        @media (max-width: 991.98px) {
            .sidebar {
                display: none !important;
            }

            .main-wrapper .page-wrapper {
                width: 100%;
                margin-left: 0;
            }
        }
    </style>
</head>

<body>
    {{ $addOn ?? '' }}

    <x-frontend.navbar />

    <div class="main-wrapper">


        <x-frontend.sidebar />

        <div class="page-wrapper">
            {{ $slot }}

        </div>
    </div>

    <x-frontend.mobile-navbar />

    <div class="mb-5"></div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="{{ asset('frontend/js/app.js') }}?v={{ uniqid() }}"></script>
    <script src="{{ asset('frontend/js/script.js') }}?v={{ uniqid() }}"></script>

    @stack('plugin-scripts')

    @stack('custom-scripts')

    <script src="{{ asset('sw.js') }}"></script>
    <script>
        if ("serviceWorker" in navigator) {
            // Register a service worker hosted at the root of the
            // site using the default scope.
            navigator.serviceWorker.register("/sw.js").then(
                (registration) => {
                    console.log("Service worker registration succeeded:", registration);
                },
                (error) => {
                    console.error(`Service worker registration failed: ${error}`);
                },
            );
        } else {
            console.error("Service workers are not supported.");
        }
    </script>
</body>

</html>
