<x-layouts.frontend title="Kurban">
    @push('styles')
        <style>
            body {
                background-color: #eeee;
            }

            .card-zakat {
                cursor: pointer;
                transition: all 0.3s ease-in-out;
            }

            .card-zakat:hover {
                transform: translateY(-5px);
            }
        </style>
    @endpush
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 mt-4">
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-6 col-lg-3">
                        <div class="card card-zakat border-0" onclick="window.location.href='{{ route('kurban.cow') }}'">
                            <img src="{{ asset('frontend/assets/images/thumbnail-qurban.jpg') }}" alt="Zakat Mal">
                            <div class="card-body p-2">
                                <h5 class="card-title">
                                    Qurban Sapi
                                </h5>
                                <div class="d-flex align-items-center gap-3 mt-3">
                                    <img src="{{ asset('admin/assets/images/logo-laziz.png') }}" alt="logo-mitra"
                                        width="40">
                                    <p>Lazismu banyumas</p>
                                </div>
                                <div class="d-flex justify-content-between mt-2">
                                    <div class="d-flex flex-column">
                                        <p>Terkumpul</p>
                                        <h1 class="amount">
                                            Rp. 0
                                        </h1>
                                    </div>
                                    <div class="d-flex flex-column">
                                        <p>Donatur</p>
                                        <p class="fw-bold">0</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.frontend>
