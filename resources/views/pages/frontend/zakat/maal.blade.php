<x-layouts.frontend title="Zakat Maal" description="Zakat Maal"
    thumbnail="{{ asset('frontend/assets/images/zakat/zakat-mal.jpg') }}">
    @include('sweetalert::alert')



    @push('styles')
        <style>
            body.donation-modal-open .view {
                backdrop-filter: blur(4px);
                -webkit-backdrop-filter: blur(4px);
                filter: blur(4px);
                overflow: hidden;
            }
        </style>
    @endpush


    {{-- mobile --}}
    <div class="view d-block d-md-none">
        <div class="position-relative">
            <img src="{{ asset('frontend/assets/images/zakat/zakat-mal.jpg') }}" alt="campaign-img"
                class="img-fluid w-100">
            <div class="position-absolute top-0 start-0 mt-3 ms-3">
                <a href="{{ route('campaign.index') }}" class="text-decoration-none text-white">
                    <i class="bi bi-arrow-left"></i>
                </a>
            </div>
        </div>
        <div class="container mt-3">
            <h4>
                Zakat Mal
            </h4>
            <div class="d-flex flex-column">
                <p>Terkumpul</p>

                <h4 class="amount text-primary mb-0">
                    {{ 'Rp ' . number_format(\App\Models\ZakatTransaction::where('status', 'success')->sum('amount'), 0, ',', '.') }}
                </h4>

            </div>

            <h5 class="mt-4 fw-bold">
                Cerita Penggalangan Dana
            </h5>
            <article>
                Tunaikan kewajiban zakat dan ajukan bantuan untuk kerabat terdekat.
                Zakat penghasilan atau zakat profesi atau zakat pendapatan adalah bagian dari zakat maal yang wajib
                dikeluarkan atas harta yang berasal dari pendapatan/penghasilan rutin dari pekerjaan yang tidak
                melanggar syariah.
                <br>
                <br>

                Berdasarkan Fatwa Majelis Ulama Indonesia (MUI), penghasilan yang dimaksud adalah setiap pendapatan
                seperti gaji, honorarium, upah, jasa, dan lain-lainnya yang diperoleh dengan cara halal, baik rutin
                seperti pejabat negara, pegawai, karyawan, maupun tidak rutin seperti dokter, pengacara, konsultan, dan
                sejenisnya, serta pendapatan yang diperoleh dari pekerjaan bebas lainnya.
                <br>
                <br>

                Jika nishab dan haul zakatmu telah terpenuhi, mari sisihkan sebagian hartamu untuk bantu banyak
                masyarakat yang membutuhkan. InsyaAllah zakat yang kamu tunaikan mensucikan hartamu setahun kebelakang
                dan mendapat keberkahan untuk setahun kedepan.
                <br>
                <br>

                Bagaimana cara menghitung zakat penghasilan?
                Setiap bulan kamu dapat tunaikan zakat dari penghasilanmu. Besar Nishab (batas minimum) per bulan setara
                dengan nilai 1/12 dari 85 gram emas (harga emas pada hari dimana zakat akan ditunaikan), dengan kadar
                2,5%. Apabila penghasilanmu setiap bulan telah melebihi nilai nishab, zakat penghasilan wajib
                dikeluarkan.
                <br>
                <br>

                Jika pendapatan tidak rutin waktu dan jumlahnya, kamu bisa menghitung hasil pendapatan selama 1 tahun,
                kemudian zakat ditunaikan apabila penghasilan bersihnya sudah cukup nishab (batas minimum) yaitu harga
                85 gram emas dengan kadar 2,5%.
                <br>
                <br>

            </article>
            <h5 class="mt-4 fw-bold">
                Donasi Terbaru
            </h5>
            {{-- <div class="d-flex flex-column gap-3">
                @foreach ($donations as $donation)
                    <div class="card border-0" style="background-color: #F6F7F9">
                        <div class="card-body">
                            <div class="d-flex align-items-center gap-3">
                                <img src="{{ asset($donation->user->donaturRelation->avatar) }}" alt="logo-mitra"
                                    width="40">
                                <div class="d-flex flex-column">
                                    <p>
                                        @if ($donation->is_anonymous == 1)
                                            Hamba Allah
                                        @else
                                            {{ $donation->user->donaturRelation->name }}
                                        @endif
                                    </p>
                                    <p class="text-end text-primary fw-bold">
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
            </div> --}}

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
                    <a href="{{ route('zakat-calculator.index') }}" class="btn btn-primary w-100 rounded-5">
                        <i class="bi bi-calculator me-2"></i>
                        Hitung Zakat
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- desktop --}}
    <div class="container mt-5 d-none d-md-block">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-7 col-lg-8">
                <img src="{{ asset('frontend/assets/images/zakat/zakat-mal.jpg') }}" alt="campaign-img"
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
                        Tunaikan kewajiban zakat dan ajukan bantuan untuk kerabat terdekat.
                        Zakat penghasilan atau zakat profesi atau zakat pendapatan adalah bagian dari zakat maal
                        yang wajib
                        dikeluarkan atas harta yang berasal dari pendapatan/penghasilan rutin dari pekerjaan yang
                        tidak
                        melanggar syariah.
                        <br>
                        <br>

                        Berdasarkan Fatwa Majelis Ulama Indonesia (MUI), penghasilan yang dimaksud adalah setiap
                        pendapatan
                        seperti gaji, honorarium, upah, jasa, dan lain-lainnya yang diperoleh dengan cara halal,
                        baik rutin
                        seperti pejabat negara, pegawai, karyawan, maupun tidak rutin seperti dokter, pengacara,
                        konsultan, dan
                        sejenisnya, serta pendapatan yang diperoleh dari pekerjaan bebas lainnya.
                        <br>
                        <br>

                        Jika nishab dan haul zakatmu telah terpenuhi, mari sisihkan sebagian hartamu untuk bantu
                        banyak
                        masyarakat yang membutuhkan. InsyaAllah zakat yang kamu tunaikan mensucikan hartamu setahun
                        kebelakang
                        dan mendapat keberkahan untuk setahun kedepan.
                        <br>
                        <br>

                        Bagaimana cara menghitung zakat penghasilan?
                        Setiap bulan kamu dapat tunaikan zakat dari penghasilanmu. Besar Nishab (batas minimum) per
                        bulan setara
                        dengan nilai 1/12 dari 85 gram emas (harga emas pada hari dimana zakat akan ditunaikan),
                        dengan kadar
                        2,5%. Apabila penghasilanmu setiap bulan telah melebihi nilai nishab, zakat penghasilan
                        wajib
                        dikeluarkan.
                        <br>
                        <br>

                        Jika pendapatan tidak rutin waktu dan jumlahnya, kamu bisa menghitung hasil pendapatan
                        selama 1 tahun,
                        kemudian zakat ditunaikan apabila penghasilan bersihnya sudah cukup nishab (batas minimum)
                        yaitu harga
                        85 gram emas dengan kadar 2,5%.
                        <br>
                        <br>

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
                        <h4 class="card-title">
                            Zakat Maal
                        </h4>
                        <div class="d-flex justify-content-between mt-2">
                            <div class="d-flex flex-column">
                                <p>Terkumpul</p>
                                <h4 class="amount text-primary">
                                    {{ 'Rp ' . number_format(\App\Models\ZakatTransaction::where('status', 'success')->sum('amount'), 0, ',', '.') }}

                                </h4>
                            </div>
                        </div>


                        <a href="{{ route('zakat-calculator.index') }}" class="btn btn-primary w-100 rounded-5">
                            <i class="bi bi-calculator me-2"></i>
                            Hitung Zakat
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- modal share --}}
    <div class="modal fade" tabindex="-1" id="modalShare">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-0 px-3">
                    <h5>
                        Bantu dengan menyebarkan
                    </h5>
                    <p>Penggalangan dana yang disebarkan melalui jejaring sosial dapat menghasilkan dana yang lebih
                        besar.</p>

                    <div class="row mb-3">
                        <div class="col-9">
                            <input type="text" class="form-control" value="{{ route('zakat-maal') }}" disabled>
                        </div>
                        <div class="col-3">
                            <button class="btn btn-primary w-100" onclick="copyToClipboard()">
                                Salin
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('plugin-scripts')
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @endpush
    @push('custom-scripts')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
        <script>
            $(document).ready(function() {
                function fetchDonations(page = 1) {
                    $.ajax({
                        url: `/api/transactions-zakat?page=${page}`,
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
                            console.log(error);
                        }
                    });
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
            $('.btnCopy').on('click', function() {
                $('#modalShare').modal('show');
            });
        </script>
        <script>
            function copyToClipboard() {
                var url = "{{ route('zakat-maal') }}";

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
    @endpush
</x-layouts.frontend>
