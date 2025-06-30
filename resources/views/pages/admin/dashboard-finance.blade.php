<div class="row">
    <div class="col-12 col-xl-12 stretch-card">
        <div class="row flex-grow-1">
            <div class="col-md-6 grid-margin">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-baseline mb-2">
                            <h6 class="card-title mb-0">Total Donasi Terkumpul</h6>
                        </div>
                        <h3 class="mb-2">
                            @php
                                $total = \App\Models\Campaign::sum('raised');
                            @endphp
                            {{ 'Rp ' . number_format($total, 0, ',', '.') }}
                        </h3>
                    </div>
                </div>
            </div>
            <div class="col-md-6 grid-margin">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-baseline mb-2">
                            <h6 class="card-title mb-0">Donasi Belum Terkonfirmasi</h6>
                        </div>
                        <h3 class="mb-2">
                            {{ \App\Models\CampaignDonation::where('status', 'pending')->count() }}
                        </h3>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-baseline mb-2">
                    <h6 class="card-title mb-0">Total Donasi Terkumpul per Campaign</h6>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <canvas id="donasiByCampaign"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-baseline mb-2">
                    <h6 class="card-title mb-0">Total Donasi Terkumpul per Bulan</h6>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <canvas id="donasiByMonth"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@php
    $labels1 = [];
    $data1 = [];

    foreach (\App\Models\Campaign::all() as $campaign) {
        $labels1[] = $campaign->title;
        $data1[] = $campaign->raised;
    }

    $total = \App\Models\Campaign::sum('raised');
    $total = $total > 0 ? $total : 1;

    $labels1 = json_encode($labels1);
    $data1 = json_encode($data1);

    $labels2 = [];
    $data2 = [];

    foreach (\App\Models\CampaignDonation::where('status', 'success')->get() as $donation) {
        $labels2[] = $donation->created_at->format('F Y');
        $data2[] = $donation->amount;
    }

    $labels2 = json_encode($labels2);
    $data2 = json_encode($data2);

@endphp

@push('custom-scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
    <script>
        var ctx = document.getElementById('donasiByCampaign').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: {!! $labels1 !!},
                datasets: [{
                    label: 'Total Donasi Terkumpul',
                    data: {!! $data1 !!},
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'Total Donasi Terkumpul per Campaign'
                    },
                    datalabels: {
                        formatter: (value, ctx) => {
                            let sum = 0;
                            let dataArr = ctx.chart.data.datasets[0].data;
                            dataArr.map(data => {
                                sum += data;
                            });
                            let percentage = (value * 100 / sum).toFixed(2) + "%";
                            return percentage;
                        },
                    }
                },
                indexAxis: 'y'
            }
        });
    </script>

    <script>
        // grafik donasi per bulan line
        var ctx = document.getElementById('donasiByMonth').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: {!! $labels2 !!},
                datasets: [{
                    label: 'Total Donasi Terkumpul',
                    data: {!! $data2 !!},
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'Total Donasi Terkumpul per Bulan'
                    },
                    datalabels: {
                        formatter: (value, ctx) => {
                            let sum = 0;
                            let dataArr = ctx.chart.data.datasets[0].data;
                            dataArr.map(data => {
                                sum += data;
                            });
                            let percentage = (value * 100 / sum).toFixed(2) + "%";
                            return percentage;
                        },
                    }
                },
            }
        });
    </script>
@endpush
