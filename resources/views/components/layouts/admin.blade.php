<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Admin' }}</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset('frontend/assets/images/logo.png') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    <!-- End fonts -->

    <!-- plugin css -->
    <link href="{{ asset('admin/assets/fonts/feather-font/css/iconfont.css') }}?v={{ uniqid() }}"
        rel="stylesheet" />
    <link href="{{ asset('admin/assets/plugins/perfect-scrollbar/perfect-scrollbar.css') }}?v={{ uniqid() }}"
        rel="stylesheet" />
    <!-- end plugin css -->

    @stack('plugin-styles')

    <!-- common css -->
    <link href="{{ asset('admin/css/app.css') }}?v={{ uniqid() }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('admin/css/custom.css') }}?v={{ uniqid() }}">
    <!-- end common css -->

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />


    @stack('style')

    @stack('head-scripts')

</head>

<body>
    <div class="main-wrapper" id="app">
        <x-admin.sidebar />
        <div class="page-wrapper">
            <x-admin.header />
            <div class="page-content">
                @include('sweetalert::alert')
                {{ $slot }}
            </div>
        </div>
    </div>

    <!-- base js -->
    <script src="{{ asset('admin/js/app.js') }}"></script>
    <script src="{{ asset('admin/assets/plugins/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('admin/assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <!-- end base js -->

    <!-- plugin js -->
    @stack('plugin-scripts')
    <!-- end plugin js -->

    <!-- common js -->
    <script src="{{ asset('admin/assets/js/template.js') }}"></script>
    <!-- end common js -->

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


    @stack('custom-scripts')
</body>

</html>
