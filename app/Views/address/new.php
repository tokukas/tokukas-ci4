<!-- use base template -->
<?= $this->extend('layouts/templates/main'); ?>


<!-- CUSTOM STYLES SECTION -->
<?= $this->section('custom-styles'); ?>

<link rel="stylesheet" href="<?= base_url('/styles/css/address-new.css'); ?>">

<?= $this->endSection(); ?>


<!-- MAIN SECTION -->
<?= $this->section('main'); ?>

<section class="container-md p-4">
    <div class="mb-4">
        <h1>Tambah Alamat</h1>
        <span>Harap isi secara berurutan mulai dari label, provinsi, dan seterusnya.</span>
        <hr>
    </div>
    <form action="<?= base_url('/address/new'); ?>" method="post">
        <div class="row field">
            <div class="col-md-3">
                <label for="addressLabel" class="form-label">Label :</label>
            </div>
            <div class="col-md-9">
                <div class="input-group">
                    <input type="text" name="address_label" id="addressLabel" class="form-control" placeholder="Berikan Label untuk alamat ini." required autofocus>
                </div>
                <span class="form-text example">Contoh : <b>Rumah</b> atau <b>Kosan</b></span>
            </div>
        </div>
        <div class="row field">
            <div class="col-md-3">
                <label for="province" class="form-label">Provinsi :</label>
            </div>
            <div class="col-md-9">
                <div class="input-group">
                    <input type="text" name="province" id="province" class="form-control" placeholder="Ketik nama Provinsi lalu pilih salah satu." required>
                </div>
                <span class="form-text example">Contoh : <b>Jawa Barat</b></span>
            </div>
        </div>
        <div class="row field">
            <div class="col-md-3">
                <label for="regency" class="form-label">Kabupaten / Kota :</label>
            </div>
            <div class="col-md-9">
                <div class="input-group">
                    <input type="text" name="regency" id="regency" class="form-control" placeholder="Ketik nama Kab/Kota lalu pilih salah satu." required>
                </div>
                <span class="form-text example">Contoh : <b>Kabupaten Indramayu</b> atau <b>Kota Bandung</b></span>
            </div>
        </div>
        <div class="row field">
            <div class="col-md-3">
                <label for="district" class="form-label">Kecamatan :</label>
            </div>
            <div class="col-md-9">
                <div class="input-group">
                    <input type="text" name="district" id="district" class="form-control" placeholder="Ketik nama Kecamatan lalu pilih salah satu." required>
                </div>
                <span class="form-text example">Contoh : <b>Indramayu</b></span>
            </div>
        </div>
        <div class="row field">
            <div class="col-md-3">
                <label for="village" class="form-label">Desa / Kelurahan :</label>
            </div>
            <div class="col-md-9">
                <div class="input-group">
                    <input type="text" name="village" id="village" class="form-control" placeholder="Ketik nama Desa/Kelurahan lalu pilih salah satu." required>
                </div>
                <span class="form-text example">Contoh : <b>Pabeanudik</b> atau <b>Margadadi</b></span>
            </div>
        </div>
        <div class="row field">
            <div class="col-md-3">
                <label for="postalCode" class="form-label">Kode Pos :</label>
            </div>
            <div class="col-md-9">
                <div class="input-group">
                    <input type="text" name="postal_code" id="postalCode" class="form-control" placeholder="Masukkan Kode Pos." required>
                </div>
                <span class="form-text example">Contoh : <b>45219</b></span>
            </div>
        </div>
        <div class="row field">
            <div class="col-md-3">
                <label for="street" class="form-label">Jalan :</label>
            </div>
            <div class="col-md-9">
                <div class="input-group">
                    <input type="text" name="street" id="street" class="form-control" placeholder="Tuliskan Jalan, Nomor Rumah, Perumahan, dan lainnya." required>
                </div>
                <span class="form-text example">Contoh : <b>Jalan Pabean Kencana Raya No. 32, Perumahan ...</b> dst.</span>
            </div>
        </div>
        <div class="row field mt-4">
            <div class="field-end">
                <button type="submit" class="btn btn-primary">
                    <i class="material-icons">add_circle_outline</i>
                    <span>Tambah Alamat</span>
                </button>
            </div>
        </div>
    </form>
</section>

<?= $this->endSection(); ?>


<!-- CUSTOM SCRIPTS SECTION -->
<?= $this->section('custom-scripts'); ?>

<script src="<?= base_url('/scripts/js/idn-area-api/index.js'); ?>"></script>
<script src="<?= base_url('/scripts/js/address-form.js'); ?>"></script>

<?= $this->endSection(); ?>
