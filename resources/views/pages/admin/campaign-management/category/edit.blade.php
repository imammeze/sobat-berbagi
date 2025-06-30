<x-layouts.admin>
    <div class="d-flex align-items-center justify-content-between">
        <nav class="page-breadcrumb mb-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Manajemen Campaign</a></li>
                <li class="breadcrumb-item">Category</li>
                <li class="breadcrumb-item active" aria-current="page">Edit</li>
            </ol>
        </nav>
        <a href="{{ route('admin.campaign-categories.index') }}" class="btn btn-danger btn-sm ml-auto mb-3">Kembali</a>
    </div>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <x-admin.card title="Edit Kategori Campaign">
                <form action="{{ route('admin.campaign-categories.update', $category->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <x-input.text label="Nama" name="name" :value="$category->name" />
                    <x-input.text label="Deskripsi" name="description" :value="$category->description" />
                    <x-button.primary class="float-end" type="submit">
                        Simpan
                    </x-button.primary>
                </form>
            </x-admin.card>
        </div>
    </div>
</x-layouts.admin>
