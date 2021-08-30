<?php

// get the value of the variable to be displayed
$brandName = $variable->getVar('brand_name');
$brandName2 = $variable->getVar('brand_name2');
$brandJargon = $variable->getVar('brand_jargon');
$ourEmail = $variable->getVar('contact_email_cs');
$ourWhatsapp = $variable->getVar('contact_whatsapp');
$ourTelegram = $variable->getVar('contact_telegram');
$ourSignal = $variable->getVar('link_signal_channel');
$ourInstagram = $variable->getVar('contact_instagram');
$ourTwitter = $variable->getVar('contact_twitter');
$ourLinktree = $variable->getVar('link_linktree');
$ourShopee = $variable->getVar('link_store_shopee');
$ourTokopedia = $variable->getVar('link_store_tokopedia');
$ourAddress = $variable->getVar('store_address') ?: 'null';

?>

<footer class="footer">
    <div class="container-md">
        <div class="row">
            <div class="left-col col-lg-4">
                <section class="mb-3">
                    <a class="brand" href="<?= base_url(); ?>">
                        <img src="<?= base_url('assets/brand-white.svg'); ?>" alt="brand" height="32" width="100%">
                        <div class="text-brand">
                            <span class="primary" translate="no"><?= esc($brandName) ?></span>
                            <span class="secondary"><?= esc($brandName2); ?></span>
                        </div>
                    </a>
                </section>
                <section class="mb-4">
                    <a href="https://www.google.com/maps/search/tokukas" data-bs-toggle="tooltip" data-bs-placement="top" title="Lihat Lokasi" aria-label="Lihat Lokasi <?= esc($brandName, 'attr') ?>">
                        <p translate="no"><?= esc($ourAddress); ?></p>
                    </a>
                </section>
                <section class="icon-bar mb-3">
                    <a href="https://www.instagram.com/<?= esc($ourInstagram, 'attr'); ?>" data-bs-toggle="tooltip" data-bs-placement="top" title="<?= esc($ourInstagram, 'attr'); ?>" aria-label="Instagram <?= esc($brandName, 'attr') ?>">
                        <div class="icon-box">
                            <i translate="no" class="fab fa-instagram fa-lg"></i>
                        </div>
                    </a>
                    <a href="https://twitter.com/<?= esc($ourTwitter, 'attr'); ?>" data-bs-toggle="tooltip" data-bs-placement="top" title="<?= esc($ourTwitter, 'attr'); ?>" aria-label="Twitter <?= esc($brandName, 'attr') ?>">
                        <div class="icon-box">
                            <i translate="no" class="fab fa-twitter fa-lg"></i>
                        </div>
                    </a>
                    <a href="mailto:<?= esc($ourEmail, 'attr') ?>" data-bs-toggle="tooltip" data-bs-placement="top" title="<?= esc($ourEmail, 'attr') ?>" aria-label="Email ke <?= esc($ourEmail, 'attr') ?>">
                        <div class="icon-box">
                            <i translate="no" class="fas fa-envelope fa-lg"></i>
                        </div>
                    </a>
                    <a href="https://wa.me/<?= esc($ourWhatsapp, 'attr') ?>" data-bs-toggle="tooltip" data-bs-placement="top" title="<?= esc($ourWhatsapp, 'attr') ?>" aria-label="Whatsapp ke <?= esc($ourWhatsapp, 'attr') ?>">
                        <div class="icon-box">
                            <i translate="no" class="fab fa-whatsapp fa-lg"></i>
                        </div>
                    </a>
                    <a href="https://t.me/<?= esc($ourTelegram, 'attr'); ?>" data-bs-toggle="tooltip" data-bs-placement="top" title="<?= esc($ourTelegram, 'attr'); ?>" aria-label="Gabung ke Channel Telegram">
                        <div class="icon-box">
                            <i translate="no" class="fab fa-telegram fa-lg"></i>
                        </div>
                    </a>
                    <a href="<?= esc($ourSignal, 'attr'); ?>" data-bs-toggle="tooltip" data-bs-placement="top" title="Signal <?= esc($brandName, 'attr') ?>" aria-label="Gabung ke Channel Signal">
                        <div class="icon-box">
                            <img src="<?= base_url('assets/signal-app-icon-white.svg'); ?>" alt="linktree icon" height="22" width="22">
                        </div>
                    </a>
                    <a href="<?= esc($ourLinktree, 'attr'); ?>" data-bs-toggle="tooltip" data-bs-placement="top" title="Linktree <?= esc($brandName, 'attr') ?>" aria-label="Linktree <?= esc($brandName, 'attr') ?>">
                        <div class="icon-box">
                            <img src="<?= base_url('assets/linktree-icon-white.svg'); ?>" alt="linktree icon" height="22" width="22">
                        </div>
                    </a>
                </section>
            </div>
            <div class="right-col col-lg-4">
                <section class="mb-3">
                    <p class="h3"><?= esc($brandJargon); ?></p>
                </section>
                <section>
                    <div class="footer-menus">
                        <a href="<?= base_url('about'); ?>" class="menu">
                            <i class="material-icons" translate="no">chevron_right</i>
                            <span>Tentang Kami</span>
                        </a>
                        <a href="<?= base_url('sell'); ?>" class="menu">
                            <i class="material-icons" translate="no">chevron_right</i>
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
                    <a href="<?= esc($ourTokopedia, 'attr'); ?>" rel="noreferrer" data-bs-toggle="tooltip" data-bs-placement="top" title="Lihat di Tokopedia" translate="no">
                        <picture>
                            <source media="(min-width: 1080px)" srcset="<?= base_url('assets/tokopedia-360w.png'); ?>">
                            <source media="(min-width: 720px)" srcset="<?= base_url('assets/tokopedia-120w.png'); ?>">
                            <img class="shop-icon" src="<?= base_url('assets/tokopedia-60w.png'); ?>" alt="Logo Tokopedia" height="60" width="100%">
                        </picture>
                    </a>
                    <a href="<?= esc($ourShopee, 'attr'); ?>" rel="noreferrer" data-bs-toggle="tooltip" data-bs-placement="top" title="Lihat di Shopee" translate="no">
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
                <span translate="no">&copy; 2021 - <?= esc($brandName) ?></span>
            </section>
            <section class="d-inline-flex gap-2 text-center">
                <a href="<?= base_url('terms'); ?>">Syarat Penggunaan</a>
                <div class="vr"></div>
                <a href="<?= base_url('privacy'); ?>">Kebijakan Privasi</a>
            </section>
        </div>
    </div>
</footer>
