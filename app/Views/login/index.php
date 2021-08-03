<!-- use base template -->
<?= $this->extend('layouts/templates/base'); ?>


<!-- CUSTOM STYLES SECTION -->
<?= $this->section('custom-styles'); ?>

<link rel="stylesheet" href="<?= base_url('/styles/css/login.css'); ?>">

<?= $this->endSection(); ?>


<!-- CONTENT SECTION -->
<?= $this->section('content'); ?>

<div class="wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="box left-box col-lg-6 order-sm-last">
                <div class="container text-center">
                    <a href="<?= base_url('/'); ?>">
                        <img class="cover" src="<?= base_url('/assets/brand-cover.jpg'); ?>" alt="brand cover">
                    </a>
                    <h3><strong>Yang Bekas Pasti Lebih Murah!</strong></h3>
                </div>
            </div>
            <div class="box right-box col-lg-6 bg-light">
                <div class="login-box">
                    <div class="card shadow">
                        <div class="card-body">
                            <section class="container mb-3 d-flex justify-content-between align-items-center">
                                <h1 class="title">Masuk</h1>
                                <a href="<?= base_url('/'); ?>" class="icon-btn" data-bs-toggle="tooltip" data-bs-placement="top" title="Ke Beranda">
                                    <i class="material-icons-outlined">close</i>
                                </a>
                            </section>
                            <section class="container">
                                <form action="<?= base_url('/login'); ?>" method="post">
                                    <?= csrf_field(); ?>
                                    <input type="hidden" name="redirect" value="">
                                    <div class="field">
                                        <label for="email" class="form-label">Email</label>
                                        <div class="input-group">
                                            <div class="input-group-text">
                                                <label for="email" class="d-flex">
                                                    <i class="material-icons">email</i>
                                                </label>
                                            </div>
                                            <input type="email" name="email" id="email" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="field password-field">
                                        <label for="password" class="form-label">Kata Sandi</label>
                                        <div class="input-group">
                                            <div class="input-group-text">
                                                <label for="password" class="d-flex">
                                                    <i class="material-icons">vpn_key</i>
                                                </label>
                                            </div>
                                            <input type="password" name="password" id="password" class="form-control" required>
                                            <button type="button" class="input-group-text btn show-password-toggle">
                                                <i class="material-icons">visibility_off</i>
                                            </button>
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
                                    <div class="field text-center">
                                        <p>Belum punya akun? <a href="<?= base_url('/register'); ?>">Daftar</a></p>
                                    </div>
                                </form>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>


<!-- CUSTOM SCRIPTS SECTION -->
<?= $this->section('custom-scripts'); ?>

<?= $this->endSection(); ?>
