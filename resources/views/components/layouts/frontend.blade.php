<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="description"
        content="{{ $description ?? 'Lazismu atau Lembaga Zakat Infaq dan Shadaqah Muhammadiyah adalah lembaga zakat tingkat nasional yang berkhidmat dalam pemberdayaan masyarakat' }}">
    <title>{{ $title }}</title>
    
    <!-- Google tag - Monitoring Bagas -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-N81C69GQZ8"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
    
      gtag('config', 'G-N81C69GQZ8');
    </script>

    <script type="application/ld+json">
        [ {
        "@context" : "http://schema.org",
        "@type" : "SoftwareApplication",
        "name" : "Sobat Berbagi by Lazismu Banyumas",
        "image" : "",
        "url" : "https://sobatberbagi.com/",
        "author" : {
            "@type" : "Owner",
            "name" : "Bagas Surahman"
        },
        "author" : {
            "@type" : "Person",
            "name" : "Muhamad Rafli Al Farizqi"
        },
        "author" : {
            "@type" : "Person",
            "name" : "Priyo Aldo"
        },
        "publisher" : {
            "@type" : "Organization",
            "name" : "PT KOLABORASI BERSAMA TEKNOLOGI - Upcolab"
        },
        "applicationCategory" : "Platform Crowdfunding"
        }, {
        "@context" : "http://schema.org",
        "@type" : "SoftwareApplication",
        "name" : "Sobat Berbagi by Lazismu Banyumas
        "image" : "",
        "url" : "https://sobatberbagi.com/",
        "author" : {
            "@type" : "Owner",
            "name" : "Bagas Surahman"
        },
        "author" : {
            "@type" : "Person",
            "name" : "Muhamad Rafli Al Farizqi"
        },
        "author" : {
            "@type" : "Person",
            "name" : "Priyo Aldo"
        },
        "publisher" : {
            "@type" : "Organization",
            "name" : "LAZISMU BANYUMAS"
        },
        "publisher" : {
            "@type" : "Organization",
            "name" : "PIMPINAN DAERAH MUHAMADIYAH BANYUMAS"
        },
        "applicationCategory" : "Platform Crowdfunding"
        } ]
    </script>
    <script type="application/ld+json">
        {
        "@context" : "http://schema.org",
        "@type" : "Organization",
        "name" : "Sobat Berbagi by Lazismu Banyumas",
        "url" : "https://sobatberbagi.com/",
        }
    </script>

    <link rel="shortcut icon" href="{{ asset('frontend/assets/images/logo.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('frontend/css/app.css') }}?v={{ uniqid() }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/custom.css') }}?v={{ uniqid() }}">

    <!-- Facebook Meta Tags -->
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">
    <meta property="og:title" content="{{ $title }}" />
    <meta property="og:description"
        content="{{ $description ?? 'Lazismu atau Lembaga Zakat Infaq dan Shadaqah Muhammadiyah adalah lembaga zakat tingkat nasional yang berkhidmat dalam pemberdayaan masyarakat' }}" />
    <meta property="og:image" content="{{ $thumbnail ?? asset('frontend/assets/images/logo.png') }} " />


    <!-- Twitter Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta property="twitter:domain" content="{{ url()->current() }}">
    <meta property="twitter:url" content="{{ url()->current() }}">
    <meta name="twitter:title" content="{{ $title }}">
    <meta name="twitter:description"
        content="{{ $description ?? 'Lazismu atau Lembaga Zakat Infaq dan Shadaqah Muhammadiyah adalah lembaga zakat tingkat nasional yang berkhidmat dalam pemberdayaan masyarakat' }}">
    <meta name="twitter:image" content="{{ $thumbnail ?? asset('frontend/assets/images/logo.png') }}">

    <!-- PWA  -->
    <meta name="apple-mobile-web-app-title" content="Lazismu Banyumas">
    <meta name="application-name" content="Lazismu Banyumas">
    <meta name="theme-color" content="#fff" />
    <link rel="apple-touch-icon" href="{{ asset('frontend/assets/images/logo.png') }}">
    <link rel="manifest" href="{{ asset('manifest.json') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    @stack('plugin-styles')

    @stack('styles')

</head>

<body>

    <x-frontend.navbar />

    @include('sweetalert::alert')
    {{ $slot }}

    <x-frontend.mobile-navbar />

    <x-frontend.footer />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="{{ asset('frontend/js/app.js') }}?v={{ uniqid() }}"></script>
    <script src="{{ asset('frontend/js/script.js') }}?v={{ uniqid() }}"></script>

    <script src="https://kit.fontawesome.com/58d8ad1c47.js" crossorigin="anonymous"></script>

    @stack('plugin-scripts')

    @stack('custom-scripts')

    {{-- <script src="{{ asset('sw.js') }}"></script> --}}
 
    <script>
        if ($(window).width() > 768) {
            var Tawk_API = Tawk_API || {},
                Tawk_LoadStart = new Date();
            (function() {
                var s1 = document.createElement("script"),
                    s0 = document.getElementsByTagName("script")[0];
                s1.async = true;
                s1.src = 'https://embed.tawk.to/65926c2f0ff6374032bad6bc/1hj1vd6t4';
                s1.charset = 'UTF-8';
                s1.setAttribute('crossorigin', '*');
                s0.parentNode.insertBefore(s1, s0);
            })();
        }
    </script>
</body>

</html>
