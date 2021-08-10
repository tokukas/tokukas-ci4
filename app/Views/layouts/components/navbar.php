<nav class="navbar navbar-expand-lg navbar-light container-fluid">
    <div class="container-md">
        <a class="navbar-brand" href="<?= base_url('/'); ?>">
            <img src="<?= base_url('/assets/brand.svg'); ?>" alt="brand" height="32">
            <div class="text-brand">
                <span class="primary">TOKUKAS</span>
                <span class="secondary">Toko Buku Bekas</span>
            </div>
        </a>
        <button class="hamburger-menu" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <div class="line line1"></div>
            <div class="line line2"></div>
            <div class="line line3"></div>
        </button>
        <div class="collapse navbar-collapse justify-content-between" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('/about'); ?>">Tentang Kami</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('/sell'); ?>">Jual Buku</a>
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
            <hr>
            <div class="button-group d-flex gap-2">
                <?php if (empty($loginSession)) : ?>
                    <a href="<?= base_url('/login'); ?>" class="btn btn-outline-primary">Masuk</a>
                    <a href="<?= base_url('/register'); ?>" class="btn btn-primary">Daftar</a>
                <?php else : ?>
                    <button class="btn btn-light"><?= $loginSession['name']; ?></button>
                    <a href="<?= base_url('/logout'); ?>" class="btn btn-outline-primary">Keluar</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</nav>
