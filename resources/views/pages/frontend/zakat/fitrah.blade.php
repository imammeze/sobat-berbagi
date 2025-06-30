<x-layouts.frontend title="Zakat Fitrah" description="Zakat Fitrah adalah zakat yang wajib dikeluarkan oleh setiap muslim yang mampu pada bulan Ramadhan."
    thumbnail="{{ asset('frontend/assets/images/zakat/zakat-fitrah.PNG') }}">
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
            <img src="{{ asset('frontend/assets/images/zakat/zakat-fitrah.PNG') }}" alt="campaign-img"
                class="img-fluid w-100">
            <div class="position-absolute top-0 start-0 mt-3 ms-3">
                <a href="{{ route('campaign.index') }}" class="text-decoration-none text-white">
                    <i class="bi bi-arrow-left"></i>
                </a>
            </div>
        </div>
        <div class="container mt-3">
            <h4>
                Zakat Fitrah
            </h4>
            <div class="d-flex flex-column">
                <p>Terkumpul</p>

                <h4 class="amount text-primary mb-0">
                    {{ 'Rp ' . number_format(\App\Models\ZakatTransaction::where('status', 'success')->sum('amount'), 0, ',', '.') }}
                </h4>

            </div>

            <h5 class="mt-4 fw-bold">
                Tentang Zakat Fitrah
            </h5>
            <article>
                Sucikan Jiwa, Bersihkan Harta, Tunaikan Zakat Fitrah Sekarang Jua!

                <br>
                <br>

                Sebagaimana sabda Rasulullah SAW:
                <br><br>
                "Barangsiapa yang mengeluarkan zakat fitrah sebelum shalat Idul Fitri, maka zakatnya diterima.
                Dan barangsiapa yang mengeluarkannya setelah shalat Idul Fitri, maka itu hanyalah sedekah
                biasa." (HR. Abu Daud)
                <br><br>
                Mari tunaikan zakat fitrahmu sekarang juga melalui Lazismu Banyumas!*
                <br><br>
                Kami menerima dan menyalurkan zakat fitrah dari 1 Ramadhan hingga menjelang sholat Idul Fitri
                1445 Hijriah.
                <br><br>
                Besaran zakat fitrah:
                <br><br>
                * 3 kg Beras per Jiwa
                <br><br>
                * Atau nominal Rp. 50.000
                <br><br>
                Zakatmu menjadi penolong mereka yang membutuhkan:
                <br><br>

                <ul>
                    <li>Membantu fakir miskin dan kaum dhuafa</li>
                    <li>Menyenangkan hati anak-anak yatim dan piatu</li>
                    <li>Membantu mereka yang terdampak musibah</li>
                </ul>

                <br><br>
                Tunaikan zakat fitrahmu sekarang juga melalui Lazismu Banyumas!

                <br><br>
                <ul>
                    <li>
                        Mudah dan praktis: Bisa melalui transfer bank, dompet digital, atau datang langsung ke
                    </li>
                    <li>
                        Aman dan terpercaya: Lazismu Banyumas adalah lembaga zakat resmi yang terdaftar di
                        BAZNAS.
                    </li>
                    <li>
                        Terdistribusi tepat sasaran: Zakatmu akan
                        disalurkan kepada mereka yang benar-benar membutuhkan.
                    </li>
                </ul>
                <br><br>
                Mari bersama-sama kita sucikan jiwa dan bersihkan harta dengan menunaikan zakat fitrah melalui
                Lazismu Banyumas.
                <br><br>
                Hubungi kami:
                <br><br>

                <ul>
                    <li>Telepon: 08112727127</li>
                    <li>Website: sobatberbagi.com</li>
                </ul>
                <br><br>
                Zakatmu, Kebahagiaan Mereka.
                <br><br>

                #LazismuBanyumas #ZakatFitrah #BerbagiKebahagiaan
            </article>
            <h5 class="mt-4 fw-bold">
                Donasi Terbaru
            </h5>
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
                    <button  class="btn btn-primary w-100 rounded-5 btnBayar">
                        <i class="bi bi-wallet2 me-2"></i>
                        Bayar Zakat
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- desktop --}}
    <div class="container mt-5 d-none d-md-block">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-7 col-lg-8">
                <img src="{{ asset('frontend/assets/images/zakat/zakat-fitrah.PNG') }}" alt="campaign-img"
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
                        Sucikan Jiwa, Bersihkan Harta, Tunaikan Zakat Fitrah Sekarang Jua!

                        <br>
                        <br>

                        Sebagaimana sabda Rasulullah SAW:
                        <br><br>
                        "Barangsiapa yang mengeluarkan zakat fitrah sebelum shalat Idul Fitri, maka zakatnya diterima.
                        Dan barangsiapa yang mengeluarkannya setelah shalat Idul Fitri, maka itu hanyalah sedekah
                        biasa." (HR. Abu Daud)
                        <br><br>
                        Mari tunaikan zakat fitrahmu sekarang juga melalui Lazismu Banyumas!*
                        <br><br>
                        Kami menerima dan menyalurkan zakat fitrah dari 1 Ramadhan hingga menjelang sholat Idul Fitri
                        1445 Hijriah.
                        <br><br>
                        Besaran zakat fitrah:
                        <br><br>
                        * 3 kg Beras per Jiwa
                        <br><br>
                        * Atau nominal Rp. 50.000
                        <br><br>
                        Zakatmu menjadi penolong mereka yang membutuhkan:
                        <br><br>

                        <ul>
                            <li>Membantu fakir miskin dan kaum dhuafa</li>
                            <li>Menyenangkan hati anak-anak yatim dan piatu</li>
                            <li>Membantu mereka yang terdampak musibah</li>
                        </ul>

                        <br><br>
                        Tunaikan zakat fitrahmu sekarang juga melalui Lazismu Banyumas!

                        <br><br>
                        <ul>
                            <li>
                                Mudah dan praktis: Bisa melalui transfer bank, dompet digital, atau datang langsung ke
                            </li>
                            <li>
                                Aman dan terpercaya: Lazismu Banyumas adalah lembaga zakat resmi yang terdaftar di
                                BAZNAS.
                            </li>
                            <li>
                                Terdistribusi tepat sasaran: Zakatmu akan
                                disalurkan kepada mereka yang benar-benar membutuhkan.
                            </li>
                        </ul>
                        <br><br>
                        Mari bersama-sama kita sucikan jiwa dan bersihkan harta dengan menunaikan zakat fitrah melalui
                        Lazismu Banyumas.
                        <br><br>
                        Hubungi kami:
                        <br><br>

                        <ul>
                            <li>Telepon: 08112727127</li>
                            <li>Website: sobatberbagi.com</li>
                        </ul>
                        <br><br>
                        Zakatmu, Kebahagiaan Mereka.
                        <br><br>

                        #LazismuBanyumas #ZakatFitrah #BerbagiKebahagiaan
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
                            Zakat Fitrah
                        </h4>
                        <div class="d-flex justify-content-between mt-2">
                            <div class="d-flex flex-column">
                                <p>Terkumpul</p>
                                <h4 class="amount text-primary">
                                    {{ 'Rp ' . number_format(\App\Models\ZakatTransaction::where('status', 'success')->where('category_zakat', 'fitrah')->sum('amount'), 0, ',', '.') }}

                                </h4>
                            </div>
                        </div>


                        <button  class="btn btn-primary w-100 rounded-5 mt-3 btnBayar">
                            <i class="bi bi-wallet2 me-2"></i>
                            Bayar Zakat
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <x-ui.share-modal :route="route('zakat-fitrah')" text="Ayo berzakat fitrah di {{ config('app.name') }}:%0A%0A" />

    @push('plugin-scripts')
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @endpush
    @push('custom-scripts')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
        <script>
            $(document).ready(function() {
                var API_KEY = "{{ env('API_KEY') }}";
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
        <script>
            $('.btnBayar').on('click', function() {
                var zakat = {
                    category_zakat: 'fitrah',
                    amount: 50000,
                }

                localStorage.setItem('zakat', JSON.stringify(zakat));

                window.location.href = "{{ route('zakat-fitrah.paymentMethod') }}";
            });
        </script>
    @endpush
</x-layouts.frontend>
