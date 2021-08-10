<!-- use base template -->
<?= $this->extend('layouts/templates/base'); ?>

<!-- CUSTOM STYLES SECTION -->
<?= $this->section('custom-styles'); ?>

<link rel="stylesheet" href="<?= base_url('/styles/css/navbar.css'); ?>">
<link rel="stylesheet" href="<?= base_url('/styles/css/footer.css'); ?>">

<?= $this->endSection(); ?>


<!-- CONTENT SECTION -->
<?= $this->section('content'); ?>

<header>
    <!-- import top navbar -->
    <?= $this->include('layouts/components/navbar'); ?>
</header>

<main id="top">

    <?= $this->renderSection('main'); ?>

</main>

<!-- import footer -->
<?= $this->include('layouts/components/footer'); ?>

<?= $this->endSection(); ?>


<!-- CUSTOM SCRIPTS SECTION -->
<?= $this->section('custom-scripts'); ?>

<script src="<?= base_url('/scripts/js/navbar.js'); ?>"></script>

<?= $this->endSection(); ?>
