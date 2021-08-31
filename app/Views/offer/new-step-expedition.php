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
                <div class="col-12">
                    <h2>Pilih Metode Pengiriman</h2>
                </div>
            </div>

            <?php if ($transactionMethod === 'offline') : ?>
                <div class="row mb-2">
                    <div class="col-12">
                        <p>Anda <strong>tidak perlu</strong> memilih metode pengiriman karena anda memilih Transaksi Offline. Itu berarti anda yang akan mengantarkan bukunya langsung ke toko kami.</p>
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
                    <div class="col-lg-4 col-md-6 mb-3">
                        <div class="card p-0">
                            <div class="card-body py-2 d-flex gap-2 align-items-center">
                                <div class="d-block">
                                    <input type="radio" name="shipping_method" id="methodOpt1" class="form-check-input" value="SiCepat Ekspres" required checked>
                                </div>
                                <div class="d-block">
                                    <label translate="no" for="methodOpt1" title="SiCepat Ekspres" aria-label="SiCepat Ekspres" class="form-check-label" data-bs-toggle="tooltip" data-bs-placement="top">
                                        <picture>
                                            <source media="(min-width: 640px)" srcset="<?= base_url('assets/logo-sicepat-16x9-480w.png'); ?>">
                                            <img src="<?= base_url('assets/logo-sicepat-16x9-240w.png'); ?>" alt="Logo SiCepat Ekspres" height="60" width="auto">
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
                                    <input type="radio" name="shipping_method" id="methodOpt2" class="form-check-input" value="Anteraja">
                                </div>
                                <div class="d-block">
                                    <label translate="no" for="methodOpt2" title="Anteraja" aria-label="Anteraja" class="form-check-label" data-bs-toggle="tooltip" data-bs-placement="top">
                                        <picture>
                                            <source media="(min-width: 640px)" srcset="<?= base_url('assets/logo-anteraja-16x9-480w.png'); ?>">
                                            <img src="<?= base_url('assets/logo-anteraja-16x9-240w.png'); ?>" alt="Logo Anteraja" height="60" width="auto">
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
                                    <input type="radio" name="shipping_method" id="methodOpt3" class="form-check-input" value="iDexpress">
                                </div>
                                <div class="d-block">
                                    <label translate="no" for="methodOpt3" title="iDexpress" aria-label="iDexpress" class="form-check-label" data-bs-toggle="tooltip" data-bs-placement="top">
                                        <picture>
                                            <source media="(min-width: 640px)" srcset="<?= base_url('assets/logo-idexpress-16x9-480w.png'); ?>">
                                            <img src="<?= base_url('assets/logo-idexpress-16x9-240w.png'); ?>" alt="Logo iDexpress" height="60" width="auto">
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
                                    <input type="radio" name="shipping_method" id="methodOpt4" class="form-check-input" value="J&T Express">
                                </div>
                                <div class="d-block">
                                    <label translate="no" for="methodOpt4" title="J&T Express" aria-label="J&T Express" class="form-check-label" data-bs-toggle="tooltip" data-bs-placement="top">
                                        <picture>
                                            <source media="(min-width: 640px)" srcset="<?= base_url('assets/logo-j&t-16x9-480w.png'); ?>">
                                            <img src="<?= base_url('assets/logo-j&t-16x9-240w.png'); ?>" alt="Logo J&T Express" height="60" width="auto">
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
                                    <input type="radio" name="shipping_method" id="methodOpt5" class="form-check-input" value="JNE Express">
                                </div>
                                <div class="d-block">
                                    <label translate="no" for="methodOpt5" title="JNE Express" aria-label="JNE Express" class="form-check-label" data-bs-toggle="tooltip" data-bs-placement="top">
                                        <picture>
                                            <source media="(min-width: 640px)" srcset="<?= base_url('assets/logo-jne-16x9-480w.png'); ?>">
                                            <img src="<?= base_url('assets/logo-jne-16x9-240w.png'); ?>" alt="Logo JNE Express" height="60" width="auto">
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
                                    <input type="radio" name="shipping_method" id="methodOpt6" class="form-check-input" value="TIKI">
                                </div>
                                <div class="d-block">
                                    <label translate="no" for="methodOpt6" title="TIKI" aria-label="TIKI" class="form-check-label" data-bs-toggle="tooltip" data-bs-placement="top">
                                        <picture>
                                            <source media="(min-width: 640px)" srcset="<?= base_url('assets/logo-tiki-16x9-480w.png'); ?>">
                                            <img src="<?= base_url('assets/logo-tiki-16x9-240w.png'); ?>" alt="Logo TIKI" height="60" width="auto">
                                        </picture>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mb-2">
                    <div class="col-12">
                        <p>Informasi jenis layanan, biaya layanan, wilayah operasional, dan sebagainya dapat anda <strong>lihat pada situs resmi</strong> dari masing-masing jasa ekspedisi berikut.</p>
                        <ul>
                            <li><a href="https://www.sicepat.com" rel="noreferrer" target="_blank" translate="no">SiCepat Ekspes</a></li>
                            <li><a href="https://anteraja.id" rel="noreferrer" target="_blank" translate="no">Anteraja</a></li>
                            <li><a href="https://idexpress.com" rel="noreferrer" target="_blank" translate="no">iDexpress</a></li>
                            <li><a href="https://www.jet.co.id" rel="noreferrer" target="_blank" translate="no">J&T Express</a></li>
                            <li><a href="https://www.jne.co.id" rel="noreferrer" target="_blank" translate="no">JNE Express</a></li>
                            <li><a href="https://www.tiki.id" rel="noreferrer" target="_blank" translate="no">TIKI</a></li>
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
