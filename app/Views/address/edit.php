<!-- use base template -->
<?= $this->extend('layouts/templates/main'); ?>


<!-- CUSTOM STYLES SECTION -->
<?= $this->section('custom-styles'); ?>

<link rel="preload" href="<?= base_url('styles/css/address-new.css'); ?>" as="style" onload="this.onload=null;this.rel='stylesheet'">
<noscript>
    <link rel="stylesheet" href="<?= base_url('styles/css/address-new.css'); ?>">
</noscript>

<?= $this->endSection(); ?>


<!-- MAIN SECTION -->
<?= $this->section('main'); ?>

<section class="container-md p-4">
    <div class="mb-4">
        <div class="d-flex gap-2 align-items-center mb-2">
            <a href="<?= base_url('address'); ?>" class="icon-btn" data-bs-toggle="tooltip" data-bs-placement="top" title="Ke Akun Saya">
                <i class="material-icons">arrow_back</i>
            </a>
            <h1 class="mb-0">Ubah Alamat</h1>
        </div>
        <span>Harap isi secara berurutan mulai dari label, provinsi, dan seterusnya.</span>
        <hr>
    </div>
    <form action="<?= base_url('address/edit/' . $oldAddress['id']); ?>" method="post">
        <?= csrf_field(); ?>
        <input type="hidden" name="_method" value="PATCH">
        <div class="row field">
            <div class="col-md-3">
                <label for="addressLabel" class="form-label">Label :</label>
            </div>
            <div class="col-md-9">
                <div class="input-group">
                    <input type="text" name="label" id="addressLabel" class="form-control <?= ($validation->hasError('label')) ? 'is-invalid' : ''; ?>" value="<?= old('label') ?: $oldAddress['label'] ?: ''; ?>" placeholder="Berikan Label untuk alamat ini." required autofocus>
                </div>
                <?php if ($validation->hasError('label')) : ?>
                    <span class="invalid-feedback d-inline"><?= $validation->getError('label'); ?></span>
                <?php else : ?>
                    <p class="form-text example">Contoh : <b>Rumah</b> atau <b>Kosan</b></p>
                <?php endif; ?>
            </div>
        </div>

        <div class="row field">
            <div class="col-md-3">
                <label for="province" class="form-label">Provinsi :</label>
            </div>
            <div class="col-md-9">
                <div class="input-group">
                    <input type="text" name="province" id="province" class="form-control <?= ($validation->hasError('province')) ? 'is-invalid' : ''; ?>" value="<?= old('province') ?: $oldAddress['province'] ?: ''; ?>" placeholder="Ketik nama Provinsi lalu pilih salah satu." required>
                </div>
                <?php if ($validation->hasError('province')) : ?>
                    <span class="invalid-feedback d-inline"><?= $validation->getError('province'); ?></span>
                <?php else : ?>
                    <span class="form-text example">Contoh : <b>Jawa Barat</b></span>
                <?php endif; ?>
            </div>
        </div>

        <div class="row field">
            <div class="col-md-3">
                <label for="regency" class="form-label">Kabupaten / Kota :</label>
            </div>
            <div class="col-md-9">
                <div class="input-group">
                    <input type="text" name="regency" id="regency" class="form-control <?= ($validation->hasError('regency')) ? 'is-invalid' : ''; ?>" value="<?= old('regency') ?: $oldAddress['regency'] ?: ''; ?>" placeholder="Ketik nama Kab/Kota lalu pilih salah satu." required>
                </div>
                <?php if ($validation->hasError('regency')) : ?>
                    <span class="invalid-feedback d-inline"><?= $validation->getError('regency'); ?></span>
                <?php else : ?>
                    <span class="form-text example">Contoh : <b>Kabupaten Indramayu</b> atau <b>Kota Bandung</b></span>
                <?php endif; ?>
            </div>
        </div>

        <div class="row field">
            <div class="col-md-3">
                <label for="district" class="form-label">Kecamatan :</label>
            </div>
            <div class="col-md-9">
                <div class="input-group">
                    <input type="text" name="district" id="district" class="form-control <?= ($validation->hasError('district')) ? 'is-invalid' : ''; ?>" value="<?= old('district') ?: $oldAddress['district'] ?: ''; ?>" placeholder="Ketik nama Kecamatan lalu pilih salah satu." required>
                </div>
                <?php if ($validation->hasError('district')) : ?>
                    <span class="invalid-feedback d-inline"><?= $validation->getError('district'); ?></span>
                <?php else : ?>
                    <span class="form-text example">Contoh : <b>Indramayu</b></span>
                <?php endif; ?>
            </div>
        </div>

        <div class="row field">
            <div class="col-md-3">
                <label for="village" class="form-label">Desa / Kelurahan :</label>
            </div>
            <div class="col-md-9">
                <div class="input-group">
                    <input type="text" name="village" id="village" class="form-control <?= ($validation->hasError('village')) ? 'is-invalid' : ''; ?>" value="<?= old('village') ?: $oldAddress['village'] ?: ''; ?>" placeholder="Ketik nama Desa/Kelurahan lalu pilih salah satu." required>
                </div>
                <?php if ($validation->hasError('village')) : ?>
                    <span class="invalid-feedback d-inline"><?= $validation->getError('village'); ?></span>
                <?php else : ?>
                    <span class="form-text example">Contoh : <b>Pabeanudik</b> atau <b>Margadadi</b></span>
                <?php endif; ?>
            </div>
        </div>

        <div class="row field">
            <div class="col-md-3">
                <label for="postalCode" class="form-label">Kode Pos :</label>
            </div>
            <div class="col-md-9">
                <div class="input-group">
                    <input type="text" name="postal_code" id="postalCode" class="form-control <?= ($validation->hasError('postal_code')) ? 'is-invalid' : ''; ?>" value="<?= old('postal_code') ?: $oldAddress['postal_code'] ?: ''; ?>" placeholder="Masukkan Kode Pos." required>
                </div>
                <?php if ($validation->hasError('postal_code')) : ?>
                    <span class="invalid-feedback d-inline"><?= $validation->getError('postal_code'); ?></span>
                <?php else : ?>
                    <span class="form-text example">Contoh : <b>45219</b></span>
                <?php endif; ?>
            </div>
        </div>

        <div class="row field">
            <div class="col-md-3">
                <label for="street" class="form-label">Jalan :</label>
            </div>
            <div class="col-md-9">
                <div class="input-group">
                    <input type="text" name="street" id="street" class="form-control <?= ($validation->hasError('street')) ? 'is-invalid' : ''; ?>" value="<?= old('street') ?: $oldAddress['street'] ?: ''; ?>" placeholder="Tuliskan Jalan, Nomor Rumah, Perumahan, dan lainnya." required>
                </div>
                <?php if ($validation->hasError('street')) : ?>
                    <span class="invalid-feedback d-inline"><?= $validation->getError('street'); ?></span>
                <?php else : ?>
                    <p class="form-text example">Contoh : <b>Jalan Pabean Kencana Raya No. 32, Perumahan...</b>, dst.</p>
                <?php endif; ?>
            </div>
        </div>

        <div class="row field mt-4">
            <div class="field-end">
                <button type="submit" class="btn btn-primary">
                    <i class="material-icons">edit</i>
                    <span>Ubah Alamat</span>
                </button>
            </div>
        </div>
    </form>
</section>

<?= $this->endSection(); ?>


<!-- CUSTOM SCRIPTS SECTION -->
<?= $this->section('custom-scripts'); ?>

<script src="<?= base_url('scripts/js/idn-area-api/index.js'); ?>" defer></script>
<script src="<?= base_url('scripts/js/address-form.js'); ?>" defer></script>

<?= $this->endSection(); ?>
