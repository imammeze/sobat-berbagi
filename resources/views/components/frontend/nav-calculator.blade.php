@push('styles')
    <style>
        .nav-item {
            transition: all 0.3s ease-in-out;
        }

        .nav-item:hover {
            border-bottom: 2px solid #FFC107;
        }

        .nav-item.active {
            border-bottom: 2px solid #FFC107;
        }


        .nav-link img {
            width: 40px;
            height: 40px;
        }

        @media (min-width: 768px) {
            .nav-pills-wrapper {
                width: 100%;
            }

            .navTab .nav {
                justify-content: center !important;
                align-items: center;
            }
        }
    </style>
@endpush

<div class="navTab mb-5">
    <ul class="nav nav-pills nav-pills-wrapper d-flex justify-content-start align-items-center overflow-x-scroll">
        <li class="nav-item {{ $active == 'penghasilan' ? 'active' : '' }}" role="presentation">
            <button class="nav-link d-flex flex-column align-items-center gap-2"
                onclick="window.location.href = '{{ route('zakat-calculator.index') }}'">
                <img src="{{ asset('frontend/assets/images/icon-calculator/ic-zakat-penghasilan.svg') }}" alt="">
                Penghasilan
            </button>
        </li>
        <li class="nav-item {{ $active == 'tabungan' ? 'active' : '' }}" role="presentation">
            <button class="nav-link d-flex flex-column align-items-center gap-2 "
                onclick="window.location.href = '{{ route('zakat-calculator.saving') }}'">
                <img src="{{ asset('frontend/assets/images/icon-calculator/ic-zakat-menabung.svg') }}" alt="">
                Tabungan
            </button>
        </li>
        <li class="nav-item {{ $active == 'emas' ? 'active' : '' }}" role="presentation">
            <button class="nav-link d-flex flex-column align-items-center gap-2 "
                onclick="window.location.href = '{{ route('zakat-calculator.gold') }}'">
                <img src="{{ asset('frontend/assets/images/icon-calculator/ic-zakat-emas.svg') }}" alt="">
                Emas
            </button>
        </li>
        <li class="nav-item {{ $active == 'perdagangan' ? 'active' : '' }}" role="presentation">
            <button class="nav-link d-flex flex-column align-items-center gap-2 "
                onclick="window.location.href = '{{ route('zakat-calculator.trading') }}'">
                <img src="{{ asset('frontend/assets/images/icon-calculator/ic-zakat-perdagangan.svg') }}"
                    alt="">
                Perdagangan
            </button>
        </li>
        </li>
        <li class="nav-item {{ $active == 'perusahaan' ? 'active' : '' }}" role="presentation">
            <button class="nav-link d-flex flex-column align-items-center gap-2 "
                onclick="window.location.href = '{{ route('zakat-calculator.company') }}'">
                <img src="{{ asset('frontend/assets/images/icon-calculator/ic-zakat-perusahaan.svg') }}"
                    alt="">
                Perusahaan
            </button>
        </li>
        <li class="nav-item {{ $active == 'pertanian' ? 'active' : '' }}" role="presentation">
            <button class="nav-link d-flex flex-column align-items-center gap-2 "
                onclick="window.location.href = '{{ route('zakat-calculator.farming') }}'">
                <img src="{{ asset('frontend/assets/images/icon-calculator/ic-zakat-pertanian.svg') }}" alt="">
                Pertanian
            </button>
        </li>
    </ul>
</div>
