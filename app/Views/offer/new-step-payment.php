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
                <div class="col-lg-4 col-md-6 mb-3">
                    <div class="card p-0">
                        <div class="card-body py-2 d-flex gap-2 align-items-center">
                            <div class="d-block">
                                <!-- PAKAI NO. TELP -->
                                <input type="radio" name="payment_id" id="methodOpt1" class="form-check-input" value="ShopeePay" required checked>
                            </div>
                            <div class="d-block">
                                <label translate="no" for="methodOpt1" title="ShopeePay" aria-label="ShopeePay" class="form-check-label" data-bs-toggle="tooltip" data-bs-placement="top">
                                    <picture>
                                        <source media="(min-width: 640px)" srcset="<?= base_url('assets/logo-shopeepay-16x9-480w.png'); ?>">
                                        <img src="<?= base_url('assets/logo-shopeepay-16x9-240w.png'); ?>" alt="Logo ShopeePay" height="60" width="auto">
                                    </picture>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-3">
                    <div class="card p-0">
                        <div class="card-body py-2 d-flex gap-2 align-items-center">
                            <div class="d-block">
                                <!-- PAKAI NO. TELP -->
                                <input type="radio" name="payment_id" id="methodOpt2" class="form-check-input" value="OVO" required>
                            </div>
                            <div class="d-block">
                                <label translate="no" for="methodOpt2" title="OVO" aria-label="OVO" class="form-check-label" data-bs-toggle="tooltip" data-bs-placement="top">
                                    <picture>
                                        <source media="(min-width: 640px)" srcset="<?= base_url('assets/logo-ovo-16x9-480w.png'); ?>">
                                        <img src="<?= base_url('assets/logo-ovo-16x9-240w.png'); ?>" alt="Logo OVO" height="60" width="auto">
                                    </picture>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-3">
                    <div class="card p-0">
                        <div class="card-body py-2 d-flex gap-2 align-items-center">
                            <div class="d-block">
                                <!-- PAKAI NO. TELP / NO. REKENING + NAMA BANK -->
                                <input type="radio" name="payment_id" id="methodOpt3" class="form-check-input" value="LinkAja" required>
                            </div>
                            <div class="d-block">
                                <label translate="no" for="methodOpt3" title="LinkAja" aria-label="LinkAja" class="form-check-label" data-bs-toggle="tooltip" data-bs-placement="top">
                                    <picture>
                                        <source media="(min-width: 640px)" srcset="<?= base_url('assets/logo-linkaja-160h.png'); ?>">
                                        <img src="<?= base_url('assets/logo-linkaja-160h.png'); ?>" alt="Logo LinkAja" height="60" width="auto">
                                    </picture>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-3">
                    <div class="card p-0">
                        <div class="card-body py-2 d-flex gap-2 align-items-center">
                            <div class="d-block">
                                <!-- PAKAI NO. TELP -->
                                <input type="radio" name="payment_id" id="methodOpt4" class="form-check-input" value="GoPay" required>
                            </div>
                            <div class="d-block">
                                <label translate="no" for="methodOpt4" title="GoPay" aria-label="GoPay" class="form-check-label" data-bs-toggle="tooltip" data-bs-placement="top">
                                    <picture>
                                        <source media="(min-width: 640px)" srcset="<?= base_url('assets/logo-gopay-16x9-480w.png'); ?>">
                                        <img src="<?= base_url('assets/logo-gopay-16x9-240w.png'); ?>" alt="Logo GoPay" height="60" width="auto">
                                    </picture>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-3">
                    <div class="card p-0">
                        <div class="card-body py-2 d-flex gap-2 align-items-center">
                            <div class="d-block">
                                <!-- PAKAI NO. REKENING -->
                                <input type="radio" name="payment_id" id="methodOpt5" class="form-check-input" value="Rekening BNI" required>
                            </div>
                            <div class="d-block">
                                <label translate="no" for="methodOpt5" title="Rekening BNI" aria-label="Rekening BNI" class="form-check-label" data-bs-toggle="tooltip" data-bs-placement="top">
                                    <picture>
                                        <source media="(min-width: 640px)" srcset="<?= base_url('assets/logo-bni-16x9-480w.png'); ?>">
                                        <img src="<?= base_url('assets/logo-bni-16x9-240w.png'); ?>" alt="Logo BNI" height="60" width="auto">
                                    </picture>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-3">
                    <div class="card p-0">
                        <div class="card-body py-2 d-flex gap-2 align-items-center">
                            <div class="d-block">
                                <input type="radio" name="payment_id" id="methodOpt6" class="form-check-input" value="Tunai" required>
                            </div>
                            <div class="d-block">
                                <label translate="no" for="methodOpt6" title="Tunai" aria-label="Tunai" class="form-check-label" data-bs-toggle="tooltip" data-bs-placement="top">
                                    <div class="cash-payment">
                                        <i class="fas fa-money-bill-wave-alt fa-lg" translate="no"></i>
                                        <strong class="fw-bold">Tunai</strong>
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
