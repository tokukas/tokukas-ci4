<!-- use template -->
<?= $this->extend('layouts/templates/two-sides'); ?>


<!-- CUSTOM STYLES SECTION -->
<?= $this->section('custom-styles'); ?>

<link rel="preload" href="<?= base_url('styles/css/login.css'); ?>" as="style" onload="this.onload=null;this.rel='stylesheet'">
<noscript>
    <link rel="stylesheet" href="<?= base_url('styles/css/login.css'); ?>">
</noscript>

<?= $this->endSection(); ?>


<!-- LEFT BOX SECTION -->
<?= $this->section('left-box'); ?>


<div class="left-box bg-light">
    <div class="login-box">
        <div class="card shadow">
            <div class="card-body">
                <section class="container mb-3 d-flex justify-content-between align-items-center">
                    <h1 class="title">Masuk</h1>
                    <a href="<?= base_url(); ?>" class="icon-btn" data-bs-toggle="tooltip" data-bs-placement="top" title="Ke Beranda">
                        <i class="material-icons">close</i>
                    </a>
                </section>
                <section class="container">
                    <form action="<?= base_url('login'); ?>" method="post">
                        <?= csrf_field(); ?>
                        <input type="hidden" name="redirect" value="<?= $redirect; ?>">
                        <div class="field">
                            <label for="email" class="form-label">Email</label>
                            <div class="input-group">
                                <div class="input-group-text">
                                    <div class="d-flex">
                                        <i class="material-icons">email</i>
                                    </div>
                                </div>
                                <input type="email" name="email" id="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" class="form-control <?= ($validation->hasError('email')) ? 'is-invalid' : ''; ?>" required>
                                <?php if ($validation->hasError('email')) : ?>
                                    <div class="invalid-feedback"><?= $validation->getError('email'); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="field password-field">
                            <label for="password" class="form-label">Kata Sandi</label>
                            <div class="input-group">
                                <div class="input-group-text">
                                    <div class="d-flex">
                                        <i class="material-icons">vpn_key</i>
                                    </div>
                                </div>
                                <input type="password" name="password" id="password" class="form-control <?= ($validation->hasError('password')) ? 'is-invalid' : ''; ?>" required>
                                <button type="button" class="input-group-text btn show-password-toggle">
                                    <i class="material-icons">visibility_off</i>
                                </button>
                                <?php if ($validation->hasError('password')) : ?>
                                    <div class="invalid-feedback"><?= $validation->getError('password'); ?></div>
                                <?php endif; ?>
                            </div>
                            <div class="mt-2">
                                <a href="#">Lupa kata sandi?</a>
                            </div>
                        </div>
                        <div class="field">
                            <div class="form-check">
                                <input type="checkbox" name="remember_me" id="rememberMe" class="form-check-input">
                                <label for="rememberMe" class="form-check-label">Ingat saya</label>
                            </div>
                        </div>
                        <div class="field d-flex">
                            <button type="submit" class="btn btn-primary flex-fill"><strong>Masuk</strong></button>
                        </div>
                        <hr>
                        <div class="field text-center">
                            <p>Belum punya akun? <a href="<?= base_url('register'); ?>">Daftar</a></p>
                        </div>
                    </form>
                </section>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>


<!-- RIGHT BOX SECTION -->
<?= $this->section('right-box'); ?>

<div class="right-box">
    <div class="container text-center">
        <a href="<?= base_url(); ?>">
            <picture>
                <source media="(min-width: 720px)" srcset="<?= base_url('assets/brand-cover-480w.jpg'); ?>">
                <img class="cover" src="<?= base_url('assets/brand-cover-360w.jpg'); ?>" alt="Brand Cover TOKUKAS" height="160" width="50%">
            </picture>
        </a>
        <p class="h3"><strong>Yang Bekas Pasti Lebih Murah!</strong></p>
    </div>
</div>

<?= $this->endSection(); ?>


<!-- CUSTOM SCRIPTS SECTION -->
<?= $this->section('custom-scripts'); ?>

<script src="<?= base_url('scripts/js/form.js'); ?>" defer></script>

<?= $this->endSection(); ?>
