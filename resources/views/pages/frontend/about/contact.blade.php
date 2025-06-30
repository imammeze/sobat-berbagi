<x-layouts.frontend title="Kontak Kami">
    @include('sweetalert::alert')
    <div class="container">
        <div class="row mt-5">
            <div class="col-6">
                <form action="{{ route('contact.store') }}" method="POST">
                    @csrf
                    <h1 class="heading-contact">Hubungi Kami</h1>
                    <p class="subheading-contact mb-5">Jika ada hal yang ingin Anda diskusikan <br> mengenai layanan
                        kami,
                        tolong
                        hubungi
                        kami.</p>
                    <x-input.text label="Nama" placeholder="Nama Lengkap" name="name" />
                    <x-input.text label="Email" placeholder="email@company.com" name="email" />
                    <x-input.text label="Perusahaan Anda" placeholder="Nama Perusahaan" name="company" />
                    <x-input.text label="Nomor Telepon" placeholder="+62 (821) 000-0000" name="phone" />
                    <x-input.textarea label="Pesan" placeholder="Tulis pesan Anda disini" name="message" />
                    <x-button.primary class="rounded-5 w-100 py-3" type="submit">Kirim Pesan</x-button.primary>
                </form>
            </div>
            <div class="col-6">
                <img src="{{ asset('frontend/assets/images/auth/welcome-authentication.jpg') }}" alt="contact-img"
                    class="img-contact float-end rounded-3">
            </div>
        </div>
    </div>
    <div class="container mt-5 pt-5">
        <h1 class="heading-contact">Atau Hubungi Kami melalui cara lain</h1>
        <p class="subheading-contact">Kami akan melakukan yang terbaik untuk segera menjawab pertanyaan Anda.</p>
        <div class="row mt-5">
            <div class="col">
                <div class="card card-contact border-0">
                    <div class="card-body">
                        <img src="{{ asset('frontend/assets/images/icon/Featured icon.svg') }}" alt="">
                        <h1 class="mt-3">Chat Kami</h1>
                        <p class="mb-2">Dengan senang hati membantu</p>
                        <a href="mailto:lazismu.bms@gmail.com">
                            lazismu.bms@gmail.com
                        </a>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card card-contact border-0">
                    <div class="card-body">
                        <img src="{{ asset('frontend/assets/images/icon/Featured icon.svg') }}" alt="">
                        <h1 class="mt-3">Kunjungi Kami</h1>
                        <p class="mb-2">Kunjungi kantor kami.</p>
                        <a href="">
                            Gedung Kantor Pimpinan Daerah Muhammadiyah Banyumas
                        </a>
                        <a href="">
                            Jalan dr. Angka No. 1, Sokanegara, Kec. Purwokerto Timur

                        </a>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card card-contact border-0">
                    <div class="card-body">
                        <img src="{{ asset('frontend/assets/images/icon/Featured icon.svg') }}" alt="">
                        <h1 class="mt-3">Hubungi Kami</h1>
                        <p class="mb-2">Melalui nomor dibawah ini.</p>
                        <a href="tel:+6281234567890">
                            (0281) 642 927
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.frontend>
