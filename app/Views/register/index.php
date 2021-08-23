<!-- use template -->
<?= $this->extend('layouts/templates/two-sides'); ?>


<!-- CUSTOM STYLES SECTION -->
<?= $this->section('custom-styles'); ?>

<link rel="preload" href="<?= base_url('styles/css/register.css'); ?>" as="style" onload="this.onload=null;this.rel='stylesheet'">
<noscript>
    <link rel="stylesheet" href="<?= base_url('styles/css/register.css'); ?>">
</noscript>

<?= $this->endSection(); ?>


<!-- LEFT BOX SECTION -->
<?= $this->section('left-box'); ?>

<div class="left-box bg-light">
    <div class="login-box">
        <div class="card shadow">
            <div class="card-body">
                <section class="container mb-3 d-flex justify-content-between align-items-center">
                    <h1 class="title">Daftar</h1>
                    <a href="<?= base_url(); ?>" class="icon-btn" data-bs-toggle="tooltip" data-bs-placement="top" title="Ke Beranda">
                        <i class="material-icons">close</i>
                    </a>
                </section>
                <section class="container">
                    <form action="<?= base_url('register'); ?>" method="post" data-form-loading="true">
                        <?= csrf_field(); ?>
                        <div class="field">
                            <label for="email" class="form-label d-inline-flex gap-1 align-items-center">
                                <span>Email</span>
                                <i class="material-icons" style="font-size: 1rem; width: 1rem; height: 1rem;" data-bs-toggle="tooltip" data-bs-placement="right" title="Kode verifikasi akan dikirimkan ke email ini.">information</i>
                            </label>
                            <div class="input-group">
                                <div class="input-group-text">
                                    <div class="d-flex">
                                        <i class="material-icons">email</i>
                                    </div>
                                </div>
                                <input type="email" name="email" id="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" class="form-control <?= ($validation->hasError('email')) ? 'is-invalid' : ''; ?>" value="<?= old('email') ?: ''; ?>" required>
                                <?php if ($validation->hasError('email')) : ?>
                                    <div class="invalid-feedback"><?= $validation->getError('email'); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="field text-center">
                            <p class="form-text text-dark">Dengan mendaftar, anda menyetujui <a href="<?= base_url('terms'); ?>">Syarat Penggunaan</a> dan <a href="<?= base_url('privacy'); ?>">Kebijakan Privasi</a>.</p>
                        </div>
                        <div class="field d-flex">
                            <button type="submit" class="btn btn-spinner btn-primary flex-fill">
                                <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                                <span class="btn-name" data-loading-name="Harap Tunggu ..."><strong>Daftar</strong></span>
                            </button>
                        </div>
                        <hr>
                        <div class="field text-center">
                            <p>Sudah punya akun? <a href="<?= base_url('login'); ?>">Masuk</a></p>
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
                <img class="cover" src="<?= base_url('assets/brand-cover-360w.jpg'); ?>" alt="Brand Cover TOKUKAS" height="160" width="100%">
            </picture>
        </a>
        <p class="h3"><strong>Yang Bekas Pasti Lebih Murah!</strong></p>
        <hr>
        <p>Anda baru dapat melakukan penjualan buku setelah anda memiliki akun.</p>
    </div>
</div>

<?= $this->endSection(); ?>


<!-- CUSTOM SCRIPTS SECTION -->
<?= $this->section('custom-scripts'); ?>

<script src="<?= base_url('scripts/js/form.js'); ?>" defer></script>

<?= $this->endSection(); ?>
