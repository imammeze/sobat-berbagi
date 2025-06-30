<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{!! $title !!}</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset('frontend/assets/images/logo.png') }}" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <style>
        body {
            background-color: #f8f9fa;
        }

        .btn-primary {
            background-color: #F68F27;
            border-color: #F68F27;
        }

        .btn-primary:hover {
            background-color: #F68F27;
            border-color: #F68F27;
        }

        .btn-primary:focus {
            background-color: #F68F27;
            border-color: #F68F27;
        }

        .btn-primary:active {
            background-color: #F68F27;
            border-color: #F68F27;
        }

        .btn-primary:active:focus {
            background-color: #F68F27;
            border-color: #F68F27;
        }
    </style>
</head>

<body>

    <div class="d-flex justify-content-center align-items-center flex-column vh-100">
        {{ $slot }}
        <x-ui.base-button color="primary" class="mt-3" href="{{ route('home') }}">
            Kembali ke Beranda
        </x-ui.base-button>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
</body>

</html>
