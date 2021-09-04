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

            <!-- STEP 3.1 -->
            <div class="row mb-3">
                <h2>Pilih Metode Pembayaran</h2>
                <p>Metode pembayaran mana yang harus kami gunakan untuk mengirimkan uang pembayaran buku anda?</p>
            </div>

            <?php $i = 0; ?>

            <div class="row mb-3">
                <h3>Transfer Via Layanan Pembayaran</h3>
                <hr>
                <?php foreach ($paymentServices as $paymentService) : ?>
                    <div class="col-lg-4 col-md-6 my-2">
                        <div class="card p-0">
                            <div class="card-body py-2 d-flex gap-3 align-items-center">
                                <div class="d-block">
                                    <?php if (empty($selectedPayment)) : ?>
                                        <input type="radio" name="payment_id" id="methodOpt<?= $i; ?>" class="form-check-input" value="<?= $paymentService['id']; ?>" data-use-phone-number="<?= $paymentService['use_phone_number']; ?>" required>
                                    <?php else : ?>
                                        <input type="radio" name="payment_id" id="methodOpt<?= $i; ?>" class="form-check-input" value="<?= $paymentService['id']; ?>" data-use-phone-number="<?= $paymentService['use_phone_number']; ?>" <?= ($paymentService['id'] === $selectedPayment) ? 'checked' : ''; ?> required>
                                    <?php endif; ?>
                                </div>
                                <div class="d-block">
                                    <label translate="no" for="methodOpt<?= $i; ?>" title="<?= $paymentService['name'] ?>" aria-label="<?= $paymentService['name'] ?>" class="form-check-label" data-bs-toggle="tooltip" data-bs-placement="top">
                                        <picture draggable="false">
                                            <source media="(min-width: 640px)" srcset="<?= empty($paymentService['logos'][1]) ? '' : base_url('assets/' . $paymentService['logos'][1]); ?>">
                                            <img src="<?= base_url('assets/' . $paymentService['logos'][0]); ?>" alt="Logo <?= $paymentService['name'] ?>" height="60" width="auto" draggable="false">
                                        </picture>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php ++$i; ?>
                <?php endforeach; ?>
            </div>

            <div class="row mb-3">
                <h3>Transfer Via Bank</h3>
                <hr>
                <?php foreach ($banks as $bank) : ?>
                    <div class="col-lg-4 col-md-6 my-2">
                        <div class="card p-0">
                            <div class="card-body py-2 d-flex gap-3 align-items-center">
                                <div class="d-block">
                                    <?php if (empty($selectedPayment)) : ?>
                                        <input type="radio" name="payment_id" id="methodOpt<?= $i; ?>" class="form-check-input" value="<?= $bank['id']; ?>" <?= ($i === 0) ? 'checked' : ''; ?> required>
                                    <?php else : ?>
                                        <input type="radio" name="payment_id" id="methodOpt<?= $i; ?>" class="form-check-input" value="<?= $bank['id']; ?>" <?= ($bank['id'] === $selectedPayment) ? 'checked' : ''; ?> required>
                                    <?php endif; ?>
                                </div>
                                <div class="d-block">
                                    <label translate="no" for="methodOpt<?= $i; ?>" title="<?= $bank['name'] ?>" aria-label="<?= $bank['name'] ?>" class="form-check-label" data-bs-toggle="tooltip" data-bs-placement="top">
                                        <picture draggable="false">
                                            <source media="(min-width: 640px)" srcset="<?= empty($bank['logos'][1]) ? '' : base_url('assets/' . $bank['logos'][1]); ?>">
                                            <img src="<?= base_url('assets/' . $bank['logos'][0]); ?>" alt="Logo <?= $bank['name'] ?>" height="60" width="auto" draggable="false">
                                        </picture>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php ++$i; ?>
                <?php endforeach; ?>
            </div>

            <div class="row mb-3">
                <h3>Tunai</h3>
                <hr>
                <div class="col-lg-4 col-md-6 my-2">
                    <div class="card p-0">
                        <div class="card-body py-2 d-flex gap-3 align-items-center">
                            <div class="d-block">
                                <input type="radio" name="payment_id" id="methodOpt<?= $i; ?>" class="form-check-input" value="CASH" <?= ($selectedPayment === 'CASH') ? 'checked' : ''; ?> required>
                            </div>
                            <div class="d-block">
                                <label translate="no" for="methodOpt<?= $i; ?>" title="Tunai" aria-label="Tunai" class="form-check-label" data-bs-toggle="tooltip" data-bs-placement="top">
                                    <div class="d-flex gap-2 align-items-center my-3 text-primary">
                                        <i class="fas fa-money-bill-wave-alt fa-lg"></i>
                                        <span class="h4 m-0 fw-bold">Tunai</span>
                                    </div>
                                </label>
                            </div>
                        </div>
                    </div>
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

<?= $this->endSection(); ?>
