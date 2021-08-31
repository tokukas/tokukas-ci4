<!-- use base template -->
<?= $this->extend('layouts/templates/main'); ?>


<!-- CUSTOM STYLES SECTION -->
<?= $this->section('custom-styles'); ?>

<link rel="preload" href="<?= base_url('styles/css/offer-new.css'); ?>" as="style" onload="this.onload=null;this.rel='stylesheet'">
<noscript>
    <link rel="stylesheet" href="<?= base_url('styles/css/offer-new.css'); ?>">
</noscript>

<?= $this->endSection(); ?>


<!-- MAIN SECTION -->
<?= $this->section('main'); ?>

<section class="container-md p-4">
    <div class="row mb-3">
        <h1>Buat Penawaran</h1>
        <hr>
    </div>
    <div class="row mb-3">
        <div class="col-lg-3 col-md-12 mb-4">

            <?= $this->include('layouts/components/new-offer-step'); ?>
            <hr>

            <div class="d-flex w-100">
                <a href="<?= base_url('offer/new/cancel'); ?>" class="btn btn-outline-danger flex-fill" data-bs-toggle="modal" data-bs-target="#confirmCancelingModal">
                    <i class="material-icons" translate="no">close</i>
                    <span>Batalkan Penawaran</span>
                </a>
            </div>

        </div>
        <div class="col-lg-9 col-md-12">

            <?= $this->renderSection('form-content'); ?>

        </div>
    </div>
</section>

<!-- Cancelling Offer Modal -->
<div class="modal fade" id="confirmCancelingModal" tabindex="-1" aria-labelledby="confirmCancelingModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmCancelingModalLabel">Konfirmasi Pembatalan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <span>Anda yakin ingin <strong>membatalkan penawaran</strong>?</span>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Kembali</button>
                <a href="<?= base_url('offer/new/cancel'); ?>" class="btn btn-outline-danger">Ya, Batalkan Penawaran</a>
            </div>
        </div>
    </div>
</div>


<?= $this->endSection(); ?>


<!-- CUSTOM SCRIPTS SECTION -->
<?= $this->section('custom-scripts'); ?>

<script src="<?= base_url('scripts/js/offer-new.js'); ?>" defer></script>

<?= $this->endSection(); ?>
