<footer class="footer">
    <div class="container-md">
        <div class="row">
            <div class="left-col col-lg-4">
                <section class="mb-3">
                    <a class="brand" href="<?= base_url(); ?>">
                        <img src="<?= base_url('assets/brand-white.svg'); ?>" alt="brand" height="32" width="100%">
                        <div class="text-brand">
                            <span class="primary">TOKUKAS</span>
                            <span class="secondary">Toko Buku Bekas</span>
                        </div>
                    </a>
                </section>
                <section class="mb-4">
                    <a href="https://www.google.com/maps/search/tokukas" data-bs-toggle="tooltip" data-bs-placement="top" title="Lihat Lokasi" aria-label="Lihat Lokasi TOKUKAS">
                        <span>Jalan Pabean Kencana Raya No. 32, Desa Pabean Udik, Kec. Indramayu, Kab. Indramayu, Jawa Barat 45219, Indonesia.</span>
                    </a>
                </section>
                <section class="icon-bar mb-3">
                    <a href="mailto:cs@tokukas.com" data-bs-toggle="tooltip" data-bs-placement="bottom" title="cs@tokukas.com" aria-label="Email ke cs@tokukas.com">
                        <div class="icon-box">
                            <i class="material-icons">email</i>
                        </div>
                    </a>
                    <a href="https://wa.me/+6285315360808" data-bs-toggle="tooltip" data-bs-placement="bottom" title="+6285315360808" aria-label="Whatsapp ke +6285315360808">
                        <div class="icon-box">
                            <i class="fab fa-whatsapp fa-lg"></i>
                        </div>
                    </a>
                    <a href="https://t.me/tokukas" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Telegram TOKUKAS" aria-label="Gabung ke Channel Telegram">
                        <div class="icon-box">
                            <i class="fab fa-telegram fa-lg"></i>
                        </div>
                    </a>
                    <a href="https://signal.group/#CjQKIBOOTbfokZmxTuuAEuS-y-v0frkY6A3yjxdMJLh9f2OYEhDQWSDd7K8InBIEp7m1kYuY" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Signal TOKUKAS" aria-label="Gabung ke Channel Signal">
                        <div class="icon-box">
                            <img src="<?= base_url('assets/signal-app-icon-white.svg'); ?>" alt="linktree icon" height="22" width="22">
                        </div>
                    </a>
                    <a href="https://linktr.ee/tokukas" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Linktree TOKUKAS" aria-label="Linktree TOKUKAS">
                        <div class="icon-box">
                            <img src="<?= base_url('assets/linktree-icon-white.svg'); ?>" alt="linktree icon" height="22" width="22">
                        </div>
                    </a>
                </section>
            </div>
            <div class="right-col col-lg-4">
                <section class="mb-3">
                    <h2>Yang Bekas Pasti Lebih Murah!</h2>
                </section>
                <section>
                    <div class="footer-menus">
                        <a href="<?= base_url('about'); ?>" class="menu">
                            <i class="material-icons">chevron_right</i>
                            <span>Tentang Kami</span>
                        </a>
                        <a href="<?= base_url('sell'); ?>" class="menu">
                            <i class="material-icons">chevron_right</i>
                            <span>Jual Buku</span>
                        </a>
                    </div>
                </section>
            </div>
            <div class="col-lg-4">
                <section class="mb-3 text-center">
                    <p><b>Kunjungi Toko Kami di :</b></p>
                </section>
                <section class="d-flex gap-3 justify-content-center mb-3">
                    <a href="https://tokopedia.com/tokukas" rel="noreferrer" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Lihat di Tokopedia">
                        <picture>
                            <source media="(min-width: 1080px)" srcset="<?= base_url('assets/tokopedia-360w.png'); ?>">
                            <source media="(min-width: 720px)" srcset="<?= base_url('assets/tokopedia-120w.png'); ?>">
                            <img class="shop-icon" src="<?= base_url('assets/tokopedia-60w.png'); ?>" alt="Logo Tokopedia" height="60" width="100%">
                        </picture>
                    </a>
                    <a href="https://shopee.co.id/tokukas" rel="noreferrer" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Lihat di Shopee">
                        <picture>
                            <source media="(min-width: 1080px)" srcset="<?= base_url('assets/shopee-360w.png'); ?>">
                            <source media="(min-width: 640px)" srcset="<?= base_url('assets/shopee-120w.png'); ?>">
                            <img class="shop-icon" src="<?= base_url('assets/shopee-60w.png'); ?>" alt="Logo Shopee" height="60" width="100%">
                        </picture>
                    </a>
                </section>
            </div>
        </div>
    </div>
    <div class="container-fluid bottom">
        <div class="container-md">
            <section>
                <span>&copy; 2021 - TOKUKAS</span>
            </section>
            <section class="d-inline-flex gap-2 text-center">
                <a href="<?= base_url('terms'); ?>">Syarat Penggunaan</a>
                <div class="vr"></div>
                <a href="<?= base_url('privacy'); ?>">Kebijakan Privasi</a>
            </section>
        </div>
    </div>
</footer>
