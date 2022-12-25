<footer class="shadow-sm">
    <div class="footer-start">
        <div class="container pt-3">
            <div class="row">
                <div class="col-lg-4 bg-white shadow rounded-5" style="z-index:10">
                    <div class="p-4 m-auto">
                        <img class="img-fluid" src="{{ asset('images/logo-dinkes-simkesda.png') }}" alt="Logo Dinkes">

                        <p class="mt-3">
                            SIMKESDA (Sistem Informasi Kesehatan Daerah) Kabupaten Tapanuli Selatan merupakan
                            suatu media yang digunakan untuk mempermudah penyebaran dan pengelolaan informasi
                            kesehatan daerah berbasis aplikasi website. Aplikasi ini dikelola langsung oleh
                            Dinas Kesehatan Kabupaten Tapanuli Selatan.
                        </p>

                        <hr />
                        <div class="small mb-3">
                            <div class="fw-bold text-uppercase">
                                Dinas Kesehatan Kabupaten Tapanuli Selatan
                            </div>
                            <table class="table table-sm table-borderless">
                                <tr>
                                    <td>
                                        <i class="fas fa-phone"></i>
                                    </td>
                                    <td>
                                        +62
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <i class="fas fa-envelope"></i>
                                    </td>
                                    <td>
                                        simkesda@tapselkab.go.id
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <i class="fas fa-house-chimney-medical"></i>
                                    </td>
                                    <td>
                                        Kompleks Perkantoran Pemerintahan Tapanuli Selatan Jalan Profesor Lafran Pane
                                        Sipirok. Kode Pos 22742
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3988.4196153265634!2d99.3023810064275!3d1.517179006751781!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x302c23268c2b2df3%3A0xaa9fe777ce8731a1!2sDinas%20Kesehatan%20Daerah%20Kab.%20Tapanuli%20Selatan!5e0!3m2!1sid!2sid!4v1638134402155!5m2!1sid!2sid"
                            width="100%" height="200" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                    </div>
                </div>
                <div class="col-lg-8 bg-white mt-5 mt-md-3 mt-lg-5 mb-lg-5 rounded-5-end">
                    <div class="row p-4">
                        <div class="col-md-6">
                            <div class="title">
                                Berita Terkini
                            </div>
                            @if ($footer_posts->count() > 0)
                                <ul>
                                    @foreach ($footer_posts as $post)
                                        <li>
                                            <a href="{{ route('post.show', $post->slug) }}">
                                                {{ $post->title }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <div class="no-data-found">
                                    Tidak ada berita tersedia.
                                </div>
                            @endif

                            <div class="title">
                                Pengumuman
                            </div>
                            @if ($footer_announcements->count() > 0)
                                <ul>
                                    @foreach ($footer_announcements as $announcement)
                                        <li>
                                            <a href="{{ route('announcement.show', $announcement->slug) }}">
                                                {{ $announcement->title }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <div class="no-data-found">
                                    Tidak ada pengumuman tersedia.
                                </div>
                            @endif
                        </div>
                        <div class="col-md-6 mt-3 mt-md-0">
                            <div class="title">
                                Menu
                            </div>
                            <ul>
                                @foreach (DataHelper::get_frontend_menus() as $menu)
                                    <li>
                                        <a href="{{ $menu['href'] }}">
                                            {{ $menu['title'] }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                            <div class="title">
                                Ikuti Kami
                            </div>
                            <div class="sosmed-group">
                                <a class="btn-sosmed btn-facebook" href="https://www.facebook.com/" target="_blank">
                                    <i class="fab fa-facebook"></i>
                                </a>
                                <a class="btn-sosmed btn-instagram" href="https://www.instagram.com/" target="_blank">
                                    <i class="fab fa-instagram"></i>
                                </a>
                                <a class="btn-sosmed btn-twitter" href="https://www.twitter.com/" target="_blank">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                <a class="btn-sosmed btn-youtube" href="https://www.youtube.com/" target="_blank">
                                    <i class="fab fa-youtube"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-end">
        <div class="container">
            <div class="small text-center text-md-end text-white py-1">
                Hak Cipta &copy;{{ date('Y') }}
                {{ config('app.name') }}. <br />
                {{ config('app.unit_name') }}. Hak Cipta Dilindungi Undang-Undang.<br />
                Versi {{ config('app.version') }}.
            </div>
        </div>
    </div>
</footer>
