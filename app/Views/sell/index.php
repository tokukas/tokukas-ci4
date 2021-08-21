<!-- use base template -->
<?= $this->extend('layouts/templates/main'); ?>


<!-- CUSTOM STYLES SECTION -->
<?= $this->section('custom-styles'); ?>

<link rel="stylesheet" href="<?= base_url('styles/css/sell.css'); ?>">

<?= $this->endSection(); ?>


<!-- MAIN SECTION -->
<?= $this->section('main'); ?>

<section class="container-md py-5 px-4 text-center">
    <div class="mb-4">
        <h3>Sudah Paham Bagaimana Caranya?</h3>
    </div>
    <a class="btn btn-primary" href="<?= base_url('offer/new'); ?>">
        <strong>Buat Penawaran Anda</strong>
    </a>
</section>

<?= $this->endSection(); ?>


<!-- CUSTOM SCRIPTS SECTION -->
<?= $this->section('custom-scripts'); ?>

<?= $this->endSection(); ?>
