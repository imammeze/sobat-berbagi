<x-layouts.admin>
    <div class="d-flex align-items-center justify-content-between">
        <nav class="page-breadcrumb mb-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Manajemen Campaign</a></li>
                <li class="breadcrumb-item active" aria-current="page">Berita Campaign</li>
            </ol>
        </nav>

        @can('campaign-latest-news-create')
            <a href="{{ route('admin.campaign-latest-news.create') }}" class="btn btn-primary btn-sm ml-auto mb-3">
                Tambah
            </a>
        @endcan
    </div>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <x-admin.card title="Data Berita Campaign">
                <x-admin.datatable>
                    <x-slot name="thead">
                        <tr>
                            <th>No</th>
                            <th>Campaign</th>
                            <th>Tanggal</th>
                            <th>Judul</th>

                            @canany(['campaign-latest-news-edit', 'campaign-latest-news-delete'])
                                <th class="noExport">Aksi</th>
                            @endcanany
                        </tr>
                    </x-slot>
                    <x-slot name="tbody">
                        @foreach ($latestNews as $news)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $news->campaign->title }}</td>
                                <td>{{ $news->date }}</td>
                                <td>{{ $news->title }}</td>

                                @canany(['campaign-latest-news-edit', 'campaign-latest-news-delete'])
                                    <td>
                                        @can('campaign-latest-news-edit')
                                            <a href="{{ route('admin.campaign-latest-news.edit', $news->id) }}"
                                                class="btn btn-sm btn-warning">Edit</a>
                                        @endcan

                                        @can('campaign-latest-news-delete')
                                            <form action="{{ route('admin.campaign-latest-news.destroy', $news->id) }}"
                                                method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-danger"
                                                    onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">Hapus</button>
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
</x-layouts.admin>
