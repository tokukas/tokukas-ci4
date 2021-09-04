<!-- use base template -->
<?= $this->extend('layouts/templates/new-offer'); ?>

<!-- CUSTOM STYLES SECTION -->
<?= $this->section('custom-styles'); ?>


<?= $this->endSection(); ?>


<!-- FORM CONTENT SECTION -->
<?= $this->section('form-content'); ?>

<?php

$paymentId = session('new_offer')['payment_id'];
$method = $paymentMethod->find($paymentId);

?>

<div class="card">
    <div class="card-body content">
        <form action="<?= base_url('offer/new/4'); ?>" method="post">
            <?= csrf_field(); ?>

            <!-- STEP 3.2 -->
            <div class="row mb-3">
                <h2>Pilih Metode Pembayaran</h2>
            </div>

            <div class="row mb-3">
                <div class="col-sm-12 col-md-4 my-2">
                    <div class="card">
                        <div class="card-body text-center">
                            <div class="card-title fw-bold">Metode yang dipilih</div>
                            <picture draggable="false">
                                <source media="(min-width: 640px)" srcset="<?= empty($method['logos'][1]) ? '' : base_url('assets/' . $method['logos'][1]); ?>">
                                <img src="<?= base_url('assets/' . $method['logos'][0]); ?>" alt="Logo <?= $method['name'] ?>" height="60" width="auto" draggable="false">
                            </picture>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-8 my-2">
                    <div class="card">
                        <div class="card-body">

                            <?php if ($paymentType === 'PAYMENT_SERVICE') : ?>
                                <div class="form-input mb-3">
                                    <label for="destNumInput" class="form-label">Nomor Telepon Tujuan :</label>
                                    <div class="input-group">
                                        <div class="input-group-text">
                                            <i id="icon" class="fas fa-phone"></i>
                                        </div>
                                        <input type="tel" name="payment_destination" id="destNumInput" class="form-control" placeholder="Contoh : 0812345678" required>
                                    </div>
                                    <div class="form-text">Gunakan nomor telepon yang terdaftar pada <strong translate="no"><?= $method['name']; ?></strong>.</div>
                                </div>
                                <hr>
                                <p class="fw-bold text-danger mb-2">Pastikan nomor telepon yang anda masukkan benar!</p>
                                <p style="font-size: smaller;">TOKUKAS <strong>tidak akan bertanggung jawab</strong> atas semua kerugian akibat kesalahan data nomor telepon yang anda berikan.</p>

                            <?php else : ?>
                                <div class="form-input mb-3">
                                    <label for="destNumInput" class="form-label">Nomor Rekening Tujuan :</label>
                                    <div class="input-group">
                                        <div class="input-group-text">
                                            <i id="icon" class="fas fa-credit-card"></i>
                                        </div>
                                        <input type="text" name="payment_destination" id="destNumInput" class="form-control" placeholder="Contoh : 12345678" required>
                                    </div>
                                    <div class="form-text">Gunakan nomor rekening <strong translate="no"><?= $method['fullname']; ?> (<?= $method['name']; ?>)</strong>.</div>
                                </div>
                                <div class="form-input mb-3">
                                    <label for="destNumInput2" class="form-label">Atas Nama :</label>
                                    <div class="input-group">
                                        <div class="input-group-text">
                                            <i id="icon" class="fas fa-id-card"></i>
                                        </div>
                                        <input type="text" name="payment_destination_name" id="destNumInput2" class="form-control" placeholder="Contoh : Budi Budiman" required>
                                    </div>
                                </div>
                                <hr>
                                <p class="fw-bold text-danger mb-2">Pastikan nomor rekening yang anda masukkan benar!</p>
                                <p style="font-size: smaller;">TOKUKAS <strong>tidak akan bertanggung jawab</strong> atas semua kerugian akibat kesalahan data rekening yang anda berikan.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

            <div id="transferDestField" class="row mb-3">
                <div class="col-12">
                </div>
            </div>


            <div class="row">
                <div class="btn-navigate">
                    <a href="<?= base_url('offer/new/4'); ?>" class="btn btn-outline-secondary">
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
