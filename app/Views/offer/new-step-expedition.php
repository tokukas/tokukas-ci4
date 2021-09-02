<!-- use base template -->
<?= $this->extend('layouts/templates/new-offer'); ?>

<!-- CUSTOM STYLES SECTION -->
<?= $this->section('custom-styles'); ?>


<?= $this->endSection(); ?>


<!-- FORM CONTENT SECTION -->
<?= $this->section('form-content'); ?>

<div class="card">
    <div class="card-body content">
        <form action="<?= base_url('offer/new/3'); ?>" method="post">
            <?= csrf_field(); ?>

            <!-- STEP 3 -->
            <div class="row mb-2">
                <div class="col-12">
                    <h2>Pilih Metode Pengiriman</h2>
                </div>
            </div>

            <?php if ($transactionMethod === 'offline') : ?>
                <input type="hidden" name="expedition_id" value="none">
                <div class="row mb-2">
                    <div class="col-12">
                        <p>Anda <strong>tidak perlu</strong> memilih metode pengiriman karena sebelumnya anda memilih Transaksi Offline. Itu berarti anda yang akan mengantarkan bukunya langsung ke toko kami.</p>
                        <p>Silahkan <strong>lanjut</strong> untuk memilih metode pembayaran.</p>
                    </div>
                </div>
            <?php else : ?>
                <div class="row mb-2">
                    <div class="col-12">
                        <p>Jasa ekspedisi mana yang akan anda gunakan untuk mengirimkan buku anda ke toko kami?</p>
                        <p>Anda dapat menggunakan jenis layanan apapun yang disediakan oleh jasa ekspedisi yang anda pilih. <a href="">Lihat Ketentuan</a></p>
                        <p><strong>Catatan :</strong> Pastikan jasa ekspedisi yang anda pilih tersedia di daerah anda!</p>
                    </div>
                </div>

                <div class="row mb-2">
                    <?php $i = 0; ?>
                    <?php foreach ($expeditions as $expedition) : ?>
                        <div class="col-lg-4 col-md-6 mb-3">
                            <div class="card p-0">
                                <div class="card-body py-2 d-flex gap-2 align-items-center">
                                    <div class="d-block">
                                        <?php if (empty($selectedExpedition)) : ?>
                                            <input type="radio" name="expedition_id" id="methodOpt<?= $i; ?>" class="form-check-input" value="<?= $expedition['id']; ?>" <?= ($i === 0) ? 'checked autofocus' : ''; ?> required>
                                        <?php else : ?>
                                            <input type="radio" name="expedition_id" id="methodOpt<?= $i; ?>" class="form-check-input" value="<?= $expedition['id']; ?>" <?= ($expedition['id'] === $selectedExpedition) ? 'checked autofocus' : ''; ?> required>
                                        <?php endif; ?>
                                    </div>
                                    <div class="d-block">
                                        <label translate="no" for="methodOpt<?= $i; ?>" title="<?= $expedition['name']; ?>" aria-label="<?= $expedition['name']; ?>" class="form-check-label" data-bs-toggle="tooltip" data-bs-placement="top">
                                            <picture>
                                                <source media="(min-width: 640px)" srcset="<?= empty($expedition['logos'][1]) ? '' : base_url('assets/' . $expedition['logos'][1]); ?>">
                                                <img src="<?= base_url('assets/' . $expedition['logos'][0]); ?>" alt="Logo <?= $expedition['name']; ?>" height="60" width="auto">
                                            </picture>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php ++$i; ?>
                    <?php endforeach; ?>
                </div>

                <div class="row mb-2">
                    <div class="col-12">
                        <p>Informasi jenis layanan, biaya layanan, wilayah operasional, dan sebagainya dapat anda <strong>lihat pada situs resmi</strong> dari masing-masing jasa ekspedisi berikut.</p>
                        <ul>
                            <?php foreach ($expeditions as $expedition) : ?>
                                <li><a href="<?= $expedition['website']; ?>" rel="noreferrer" target="_blank" translate="no"><?= $expedition['name']; ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            <?php endif; ?>

            <div class="row">
                <div class="col-12">
                    <div class="btn-navigate">
                        <a href="<?= base_url('offer/new/2'); ?>" class="btn btn-outline-secondary">
                            <i class="material-icons">arrow_back</i>
                            <span>Kembali</span>
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <span class="fw-bold">Lanjut</span>
                            <i class="material-icons">arrow_forward</i>
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection(); ?>


<!-- CUSTOM SCRIPTS SECTION -->
<?= $this->section('custom-scripts'); ?>


<?= $this->endSection(); ?>
