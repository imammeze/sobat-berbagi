<x-layouts.admin>
    <div class="d-flex align-items-center justify-content-between">
        <nav class="page-breadcrumb mb-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Manajemen FAQ</a></li>
                <li class="breadcrumb-item">FAQ</li>
                <li class="breadcrumb-item active" aria-current="page">Edit</li>

            </ol>
        </nav>
        <a href="{{ route('admin.faqs.index') }}" class="btn btn-danger btn-sm ml-auto mb-3">Kembali</a>
    </div>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <x-admin.card title="Edit FAQ">
                <form action="{{ route('admin.faqs.update', $faq->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <x-input.select label="Kategori" name="faq_category_id" :options="$categories" :value="$faq->faq_category_id" />
                    <x-input.text label="Pertanyaan" name="question" :value="$faq->question" />
                    <x-form.mde label="Jawaban" name="answer" id="answer" :value="$faq->answer" />
                    <x-button.primary class="float-end" type="submit">
                        Simpan
                    </x-button.primary>
                </form>
            </x-admin.card>
        </div>
    </div>
</x-layouts.admin>
