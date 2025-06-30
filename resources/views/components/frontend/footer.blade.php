<div class="footer-border border mt-5"></div>
<footer class="text-center text-lg-start mt-5">
    <!-- Grid container -->
    <div class="container p-4 mb-5">
        <!--Grid row-->
        <div class="row">
            <!--Grid column-->
            <div class="col-lg-4 col-md-12 mb-4 mb-md-4">
                <img src="{{ asset('admin/assets/images/logo-sobat-berbagi-2025.png') }}" alt="logo sobat berbagi"
                    class="img-fluid img-logo" width="100">

                <p class="mt-3">
                    Sobat Berbagi adalah platform digital funding yang diterbitkan oleh LAZISMU Banyumas guna memudahkan
                    masyarakat dalam berbagi kebaikan melalui program yang kreatif.
                </p>
            </div>
            <!--Grid column-->

            <!--Grid column-->
            <div class="col-lg-2 col-md-12 mb-4 mb-md-4">
                <h5 class="fw-bold">Kategori</h5>

                <ul class="list-unstyled mt-3 mb-0">
                    <li>
                        <a href="{{ route('campaign.index') }}" class="text-dark text-decoration-none">Donasi</a>
                    </li>
                    <li>
                        <a href="{{ route('zakat-maal') }}" class="text-dark text-decoration-none">Zakat Maal</a>
                    </li>
                </ul>
            </div>
            <!--Grid column-->

            <!--Grid column-->
            <div class="col-lg-2 col-md-12 mb-4 mb-md-4">
                <h5 class="fw-bold mb-0">Mitra Kami</h5>

                <ul class="list-unstyled mt-3">
                    <li>
                        <a href="{{ route('mitra.index') }}" class="text-dark text-decoration-none">Mitra</a>
                    </li>
                    <li>
                        <a href="{{ route('register-mitra') }}" class="text-dark text-decoration-none">Daftar Mitra</a>
                    </li>
                </ul>
            </div>
            <!--Grid column-->

            <!--Grid column-->
            <div class="col-lg-2 col-md-12 mb-4 mb-md-4">
                <h5 class="fw-bold mb-0">FAQ</h5>

                <ul class="list-unstyled mt-3">
                    @foreach (\App\Models\FaqCategory::all()->sortBy('created_at') as $category)
                        <li>
                            <a href="{{ route('faq', ['category' => $category->slug]) }}"
                                class="text-dark text-decoration-none">{{ $category->name }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
            <!--Grid column-->

            <!--Grid column-->
            <div class="col-lg-2 col-md-12 mb-4 mb-md-4">
                <h5 class="fw-bold mb-0">Tentang Kami</h5>

                <ul class="list-unstyled mt-3">
                    <li>
                        <a href="{{ route('about-us') }}" class="text-dark text-decoration-none">Profil</a>
                    </li>
                    <li>
                        <a href="{{ route('vision-mission') }}" class="text-dark text-decoration-none">Visi & Misi</a>
                    </li>
                    <li>
                        <a href="{{ route('news.index') }}" class="text-dark text-decoration-none">Berita</a>
                    </li>
                    <li>
                        <a href="{{ route('contact') }}" class="text-dark text-decoration-none">Hubungi Kami</a>
                    </li>
                </ul>
            </div>
            <!--Grid column-->
        </div>
        <!--Grid row-->
    </div>
    <!-- Grid container -->

    <div class="pe-5 ps-5">
        <div class="border mt-5 mb-4"></div>
    </div>
    <!-- Copyright -->
    <div class="container  mb-5">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-6">
                <p>
                    Copyright © {{ date('Y') }} <a class="text-dark text-decoration-none fw-bold"
                        href="https://sobatberbagi.com/">Sobat Berbagi</a> by Lazismu Banyumas
                </p>
            </div>
            <div class="col-12 col-sm-12 col-md-12 col-lg-6 mt-4 mt-sm-4 mt-md-0 mt-lg-0">
                <section class="d-flex justify-content-center justify-content-md-center justify-content-lg-end">
                    <div>
                        <a href="https://www.facebook.com/majalah.matahati.1/"
                            class="text-dark text-decoration-none me-4" target="_blank">
                            <i class="fa-brands fa-facebook"></i>
                        </a>
                        <a href="https://instagram.com/lazismubanyumas" class="text-dark text-decoration-none me-4"
                            target="_blank">
                            <i class="fa-brands fa-instagram"></i>
                        </a>
                        <a href="https://www.youtube.com/channel/UCd0B0l5uwESLpi0omNFq_KA"
                            class="text-dark text-decoration-none me-4" target="_blank">
                            <i class="fa-brands fa-youtube"></i>
                        </a>
                    </div>
                </section>
            </div>
        </div>
    </div>
    <!-- Copyright -->
</footer>
