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
                    <!-- Tab untuk Notifikasi Blast -->
                    <div class="tab-pane fade show active" id="tab-1" role="tabpanel" aria-labelledby="tab-1-link">
                        <form action="" method="POST">
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

                    <!-- Tab untuk Notifikasi Personal -->
                    <div class="tab-pane fade" id="tab-2" role="tabpanel" aria-labelledby="tab-2-link">
                        <form action="{{ route('admin.whatsapp.store-single') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="number" class="form-label">Penerima</label>
                                <select name="number" id="number" class="form-select">
                                    <option value="">Pilih Penerima</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->donaturRelation->phone_number ?? '' }}"
                                            data-name="{{ $user->donaturRelation->name ?? '' }}">
                                            {{ $user->donaturRelation->name ?? '' }} -
                                            {{ $user->donaturRelation->phone_number ?? '' }}
                                        </option>
                                    @endforeach
                                </select>
                                <input type="hidden" name="user_name" id="user_name" value="">
                            </div>

                            <!-- Select Kampanye -->
                            <div class="mb-3">
                                <label for="campaign" class="form-label">Nama Kampanye</label>
                                <select name="campaign" id="campaign" class="form-select">
                                    <option value="">Pilih Kampanye</option>
                                    @foreach ($campaigns as $campaign)
                                        <option value="{{ $campaign->title }}" data-link="{{ $campaign->slug }}" data-thumbnail="{{ $campaign->thumbnail }}">
                                            {{ $campaign->title }}
                                        </option>
                                    @endforeach
                                </select>
                                <input type="hidden" name="campaign_title" id="campaign_title" value="">
                                <input type="hidden" name="campaign_link" id="campaign_link" value="">
                                <input type="hidden" name="campaign_thumbnail" id="campaign_thumbnail" value="">
                            </div>

                            <x-input.textarea name="message" label="Pesan"
                                value="Assalamu’alaikum Warahmatullahi Wabarakatuh, *{Nama User}*.
                                
Kami dari Sobat Berbagi ingin mengajak Anda untuk berpartisipasi dalam kampanye donasi *{Nama Kampanye}*. Kampanye ini bertujuan untuk membantu sesama yang membutuhkan, dan kami sangat berharap dukungan Anda agar tujuan mulia ini dapat tercapai.

Ayo ajak teman-teman dan keluarga untuk bergabung dalam kampanye donasi kita! Dengan berbagi, kita bisa mencapai target lebih cepat dan memberikan dampak lebih besar. Gunakan tagar #DonasiBersama!

🤝 Dukung kampanye *{Nama Kampanye}* melalui link berikut: {Link Donasi}

Mari bersama-sama kita jadikan dunia ini lebih baik dengan setiap kontribusi yang kita berikan.
Jazakumullah khairan katsiran atas perhatian dan dukungan Anda.

Wassalamu’alaikum Warahmatullahi Wabarakatuh.  
Sobat Berbagi by Lazismu Banyumas
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

            $('#number').on('change', function() {
                // Ambil data-name dari option yang dipilih
                var selectedName = $(this).find(':selected').data('name');
                
                // Isi hidden input dengan nama pengguna
                $('#user_name').val(selectedName || '');
            });

            $('#campaign').on('change', function() {
                var campaignName = $(this).find(':selected').val();
                var campaignLink = $(this).find(':selected').data('link');
                var campaignThumbnail = $(this).find(':selected').data('thumbnail');

                $('#campaign_title').val(campaignName || '');
                $('#campaign_link').val(campaignLink || '');
                $('#campaign_thumbnail').val(campaignThumbnail || '');
            });
        });
    </script>
    @endpush
</x-layouts.admin>
