<div class="row">
    <div class="col-12 col-xl-12 stretch-card">
        <div class="row flex-grow-1">
            <div class="col-md-3 grid-margin">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-baseline mb-2">
                            <h6 class="card-title mb-0">Total Donasi Terkumpul</h6>
                        </div>
                        <h3 class="mb-2">
                            {{ 'Rp ' . number_format(\App\Models\Campaign::sum('raised'), 0, ',', '.') }}
                        </h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3 grid-margin">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-baseline mb-2">
                            <h6 class="card-title mb-0">Total Donatur Terdaftar</h6>
                        </div>
                        <h3 class="mb-2">
                            {{ \App\Models\Donatur::count() }}
                        </h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3 grid-margin">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-baseline mb-2">
                            <h6 class="card-title mb-0">Total Mitra Terdaftar</h6>
                        </div>
                        <h3 class="mb-2">
                            {{ \App\Models\Mitra::where('status', 'verified')->count() }}
                        </h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3 grid-margin">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-baseline mb-2">
                            <h6 class="card-title mb-0">Total Campaign Terdaftar</h6>
                        </div>
                        <h3 class="mb-2">
                            {{ \App\Models\Campaign::where('status', 'verified')->count() }}
                        </h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
