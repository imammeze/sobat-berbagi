<x-layouts.admin>
    <div class="d-flex align-items-center justify-content-between">
        <nav class="page-breadcrumb mb-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Manajemen Website</a></li>
                <li class="breadcrumb-item active" aria-current="page">Banner</li>
            </ol>
        </nav>

        @can('banner-create')
            <a href="{{ route('admin.banners.create') }}" class="btn btn-primary btn-sm ml-auto mb-3">Tambah Banner</a>
        @endcan
    </div>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <x-admin.card title="Data Banner">
                <x-admin.datatable>
                    <x-slot name="thead">
                        <tr>
                            <th>No</th>
                            <th>Desktop Image</th>
                            <th>Mobile Image</th>
                            <th>Link</th>

                            @canany(['banner-edit', 'banner-delete'])
                                <th class="noExport">Aksi</th>
                            @endcanany
                        </tr>
                    </x-slot>
                    <x-slot name="tbody">
                        @foreach ($banners as $banner)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <img src="{{ asset($banner->desktop_image) }}" alt="image" class="table-image">
                                </td>
                                <td>
                                    <img src="{{ asset($banner->mobile_image) }}" alt="image" class="table-image">
                                </td>
                                <td>{{ $banner->link }}</td>

                                <td>
                                    @can('banner-edit')
                                        <a href="{{ route('admin.banners.edit', $banner->id) }}"
                                            class="btn btn-sm btn-warning">Edit</a>
                                    @endcan

                                    @can('banner-delete')
                                        <form action="{{ route('admin.banners.destroy', $banner->id) }}" method="POST"
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
