<!-- use base template -->
<?= $this->extend('layouts/templates/new-offer'); ?>

<!-- CUSTOM STYLES SECTION -->
<?= $this->section('custom-styles'); ?>


<?= $this->endSection(); ?>


<!-- FORM CONTENT SECTION -->
<?= $this->section('form-content'); ?>

<div class="card">
    <div class="card-body content">
        <form action="<?= base_url('offer/new/1'); ?>" method="post">
            <?= csrf_field(); ?>

            <!-- STEP 1 -->
            <input id="addressIdStorage" type="hidden" name="address_id" value="<?= $selectedAddressId; ?>">
            <div class="row mb-2">
                <h2>Dimana Lokasi Anda?</h2>
                <p>Kami membutuhkan alamat anda untuk menentukan opsi metode transaksi yang dapat anda lakukan, serta melakukan estimasi jarak ataupun biaya pengiriman.</p>
                <p>Transaksi offline (tatap muka) hanya dapat dilakukan bagi anda yang beralamat di sekitar <a href="https://www.google.com/maps/search/tokukas" rel="noreferrer" target="_blank">lokasi TOKUKAS</a>.</p>
            </div>

            <div class="row mb-2">
                <div class="cards-scroll">
                    <?php foreach ($myAddresses as $address) : ?>
                        <div class="card p-0">
                            <div class="card-header">
                                <span class="card-title m-0"><?= $address['label']; ?></span>
                                <?php if ($address['is_default']) : ?>
                                    <span class="badge bg-primary">Utama</span>
                                <?php endif; ?>
                            </div>
                            <div class="card-body">
                                <p class="card-text" loading="lazy"><?= $address['stringified']; ?></p>
                                <div class="d-flex">
                                    <?php if ($address['id'] === $selectedAddressId) : ?>
                                        <button type="button" class="btn btn-outline-primary flex-fill" data-btn="address" data-id="<?= $address['id']; ?>" disabled>
                                            <i class="material-icons">checked</i>
                                            <span>Terpilih</span>
                                        </button>
                                    <?php else : ?>
                                        <button type="button" class="btn btn-outline-secondary flex-fill" data-btn="address" data-id="<?= $address['id']; ?>">
                                            <span>Pilih Alamat</span>
                                        </button>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    <div class="card" style="width: 20rem;">
                        <a href="<?= base_url('address/new'); ?>" class="card-body btn btn-outline-secondary p-4 d-flex flex-column gap-3" style="text-decoration: none;">
                            <i class="material-icons" style="font-size: 2rem;">add_circle_outline</i>
                            <span class="card-text"><strong>Tambah Alamat Baru</strong></span>
                        </a>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="btn-navigate">
                    <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#confirmCancelingModal">
                        <i class="material-icons">arrow_back</i>
                        <span>Kembali</span>
                    </button>
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
