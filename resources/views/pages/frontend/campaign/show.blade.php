<x-layouts.frontend title="{{ $campaign->title }}" description="{{ $campaign->story }}"
    thumbnail="{{ asset($campaign->thumbnail) }}">
    @include('sweetalert::alert')

    @php
        $endDate = \Carbon\Carbon::parse($campaign->end_date);
        $now = \Carbon\Carbon::now();
        $daysAgoOrLeft = $endDate->isPast() ? 'hari yang lalu' : 'hari lagi';
    @endphp

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

            article img {
                width: 100%;
            }
        </style>
    @endpush


    {{-- mobile --}}
    <div class="view d-block d-md-none">
        <div class="position-relative ">
            <img src="{{ asset($campaign->thumbnail) }}" alt="campaign-img" class="img-fluid ">

            <div class="header-nav">
                <a href="{{ route('campaign.index') }}" class="text-decoration-none ">
                    <i class="bi bi-arrow-left fw-bold"></i>
                </a>
                <p id="campaign-name">{{ \Illuminate\Support\Str::limit($campaign->title, 35) }}</p>
            </div>
        </div>
        <div class="container mt-3">
            <h4>{{ $campaign->title }}</h4>
            <div class="d-flex flex-column">
                <h4 class="amount text-primary mb-0">
                    Rp. {{ number_format($campaign->raised, 0, ',', '.') }}
                </h4>
                <div class="d-flex mt-2 justify-content-between">
                    @php
                        $progress = ($campaign->raised / $campaign->target) * 100;

                        $progress = round($progress);
                    @endphp
                    <p>{{ $progress }}% Terkumpul dari target Rp.
                        {{ number_format($campaign->target, 0, ',', '.') }}
                    </p>
                    <p class="fw-bold">
                        {{ \Carbon\Carbon::parse($campaign->end_date)->diffInDays(\Carbon\Carbon::now()) }}
                        hari lagi
                    </p>
                </div>
            </div>
            <div class="progress mt-2">
                @php
                    $progress = ($campaign->raised / $campaign->target) * 100;
                @endphp

                <style>
                    .progress-bar-{{ $campaign->id }} {
                        width: 0;
                        height: 100%;
                        background-color: var(--primary);
                        animation: progressAnimation-{{ $campaign->id }} 1s cubic-bezier(0.42, 0, 0.58, 1) forwards;
                    }

                    @keyframes progressAnimation-{{ $campaign->id }} {
                        0% {
                            width: 0 !important;
                        }

                        25% {
                            width: {{ $progress * 0.25 }}%;
                        }
                    }
                </style>

                <div class="progress-bar-{{ $campaign->id }}" role="progressbar" style="width: {{ $progress }}%"
                    aria-valuenow="{{ $progress }}" aria-valuemin="0" aria-valuemax="100">
                </div>
            </div>
            <h5 class="mt-5 fw-bold">
                Informasi Penggalangan Dana
            </h5>
            <div class="card mt-2 shadow-sm">
                <div class="card-body ">
                    <h5>Penggalang Dana</h5>
                    <div class="d-flex align-items-center gap-3 mt-3">
                        <img src="{{ asset($campaign->mitra->logo) }}" alt="logo-mitra" width="40">
                        <h6 class="fw-bold mb-0">
                            <a href="{{ route('mitra.show', $campaign->mitra->slug) }}"
                                class="text-decoration-none text-dark">
                                {{ $campaign->mitra->name }}
                            </a>
                        </h6>
                    </div>
                </div>
            </div>
            <h5 class="mt-4 fw-bold">
                Cerita Penggalangan Dana
            </h5>
            <article id="storyMobile">
                {!! \Illuminate\Support\Str::markdown($campaign->story) !!}
                <div class="overlay"></div>
            </article>
            <div class="d-flex justify-content-center">
                <a class="text-decoration-none text-primary" id="btnReadMore">
                    Lihat Selengkapnya
                </a>
            </div>
            <h5 class="mt-4 fw-bold">
                Kabar Penggunaan Dana
            </h5>
            <div class="timeline {{ $campaign->latestNews->count() > 0 ? '' : 'show' }}">
                @forelse ($campaign->latestNews as $news)
                    <div class="timeline-item">
                        <p class="timeline-date">{{ $news->formattedDate }}</p>
                        <h5 class="timeline-title mt-3">{{ $news->title }}</h5>
                        <article>
                            {!! $news->content !!}
                        </article>
                    </div>
                    <div class="overlay"></div>

                @empty
                    <p>Belum ada kabar penggunaan dana</p>
                @endforelse
            </div>
            @if ($campaign->latestNews->count() > 0)
                <div class="d-flex justify-content-center">
                    <a class="text-decoration-none text-primary" id="btnReadMoreNews">
                        Lihat Selengkapnya
                    </a>
                </div>
            @endif
            <h5 class="mt-4 fw-bold">
                Donasi Terbaru
            </h5>
            <div class="d-flex flex-column gap-3">
                @foreach ($donations as $donation)
                    <div class="card border-0" style="background-color: #F6F7F9">
                        <div class="card-body">
                            <div class="d-flex align-items-center gap-3">
                                <img src="{{ optional($donation->user?->donaturRelation)->avatar 
                                    ? asset($donation->user->donaturRelation->avatar) 
                                    : asset('storage/users/avatar/profile-default.png') }}" 
                                alt="logo-mitra" width="40">                        
                                <div class="d-flex flex-column">
                                    <p>
                                        @if ($donation->is_anonymous == 1)
                                            Hamba Allah
                                        @else
                                            {{ $donation->user->donaturRelation->name }}
                                        @endif
                                    </p>
                                    <p class="text-primary fw-bold">
                                        Berdonasi sebesar Rp. {{ number_format($donation->amount, 0, ',', '.') }}
                                    </p>
                                    <p>
                                        {{ $donation->message }}
                                    </p>
                                    <p>
                                        {{ \Carbon\Carbon::parse($donation->created_at)->diffForHumans() }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                {{ $donations->links() }}
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
                    @if ($endDate->isFuture() && $campaign->raised < $campaign->target)
                        @auth
                            <x-button.primary class="rounded-5 w-100" id="btnDonationMobile">
                                Donasi Sekarang
                            </x-button.primary>
                        @else
                            <x-button.primary class="rounded-5 w-100" id="btnDonationMobile">
                                Donasi Sekarang
                            </x-button.primary>
                        @endauth
                    @else
                        <x-button.primary class="rounded-5
                                    w-100" disabled>
                            Donasi Sudah Ditutup
                        </x-button.primary>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- desktop --}}
    <div class="container mt-5 d-none d-md-block">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-7 col-lg-8">
                <img src="{{ asset($campaign->thumbnail) }}" alt="campaign-img" class="img-fluid rounded"
                    style="width: 100%; object-fit: cover; object-position: center">
                <ul class="nav nav-tabs mt-4" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home"
                            type="button" role="tab" aria-controls="home" aria-selected="true">Detail
                            Cerita</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="kabar-tab" data-bs-toggle="tab" data-bs-target="#kabar"
                            type="button" role="tab" aria-controls="kabar" aria-selected="false">Kabar
                            Penggunaan
                            Dana</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile"
                            type="button" role="tab" aria-controls="profile"
                            aria-selected="false">Donatur</button>
                    </li>

                </ul>
                <div class="tab-content mt-3" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab"
                        style="white-space: pre-line">
                        <article>
                            {!! $campaign->story !!}
                        </article>
                    </div>
                    <div class="tab-pane fadee" id="kabar" role="tabpanel" aria-labelledby="kabar-tab">
                        <div class="timeline">
                            @forelse ($campaign->latestNews as $news)
                                <div class="timeline-item">
                                    <p class="timeline-date">{{ $news->formattedDate }}</p>
                                    <h5 class="timeline-title mt-3">{{ $news->title }}</h5>
                                    <article>
                                        {!! $news->content !!}
                                    </article>
                                </div>
                            @empty
                                <p>Belum ada kabar penggunaan dana</p>
                            @endforelse
                        </div>
                    </div>
                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <div class="d-flex gap-3 mt-3 justify-content-between flex-column"
                            id="campaign-donations-list">
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
                        <h4 class="card-title">{{ $campaign->title }}</h4>
                        <div class="d-flex align-items-center gap-3 mt-3">
                            <img src="{{ asset('admin/assets/images/logo-laziz.png') }}" alt="logo-mitra"
                                width="40">
                            <p>
                                <a href="" class="text-decoration-none text-dark">
                                    {{ $campaign->mitra->name }}
                                </a>
                            </p>
                        </div>
                        <div class="d-flex justify-content-between mt-2">
                            <div class="d-flex flex-column">
                                <p>Terkumpul</p>
                                <h4 class="amount text-primary">
                                    Rp. {{ number_format($campaign->raised, 0, ',', '.') }}
                                </h4>
                            </div>
                        </div>
                        <div class="progress ">
                            @php
                                $progress = ($campaign->raised / $campaign->target) * 100;

                                $progress = round($progress);
                            @endphp

                            <style>
                                .progress-bar-{{ $campaign->id }} {
                                    width: 0;
                                    height: 100%;
                                    background-color: var(--primary);
                                    animation: progressAnimation-{{ $campaign->id }} 1s cubic-bezier(0.42, 0, 0.58, 1) forwards;
                                }

                                @keyframes progressAnimation-{{ $campaign->id }} {
                                    0% {
                                        width: 0 !important;
                                    }

                                    25% {
                                        width: {{ $progress * 0.25 }}%;
                                    }
                                }
                            </style>

                            <div class="progress-bar-{{ $campaign->id }}" role="progressbar"
                                style="width: {{ $progress }}%" aria-valuenow="{{ $progress }}"
                                aria-valuemin="0" aria-valuemax="100">
                            </div>
                        </div>
                        <div class="d-flex mt-2 justify-content-between">
                            <p><b>{{ $progress }}%</b> dari target
                                {{ number_format($campaign->target, 0, ',', '.') }}
                            </p>
                            @if ($endDate->isFuture())
                                <p class="fw-bold">
                                    {{ $endDate->diffInDays($now) }} {{ $daysAgoOrLeft }}
                                </p>
                            @else
                                <p class="fw-bold">
                                    Penggalangan dana selesai
                                </p>
                            @endif

                        </div>
                        @if ($endDate->isFuture() && $campaign->raised < $campaign->target)
                            @auth
                                @hasrole('donatur')
                                    <x-button.primary class="mt-4 w-100 rounded-5"
                                        onclick="window.location.href='{{ route('donation.create', $campaign->slug) }}'">
                                        Donasi Sekarang
                                    </x-button.primary>
                                @else
                                    <x-button.primary class="mt-4 w-100 rounded-5" disabled>
                                        Login Sebagai Donatur
                                    </x-button.primary>
                                @endhasrole
                            @else
                                @hasrole('donatur')
                                    <x-button.primary class="mt-4 w-100 rounded-5"
                                        onclick="window.location.href='{{ route('login', ['redirect' => route('donation.create', $campaign->slug)]) }}'">
                                        Donasi Sekarang
                                    </x-button.primary>
                                @else
                                    <x-button.primary class="mt-4 w-100 rounded-5"
                                        onclick="window.location.href='{{ route('login', ['redirect' => route('donation.create', $campaign->slug)]) }}'">
                                        Donasi Sekarang
                                    </x-button.primary>
                                @endhasrole
                            @endauth
                            <x-button.primary-outline class="mt-2 w-100 rounded-5 btnCopy">
                                <i class="bi bi-share me-2"></i>
                                Bagikan
                            </x-button.primary-outline>
                        @else
                            <x-button.primary class="rounded-5 w-100 mt-3" disabled>
                                Donasi Sudah Ditutup
                            </x-button.primary>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-ui.share-modal :route="route('campaign.show', $campaign->slug)" text="Ayo bantu {{ $campaign->title }} di {{ config('app.name') }}:%0A%0A" />

        <div class="donation-modal">
            <div class="d-flex flex-column justify-content-between">
                <div class="d-flex justify-content-end w-100">
                    <button type="button" class="btn-close" id="btnCloseDonationModal" aria-label="Close"></button>
                </div>
                <h6 class="text-center mb-3">Pilih Nominal Donasi</h6>
        
                @php
                    $nominals = [];
                    $isEvent = $campaign->type === 'event';
                    $fixedAmount = $campaign->fixed_amount ?? 0;

                    if ($isEvent) {
                        // Tambahkan nominal tambahan khusus untuk event
                        $nominals = [10000, 40000, 50000, 80000, 100000, 200000];
                    } else {
                        $nominals = [10000, 50000, 100000, 300000, 500000, 1000000];
                    }
                @endphp
        
                <div class="d-flex flex-column mb-3 gap-3">
                    @foreach ($nominals as $nom)
                        @php
                            // Nonaktifkan nominal jika:
                            // - Ini event dan nominal < fixed_amount
                            // - Nominal < 30.000 (baik event atau bukan)
                            $isDisabled = ($isEvent && $nom < $fixedAmount) || $nom < 30000;
                        @endphp
        
                        <div class="card card-nominal border-0 {{ $isDisabled ? 'disabled opacity-50' : '' }}" 
                            style="background-color: #F6F7F9" 
                            nom="{{ $nom }}"
                            onclick="{{ !$isDisabled ? 'selectNominal(' . $nom . ')' : '' }}">
                            <div class="card-body p-2 border-bottom">
                                <div class="d-flex justify-content-between">
                                    <h6 class="fw-bold">Rp. {{ number_format($nom, 0, ',', '.') }}</h6>
                                    <i class="bi bi-arrow-right"></i>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
        
                <input type="hidden" name="amount" id="amount" value="{{ $isEvent ? $fixedAmount : '' }}">
        
                @if (!$isEvent)
                    <x-input.text placeholder="Masukkan nominal donasi" 
                        label="Nominal Donasi Lainnya" 
                        id="amount_display"
                        class="amount-input" />
                @else
                    <x-input.text label="Nominal Donasi" id="amount_display" class="amount-input"
                        value="Rp. {{ number_format($fixedAmount, 0, ',', '.') }}" disabled />
                @endif
        
                <x-button.primary class="rounded-5 w-100" id="btnPayment">
                    Lanjutkan Pembayaran
                </x-button.primary>
            </div>
        </div>
        



    @push('custom-scripts')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
        {{-- <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
<script>
    function payWithMidtrans() {
        snap.pay('{{ $snapToken }}');
    }
</script> --}}
        <script>
            $(document).ready(function() {
                var API_KEY = "{{ env('API_KEY') }}";
                // console.log(API_KEY);
                
                if (!API_KEY || API_KEY === "null" || API_KEY === "undefined") {
                    function fetchDonations(page = 1) {
                        $.ajax({
                            url: `/api/campaigns/{{ $campaign->slug }}/donations?page=${page}`,
                            method: 'GET',
                            headers: {
                                "X-API-KEY": "BGS8JfH5Xk3aPmLq9RwTdNsVyZbC67WQYo",
                                "Accept": "application/json"
                            },
                            dataType: 'json',
                            success: function(response) {
                                displayDonations(response.data);
                                updatePaginationInfo(response.pagination);
                            },
                            error: function(error) {
                                console.log("Gagal mengambil data donasi:", error);
                            }
                        });
                    }
                } else {
                    function fetchDonations(page = 1) {
                        $.ajax({
                            url: `/api/campaigns/{{ $campaign->slug }}/donations?page=${page}`,
                            method: 'GET',
                            headers: {
                                "X-API-KEY": API_KEY,
                                "Accept": "application/json"
                            },
                            dataType: 'json',
                            success: function(response) {
                                displayDonations(response.data);
                                updatePaginationInfo(response.pagination);
                            },
                            error: function(error) {
                                console.log("Gagal mengambil data donasi:", error);
                            }
                        });
                    }
                }

                function displayDonations(donations) {

                    let html = '';
                    donations.forEach(function(donation) {
                        html += `
                    <div class=" d-flex align-items-center gap-3 mt-3 justify-content-between">
                        <div class="d-flex align-items-center gap-3">
                            <img src="${donation.avatar}" alt="logo-mitra" width="40">
                            <div class="d-flex flex-column">
                                <p>
                                    ${donation.is_anonymous == 1 ? 'Hamba Allah' : donation.name}
                                </p>
                                <p>
                                    ${donation.created_at}
                                </p>
                                <p>
                                    ${donation.message || ''}
                                </p>
                            </div>
                        </div>
                        <p class="text-end text-primary fw-bold">
                            Rp. ${donation.amount.toLocaleString('id-ID')}
                        </p>
                    </div>
                `;
                    });

                    $('#campaign-donations-list').html(html);
                }

                function updatePaginationInfo(pagination) {
                    $('#current-page').text(pagination.current_page);
                    $('#total-pages').text(pagination.total_pages);
                }

                // Initial load
                fetchDonations();

                // Optional: Implement pagination navigation
                $('#next-page').on('click', function() {
                    let currentPage = parseInt($('#current-page').text());
                    let totalPages = parseInt($('#total-pages').text());

                    if (currentPage < totalPages) {
                        fetchDonations(currentPage + 1);
                    }
                });

                $('#prev-page').on('click', function() {
                    let currentPage = parseInt($('#current-page').text());

                    if (currentPage > 1) {
                        fetchDonations(currentPage - 1);
                    }
                });
            });
        </script>

        <script>
            $(window).scroll(function() {
                if ($(window).scrollTop() >= 100) {
                    $('.header-nav').addClass('fixed-top');
                } else {
                    $('.header-nav').removeClass('fixed-top');
                }
            });
        </script>
        <script>
            function copyToClipboard() {
                var url = "{{ route('campaign.show', $campaign->slug) }}";

                if (navigator.clipboard) {
                    navigator.clipboard.writeText(url)
                        .then(function() {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: 'Link berhasil disalin',
                                showConfirmButton: false,
                                timer: 1500,
                                timerProgressBar: true
                            })
                        })
                        .catch(function(err) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal',
                                text: 'Browser tidak mendukung fitur ini',
                                showConfirmButton: false,
                                timer: 1500
                            })
                        });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        text: 'Browser tidak mendukung fitur ini',
                        showConfirmButton: false,
                        timer: 1500
                    })
                }
            }
        </script>
        <script>
            $('#btnDonationMobile').on('click', function() {
                $('.donation-modal').addClass('show');
                $('body').addClass('donation-modal-open');
            });

            $('#btnCloseDonationModal').on('click', function() {
                $('.donation-modal').removeClass('show');
                $('body').removeClass('donation-modal-open');
            });
        </script>

        <script>
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
                if ($(this).hasClass('disabled')) {
                    return;
                }

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
                let campaign = "{{ $campaign->slug }}";

                if (amount == '') {
                    alert('Nominal donasi tidak boleh kosong');
                } else {
                    var donation = {
                        amount: amount,
                        campaign: campaign
                    };

                    if (localStorage.getItem('donation')) {
                        localStorage.removeItem('donation');
                        localStorage.setItem('donation', JSON.stringify(donation));
                    } else {
                        localStorage.setItem('donation', JSON.stringify(donation));
                    }



                    window.location.href = "{{ route('donation.paymentMethod', $campaign->slug) }}";

                }
            });
        </script>
        <script>
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

            $('#btnReadMoreNews').on('click', function() {
                if ($('.timeline').hasClass('show')) {
                    $('.timeline').removeClass('show');
                    $('#btnReadMoreNews').text('Lihat Selengkapnya');
                    $('.timeline').append(`<div class="overlay"></div>`);
                } else {
                    $('.timeline').addClass('show');
                    $('#btnReadMoreNews').text('Lihat Lebih Sedikit');
                    $('.timeline').find('.overlay').remove();
                }
            });
        </script>
    @endpush
</x-layouts.frontend>
