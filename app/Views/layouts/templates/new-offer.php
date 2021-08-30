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

        </div>
        <div class="col-lg-9 col-md-12">

            <?= $this->renderSection('form-content'); ?>

        </div>
    </div>
</section>

<?= $this->endSection(); ?>


<!-- CUSTOM SCRIPTS SECTION -->
<?= $this->section('custom-scripts'); ?>

<script src="<?= base_url('scripts/js/offer-new.js'); ?>" defer></script>

<?= $this->endSection(); ?>
