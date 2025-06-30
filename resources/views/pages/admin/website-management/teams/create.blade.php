<x-layouts.admin>
    @push('plugin-styles')
        <link rel="stylesheet" href="{{ asset('admin/assets/plugins/image-upload/css/image-upload.css') }}">
    @endpush

    <div class="d-flex align-items-center justify-content-between">
        <nav class="page-breadcrumb mb-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Manajemen Website</a></li>
                <li class="breadcrumb-item">Team</li>
                <li class="breadcrumb-item active" aria-current="page">Create</li>

            </ol>
        </nav>
        <a href="{{ route('admin.teams.index') }}" class="btn btn-danger btn-sm ml-auto mb-3">Kembali</a>
    </div>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <x-admin.card title="Tambah Team">


                <form action="{{ route('admin.teams.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <x-form.file label="Pas Foto" name="image" />
                    <x-form.input label="Nama" name="name" />
                    <x-form.input label="Posisi" name="position" />
                    <x-form.textarea label="Deskripsi" name="description" />

                    <x-button.primary class="float-end" type="submit">
                        Simpan
                    </x-button.primary>
                </form>
            </x-admin.card>
        </div>
    </div>
    @push('custom-scripts')
        <script src="{{ asset('admin/assets/plugins/image-upload/js/image-upload.js') }}"></script>
        <script>
            new ImageUploader("drop-area", "input-file", "img-view");
        </script>
    @endpush
</x-layouts.admin>
