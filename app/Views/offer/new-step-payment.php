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
            <div class="row mb-2">
                <h2>Pilih Metode Pembayaran</h2>
                <p>Metode pembayaran mana yang harus kami gunakan untuk mengirimkan uang pembayaran buku anda?</p>
            </div>

            <div class="row mb-2">
                <?php $i = 0; ?>
                <?php foreach ($paymentMethods as $paymentMethod) : ?>
                    <div class="col-lg-4 col-md-6 mb-3">
                        <div class="card p-0">
                            <div class="card-body py-2 d-flex gap-2 align-items-center">
                                <div class="d-block">
                                    <!-- PAKAI NO. TELP -->
                                    <?php if (empty($selectedPayment)) : ?>
                                        <input type="radio" name="payment_id" id="methodOpt<?= $i; ?>" class="form-check-input" value="<?= $paymentMethod['id']; ?>" <?= ($i === 0) ? 'checked autofocus' : ''; ?> required>
                                    <?php else : ?>
                                        <input type="radio" name="payment_id" id="methodOpt<?= $i; ?>" class="form-check-input" value="<?= $paymentMethod['id']; ?>" <?= ($paymentMethod['id'] === $selectedPayment) ? 'checked autofocus' : ''; ?> required>
                                    <?php endif; ?>
                                </div>
                                <div class="d-block">
                                    <label translate="no" for="methodOpt<?= $i; ?>" title="<?= $paymentMethod['name'] ?>" aria-label="<?= $paymentMethod['name'] ?>" class="form-check-label" data-bs-toggle="tooltip" data-bs-placement="top">
                                        <picture>
                                            <source media="(min-width: 640px)" srcset="<?= empty($paymentMethod['logos'][1]) ? '' : base_url('assets/' . $paymentMethod['logos'][1]); ?>">
                                            <img src="<?= base_url('assets/' . $paymentMethod['logos'][0]); ?>" alt="Logo <?= $paymentMethod['name'] ?>" height="60" width="auto">
                                        </picture>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php ++$i; ?>
                <?php endforeach; ?>
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
