<x-layouts.frontend title="Tentang Lazismu Banyumas">
    <x-frontend.header-section subheading="Tentang Kami" heading="Tentang Lazismu Banyumas"
        supporting-text="Temukan lebih banyak tentang Lazismu dan tim yang ada di baliknya" />

    <div class="container mt-5">
        <div class="d-flex mt-5 gap-5  align-items-center">
            <img src="{{ asset('frontend/assets/images/cta-image-1.jpg') }}" alt="cta-image-1" class="about-image">

            <div class="d-flex flex-column">
                <p class="text-primary">Kami telah membantu ribuan orang yang membutuhkan</p>
                <h1 class="fw-bold mb-5">Ini hanyalah awal dari <br> perjalanan kami.</h1>
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
        </div>

        <div class="d-flex justify-content-between align-items-center py-5">
            <div class="d-flex flex-column">
                <h6 class="text-primary">Kenal lebih dekat dengan kami</h6>
                <h1 class="fw-bold">Profil Lazismu Banyumas</h1>
                <p>Lembaga amil zakat, infak dan sedekah Muhammadiyah (Lazismu) Banyumas adalah lembaga nirlaba tingkat
                    kabupaten yang berkhidmat dalam pengelolaan dana zakat, infak,dan dana keagamaan lainnya baik dari
                    perseorangan maupun lembaga</p>
                <h6 class="mt-5">Waktu Berdiri</h6>
                <p>02 Oktober 2010 M. / 23 Syawal 1431 H</p>
            </div>
        </div>

        <img src="{{ asset('frontend/assets/images/Frame 2050.png') }}" alt="cta-image-1" class="img-fluid mt-5">

        <div class="d-flex justify-content-between  py-5">
            <div class="vision">
                <h1>Visi Kami</h1>
                <h6>Menjadi Lembaga Amil Zakat Terpercaya</h6>
            </div>
            <div class="mission">
                <h1>Misi Kami</h1>

                <ul>
                    <li>Optimalisasi kualitas pengelolaan ZIS yang amanah, professional, dan transparan.</li>
                    <li>Optimalisasi pendayagunaan ZIS yang kreatif, inovatif dan produktif.</li>
                    <li>Optimalisasi pelayanan donator.</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="container mt-5 pt-5">
        <h1 class="heading-contact">Hubungi Kami</h1>
        <p class="subheading-contact">Kami akan melakukan yang terbaik untuk segera menjawab pertanyaan Anda.</p>
        <div class="row mt-5">
            <div class="col">
                <div class="card card-contact border-0">
                    <div class="card-body">
                        <img src="{{ asset('frontend/assets/images/icon/Featured icon.svg') }}" alt="">
                        <h1 class="mt-3">Chat Kami</h1>
                        <p class="mb-2">Dengan senang hati membantu</p>
                        <a href="mailto:lazismu.bms@gmail.com">
                            lazismu.bms@gmail.com
                        </a>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card card-contact border-0">
                    <div class="card-body">
                        <img src="{{ asset('frontend/assets/images/icon/Featured icon.svg') }}" alt="">
                        <h1 class="mt-3">Kunjungi Kami</h1>
                        <p class="mb-2">Kunjungi kantor kami.</p>
                        <a href="">
                            Gedung Kantor Pimpinan Daerah Muhammadiyah Banyumas
                        </a>
                        <a href="">
                            Jalan dr. Angka No. 1, Sokanegara, Kec. Purwokerto Timur

                        </a>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card card-contact border-0">
                    <div class="card-body">
                        <img src="{{ asset('frontend/assets/images/icon/Featured icon.svg') }}" alt="">
                        <h1 class="mt-3">Hubungi Kami</h1>
                        <p class="mb-2">Melalui nomor dibawah ini.</p>
                        <a href="tel:+6281234567890">
                            (0281) 642 927
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('styles')
        <style>
            .about-image {
                width: 700px;
                height: 600px;
                object-fit: cover;
            }
        </style>
    @endpush

</x-layouts.frontend>
