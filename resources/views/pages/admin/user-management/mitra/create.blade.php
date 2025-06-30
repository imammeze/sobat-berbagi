<x-layouts.admin>
    <div class="d-flex align-items-center justify-content-between">
        <nav class="page-breadcrumb mb-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Manajemen Akun</a></li>
                <li class="breadcrumb-item">Mitra</li>
                <li class="breadcrumb-item active" aria-current="page">Tambah</li>

            </ol>
        </nav>
        <a href="{{ route('admin.mitra.index') }}" class="btn btn-danger btn-sm ml-auto mb-3">Kembali</a>
    </div>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <x-admin.card title="Tambah Mitra">
                <form action="{{ route('admin.mitra.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <x-form.input type="email" name="email" label="Email" />
                    <x-form.input name="name" label="Nama Mitra" />
                    <x-form.input name="slug" label="Username" />
                    <x-form.input type="file" name="logo" label="Logo Mitra" />
                    <x-form.mde name="description" label="Deskripsi Mitra" id="description" />
                    <x-form.textarea name="address" label="Alamat Mitra" />
                    <x-form.input name="phone" value="{{ old('phone') }}" label="Nomer Hp Aktif" />
                    <x-form.input name="identity_number" value="{{ old('identity_number') }}" label="NIK" />
                    <x-form.input name="pic_name" value="{{ old('pic_name') }}" label="Nama Penanggung Jawab" />
                    <x-form.input type="file" name="identity_file" label="Foto KTP" />
                    <x-input.password name="password" value="" label="Password" />

                    <x-button.primary class="float-end" type="submit">
                        Simpan
                    </x-button.primary>
                </form>
            </x-admin.card>
        </div>
    </div>
</x-layouts.admin>
