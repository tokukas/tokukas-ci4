<?php

// get the value of the variable to be displayed
$brandName = $variable->getVar('brand_name') ?: 'TOKUKAS';
$brandName2 = $variable->getVar('brand_name2') ?: 'Toko Buku Bekas';

?>

<nav class="navbar navbar-expand-lg navbar-light container-fluid">
    <div class="container-md">
        <a class="navbar-brand" href="<?= base_url(); ?>">
            <img src="<?= base_url('assets/brand.svg'); ?>" alt="brand" height="32" width="100%">
            <div class="text-brand">
                <span class="primary"><?= esc($brandName); ?></span>
                <span class="secondary"><?= esc($brandName2); ?></span>
            </div>
        </a>
        <button class="hamburger-menu" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <div class="line line1"></div>
            <div class="line line2"></div>
            <div class="line line3"></div>
        </button>
        <div class="collapse navbar-collapse justify-content-between" id="navbarNavDropdown">
            <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 10rem;">
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('about'); ?>">Tentang Kami</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('sell'); ?>">Jual Buku</a>
                </li>
                <li class="nav-item dropdown d-none">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Dropdown link
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <li><a class="dropdown-item" href="#">Action</a></li>
                        <li><a class="dropdown-item" href="#">Another action</a></li>
                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                    </ul>
                </li>
            </ul>
            <hr class="my-sm-2">
            <?php if (empty($loginSession)) : ?>
                <div class="button-group d-flex gap-2">
                    <a href="<?= base_url('login'); ?>" class="btn btn-outline-primary">Masuk</a>
                    <a href="<?= base_url('register'); ?>" class="btn btn-primary">Daftar</a>
                </div>
            <?php else : ?>
                <div class="dropdown">
                    <button class="dropdown-toggle btn btn-outline-primary my-sm-2" id="profileDropdownMenuLink" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="material-icons">account_circle</i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-lg-end profile-menus" aria-labelledby="profileDropdownMenuLink">
                        <li>
                            <a class="dropdown-item btn btn-primary" href="<?= base_url('account'); ?>">
                                <i class="material-icons">account_circle</i>
                                <span><strong><?= $loginSession['name']; ?></strong></span>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item btn" href="<?= base_url('settings'); ?>">
                                <i class="material-icons">settings</i>
                                <span>Pengaturan</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <button type="button" class="dropdown-item btn btn-danger" data-bs-toggle="modal" data-bs-target="#logoutModal">
                                <i class="material-icons">logout</i>
                                <span>Keluar</span>
                            </button>
                        </li>
                    </ul>
                </div>
            <?php endif; ?>
        </div>
    </div>
</nav>

<!-- Logout confirm dialog -->
<div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalConfirmation" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="logoutModalConfirmation">Konfirmasi Keluar</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <span>Anda yakin ingin keluar?</span>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">
                    <i class="material-icons">close</i>
                    <span>Batalkan</span>
                </button>
                <a href="<?= base_url('logout'); ?>" class="btn btn-outline-danger">
                    <i class="material-icons">logout</i>
                    <span>Keluar</span>
                </a>
            </div>
        </div>
    </div>
</div>
