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
                <section class="container mb-3 d-flex gap-3 justify-content-start align-items-center">
                    <a href="<?= base_url('register'); ?>" class="icon-btn">
                        <i class="material-icons">arrow_back</i>
                    </a>
                    <h1 class="title">Daftar</h1>
                </section>
                <section class="container">
                    <form action="<?= base_url('register/new'); ?>" method="post" data-form-loading="true">
                        <?= csrf_field(); ?>
                        <input type="hidden" name="id" value="<?= $verificator['id']; ?>">
                        <div class="field">
                            <label for="email" class="form-label">Email</label>
                            <div class="input-group">
                                <div class="input-group-text">
                                    <label for="email" class="d-flex">
                                        <i class="material-icons">email</i>
                                    </label>
                                </div>
                                <input type="email" id="email" class="form-control" value="<?= $verificator['email']; ?>" disabled>
                                <a href="<?= base_url('register'); ?>" class="btn btn-outline-secondary" data-bs-toggle="tooltip" data-bs-placement="top" title="Ubah Email">
                                    <i class="material-icons">edit</i>
                                </a>
                            </div>
                        </div>
                        <div class="field">
                            <label for="fullname" class="form-label">Nama Lengkap</label>
                            <div class="input-group">
                                <div class="input-group-text">
                                    <label for="fullname" class="d-flex">
                                        <i class="material-icons">badge</i>
                                    </label>
                                </div>
                                <input type="text" name="fullname" id="fullname" class="form-control <?= ($validation->hasError('fullname')) ? 'is-invalid' : ''; ?>" value="<?= old('fullname') ?: ''; ?>" required>
                                <?php if ($validation->hasError('fullname')) : ?>
                                    <div class="invalid-feedback"><?= $validation->getError('fullname'); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="field password-field">
                            <label for="password" class="form-label">Kata Sandi</label>
                            <div class="input-group">
                                <div class="input-group-text">
                                    <label for="password" class="d-flex">
                                        <i class="material-icons">lock</i>
                                    </label>
                                </div>
                                <input type="password" name="password" id="password" class="form-control <?= ($validation->hasError('password')) ? 'is-invalid' : ''; ?>" required>
                                <button type="button" class="input-group-text btn show-password-toggle">
                                    <i class="material-icons">visibility_off</i>
                                </button>
                                <?php if ($validation->hasError('password')) : ?>
                                    <div class="invalid-feedback"><?= $validation->getError('password'); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="field password-field">
                            <label for="cpassword" class="form-label">Konfirmasi Kata Sandi</label>
                            <div class="input-group">
                                <div class="input-group-text">
                                    <label for="cpassword" class="d-flex">
                                        <i class="material-icons">vpn_key</i>
                                    </label>
                                </div>
                                <input type="password" name="cpassword" id="cpassword" class="form-control <?= ($validation->hasError('cpassword')) ? 'is-invalid' : ''; ?>" required>
                                <button type="button" class="input-group-text btn show-password-toggle">
                                    <i class="material-icons">visibility_off</i>
                                </button>
                                <?php if ($validation->hasError('cpassword')) : ?>
                                    <div class="invalid-feedback"><?= $validation->getError('cpassword'); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="field d-flex">
                            <button type="submit" class="btn btn-spinner btn-primary flex-fill">
                                <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                                <span class="btn-name" data-loading-name="Mendaftarkan Akun ..."><strong>Daftar</strong></span>
                            </button>
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
