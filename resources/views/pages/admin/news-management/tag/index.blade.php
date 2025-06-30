<x-layouts.admin>
    <div class="d-flex align-items-center justify-content-between">
        <nav class="page-breadcrumb mb-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Manajemen Berita</a></li>
                <li class="breadcrumb-item active" aria-current="page">Tag</li>
            </ol>
        </nav>
        <a href="{{ route('admin.news-tags.create') }}" class="btn btn-primary btn-sm ml-auto mb-3">Tambah
            Tag</a>
    </div>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <x-admin.card title="Data Tag Berita">
                <x-admin.datatable>
                    <x-slot name="thead">
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Slug</th>

                            @canany(['article-tag-edit', 'article-tag-delete'])
                                <th class="noExport">Aksi</th>
                            @endcanany
                        </tr>
                    </x-slot>
                    <x-slot name="tbody">
                        @foreach ($tags as $tag)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $tag->name }}</td>
                                <td>{{ $tag->slug }}</td>
                                <td>

                                    @can('article-tag-edit')
                                        <a href="{{ route('admin.news-tags.edit', $tag->id) }}"
                                            class="btn btn-sm btn-warning">Edit</a>
                                    @endcan

                                    @can('article-tag-delete')
                                        <form action="{{ route('admin.news-tags.destroy', $tag->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger"
                                                onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">Hapus</button>
                                        </form>
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                    </x-slot>
                </x-admin.datatable>
            </x-admin.card>
        </div>
    </div>
</x-layouts.admin>
