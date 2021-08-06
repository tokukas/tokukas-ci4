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
                    <h2 class="title">Masukkan Kode Verifikasi</h2>
                </section>
                <section class="container mb-3">
                    <p class="text-center">Masukkan kode verifikasi yang sudah kami kirimkan ke email <strong><?= $verificator['email']; ?></strong></p>
                    <form action="<?= base_url('/register/verify'); ?>" method="post">
                        <?= csrf_field(); ?>
                        <input type="hidden" name="verification_id" value="<?= $verificator['id']; ?>">
                        <div class="field">
                            <label for="verificationCode" class="form-label">Kode Verifikasi</label>
                            <div class="input-group">
                                <div class="input-group-text">
                                    <label for="verificationCode" class="d-flex">
                                        <i class="material-icons">pin</i>
                                    </label>
                                </div>
                                <input type="text" name="verification_code" id="verificationCode" class="form-control" required>
                            </div>
                        </div>
                        <div class="field d-flex">
                            <button type="submit" class="btn btn-primary flex-fill"><strong>Verifikasi</strong></button>
                        </div>
                    </form>
                    <hr>
                    <div class="text-center">
                        <p class="m-0">Tidak menerima kode?</p>
                        <span class="form-text">Coba cek di folder spam atau sampah anda, atau</span>
                        <form action="<?= base_url('/register'); ?>" method="post">
                            <input type="hidden" name="email" value="<?= $verificator['email']; ?>">
                            <button type="submit" class="resend-otp btn btn-link btn-sm p-0">Kirim Ulang Kode</button>
                        </form>
                    </div>
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
