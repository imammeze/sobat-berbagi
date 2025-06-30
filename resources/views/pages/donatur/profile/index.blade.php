<x-layouts.donatur title="Profil">
    @push('styles')
        <style>
            .fas {
                font-size: 1.5rem;
            }


            .menu-item {
                background-color: #F6F7F9
            }

            .menu-item:hover {
                background-color: #E5E5E5
            }

            .menu-item:active {
                background-color: #E5E5E5
            }

            .fa-chevron-right {
                font-size: 1rem;
            }
        </style>
    @endpush


    <div class="d-block d-sm-block d-md-none d-lg-none">
        <div class="bg-primary">
            <h6 class="text-white py-3 px-3">Profil</h6>
        </div>

        <div class="container mt-3">
            <div class="d-flex flex-column align-items-center justify-content-center">
                <img src="{{ asset(Auth::user()->donaturRelation->avatar) }}"
                    alt="{{ Auth::user()->donaturRelation->name }}" class="img-fluid rounded-circle" width="60">
                <h6 class="mt-3">{{ Auth::user()->donaturRelation->name }}</h6>
                <p class="text-muted">{{ Auth::user()->email }}</p>
                <a href="{{ route('donatur.profile.edit') }}" class="btn btn-primary btn-sm mt-3 rounded-5 px-4">Edit
                    Profil</a>
            </div>

            <h6 class="fw-bold mt-5">Donasi</h6>
            <div class="d-flex flex-column gap-2 mt-3">
                <div class="menu-item d-flex align-items-center justify-content-between p-3"
                    onclick="window.location.href='{{ route('donatur.dashboard') }}'">
                    <div class="d-flex align-items-center gap-2">
                        <i class="fas fa-chart-line"></i>
                        <h6 class="mb-0">Dashboard</h6>
                    </div>
                    <i class="fas fa-chevron-right"></i>
                </div>
                <div class="menu-item d-flex align-items-center justify-content-between p-3"
                    onclick="window.location.href='{{ route('donatur.transaction') }}'">
                    <div class="d-flex align-items-center gap-2">
                        <i class="fas fa-history"></i>
                        <h6 class="mb-0">Riwayat Transaksi</h6>
                    </div>
                    <i class="fas fa-chevron-right"></i>
                </div>
            </div>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <x-button.primary-outline type="submit" class="w-100 mt-5 rounded-5 px-4"
                    onclick="return confirm('Apakah anda yakin ingin keluar?')">
                    Keluar
                </x-button.primary-outline>
            </form>
        </div>

    </div>

    <div class="row mt-3 p-3">
        <div class="col-12">
            <h4 class="fw-bold">Profil</h4>

            <div class="d-flex justify-content-between align-items-center mt-3">
                <div class="title">
                    <h5>Data Diri</h5>
                    <p>Ubah data personal anda disini.</p>
                </div>
                <x-button.primary>
                    Simpan
                </x-button.primary>
            </div>


            <form action="{{ route('donatur.profile.update') }}" method="POST" class="mt-3">
                @csrf
                <x-form.input name="name" label="Nama" value="{{ Auth::user()->donaturRelation->name }}" />
                <x-form.input name="email" label="Email" value="{{ Auth::user()->email }}" disabled />
                <x-form.input name="phone_number" label="Nomor Telepon"
                    value="{{ Auth::user()->donaturRelation->phone_number }}" />
                <x-form.textarea name="address" label="Alamat" value="{{ Auth::user()->donaturRelation->address }}" />
                <x-button.primary type="submit">
                    Simpan
                </x-button.primary>
            </form>
        </div>
    </div>

    @push('custom-scripts')
        <script>
            $('footer').hide();
            $('.footer-border').hide();
        </script>
    @endpush
</x-layouts.donatur>
