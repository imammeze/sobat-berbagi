<x-layouts.admin title="Campaign">
    <div class="d-flex align-items-center justify-content-between">
        <nav class="page-breadcrumb mb-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Manajemen Campaign</a></li>
                <li class="breadcrumb-item active" aria-current="page">Category</li>
            </ol>
        </nav>
        <a href="{{ route('admin.campaigns.create') }}" class="btn btn-primary btn-sm ml-auto mb-3">Tambah
            Campaign</a>
    </div>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <x-admin.card title="Data Campaign">
                <x-admin.datatable>
                    <x-slot name="thead">
                        <tr>
                            <th>No</th>
                            <th>Title</th>
                            <th>Slug</th>
                            <th>Thumbnail</th>
                            <th>Total Donasi</th>
                            <th>Target Donasi</th>
                            <th>Biaya Tetap</th>
                            <th>Tanggal Berakhir</th>
                            <th>Type</th>
                            <th>Status</th>

                            @can('campaign-edit')
                                <th class="noExport">Featured</th>
                            @endcan

                            @canany(['campaign-edit', 'campaign-delete', 'campaign-verify'])
                                <th class="noExport">Aksi</th>
                            @endcanany
                        </tr>
                    </x-slot>
                    <x-slot name="tbody">
                        @foreach ($campaigns as $campaign)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $campaign->title }}</td>
                                <td>{{ $campaign->slug }}</td>
                                <td>
                                    <img src="{{ asset($campaign->thumbnail) }}" alt="{{ $campaign->title }}"
                                        class="img-fluid" width="100">
                                </td>
                                <td>Rp {{ number_format($campaign->raised, 0, ',', '.') }}</td>
                                <td>Rp {{ number_format($campaign->target, 0, ',', '.') }}</td>
                                <td>Rp {{ number_format($campaign->fixed_amount, 0, ',', '.') }}</td>
                                <td>{{ $campaign->end_date }}</td>
                                <td>{{ $campaign->type }}</td>
                                <td>
                                    @if ($campaign->status == 'pending')
                                        <span class="badge bg-warning text-dark">{{ $campaign->status }}</span>
                                    @elseif($campaign->status == 'verified')
                                        <span class="badge bg-success">{{ $campaign->status }}</span>
                                    @else
                                        <span class="badge bg-danger">{{ $campaign->status }}</span>
                                    @endif
                                </td>
                                @can('campaign-edit')
                                    <td>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" role="switch"
                                                @checked($campaign->is_featured) id="featured-{{ $campaign->id }}"
                                                name="featured" value="{{ $campaign->is_featured }}"
                                                onclick="updateFeatured('{{ $campaign->id }}')">
                                        </div>
                                    </td>
                                @endcan

                                @canany(['campaign-edit', 'campaign-delete', 'campaign-verify'])
                                    <td>
                                        @can('campaign-verify')
                                            @if ($campaign->status == 'pending')
                                                <button class="btn btn-success btn-sm"
                                                    onclick="verify('{{ $campaign->id }}')">Verifikasi</button>
                                            @endif
                                        @endcan

                                        @can('campaign-edit')
                                            <a href="{{ route('admin.campaigns.edit', $campaign->id) }}"
                                                class="btn btn-warning btn-sm">Edit</a>
                                        @endcan



                                        <a href="{{ route('admin.campaigns.show', $campaign->id) }}"
                                            class="btn btn-info btn-sm">Detail</a>

                                        @can('campaign-delete')
                                            <form action="{{ route('admin.campaigns.destroy', $campaign->id) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</button>
                                            </form>
                                        @endcan
                                    </td>
                                @endcanany
                            </tr>
                        @endforeach
                    </x-slot>
                </x-admin.datatable>
            </x-admin.card>
        </div>
    </div>

    @push('custom-scripts')
        <script>
            function updateFeatured(id) {
                $.ajax({
                    url: "/admin/campaigns/featured/" + id,
                    type: "POST",
                    data: {
                        id: id,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(data) {
                        alert(data.message);

                        location.reload();
                    }
                })
            }

            function verify(id) {
                $.ajax({
                    url: "/admin/campaigns/verified/" + id,
                    type: "POST",
                    data: {
                        id: id,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(data) {
                        alert(data.message);

                        location.reload();
                    }
                })
            }
        </script>
    @endpush
</x-layouts.admin>
