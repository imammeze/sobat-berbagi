<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }}</title>
    <link rel="shortcut icon" href="{{ asset('frontend/assets/images/logo.png') }}" type="image/x-icon">


    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    <!-- End fonts -->

    <!-- plugin css -->
    <link href="{{ asset('admin/assets/fonts/feather-font/css/iconfont.css') }}" rel="stylesheet" />
    <link href="{{ asset('admin/assets/plugins/perfect-scrollbar/perfect-scrollbar.css') }}" rel="stylesheet" />
    <!-- end plugin css -->

    @stack('plugin-styles')

    <!-- common css -->
    <link href="{{ asset('admin/css/app.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('admin/css/custom.css') }}">
    <!-- end common css -->

    <!-- PWA  -->
    <meta name="apple-mobile-web-app-title" content="Lazismu Banyumas">
    <meta name="application-name" content="Lazismu Banyumas">
    <meta name="theme-color" content="#fff" />
    <link rel="apple-touch-icon" href="{{ asset('frontend/assets/images/logo.png') }}">
    <link rel="manifest" href="{{ asset('manifest.json') }}">

    @stack('style')

</head>

<body>

    <div class="main-wrapper" id="app">
        <div class="page-wrapper full-page">

            @include('sweetalert::alert')


            {{ $slot }}

        </div>
    </div>

    <!-- base js -->
    <script src="{{ asset('admin/js/app.js') }}"></script>
    <script src="{{ asset('admin/assets/plugins/feather-icons/feather.min.js') }}"></script>
    <!-- end base js -->

    <!-- plugin js -->
    @stack('plugin-scripts')
    <!-- end plugin js -->

    <!-- common js -->
    <script src="{{ asset('admin/assets/js/template.js') }}"></script>
    <!-- end common js -->

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

    @stack('custom-scripts')
</body>

</html>
