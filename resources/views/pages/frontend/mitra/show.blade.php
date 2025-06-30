<x-layouts.frontend title="{{ $mitra->name }}">
    @push('styles')
        <style>
            .logo {
                width: 100px;
                height: 100px;
                border-radius: 50%;
                padding: 1rem;
                display: flex;
                justify-content: center;
                align-items: center;
                background-color: #fff;
            }

            .campaign-card {
                cursor: pointer;
                transition: all 0.3s ease-in-out;
            }

            .campaign-card:hover {
                transform: translateY(-5px);
            }

            .nav-tabs .nav-link {
                color: #000;
                border: none;
                border-bottom: 2px solid transparent;
                transition: all 0.3s ease-in-out;
            }
        </style>
    @endpush
    <div class="container ">
        <div class="d-none d-sm-none d-md-flex d-lg-flex align-items-center gap-3">
            <div class="logo">
                <img src="{{ $mitra->logo }}" alt="" class="img-fluid">
            </div>
            <div class="information d-flex flex-column align-items-start">
                <h5 class="text-center mt-3">
                    {{ $mitra->name }}
                </h5>
                <div class="d-flex gap-4 justify-content-start">
                    <div class="d-flex align-items-center gap-2">
                        <i class="fas fa-check bg-primary text-white rounded-circle p-1"></i>
                        Terverifikasi
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <i class="fas fa-calendar-alt"></i>
                        Bergabung sejak {{ $mitra->created_at->diffForHumans() }}
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <i class="fas fa-heart"></i>
                        Memiliki {{ $mitra->campaigns->count() }} campaign
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex d-sm-flex d-md-none d-lg-none gap-3 justify-content-center flex-column align-items-center">
            <div class="logo">
                <img src="{{ $mitra->logo }}" alt="" class="img-fluid">
            </div>
            <h5 class="text-center">
                {{ $mitra->name }}
            </h5>
            <p class="text-center text-muted">
                Bergabung sejak {{ $mitra->created_at->diffForHumans() }}
            </p>
            <p class="text-center">
                Memiliki {{ $mitra->campaigns->count() }} campaign
            </p>
        </div>
        <ul class="nav nav-tabs mt-3" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button
                    class="nav-link {{ request()->is('mitra-kami/' . $mitra->slug) && !request()->query('tab') ? 'active' : '' }}"
                    onclick="window.location.href='{{ route('mitra.show', ['slug' => $mitra->slug]) }}'">
                    Campaign
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link {{ request()->query('tab') == 'tentang' ? 'active' : '' }}"
                    onclick="window.location.href='{{ route('mitra.show', ['slug' => $mitra->slug, 'tab' => 'tentang']) }}'">
                    Tentang
                </button>

            </li>
        </ul>
        <div class="tab-content mt-3" id="myTabContent">
            <div
                class="tab-pane fade {{ request()->is('mitra-kami/' . $mitra->slug) && !request()->query('tab') ? 'show active' : '' }}">
                <div class="row">
                    @foreach ($mitra->campaigns as $campaign)
                        <div class="col-12 col-md-4 col-lg-3 mt-5">
                            <div class="card border-0 campaign-card shadow-sm"
                                onclick="window.location.href='{{ route('campaign.show', $campaign->slug) }}'">
                                <img src="{{ asset($campaign->thumbnail) }}" class="card-img-top"
                                    alt="thumbnail-campaign">
                                <div class="card-body p-2 d-flex flex-column justify-content-between">
                                    <h6 class="card-title">
                                        <a href="{{ route('campaign.show', $campaign->slug) }}"
                                            class="text-decoration-none text-dark">
                                            {{ $campaign->title }}
                                        </a>
                                    </h6>
                                    <div class="d-flex align-items-center gap-3 mt-3">
                                        <img src="{{ asset($campaign->mitra->logo) }}" alt="logo-mitra" width="40">
                                        <p>
                                            <a href="" class="text-decoration-none text-dark">
                                                {{ $campaign->mitra->name }}
                                            </a>
                                        </p>
                                    </div>
                                    <div class="progress mt-3">
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

                                        <div class="progress-bar-{{ $campaign->id }}" role="progressbar"
                                            style="width: {{ $progress }}%" aria-valuenow="{{ $progress }}"
                                            aria-valuemin="0" aria-valuemax="100">
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between mt-2">
                                        <div class="d-flex flex-column">
                                            <p>Terkumpul</p>
                                            <h6 class="amount">
                                                Rp. {{ number_format($campaign->raised, 0, ',', '.') }}
                                            </h6>
                                        </div>
                                        <div class="d-flex flex-column">
                                            <p>Sisa hari</p>
                                            <p class="fw-bold">
                                                @php
                                                    $endDate = \Carbon\Carbon::parse($campaign->end_date);
                                                    $now = \Carbon\Carbon::now();
                                                    $daysAgoOrLeft = $endDate->isPast()
                                                        ? 'hari yang lalu'
                                                        : 'hari lagi';
                                                @endphp
                                                {{ $endDate->diffInDays($now) }} {{ $daysAgoOrLeft }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="tab pane fade {{ request()->query('tab') == 'tentang' ? 'show active' : '' }}">
                {{ \Illuminate\Mail\Markdown::parse($mitra->description) }}
            </div>
        </div>
    </div>
</x-layouts.frontend>
