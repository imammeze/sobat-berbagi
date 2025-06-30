<x-layouts.admin>
    <div class="d-flex align-items-center justify-content-between">
        <nav class="page-breadcrumb mb-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Manajemen Transaksi</a></li>
                <li class="breadcrumb-item"><a href="#">Metode Pembayaran</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit</li>
            </ol>
        </nav>
        <a href="{{ route('admin.metode-pembayaran.index') }}" class="btn btn-danger btn-sm ml-auto mb-3">Kembali</a>
    </div>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <x-admin.card title="Edit Metode Pembayaran">
                <form action="{{ route('admin.metode-pembayaran.update', $paymentMethod->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <x-input.text label="Kode" name="code" :value="$paymentMethod->code" />
                    <x-input.text label="Nama" name="name" :value="$paymentMethod->name" />
                    <x-input.file label="Logo" name="logo" />
                    <x-input.text label="Nomor" name="number" :value="$paymentMethod->number" />
                    <x-input.text label="Pemilik" name="owner" :value="$paymentMethod->owner" />
                    <div class="mb-3">
                        <label for="category" class="form-label">Kategori</label>
                        <select class="form-control @error('category') is-invalid @enderror" id="category"
                            name="category">
                            <option value="">Pilih Kategori</option>
                            <option value="zakat" {{ $paymentMethod->category == 'zakat' ? 'selected' : '' }}>Zakat
                            </option>
                            <option value="infaq" {{ $paymentMethod->category == 'infaq' ? 'selected' : '' }}>Infak
                            </option>
                        </select>
                        @error('category')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <x-button.primary class="float-end" type="submit">
                        Simpan
                    </x-button.primary>
                </form>
            </x-admin.card>
        </div>
    </div>
</x-layouts.admin>
