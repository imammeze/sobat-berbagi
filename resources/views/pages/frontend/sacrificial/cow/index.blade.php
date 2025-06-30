<x-layouts.frontend title="Kurban Sapi">
    @push('styles')
        <style>
            body.donation-modal-open .view {
                backdrop-filter: blur(4px);
                -webkit-backdrop-filter: blur(4px);
                filter: blur(4px);
                overflow: hidden;
            }

            .header-nav {
                z-index: 1;
                background: linear-gradient(to bottom, rgba(0, 0, 0, .7), rgba(0, 0, 0, 0.1));
                background-color: transparent;
                position: absolute;
                width: 100%;
                padding: 1rem;
                top: 0;
            }

            .header-nav a {
                color: #fff !important;
            }

            .header-nav #campaign-name {
                display: none;
            }

            .header-nav.fixed-top {
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                animation: fadeInDown 0.5s;
                background-color: #fff !important;
                background: transparent;
                display: flex;
                align-items: center;
                gap: 10px;
            }

            .header-nav.fixed-top a {
                color: #000 !important;
            }

            .header-nav.fixed-top #campaign-name {
                display: block;
                font-size: 1rem;
            }

            @keyframes fadeInDown {
                0% {
                    opacity: 0;
                    transform: translateY(-20px);
                }

                100% {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            .timeline {
                position: relative;
            }

            .timeline-item {
                position: relative;
                margin-bottom: 20px;
                padding-left: 20px;
                /* Add padding to the left for the timeline line */
            }

            .timeline-date {
                font-size: 14px;
                font-weight: bold;
                color: #333;
            }

            .timeline-title {
                font-size: 18px;
                font-weight: bold;
                color: #0066cc;
            }

            .timeline-item article p {
                font-size: 16px;
                color: #666;
            }

            .timeline-item article img {
                width: 500px;
                height: auto;
            }

            @media (max-width: 768px) {
                .timeline-item article img {
                    width: 100%;
                }
            }

            /* Style the connector line */
            .timeline-item:before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                /* Adjusted to 0 */
                width: 2px;
                height: 100%;
                background-color: #0066cc;
            }

            /* Style the connector dot */
            .timeline-item:after {
                content: '';
                position: absolute;
                top: 10px;
                left: -4px;
                /* Adjusted to -4px */
                width: 10px;
                height: 10px;
                background-color: #0066cc;
                border-radius: 50%;
            }
        </style>
    @endpush


    <div class="container mt-5 d-none d-md-block">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-7 col-lg-8">
                <img src="{{ asset('frontend/assets/images/thumbnail-qurban.jpg') }}" alt="campaign-img"
                    class="img-fluid rounded"
                    style="height: 400px; width: 100%; object-fit: cover; object-position: center">
                <ul class="nav nav-tabs mt-4" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home"
                            type="button" role="tab" aria-controls="home" aria-selected="true">Detail
                            Cerita</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile"
                            type="button" role="tab" aria-controls="profile" aria-selected="false">Donatur</button>
                    </li>
                </ul>
                <div class="tab-content mt-3" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    </div>
                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <div class="d-flex gap-3 mt-3 justify-content-between flex-column" id="campaign-donations-list">
                        </div>
                        <div id="pagination-info" class="d-flex mt-3 flex-column float-end">
                            <div class="d-flex align-items-center">
                                <button id="prev-page" class="btn btn-sm btn-outline-primary">
                                    <i class="bi bi-arrow-left"></i>
                                </button>
                                <p class="mx-2">Halaman <span id="current-page">1</span> dari <span
                                        id="total-pages">1</span></p>
                                <button id="next-page" class="btn btn-sm btn-outline-primary">
                                    <i class="bi bi-arrow-right"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-12 col-md-5 col-lg-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h4 class="card-title">Kurban Sapi</h4>
                        <div class="d-flex align-items-center gap-3 mt-3">
                            <img src="{{ asset('admin/assets/images/logo-laziz.png') }}" alt="logo-mitra"
                                width="40">
                            <p>
                                <a href="" class="text-decoration-none text-dark">
                                    Lazizmu Banyumas
                                </a>
                            </p>
                        </div>
                        <div class="d-flex justify-content-between mt-2">
                            <div class="d-flex flex-column">
                                <p>Terkumpul</p>
                                <h4 class="amount text-primary">
                                    Rp.
                                    {{ number_format(\App\Models\SacrificialTransaction::where('sacrificial_type', 'cow_personal')->sum('amount'), 0, ',', '.') }}
                                </h4>
                            </div>
                        </div>
                        @auth
                            @hasrole('donatur')
                                <x-button.primary class="mt-4 w-100 rounded-5"
                                    onclick="window.location.href='{{ route('kurban.cow') }}'">
                                    Kurban Sekarang
                                </x-button.primary>
                            @else
                                <x-button.primary class="mt-4 w-100 rounded-5" disabled>
                                    Login Sebagai Donatur
                                </x-button.primary>
                            @endhasrole
                        @else
                            @hasrole('donatur')
                                <x-button.primary class="mt-4 w-100 rounded-5"
                                    onclick="window.location.href='{{ route('login', ['redirect' => route('kurban.cow')]) }}'">
                                    Kurban Sekarang
                                </x-button.primary>
                            @else
                                <x-button.primary class="mt-4 w-100 rounded-5"
                                    onclick="window.location.href='{{ route('login', ['redirect' => route('kurban.cow')]) }}'">
                                    Kurban Sekarang
                                </x-button.primary>
                            @endhasrole
                        @endauth
                        <x-button.primary-outline class="mt-2 w-100 rounded-5 btnCopy">
                            <i class="bi bi-share me-2"></i>
                            Bagikan
                        </x-button.primary-outline>
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{-- mobile --}}
    <div class="view d-block d-md-none">
        <div class="position-relative ">
            <img src="{{ asset('frontend/assets/images/thumbnail-qurban.jpg') }}" alt="campaign-img" class="img-fluid ">

            <div class="header-nav">
                <a href="{{ route('kurban.index') }}" class="text-decoration-none ">
                    <i class="bi bi-arrow-left fw-bold"></i>
                </a>
                <p id="campaign-name">
                    Kurban Sapi
                </p>
            </div>
        </div>
        <div class="container mt-3">
            <h4>
                Kurban Sapi
            </h4>
            <div class="d-flex flex-column">
                <h4 class="amount text-primary mb-0">
                    Rp.
                    {{ number_format(\App\Models\SacrificialTransaction::where('sacrificial_type', 'cow_personal')->sum('amount'), 0, ',', '.') }}
                </h4>
            </div>
            <h5 class="mt-5 fw-bold">
                Informasi Penggalangan Dana
            </h5>
            <div class="card mt-2 shadow-sm">
                <div class="card-body ">
                    <h5>Penggalang Dana</h5>
                    <div class="d-flex align-items-center gap-3 mt-3">
                        <img src="{{ asset('admin/assets/images/logo-laziz.png') }}" alt="logo-mitra" width="40">
                        <h6 class="fw-bold mb-0">
                            <a href="#" class="text-decoration-none text-dark">
                                Lazizmu Banyumas
                            </a>
                        </h6>
                    </div>
                </div>
            </div>
            <h5 class="mt-4 fw-bold">
                Cerita Penggalangan Dana
            </h5>
            <article id="storyMobile">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptates natus voluptatum atque dicta
                molestias tempora est similique quas, consectetur laboriosam itaque molestiae consequatur delectus
                ipsam, quaerat aliquam quam, quod dolores.
                <div class="overlay"></div>
            </article>
            <div class="d-flex justify-content-center">
                <a class="text-decoration-none text-primary" id="btnReadMore">
                    Lihat Selengkapnya
                </a>
            </div>
            <h5 class="mt-4 fw-bold">
                Donasi Terbaru
            </h5>
            <div class="d-flex flex-column gap-3">

            </div>
        </div>
        <div class="card w-100 position-fixed bottom-0 bg-white shadow-lg p-3 border-0">

            <div class="row">
                <div class="col-5">
                    <x-button.primary-outline class="rounded-5 w-100 btnCopy">
                        <i class="bi bi-share me-2"></i>
                        Bagikan
                    </x-button.primary-outline>
                </div>
                <div class="col-7">
                    @auth
                        <x-button.primary class="rounded-5 w-100" id="btnDonationMobile">
                            Kurban Sekarang
                        </x-button.primary>
                    @else
                        <x-button.primary class="rounded-5 w-100" id="btnDonationMobile">
                            Kurban Sekarang
                        </x-button.primary>
                    @endauth
                </div>
            </div>
        </div>
    </div>

    <x-ui.share-modal :route="route('kurban.cow')" text="Ayo berkurban di {{ config('app.name') }}:%0A%0A" />

    <div class="donation-modal">
        <div class="d-flex flex-column justify-content-between ">
            <div class="d-flex justify-content-end w-100">

                <button type="button" class="btn-close" id="btnCloseDonationModal" aria-label="Close"></button>

            </div>
            <h6 class="text-center mb-3">Pilih Jenis Kurban</h6>
            <div class="d-flex flex-column mb-3 gap-3">
                <div class="card card-nominal border-0" style="background-color: #F6F7F9" nom="24500000">
                    <div class="card-body p-2 border-bottom">
                        <div class="d-flex justify-content-between">
                            <h6 class="fw-bold">
                                Sapi 1 Ekor (24.500.000)
                            </h6>
                            <i class="bi bi-arrow-right"></i>
                        </div>
                    </div>
                </div>

                <div class="card card-nominal border-0" style="background-color: #F6F7F9" nom="3500000">
                    <div class="card-body p-2 border-bottom">
                        <div class="d-flex justify-content-between">
                            <h6 class="fw-bold">
                                Sapi Rombongan (3.500.000)
                            </h6>
                            <i class="bi bi-arrow-right"></i>
                        </div>
                    </div>
                </div>
            </div>
            <input type="hidden" name="amount" id="amount">
            <x-input.text placeholder="Masukkan nominal donasi" id="amount_display" class="amount-input" disabled />
            <x-button.primary class="rounded-5 w-100" id="btnPayment">
                Lanjutkan Pembayaran
            </x-button.primary>
        </div>
    </div>

    @push('custom-scripts')
        <script>
            $(window).scroll(function() {
                if ($(window).scrollTop() >= 100) {
                    $('.header-nav').addClass('fixed-top');
                } else {
                    $('.header-nav').removeClass('fixed-top');
                }
            });

            $('#btnDonationMobile').on('click', function() {
                $('.donation-modal').addClass('show');
                $('body').addClass('donation-modal-open');
            });

            $('#btnCloseDonationModal').on('click', function() {
                $('.donation-modal').removeClass('show');
                $('body').removeClass('donation-modal-open');
            });

            function formatRupiah(angka, prefix) {
                var number_string = angka.replace(/[^,\d]/g, '').toString(),
                    split = number_string.split(','),
                    sisa = split[0].length % 3,
                    rupiah = split[0].substr(0, sisa),
                    ribuan = split[0].substr(sisa).match(/\d{3}/g);

                if (ribuan) {
                    separator = sisa ? '.' : '';
                    rupiah += separator + ribuan.join('.');
                }

                rupiah = split[1] !== undefined ? rupiah + ',' + split[1] : rupiah;
                return prefix === undefined ? rupiah : rupiah ? 'Rp ' + rupiah : '';
            }

            $('.card-nominal').on('click', function() {
                let nominal = $(this).attr('nom');
                $('#amount').val(nominal);
                $('#amount_display').val(formatRupiah(nominal, 'Rp '));
            });

            $('#amount_display').on('input', function() {
                let nominal = $(this).val();
                $('#amount_display').val(formatRupiah(nominal, 'Rp '));
                $('#amount').val(parseInt(nominal.replace(/[^\d]/g, '')));
            });

            $('#btnPayment').on('click', function() {
                let amount = $('#amount').val();
                let sacrificeType = 'kurban-sapi-rombongan';

                if (amount == '') {
                    alert('Nominal tidak boleh kosong');
                } else {
                    if(amount == 24500000) {
                        sacrificeType = 'kurban-sapi-1-ekor';
                    } else {
                        sacrificeType = 'kurban-sapi-rombongan';
                    }

                    var sacrifice = {
                        amount: amount,
                        sacrifice_type: sacrificeType
                    };

                    if (localStorage.getItem('sacrifice')) {
                        localStorage.removeItem('sacrifice');
                        localStorage.setItem('sacrifice', JSON.stringify(sacrifice));
                    } else {
                        localStorage.setItem('sacrifice', JSON.stringify(sacrifice));
                    }

                    if(sacrificeType === 'kurban-sapi-rombongan') {
                        window.location.href = "{{ route('kurban.paymentMethod', 'kurban-sapi-rombongan') }}";
                    } else {
                        window.location.href = "{{ route('kurban.paymentMethod', 'kurban-sapi-1-ekor') }}";
                    }
                }
            });

            $('#btnReadMore').on('click', function() {
                if ($('#storyMobile').hasClass('show')) {
                    $('#storyMobile').removeClass('show');
                    $('#btnReadMore').text('Lihat Selengkapnya');
                    $('#storyMobile').append(`<div class="overlay"></div>`);
                } else {
                    $('#storyMobile').addClass('show');
                    $('#btnReadMore').text('Lihat Lebih Sedikit');
                    $('#storyMobile').find('.overlay').remove();
                }
            });
        </script>
    @endpush
</x-layouts.frontend>
