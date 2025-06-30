<x-layouts.admin title="{{ $campaign->title }}">
    <div class="d-flex align-items-center justify-content-between">
        <nav class="page-breadcrumb mb-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Manajemen Campaign</a></li>
                <li class="breadcrumb-item active" aria-current="page">
                    {{ $campaign->title }}
                </li>
            </ol>
        </nav>
        <a href="{{ route('admin.campaigns.index') }}" class="btn btn-primary btn-sm ml-auto mb-3">
            Kembali
        </a>
    </div>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <x-admin.card title="{{ $campaign->title }}">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <tr>
                            <th>Judul</th>
                            <td>{{ $campaign->title }}</td>
                        </tr>
                        <tr>
                            <th>Slug</th>
                            <td>{{ $campaign->slug }}</td>
                        </tr>
                        <tr>
                            <th>Thumbnail</th>
                            <td>
                                <img src="{{ asset($campaign->thumbnail) }}" alt="{{ $campaign->title }}"
                                    class="img-fluid" width="100">
                            </td>
                        </tr>
                        <tr>
                            <th>Story</th>
                            <td style="white-space: pre-line">
                                {!! $campaign->story !!}
                            </td>
                        </tr>
                        <tr>
                            <th>Total Donasi</th>
                            <td>{{ $campaign->raised }}</td>
                        </tr>
                        <tr>
                            <th>Target Donasi</th>
                            <td>{{ $campaign->formatted_target }}</td>
                        </tr>
                        <tr>
                            <th>Tanggal Berakhir</th>
                            <td>{{ \Carbon\Carbon::parse($campaign->end_date)->isoFormat('D MMMM Y') }}</td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>
                                @if ($campaign->status == 'pending')
                                    <span class="badge bg-warning text-dark">{{ $campaign->status }}</span>
                                @elseif($campaign->status == 'success')
                                    <span class="badge bg-success">{{ $campaign->status }}</span>
                                @else
                                    <span class="badge bg-danger">{{ $campaign->status }}</span>
                                @endif
                            </td>
                        </tr>
                    </table>
                </div>
                <x-slot name="footer">
                    @if ($campaign->status == 'pending' && auth()->user()->hasAnyRole(['superadmin', 'manager-campaign']))
                        <form action="{{ route('admin.campaigns.update', $campaign->id) }}" method="POST"
                            class="d-inline">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="status" value="verified">
                            <button class="btn btn-success btn-sm"
                                onclick="return confirm('Yakin ingin memverifikasi campaign ini?')">Verifikasi</button>
                        </form>
                    @endif
                    <a href="{{ route('admin.campaigns.index') }}" class="btn btn-secondary btn-sm">Kembali</a>
                </x-slot>
            </x-admin.card>
        </div>
    </div>
</x-layouts.admin>
