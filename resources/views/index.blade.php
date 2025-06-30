<x-layouts.frontend title="Sobat Berbagi">
    @push('plugin-styles')
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
    @endpush

    @push('styles')
        <style>
            .bannerSwiper.swiper {
                width: 85%;
                height: 100%;
                border-radius: 1rem;
            }

            .bannerSwiper .swiper-slide {
                text-align: center;
                font-size: 18px;
                background: #fff;
                display: flex;
                justify-content: center;
                align-items: center;
                border-radius: 1rem;

            }

            .bannerSwiper .swiper-slide img {
                display: block;
                width: 100%;
                height: 100%;
                object-fit: cover;
                border-radius: 1rem;
            }

            .bannerSwiper .swiper-pagination {
                position: unset;
                text-align: left;
            }

            .bannerSwiper .swiper-pagination-bullet-active {
                background: #F68F27;
            }

            @media (max-width: 767px) {
                .bannerSwiper.swiper {
                    width: 95%;
                }
            }
        </style>
    @endpush

    <!-- ======= Slider Section ======= -->
    <x-frontend.banner>
        @foreach ($banners as $banner)
            <div class="swiper-slide" onclick="window.location.href='{{ $banner->link }}'">
                <img src="{{ asset($banner->desktop_image) }}" alt="banner"
                    class="d-none d-sm-none d-md-none d-lg-block">
                <img src="{{ asset($banner->mobile_image) }}" alt="banner"
                    class="d-block d-sm-block d-md-block d-lg-none">
            </div>
        @endforeach
    </x-frontend.banner>
    <!-- ======= End Slider Section ======= -->


    <!-- ======= Card Section ======= -->
    <div class="container py-5 ">
        <h1 class="section-heading">Mereka Butuh Bantuanmu</h1>
        <div class="campaign-container d-flex">
            @foreach ($campaigns as $campaign)
                <x-frontend.card.campaign :campaign="$campaign" />
            @endforeach
        </div>
        <div class="d-flex justify-content-center ">
            <x-button.primary-outline class="rounded-5 py-2 px-4 fw-bold w-sm-100"
                onclick="window.location.href='{{ route('campaign.index') }}'">
                Lihat Semua
            </x-button.primary-outline>
        </div>
    </div>
    <!-- ======= End Card Section ======= -->


    <!-- ======= Desktop Feature Section ======= -->
    <div class="container py-5 d-none d-sm-none d-md-block d-lg-block">
        <div class="row align-items-center">
            <div class="col-12 col-sm-12 col-md-12 col-lg-4">
                <h1 class="section-heading">Berbuat baik apa hari ini?</h1>
                <p>Setitik kebaikan bisa dimulai hari ini, Anda yang membuat perbedaan.</p>
                <img src="{{ asset('frontend/assets/images/homepage/feature-section.png') }}"
                    alt="Berbuat baik apa hari ini" class="img-fluid mt-4 rounded shadow-sm">
            </div>
            <div class="col-12 col-sm-12 col-md-6 col-lg-4 mt-5 mt-md-5 mt-lg-0">
                <x-frontend.card.feature image="{{ asset('frontend/assets/images/donasi-logo.svg') }}" title="Donasi"
                    caption="Aksi kebaikan sederhana, ulurkan tangan untuk meringankan beban mereka"
                    link="{{ route('campaign.index') }}" cta="Donasi Sekarang" />
                <x-frontend.card.feature image="{{ asset('frontend/assets/images/infaq-logo.svg') }}" title="Infaq"
                    caption="Berkah dalam setiap infaq, salurkan sumbangan melalui kami." link=""
                    cta="Infaq sekarang" class="mt-0 mt-sm-0 mt-md-5 mt-lg-5" />
            </div>
            <div class="col-12 col-sm-12 col-md-6 col-lg-4 mt-md-5 mt-lg-0">
                <x-frontend.card.feature image="{{ asset('frontend/assets/images/zakat-logo.svg') }}" title="Zakat"
                    caption="Langkah ringan, keberkahan besar. Bayar zakat dengan mudah melalui kami." link=""
                    cta="Zakat Sekarang" link="{{ route('zakat-calculator.index') }}" /> <x-frontend.card.feature
                    image="{{ asset('frontend/assets/images/kurban-logo.svg') }}" title="Kurban"
                    caption="Tunaikan kurban sesuai syarat Islam melalui bantuan kami." link=""
                    cta="Kurban sekarang" class="mt-0 mt-sm-0 mt-md-5 mt-lg-5" />
            </div>
        </div>
    </div>
    <!-- ======= End Desktop Feature Section ======= -->

    <!-- ======= Mobile Feature Section ======= -->
    <div class="container  d-block d-sm-block d-md-none d-lg-none ">
        <div class="row align-items-center">
            <div class="col-12 col-sm-12 col-md-12 col-lg-4">
                <h1 class="section-heading">Berbuat baik apa hari ini?</h1>
            </div>
            <div class="col-12 d-flex justify-content-between mt-3">
                <x-frontend.card.feature-mobile image="{{ asset('frontend/assets/images/ic-donasi-mobile.svg') }}"
                    title="Donasi" link="{{ route('campaign.index') }}" />
                <x-frontend.card.feature-mobile image="{{ asset('frontend/assets/images/ic-infaq-mobile.svg') }}"
                    title="Infaq" link="{{ route('campaign.index') }}" />
                <x-frontend.card.feature-mobile image="{{ asset('frontend/assets/images/ic-zakat-mobile.svg') }}"
                    title="Zakat" link="{{ route('zakat-calculator.index') }}" />
                <x-frontend.card.feature-mobile image="{{ asset('frontend/assets/images/ic-kurban-mobile.svg') }}"
                    title="Kurban" link="" />
            </div>

        </div>
    </div>
    <!-- ======= End Mobile Feature Section ======= -->

    <!-- ======= Banner Cta Section ======= -->
    <div class="container py-4">
        <x-frontend.banner-cta title="Berkah dalam berbagi, <br> mari membayar zakat hari ini" cta-1="Bayar zakatmu"
            cta-2="Hitung zakatmu" image="{{ asset('frontend/assets/images/cta-image.png') }}"
            link="{{ route('zakat-calculator.index') }}" />
    </div>
    <!-- ======= End Banner Cta Section ======= -->

    <!-- ======= Zakat Section ======= -->
    <div class="container py-5 zakat-container">
        <div class="swiper mySwiper">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <x-frontend.card.zakat title="Zakat Fitrah"
                        img="{{ asset('frontend/assets/images/zakat/zakat-fitrah.PNG') }}"
                        amount="{{ \App\Models\ZakatTransaction::where('status', 'success')->where('category_zakat', 'fitrah')->sum('amount') }}"
                        donatur="{{ \App\Models\ZakatTransaction::where('status', 'success')->where('category_zakat', 'fitrah')->count() }}"
                        url="{{ route('zakat-fitrah') }}" />
                </div>
                <div class="swiper-slide">
                    <x-frontend.card.zakat title="Zakat Mal"
                        img="{{ asset('frontend/assets/images/zakat/zakat-mal.jpg') }}"
                        amount="{{ \App\Models\ZakatTransaction::where('status', 'success')->where('category_zakat', 'mal')->sum('amount') }}"
                        donatur="{{ \App\Models\ZakatTransaction::where('status', 'success')->where('category_zakat', 'mal')->count() }}"
                        url="{{ route('zakat-maal') }}" />
                </div>
            </div>
        </div>


    </div>
    <!-- ======= End Zakat Section ======= -->

    <!-- ======= About Section ======= -->
    <section id="home-about"
        style="background: url('{{ asset('frontend/assets/images/homepage/bg-count-donasi.png') }}');">
        <div class=" py-5 position-relative about-section d-none d-sm-none d-md-block d-lg-block">
            <div class="orange-circle"></div>
            <div class="container">
                <h1 class="section-heading">Mengelola Zakat Dengan <br> Manajemen Modern</h1>
                <p class="mt-3">
                    LAZISMU adalah lembaga zakat tingkat nasional yang berkhidmat dalam <br> pemberdayaan masyarakat
                    melalui
                    pendayagunaan secara produktif dana zakat, <br> infaq, wakaf dan dana kedermawanan lainnya baik dari
                    perseorangan,
                    lembaga, <br> perusahaan dan instansi lainnya.
                </p>
                <x-button.primary class="rounded-5 mt-3">Tentang Kami</x-button.primary>
                <div class="d-flex mt-5 justify-content-between align-items-center gap-5">
                    <div class="about-left">
                        <div class="d-flex align-items-center about-item">
                            <img src="{{ asset('frontend/assets/images/icon/ic-program.svg') }}" alt="">
                            <div class="information">
                                <h1>
                                    {{ $campaigns->count() }}
                                </h1>
                                <p>Program Donasi</p>
                            </div>
                        </div>
                        <div class="d-flex align-items-center about-item mt-5">
                            <img src="{{ asset('frontend/assets/images/icon/ic-dana.svg') }}" alt="">
                            <div class="information">
                                <h1>
                                    Rp {{ number_format($campaigns->sum('raised')) }}
                                </h1>
                                <p>Total dana terkumpul</p>
                            </div>
                        </div>
                        <div class="d-flex align-items-center about-item mt-5">
                            <img src="{{ asset('frontend/assets/images/icon/ic-donator.svg') }}" alt="">
                            <div class="information">
                                <h1>
                                    {{ \App\Models\Donatur::count() }}
                                </h1>
                                <p>Donatur terdaftar</p>
                            </div>
                        </div>
                    </div>
                    <div class="about-right">
                        <img src="{{ asset('frontend/assets/images/cta-image-1.jpg') }}" alt="cta-image-1"
                            class="img-fluid">
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- ======= End About Section ======= -->

    <!-- ======= Artikel Section ======= -->
    <div class="container py-lg-5 mt-lg-5">
        <h1 class="section-heading text-center">Informasi Terbaru melalui Artikel dan Berita dari Kami</h1>
        <div class="section-article gap-5 mt-3">
            @foreach ($news as $new)
                <x-frontend.card.article :new="$new" />
            @endforeach
        </div>
        <div class="d-flex justify-content-center mt-5">
            <x-button.primary-outline class="rounded-5 py-2 px-4 fw-bold w-sm-100"
                onclick="window.location.href='{{ route('news.index') }}'">
                Lihat Semua
            </x-button.primary-outline>
        </div>
    </div>
    <!-- ======= End Artikel Section ======= -->

    <!-- ======= Banner Cta Section ======= -->
    <div class="container mt-5">
        <x-frontend.banner-cta title="Donasi Membawa Perubahan" cta-1="Jadi Donatur"
            image="{{ asset('frontend/assets/images/cta-donatur.png') }}"
            caption="Satu langkah kecil, banyak perubahan besar, mari bergabung dalam aksi <br> donasi untuk mewujudkan dampak positif yang luar biasa."
            link="{{ route('register') }}" />
    </div>
    <!-- ======= End Banner Cta Section ======= -->


    <!-- ======= Mitra Section ======= -->
    <div class="mitra-section container py-5 ">
        <div class="d-flex justify-content-between align-content-center">
            <div class="title-caption">
                <h1 class="section-heading">Satu Hati, Berbagi di Lazismu</h1>
                <p>
                    Bersama lebih dari 40 perusahaan yang telah bergabung dengan kami, mari bersama-sama <br>
                    menginspirasi
                    perubahan sosial melalui Program CSR Perusahaan Anda bersama Lazismu.
                </p>
            </div>
            <div class="flex-button align-items-center">
                <x-button.primary class="rounded-5 py-2 px-4"
                    onclick="window.location.href='{{ route('register-mitra') }}'">
                    Bekerjasama dengan kami
                </x-button.primary>
            </div>
        </div>
        <div class="d-none d-sm-none d-md-none d-lg-flex mt-5 justify-content-between align-items-center">
            <img src="{{ asset('frontend/assets/images/logo-mitra/Logo Masjid 17.png') }}" alt="logo"
                width="100">
            <img src="{{ asset('frontend/assets/images/logo-mitra/logo_rsu.png') }}" alt="logo" width="100">
            <img src="{{ asset('frontend/assets/images/logo-mitra/logo-abata.png') }}" alt="logo"
                width="100">
            <img src="{{ asset('frontend/assets/images/logo-mitra/logo-alitjihad.jpg') }}" alt="logo"
                width="100">
            <img src="{{ asset('frontend/assets/images/logo-mitra/logo-apotekk24.png') }}" alt="logo"
                width="100">
            <img src="{{ asset('frontend/assets/images/logo-mitra/logo-askrindo.jpeg') }}" alt="logo"
                width="100">
            <img src="{{ asset('frontend/assets/images/logo-mitra/logo-bmt.png') }}" alt="logo" width="100">
            <img src="{{ asset('frontend/assets/images/logo-mitra/logo-fikri.svg') }}" alt="logo"
                width="100">
            <img src="{{ asset('frontend/assets/images/logo-mitra/logo-long1-1.png') }}" alt="logo"
                width="100">

        </div>
        <div class="d-none d-sm-none d-md-none d-lg-flex mt-5 justify-content-between align-items-center">
            <img src="{{ asset('frontend/assets/images/logo-mitra/logo-mam.png') }}" alt="logo" width="100">
            <img src="{{ asset('frontend/assets/images/logo-mitra/logo-margono.png') }}" alt="logo"
                width="100">
            <img src="{{ asset('frontend/assets/images/logo-mitra/logo-mbs.jpeg') }}" alt="logo" width="100">
            <img src="{{ asset('frontend/assets/images/logo-mitra/logo-ponpes.png') }}" alt="logo"
                width="100">
            <img src="{{ asset('frontend/assets/images/logo-mitra/logo-rsi.webp') }}" alt="logo" width="100">
            <img src="{{ asset('frontend/assets/images/logo-mitra/logo-sdph.jpg') }}" alt="logo" width="100">

        </div>
        <div class="d-none d-sm-none d-md-none d-lg-flex mt-5 justify-content-between align-items-center">
            <img src="{{ asset('frontend/assets/images/logo-mitra/logo-sdump.png') }}" alt="logo"
                width="100">
            <img src="{{ asset('frontend/assets/images/logo-mitra/logo-smamu.png') }}" alt="logo"
                width="100">
            <img src="{{ asset('frontend/assets/images/logo-mitra/logosmkmuajb.png') }}" alt="logo"
                width="100">
            <img src="{{ asset('frontend/assets/images/logo-mitra/ORARI.png') }}" alt="logo" width="100">
            <img src="{{ asset('frontend/assets/images/logo-mitra/Pertamina.png') }}" alt="logo" width="100">
            <img src="{{ asset('frontend/assets/images/logo-mitra/PT IME.png') }}" alt="logo" width="100">
            <img src="{{ asset('frontend/assets/images/logo-mitra/RASI.png') }}" alt="logo" width="100">
            <img src="{{ asset('frontend/assets/images/logo-mitra/UMP Logo.png') }}" alt="logo" width="100">
        </div>
        <div class="d-flex d-sm-flex d-md-flex d-lg-none mt-5 flew-row justify-content-between align-items-center gap-3"
            style="overflow-x: scroll; flex-direction: row !important; flex-wrap: nowrap !important; -webkit-overflow-scrolling: touch;">
            <img src="{{ asset('frontend/assets/images/logo-mitra/Logo Masjid 17.png') }}" alt="logo"
                width="100">
            <img src="{{ asset('frontend/assets/images/logo-mitra/logo_rsu.png') }}" alt="logo" width="100">
            <img src="{{ asset('frontend/assets/images/logo-mitra/logo-abata.png') }}" alt="logo"
                width="100">
            <img src="{{ asset('frontend/assets/images/logo-mitra/logo-alitjihad.jpg') }}" alt="logo"
                width="100">
            <img src="{{ asset('frontend/assets/images/logo-mitra/logo-apotekk24.png') }}" alt="logo"
                width="100">
            <img src="{{ asset('frontend/assets/images/logo-mitra/logo-askrindo.jpeg') }}" alt="logo"
                width="100">
            <img src="{{ asset('frontend/assets/images/logo-mitra/logo-bmt.png') }}" alt="logo" width="100">
            <img src="{{ asset('frontend/assets/images/logo-mitra/logo-fikri.svg') }}" alt="logo"
                width="100">
            <img src="{{ asset('frontend/assets/images/logo-mitra/logo-long1-1.png') }}" alt="logo"
                width="100">
            <img src="{{ asset('frontend/assets/images/logo-mitra/logo-mam.png') }}" alt="logo" width="100">
            <img src="{{ asset('frontend/assets/images/logo-mitra/logo-margono.png') }}" alt="logo"
                width="100">
            <img src="{{ asset('frontend/assets/images/logo-mitra/logo-mbs.jpeg') }}" alt="logo" width="100">
            <img src="{{ asset('frontend/assets/images/logo-mitra/logo-ponpes.png') }}" alt="logo"
                width="100">
            <img src="{{ asset('frontend/assets/images/logo-mitra/logo-rsi.webp') }}" alt="logo" width="100">
            <img src="{{ asset('frontend/assets/images/logo-mitra/logo-sdph.jpg') }}" alt="logo" width="100">
            <img src="{{ asset('frontend/assets/images/logo-mitra/logo-sdump.png') }}" alt="logo"
                width="100">
            <img src="{{ asset('frontend/assets/images/logo-mitra/logo-smamu.png') }}" alt="logo"
                width="100">
            <img src="{{ asset('frontend/assets/images/logo-mitra/logosmkmuajb.png') }}" alt="logo"
                width="100">
            <img src="{{ asset('frontend/assets/images/logo-mitra/ORARI.png') }}" alt="logo" width="100">
            <img src="{{ asset('frontend/assets/images/logo-mitra/Pertamina.png') }}" alt="logo" width="100">
            <img src="{{ asset('frontend/assets/images/logo-mitra/PT IME.png') }}" alt="logo" width="100">
            <img src="{{ asset('frontend/assets/images/logo-mitra/RASI.png') }}" alt="logo" width="100">
            <img src="{{ asset('frontend/assets/images/logo-mitra/UMP Logo.png') }}" alt="logo" width="100">
        </div>
    </div>
    <!-- ======= End Mitra Section ======= -->


    @push('plugin-scripts')
        <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    @endpush

    @push('custom-scripts')
        <script>
            var swiper = new Swiper(".bannerSwiper", {
                pagination: {
                    el: ".swiper-pagination",

                },
                navigation: {
                    nextEl: ".swiper-button-next",
                    prevEl: ".swiper-button-prev",
                },
                autoplay: {
                    delay: 3000,
                },
                loop: true,
            });
        </script>
        <script>
            var swiper = new Swiper(".mySwiper", {
                slidesPerView: 2,
                spaceBetween: 20,
                centeredSlides: false,
                breakpoints: {
                    320: {
                        slidesPerView: 1.2,
                        spaceBetween: 10,
                    },
                    768: {
                        slidesPerView: 2,
                        spaceBetween: 20,
                        centeredSlides: true,
                        initialSlide: 1
                    },
                    1024: {
                        slidesPerView: 3,
                        spaceBetween: 20,
                        centeredSlides: false,

                    },
                },

            });
        </script>
    @endpush
</x-layouts.frontend>
