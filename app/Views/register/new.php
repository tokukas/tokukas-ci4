<!-- use template -->
<?= $this->extend('layouts/templates/two-sides'); ?>


<!-- CUSTOM STYLES SECTION -->
<?= $this->section('custom-styles'); ?>

<link rel="stylesheet" href="<?= base_url('/styles/css/register.css'); ?>">

<?= $this->endSection(); ?>


<!-- LEFT BOX SECTION -->
<?= $this->section('left-box'); ?>

<div class="left-box bg-light">
    <div class="login-box">
        <div class="card shadow">
            <div class="card-body">
                <section class="container mb-3 d-flex gap-3 justify-content-start align-items-center">
                    <a href="<?= base_url('/register'); ?>" class="icon-btn">
                        <i class="material-icons-outlined">arrow_back</i>
                    </a>
                    <h1 class="title">Daftar</h1>
                </section>
                <section class="container">
                    <form action="<?= base_url('/register'); ?>" method="post">
                        <?= csrf_field(); ?>
                        <div class="field">
                            <label for="email" class="form-label">Email</label>
                            <div class="input-group">
                                <div class="input-group-text">
                                    <label for="email" class="d-flex">
                                        <i class="material-icons">email</i>
                                    </label>
                                </div>
                                <input type="email" id="email" class="form-control" value="<?= $email; ?>" disabled>
                                <a href="<?= base_url('/register'); ?>" class="btn btn-outline-secondary" data-bs-toggle="tooltip" data-bs-placement="top" title="Ubah Email">
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
                                <input type="text" name="fullname" id="fullname" class="form-control" required>
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
                                <input type="password" name="password" id="password" class="form-control" required>
                                <button type="button" class="input-group-text btn show-password-toggle">
                                    <i class="material-icons">visibility_off</i>
                                </button>
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
                                <input type="password" name="cpassword" id="cpassword" class="form-control" required>
                                <button type="button" class="input-group-text btn show-password-toggle">
                                    <i class="material-icons">visibility_off</i>
                                </button>
                            </div>
                        </div>
                        <div class="field d-flex">
                            <button type="submit" class="btn btn-primary flex-fill"><strong>Daftar</strong></button>
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
        <a href="<?= base_url('/'); ?>">
            <img class="cover" src="<?= base_url('/assets/brand-cover.jpg'); ?>" alt="brand cover">
        </a>
        <h3><strong>Yang Bekas Pasti Lebih Murah!</strong></h3>
        <hr>
        <p>Anda baru dapat melakukan penjualan buku setelah anda memiliki akun.</p>
    </div>
</div>

<?= $this->endSection(); ?>


<!-- CUSTOM SCRIPTS SECTION -->
<?= $this->section('custom-scripts'); ?>

<script src="<?= base_url('/scripts/js/form.js'); ?>"></script>

<?= $this->endSection(); ?>
