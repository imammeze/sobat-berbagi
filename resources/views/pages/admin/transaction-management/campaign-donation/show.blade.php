<x-layouts.admin>
    @push('plugin-styles')
        <link rel="stylesheet" href="{{ asset('admin/assets/plugins/lightbox/css/lightbox.css') }}">
    @endpush

    <div class="d-flex align-items-center justify-content-between">
        <nav class="page-breadcrumb mb-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Manajemen Transaksi</a></li>
                <li class="breadcrumb-item">Transaksi Campaign</li>
                <li class="breadcrumb-item active">Detail</li>
            </ol>
        </nav>
    </div>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <x-admin.card title="Data Transaksi">
                <div class="row">
                    <div class="col-md-12">
                        <table class="table">
                            <tr>
                                <th>Nama Campaign</th>
                                <td>{{ $campaignDonation->campaign->title ?? '' }}</td>
                            </tr>
                            <tr>
                                <th>Donatur</th>
                                <td>{{ $campaignDonation->user->donaturRelation->name }}</td>
                            </tr>
                            <tr>
                                <th>Metode Pembayaran</th>
                                <td>{{ $campaignDonation->paymentMethod->name ?? '' }} -
                                    {{ $campaignDonation->paymentMethod->number ?? '' }}</td>
                            </tr>
                            <tr>
                                <th>Total Donasi</th>
                                <td>
                                    Rp {{ number_format($campaignDonation->amount, 0, ',', '.') }}
                                </td>
                            </tr>
                            <tr>
                                <th>Bukti Pembayaran</th>
                                <td>
                                    <a href="{{ asset($campaignDonation->proof ?? '') }}" data-lightbox="image-1"
                                        data-title="Bukti Pembayaran {{ $campaignDonation->paymentMethod->name ?? '' }}">
                                        <img src="{{ asset($campaignDonation->proof ?? '') }}" alt="Bukti Pembayaran"
                                            class="img-table-lightbox" width="100">
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td>
                                    @if ($campaignDonation->status == 'pending')
                                        <span class="badge bg-warning">Pending</span>
                                    @elseif ($campaignDonation->status == 'success')
                                        <span class="badge bg-success">Success</span>
                                    @elseif ($campaignDonation->status == 'failed')
                                        <span class="badge bg-danger">Failed</span>
                                    @endif
                                </td>
                            </tr>
                        </table>
                        <x-slot name="footer">
                            <div class="d-flex gap-3 ">
                                @can('campaign-donation-approve')
                                    @if ($campaignDonation->status == 'pending')
                                        <div class="d-flex justify-content-between">
                                            <form
                                                action="{{ route('admin.transaksi-campaign.approve', $campaignDonation->id) }}"
                                                method="POST">
                                                @csrf
                                                <button class="btn btn-success btn-sm"
                                                    onclick="return confirm('Apakah anda yakin ingin menerima transaksi ini?')">
                                                    Terima</button>
                                            </form>
                                        </div>
                                    @endif
                                @endcan

                                <a href="{{ route('admin.transaksi-campaign.index') }}"
                                    class="btn btn-danger btn-sm">Kembali</a>
                            </div>
                        </x-slot>
                    </div>
                </div>
            </x-admin.card>
        </div>
    </div>

    @push('plugin-scripts')
        <script src="{{ asset('admin/assets/plugins/lightbox/js/lightbox-plus-jquery.min.js') }}"></script>

        <script>
            lightbox.option({
                'resizeDuration': 200,
                'wrapAround': true
            })
        </script>
    @endpush
</x-layouts.admin>
