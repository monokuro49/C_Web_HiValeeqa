<section class="footer bg-dark p-5">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-4 mb-5">
                <h2 class="pb-4 mb-4 text-pink border-bottom border-foot">HI VALEEQA</h2>
                <ul class="list-unstyled mb-5">
                    <li class="mb-3 align-items-center d-flex"><i class='bx bxs-map bx-sm me-2'></i> Jember, Jawa Timur
                    </li>
                    <li class="mb-3 align-items-center d-flex"><i class='bx bxs-envelope bx-sm me-2'></i>
                        hi-valeeqa@gmail.com</li>
                    <li class="mb-3">
                        <a href="https://www.instagram.com/hi.valeeqa"
                           rel="nofollow"
                           target="_blank"
                           class="justify-content-start align-items-center d-flex">
                            <i class='bx bxl-instagram bx-sm me-2'></i> hi.valeeqa
                        </a>
                    </li>
                </ul>
            </div>
            <div class="col-12 col-lg-4 mb-5">
                <h2 class="fw-light pb-4 mb-4 border-bottom border-foot">Produk</h2>
                <ul class="list-unstyled mb-5">
                    <li class="mb-3">
                        <a href="{{ url('shop') }}">Chayra Abaya</a>
                    </li>
                    <li class="mb-3">
                        <a href="{{ url('shop') }}">Yumna Dress</a>
                    </li>
                </ul>
            </div>
            <div class="col-12 col-lg-4 mb-5">
                <h2 class="fw-light pb-4 mb-4 border-bottom border-foot">Layanan</h2>
                <ul class="list-unstyled mb-5">
                    <li class="mb-3">
                        <a href="{{ url('about-us') }}">Tentang Kami</a>
                    </li>
                    <li class="mb-3">
                        <a href="{{ session()->has('loggedIn') ? url('contact') : url('login') }}">Kontak</a>
                    </li>
                    <li class="mb-3">
                        <a href="{{ url('privacy-policy') }}">Kebijakan Privasi</a>
                    </li>
                    <li class="mb-3">
                        <a href="{{ url('terms-conditions') }}">Syarat dan Ketentuan</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>

<section class="copyright bg-black py-3">
    <div class="container">
        <div class="row pt-2">
            <div class="col-12">
                <p class="text-left text-light">
                    Copyright &copy; <?= Date('Y') ?> Hi Valeeqa
                </p>
            </div>
        </div>
    </div>
</section>
