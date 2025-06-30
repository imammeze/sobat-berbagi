<x-layouts.admin>
    <div class="d-flex align-items-center justify-content-between">
        <nav class="page-breadcrumb mb-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Manajemen Campaign</a></li>
                <li class="breadcrumb-item">Berita</li>
                <li class="breadcrumb-item active" aria-current="page">Tambah</li>

            </ol>
        </nav>
        <a href="{{ route('admin.campaign-latest-news.index') }}" class="btn btn-danger btn-sm ml-auto mb-3">Kembali</a>
    </div>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <x-admin.card title="Tambah Berita Campaign">
                <form action="{{ route('admin.campaign-latest-news.store') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf


                    <x-form.select label="Campaign" name="campaign_id" :options="$campaigns" key="id"
                        value="title" />

                    <x-form.input label="Tanggal" name="date" type="date" />

                    <x-form.input label="Judul" name="title" />

                    <x-form.mde label="Content" name="content" id="content" />

                    <x-button.primary class="float-end" type="submit">
                        Simpan
                    </x-button.primary>
                </form>
            </x-admin.card>
        </div>
    </div>
</x-layouts.admin>
