<x-layouts.admin>
    <div class="d-flex align-items-center justify-content-between">
        <nav class="page-breadcrumb mb-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Manajemen Campaign</a></li>
                <li class="breadcrumb-item">Campaign</li>
                <li class="breadcrumb-item active" aria-current="page">Create</li>

            </ol>
        </nav>
        <a href="{{ route('admin.campaigns.index') }}" class="btn btn-danger btn-sm ml-auto mb-3">Kembali</a>
    </div>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <x-admin.card title="Tambah Campaign">
                <form action="{{ route('admin.campaigns.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <x-form.select label="Kategori" name="campaign_category_id" :options="$categories" />

                    @if (!Auth::user()->hasRole('mitra'))

                        <div class="mb-3">
                            <label for="mitra_id" class="form-label">Mitra</label>

                            <select name="mitra_id" id="mitra_id" class="form-select" required>
                                <option value="">Pilih Mitra</option>
                                @foreach ($mitras as $mitra)
                                    <option value="{{ $mitra->mitraRelation->id }}">
                                        {{ $mitra->mitraRelation->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <input type="hidden" name="status" value="verified">
                    @else
                        <input type="hidden" name="mitra_id" value="{{ Auth::user()->profile->id }}">
                    @endif

                    <x-form.input label="Title" name="title" id="title" />
                    <x-form.input label="Slug" name="slug" id="slug" />
                    <x-form.file label="Thumbnail" name="thumbnail" />
                    <x-form.mde label="Story" name="story" id="story" />
                    <x-form.select label="Type" name="type" id="type" :options="$types" :selected="old('type')" />
                    <x-form.select 
                        label="Gunakan Fixed Amount?" 
                        name="is_fixed_amount" 
                        id="is_fixed_amount" 
                        :options="$fix_amount" 
                        :selected="old('is_fixed_amount')" 
                    />
                    <div class="mb-3" id="fixedAmountField" style="display: none;">
                        <label for="fixed_amount" class="form-label">Fixed Amount</label>
                        <input type="number" name="fixed_amount" id="fixed_amount" class="form-control" value="{{ old('fixed_amount') }}">
                    </div>
                    <x-form.input label="Target Donasi" name="target" />
                    <x-input.date label="Tanggal Berakhir" name="end_date" />
                    <x-button.primary class="float-end" type="submit">
                        Simpan
                    </x-button.primary>
                </form>
            </x-admin.card>
        </div>
    </div>

    @push('custom-scripts')
        <script>
            $(document).ready(function() {
                $('#title').on('keyup', function() {
                    $('#slug').val($(this).val().toLowerCase().split(',').join('').replace(/\s/g, "-"));
                });

                let $isFixedAmountSelect = $("#is_fixed_amount");
                let $fixedAmountField = $("#fixedAmountField");

                function toggleFixedAmount() {
                    if ($isFixedAmountSelect.val() === "1") {
                        $fixedAmountField.show();
                    } else {
                        $fixedAmountField.hide();
                    }
                }

                $isFixedAmountSelect.change(toggleFixedAmount);
                toggleFixedAmount(); // Jalankan saat halaman dimuat
            });
        </script>
    @endpush
</x-layouts.admin>
