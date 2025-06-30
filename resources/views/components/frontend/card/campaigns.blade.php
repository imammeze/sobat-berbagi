<div class="col-12 col-md-6 col-lg-4 mt-3">
    <div class="card border-0 campaign-card d-none d-md-flex d-lg-flex shadow-sm"
     onclick="window.location.href='{{ $campaign->type === 'event' ? route('event.show', $campaign->slug) : route('campaign.show', $campaign->slug) }}'">
        <img src="{{ asset($campaign->thumbnail) }}" class="card-img-top" alt="thumbnail-campaign">
        <div class="card-body p-2 d-flex flex-column justify-content-between">
            <h6 class="card-title">
                <a href="{{ $campaign->type === 'event' ? route('event.show', $campaign->slug) : route('campaign.show', $campaign->slug) }}" class="text-decoration-none text-dark">
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

                <div class="progress-bar-{{ $campaign->id }}" role="progressbar" style="width: {{ $progress }}%"
                    aria-valuenow="{{ $progress }}" aria-valuemin="0" aria-valuemax="100">
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
                            $daysAgoOrLeft = $endDate->isPast() ? 'hari yang lalu' : 'hari lagi';
                        @endphp
                        {{ $endDate->diffInDays($now) }} {{ $daysAgoOrLeft }}
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="border-0 campaign-card-mobile d-flex d-md-none d-lg-none justify-content-between gap-3"
        onclick="window.location.href='{{ $campaign->type === 'event' ? route('event.show', $campaign->slug) : route('campaign.show', $campaign->slug) }}'">
        <img src="{{ asset($campaign->thumbnail) }}" class="card-img-top" alt="thumbnail-campaign">
        <div class="d-flex flex-column ">
            <p class="card-title">
                <a href="{{ $campaign->type === 'event' ? route('event.show', $campaign->slug) : route('campaign.show', $campaign->slug) }}" class="text-decoration-none text-dark">
                    {{ Str::limit($campaign->title, 30) }}
                </a>
            </p>
            <p>
                <a href="{{ route('mitra.show', $campaign->mitra->slug) }}" class="text-decoration-none text-primary">
                    {{ $campaign->mitra->name }}
                </a>
            </p>
            <div class="progress mt-2" style="height: 5px !important;">
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
            <div class="d-flex justify-content-between mt-2">
                <div class="d-flex flex-column">
                    <p class="text-dark">Terkumpul</p>
                    <p class="text-dark fw-bold">
                        Rp. {{ number_format($campaign->raised, 0, ',', '.') }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
