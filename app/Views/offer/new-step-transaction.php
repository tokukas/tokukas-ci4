<!-- use base template -->
<?= $this->extend('layouts/templates/new-offer'); ?>

<!-- CUSTOM STYLES SECTION -->
<?= $this->section('custom-styles'); ?>


<?= $this->endSection(); ?>


<!-- FORM CONTENT SECTION -->
<?= $this->section('form-content'); ?>

<div class="card">
    <div class="card-body content">
        <form action="<?= base_url('offer/new/2'); ?>" method="post">
            <?= csrf_field(); ?>

            <!-- STEP 2 -->
            <div class="row mb-2">
                <h2>Pilih Metode Transaksi</h2>
                <p>Metode transaksi apa yang ingin anda lakukan?</p>
            </div>

            <div class="row mb-2">
                <div class="col-lg-6 mb-3">
                    <div class="card p-0">
                        <div class="card-body">
                            <div class="form-check">
                                <input type="radio" name="transaction_method" id="methodOpt1" class="form-check-input" value="online" required <?= $selectedTransactionMethod === 'online' ? 'checked' : ''; ?>>
                                <label for="methodOpt1" class="form-check-label card-title fw-bold">Transaksi Online</label>
                            </div>
                            <p class="card-text">Transaksi dilakukan secara jarak jauh antara anda dengan TOKUKAS. <a href="">Lihat Ketentuan</a>.</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 mb-3">
                    <?php if ($canChoose) : ?>
                        <div class="card p-0">
                            <div class="card-body">
                                <div class="form-check">
                                    <input type="radio" name="transaction_method" id="methodOpt2" class="form-check-input" value="offline" <?= $selectedTransactionMethod === 'offline' ? 'checked' : ''; ?>>
                                    <label for="methodOpt2" class="form-check-label card-title fw-bold">Transaksi Offline</label>
                                </div>
                                <p class="card-text">Transaksi dilakukan secara langsung dengan mendatangi toko. <a href="">Lihat Ketentuan</a>.</p>
                            </div>
                        </div>
                    <?php else : ?>
                        <div class="card p-0">
                            <div class="card-body text-muted">
                                <p class="card-title fw-bold">Transaksi Offline</p>
                                <p class="card-text">Anda <strong>tidak bisa</strong> memilih Transaksi Offline karena lokasi anda terlalu jauh dari toko.</p>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="row">
                <div class="btn-navigate">
                    <a href="<?= base_url('offer/new/1'); ?>" class="btn btn-outline-secondary">
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


<?= $this->endSection(); ?>
