<x-layouts.admin>
    <div class="d-flex align-items-center justify-content-between">
        <nav class="page-breadcrumb mb-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Manajemen Akun</a></li>
                <li class="breadcrumb-item">Mitra</li>
                <li class="breadcrumb-item active" aria-current="page">Show</li>

            </ol>
        </nav>
        <a href="{{ route('admin.mitra.index') }}" class="btn btn-danger btn-sm ml-auto mb-3">Kembali</a>
    </div>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <x-admin.card title="Detail Mitra">
                <table class="table table-striped">
                    <tr>
                        <th>Email</th>
                        <td>{{ $mitra->user->email }}</td>
                    </tr>
                    {{-- 'name',
                    'slug',
                    'logo',
                    'description',
                    'address',
                    'phone',
                    'pic_name',
                    'identity_number',
                    'identity_file',
                    'identity_file_handheld',
                    'status', --}}

                    <tr>
                        <th>Nama Mitra</th>
                        <td>{{ $mitra->name }}</td>
                    </tr>
                    <tr>
                        <th>Username</th>
                        <td>{{ $mitra->slug }}</td>
                    </tr>
                    <tr>
                        <th>Logo Mitra</th>
                        <td>
                            @if ($mitra->logo)
                                <img src="{{ asset($mitra->logo) }}" width="100px" alt="">
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Deskripsi Mitra</th>
                        <td>{!! $mitra->description !!}</td>
                    </tr>
                    <tr>
                        <th>Alamat Mitra</th>
                        <td>{{ $mitra->address }}</td>
                    </tr>
                    <tr>
                        <th>Nomer Hp Mitra</th>
                        <td>{{ $mitra->phone }}</td>
                    </tr>
                    <tr>
                        <th>Penanggung Jawab</th>
                        <td>{{ $mitra->pic_name }}</td>
                    </tr>
                    <tr>
                        <th>NIK</th>
                        <td>{{ $mitra->identity_number }}</td>
                    </tr>
                    <tr>
                        <th>Foto KTP</th>
                        <td>
                            @if ($mitra->identity_file)
                                <img src="{{ asset($mitra->identity_file) }}" width="100px" alt="">
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>{{ $mitra->status }}</td>
                    </tr>

                </table>
            </x-admin.card>
        </div>
    </div>
</x-layouts.admin>
