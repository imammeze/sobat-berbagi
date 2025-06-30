<x-layouts.admin>
    @push('plugin-styles')
        <link rel="stylesheet" href="{{ asset('admin/assets/plugins/image-upload/css/image-upload.css') }}">
    @endpush

    <div class="d-flex align-items-center justify-content-between">
        <nav class="page-breadcrumb mb-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Manajemen Website</a></li>
                <li class="breadcrumb-item">Banner</li>
                <li class="breadcrumb-item active" aria-current="page">Tambah Banner</li>

            </ol>
        </nav>
        <a href="{{ route('admin.banners.index') }}" class="btn btn-danger btn-sm ml-auto mb-3">Kembali</a>
    </div>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <x-admin.card title="Tambah Banner">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong> Terdapat kesalahan saat input data. <br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.banners.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf


                    <div class="mb-3">
                        <label class="form-label" for="input-file">Desktop Image</label>
                        <label for="input-file" id="drop-area" class="drop-area">
                            <input type="file" name="desktop_image" id="input-file" accept="image/*" hidden>
                            <div id="img-view" class="img-view">
                                <img src="{{ asset('admin/assets/plugins/image-upload/images/gallery-export.svg') }}"
                                    id="img" width="50">
                                <p id="img-info">Pilih gambar untuk diunggah</p>
                            </div>
                        </label>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="input-file">Mobile Image</label>
                        <label for="input-file2" id="drop-area2" class="drop-area">
                            <input type="file" name="mobile_image" id="input-file2" accept="image/*" hidden>
                            <div id="img-view2" class="img-view">
                                <img src="{{ asset('admin/assets/plugins/image-upload/images/gallery-export.svg') }}"
                                    id="img" width="50">
                                <p id="img-info">Pilih gambar untuk diunggah</p>
                            </div>
                        </label>
                    </div>
                    <x-input.text label="Link" name="link" type="text" placeholder="Link" />

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
            new ImageUploader("drop-area2", "input-file2", "img-view2");
        </script>
    @endpush
</x-layouts.admin>
