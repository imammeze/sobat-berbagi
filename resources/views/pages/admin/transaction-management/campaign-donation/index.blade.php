<x-layouts.admin title="Transaksi Campaign">
    <div class="d-flex align-items-center justify-content-between">
        <nav class="page-breadcrumb mb-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Manajemen Transaksi</a></li>
                <li class="breadcrumb-item active" aria-current="page">Transaksi Campaign</li>
            </ol>
        </nav>
    </div>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <x-admin.card title="Data Metode Pembayaran">
                <ul class="nav nav-tabs">
                    @php
                        $paymentMethodCode = request()->input('payment_method_code');
                    @endphp
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('admin/transaksi-campaign*') && $paymentMethodCode == 'manual' ? 'active' : '' }}"
                            href="{{ route('admin.transaksi-campaign.index', ['payment_method_code' => 'manual']) }}"
                            aria-current="page">
                            Transaksi Manual
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('admin/transaksi-campaign*') && $paymentMethodCode == 'qris' ? 'active' : '' }}"
                            href="{{ route('admin.transaksi-campaign.index', ['payment_method_code' => 'qris']) }}">
                            Transaksi Qris
                        </a>
                    </li>

                </ul>
                <div class="tab-content mt-3">
                    <div class="tab-pane fade show active">
                        <x-admin.datatable :use-buttons="true" :export-file-name="'Data Transaksi Campaign'">
                            <x-slot name="thead">
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Nama Campaign</th>
                                    <th>Nama Donatur</th>
                                    <th>Total Donasi</th>
                                    <th>Status</th>
                                    <th class="noExport">Aksi</th>
                                </tr>
                            </x-slot>
                            <x-slot name="tbody">
                                @foreach ($campaignDonations as $campaignDonation)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $campaignDonation->created_at->isoFormat('D MMMM Y HH:mm') }}</td>

                                        <td>{{ $campaignDonation->campaign->title ?? '-' }}</td>
                                        <!--@php-->
                                        <!--dd($campaignDonation->user->donaturRelation->name);-->

                                        <!--@endphp-->
                                        <td>{{ $campaignDonation->user->donaturRelation->name ?? '' }}</td>
                                        <td data-id="{{ $campaignDonation->id }}">Rp {{ number_format($campaignDonation->amount, 0, ',', '.') }}</td>
                                        <td>
                                            @if ($campaignDonation->status == 'pending')
                                                <span class="badge bg-warning">Belum Di Konfirmasi</span>
                                            @elseif ($campaignDonation->status == 'success')
                                                <span class="badge bg-success">Berhasil</span>
                                            @elseif ($campaignDonation->status == 'failed')
                                                <span class="badge bg-danger">Failed</span>
                                            @endif
                                        </td>
                                        <td>
                                            <button class="btn btn-warning btn-sm edit-donation" 
                                                data-id="{{ $campaignDonation->id }}" 
                                                data-amount="{{ $campaignDonation->amount }}"
                                                data-bs-toggle="modal" 
                                                data-bs-target="#editDonationModal_{{ $campaignDonation->id }}">
                                                Edit
                                            </button>
                                            <a href="{{ route('admin.transaksi-campaign.show', $campaignDonation->id) }}"
                                                class="btn btn-primary btn-sm">Detail</a>
                                        </td>

                                        <!-- MODAL EDIT DONASI -->
                                        <div class="modal fade" id="editDonationModal_{{ $campaignDonation->id }}" tabindex="-1" aria-labelledby="editDonationModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editDonationModalLabel">Edit Nominal Donasi</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('admin.transaksi-campaign.update', $campaignDonation->id) }}" method="POST"
                                                            enctype="multipart/form-data">
                                                            @csrf
                                                            @method('PUT')
                                                            {{-- <input type="hidden" id="donation-id"> --}}
                                                            <div class="mb-3">
                                                                <label for="amount_formatted" class="form-label">Nominal Donasi</label>
                                                                <input type="text" class="form-control" required name="amount"
                                                                    value="{{ $campaignDonation->amount }}">
                                                                {{-- <input type="hidden" name="amount" id="amount" value="{{ $campaignDonation->amount }}"> --}}
                                                            </div>
                                                            <button type="submit" class="btn btn-success">Simpan</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                @endforeach
                            </x-slot>
                        </x-admin.datatable>
                    </div>
                </div>

            </x-admin.card>
        </div>
    </div>
     
</x-layouts.admin>

@push('custom-scripts')
<script>
$(document).ready(function () {
    $("#amount_formatted").on("input", function () {
        let angka = $(this).val().replace(/[^0-9]/g, ''); // Ambil hanya angka

        if (angka === "") {
            $("#amount").val(""); // Kosongkan hidden input jika tidak ada angka
            return $(this).val(""); // Kosongkan input formatted juga
        }

        let formatted = new Intl.NumberFormat("id-ID").format(angka); // Format ke Rupiah
        $(this).val(formatted); // Update tampilan input
        $("#amount").val(angka); // Simpan angka asli (tanpa format) di input hidden
    });
});


</script>

@endpush
