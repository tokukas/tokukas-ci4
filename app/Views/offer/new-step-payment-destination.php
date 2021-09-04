<!-- use base template -->
<?= $this->extend('layouts/templates/new-offer'); ?>

<!-- CUSTOM STYLES SECTION -->
<?= $this->section('custom-styles'); ?>


<?= $this->endSection(); ?>


<!-- FORM CONTENT SECTION -->
<?= $this->section('form-content'); ?>

<div class="card">
    <div class="card-body content">
        <form action="<?= base_url('offer/new/4'); ?>" method="post">
            <?= csrf_field(); ?>

            <!-- STEP 3 -->
            <div class="row mb-3">
                <h2>Pilih Metode Pembayaran</h2>
                <p>Metode pembayaran mana yang harus kami gunakan untuk mengirimkan uang pembayaran buku anda?</p>
            </div>

            <div id="transferDestField" class="row mb-3 d-none">
                <div class="col-md-12 col-lg-6 mb-3">
                    <div class="form-input">
                        <label for="destNumInput" class="form-label"></label>
                        <div class="input-group">
                            <div class="input-group-text">
                                <i id="icon" class="fas fa-money-check"></i>
                            </div>
                            <input type="tel" name="payment_destination" id="destNumInput" class="form-control">
                        </div>
                        <div class="form-text">Gunakan nomor telepon yang terdaftar pada layanan pembayaran yang anda pilih.</div>
                    </div>
                </div>
                <div class="col-md-12 col-lg-6 mb-3">
                    <p class="fw-bold text-danger mb-2">Pastikan nomor telepon atau nomor rekening yang anda masukkan benar!</p>
                    <p style="font-size: smaller;">TOKUKAS <strong>tidak akan bertanggung jawab</strong> atas semua kerugian akibat kesalahan nomor telepon atau nomor rekening yang anda berikan.</p>
                </div>
            </div>


            <div class="row">
                <div class="btn-navigate">
                    <a href="<?= base_url('offer/new/3'); ?>" class="btn btn-outline-secondary">
                        <i class="material-icons">arrow_back</i>
                        <span>Kembali</span>
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <span class="fw-bold">Lanjut</span>
                        <i class="material-icons">arrow_forward</i>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection(); ?>


<!-- CUSTOM SCRIPTS SECTION -->
<?= $this->section('custom-scripts'); ?>

<script src="<?= base_url('scripts/js/offer-new-payment.js'); ?>" defer></script>

<?= $this->endSection(); ?>
