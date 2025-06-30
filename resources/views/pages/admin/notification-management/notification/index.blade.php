<x-layouts.admin>

    <div class="d-flex align-items-center justify-content-between">
        <nav class="page-breadcrumb mb-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Manajemen Notifikasi</a></li>
                <li class="breadcrumb-item active" aria-current="page">Kirim</li>

            </ol>
        </nav>
    </div>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">

            <x-admin.card title="Kirim Notifikasi">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" id="tab-1-link" data-toggle="tab" href="#tab-1">
                            Notifikasi Blast
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="tab-2-link" data-toggle="tab" href="#tab-2">
                            Notifikasi Personal
                        </a>
                    </li>


                </ul>
                <div class="tab-content mt-3">
                    <div class="tab-pane fade show active" id="tab-1" role="tabpanel" aria-labelledby="tab-1-link">
                        <form action="{{ route('admin.notification.store') }}" method="POST">
                            @csrf
                            <x-input.textarea name="message" label="Pesan"
                                value="Halo!

Ayo ajak teman-teman dan keluarga untuk bergabung dalam kampanye donasi kita! Dengan berbagi, kita bisa mencapai target lebih cepat dan memberikan dampak lebih besar. Gunakan tagar #DonasiBersama!

🤝 Bagikan Link Donasi: [Link Donasi]

Terima kasih atas dukungan dan kerjasamanya!

Salam,
Lazismu Banyumas
" />
                            <x-button.primary type="submit">Kirim</x-button.primary>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="tab-2" role="tabpanel" aria-labelledby="tab-2-link">
                        <form action="{{ route('admin.notification.store-single') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="penerima" class="form-label">Penerima</label>
                                <select name="number" id="number" class="form-select">
                                    <option value="">Pilih Penerima</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->donaturRelation->phone_number ?? '' }}">
                                            {{ $user->donaturRelation->name ?? '' }} -
                                            {{ $user->donaturRelation->phone_number ?? '' }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <x-input.textarea name="message" label="Pesan"
                                value="Halo *[Nama User]*!

Ayo ajak teman-teman dan keluarga untuk bergabung dalam kampanye donasi kita! Dengan berbagi, kita bisa mencapai target lebih cepat dan memberikan dampak lebih besar. Gunakan tagar #DonasiBersama!

🤝 Bagikan Link Donasi: [Link Donasi]

Terima kasih atas dukungan dan kerjasamanya!

Salam,
Lazismu Banyumas
" />
                            <x-button.primary type="submit">Kirim</x-button.primary>
                        </form>
                    </div>

                </div>

            </x-admin.card>
        </div>
    </div>


    @push('custom-scripts')
        <script>
            $(document).ready(function() {
                $('.nav-tabs a').on('click', function(e) {
                    e.preventDefault();
                    $(this).tab('show');
                });
            });
        </script>
    @endpush
</x-layouts.admin>
