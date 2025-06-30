<x-layouts.admin>
    <div class="d-flex align-items-center justify-content-between">
        <nav class="page-breadcrumb mb-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Manajemen Campaign</a></li>
                <li class="breadcrumb-item active" aria-current="page">Category</li>
            </ol>
        </nav>
        <a href="{{ route('admin.campaign-categories.create') }}" class="btn btn-primary btn-sm ml-auto mb-3">Tambah
            Kategori</a>
    </div>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <x-admin.card title="Data Kategori Campaign">
                <x-admin.datatable>
                    <x-slot name="thead">
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Slug</th>
                            <th>Deskripsi</th>

                            @canany(['campaign-category-edit', 'campaign-category-delete'])
                                <th class="noExport">Aksi</th>
                            @endcanany
                        </tr>
                    </x-slot>
                    <x-slot name="tbody">
                        @foreach ($categories as $category)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $category->name }}</td>
                                <td>{{ $category->slug }}</td>
                                <td>{{ $category->description }}</td>
                                <td>

                                    @can('campaign-category-edit')
                                        <a href="{{ route('admin.campaign-categories.edit', $category->id) }}"
                                            class="btn btn-sm btn-warning">Edit</a>
                                    @endcan

                                    @can('campaign-category-delete')
                                        <form action="{{ route('admin.campaign-categories.destroy', $category->id) }}"
                                            method="POST" class="d-inline">
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
